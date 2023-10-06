<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        $this->load->library('upload');
        if ($this->session->userdata('logged_in') != true || $this->session->userdata('role') != 'admin') {
            redirect(base_url() . 'login');
        }
    }

    public function index()
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->num_rows();
        $data['keuangan'] = $this->m_model->get_data('pembayaran')->num_rows();

        $this->load->view('admin/index', $data);
    }
    public function export_guru()
    {	
		$data['data_guru']=$this->m_model->get_data('guru')->result();
		$data['nama']= 'Guru';
		if ($this->uri->segment(3)== 'pdf') {
			$this->load->library('pdf');
			$this->pdf->load_view('admin/export_guru',$data);
			$this->pdf->render();
			$this->pdf->stream('data_guru.pdf', array("Attachment" =>false));


			
		}else {
			$this->load->view('admin/download_guru',$data);
		}

        $this->load->view('admin/export_guru');
    }
    public function  export_siswa(){
		$data['data_siswa']=$this->m_model->get_data('siswa')->result();
		$data['nama']= 'siswa';
		if ($this->uri->segment(3)== 'pdf') {
			$this->load->library('pdf');
			$this->pdf->load_view('admin/export_data_siswa',$data);
			$this->pdf->render();
			$this->pdf->stream('data_pembayaran.pdf', array("Attachment" =>false));


			
		}else {
			$this->load->view('admin/download_data_siswa',$data);
		}
	}
    public function  export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
         
        $style_col = [
            'font'=> ['bold' => true],
            'alignment'=> [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment ::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment ::VERTICAL_CENTER
            ],
            'borders'=> [
                'top'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'right'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'bottom'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'left'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN]
            ],
            ];
        $style_row = [
            
            'alignment'=> [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment ::VERTICAL_CENTER
            ],
            'borders'=> [
                'top'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'right'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'bottom'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN],
                'left'=> ['borderstyle'=> \PhpOffice\PhpSpreadsheet\Style\Border ::BORDER_THIN]
            ],
            ];
    // Head
            $sheet->setCellValue('A1','DATA SISWA');
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->getFont()->setBold(true);
    
            $sheet->setCellValue('A2','ID');
            $sheet->setCellValue('B2','NAMA SISWA');
            $sheet->setCellValue('C2','NISN');
            $sheet->setCellValue('D2','GENDER');
            $sheet->setCellValue('E2','KELAS');
            $sheet->setCellValue('F2','FOTO');
    
            $sheet->getStyle('A2')->applyFromArray($style_col);
            $sheet->getStyle('B2')->applyFromArray($style_col);
            $sheet->getStyle('C2')->applyFromArray($style_col);
            $sheet->getStyle('D2')->applyFromArray($style_col);
            $sheet->getStyle('E2')->applyFromArray($style_col);
            $sheet->getStyle('F2')->applyFromArray($style_col);
    // get data dari database
            $data_siswa = $this->m_model->get_data('siswa')->result();
    // isi
            $no=1;
            $numrow=3;
            foreach ($data_siswa as $data) {
            $sheet->setCellValue('A'.$numrow,$data->id_siswa);
            $sheet->setCellValue('B'.$numrow,$data->nama_siswa);
            $sheet->setCellValue('C'.$numrow,$data->nisn);
            $sheet->setCellValue('D'.$numrow,$data->gender);
            $sheet->setCellValue('E'.$numrow,tampil_full_kelas_byid($data->id_kelas));
          
    
    $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
    $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
    $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
    $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
    $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
     
    $no++;
    $numrow++;
    }
    
    
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(30);
     
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
    
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
            $sheet->setTitle("LAPORAN DATA SISWA");
    
    
            header('Content-Type: aplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Siswa.xlsx"');
            header('cache-Control: max-age=0');
    
            $writer =new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
        public function import() 
        { 
          if (isset($_FILES["file"]["name"])) { 
            $path = $_FILES["file"]["tmp_name"]; 
            $object = PhpOffice\PhpSpreadsheet\IOFactory::load($path); 
            foreach ($object->getWorksheetIterator() as $worksheet) { 
              $highestRow = $worksheet->getHighestRow(); 
              $highestColumn = $worksheet->getHighestColumn(); 
              for ($row = 3; $row <= $highestRow; $row++) { 
                  $nama_siswa = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); 
                $nisn = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); 
                $gender = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); 
                $kelas = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $foto = $worksheet->getCellByColumnAndRow(6, $row)->getValue(); 

         
                // Periksa apakah ID siswa sudah ada 
                $get_id_by_nisn = $this->m_model->get_by_nisn($nisn); 
                $parts = explode(' ', $kelas); 
                             
                // Ambil kata pertama 
                $tingkat = $parts[0]; 
                $jurusan = $parts[1]; 
                $get_id_by_jurusan = $this->m_model->get_by_jurusan( $tingkat,$jurusan); 
     
                if (!$get_id_by_nisn) { 
                  // Jika ID siswa belum ada, masukkan data baru 
                  $data = array( 
                    'foto' => 'User.png', 
                    'nisn' => $nisn, 
                    'nama_siswa' => $nama_siswa, 
                    'gender' => $gender, 
            'id_kelas' => $get_id_by_jurusan
                  ); 
                  $this->m_model->tambah_data('siswa', $data); 
                } else { 
                  // Jika ID siswa sudah ada, lakukan tindakan yang sesuai
                  // Misalnya, Anda bisa memperbarui data yang sudah ada 
                  $data = array( 
                    'nisn' => $nisn, 
                    'nama_siswa' => $nama_siswa, 
                    'gender' => $gender, 
            'id_kelas' => $get_id_by_jurusan
                  ); 
                  $this->m_model->ubah_data('siswa', $data, array('id_siswa' => $get_id_by_nisn)); 
                } 
              } 
            } 
            redirect(base_url('admin/daftar_siswa')); 
          } else { 
            echo 'Invalid File'; 
          } 
        }
    public function upload_img($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/siswa/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '30000';
        $config['file_name'] = $kode;
        
        $this->load->library('upload', $config); // Load library 'upload' with config
        
        if (!$this->upload->do_upload($value)) {
            return array(false, '');
        } else {
            $fn = $this->upload->data();
            $nama = $fn['file_name'];
            return array(true, $nama);
        }
    }
    
    public function aksi_tambah_siswa()
    {
        $foto = $this->upload_img('foto');
        
        if ($foto[0] == false) {
            $data = [
                'foto' => 'User.png',
                'nama_siswa' => $this->input->post('nama_siswa'),
                'nisn' => $this->input->post('nisn'),
                'gender' => $this->input->post('gender'),
                'id_kelas' => $this->input->post('id_kelas'),
            ];
            $this->m_model->tambah_data('siswa', $data);
            redirect(base_url('admin/daftar_siswa'));
        } else {
            $data = [
                'foto' => $foto[1],
                'nama_siswa' => $this->input->post('nama_siswa'),
                'nisn' => $this->input->post('nisn'),
                'gender' => $this->input->post('gender'),
                'id_kelas' => $this->input->post('id_kelas'),
            ];
            $this->m_model->tambah_data('siswa', $data);
            redirect(base_url('admin/daftar_siswa'));
        }
    }

  
    public function user()
    {
        $data['user'] = $this->m_model->get_by_id('admin', 'id', $this->session->userdata('id'))->result();

        $this->load->view('admin/user', $data);
    } 
    public function upload_image()
    {  
        $base64_image = $this->input->post('base64_image');
    
        $binary_image = base64_encode($base64_image);
    
        $data = array(
            'foto' => $binary_image
        );
    
        $eksekusi = $this->m_model->ubah_data('admin', $data, array('id'=>$this->input->post('id')));
        if($eksekusi) {
            $this->session->set_flashdata('sukses' , 'berhasil');
            redirect(base_url('admin/user'));
        } else {
            $this->session->set_flashdata('error' , 'gagal...');
           echo "error gais";
        }
    }

    public function aksi_ubah_akun()
    {
        $password_baru = $this->input->post('password_baru');
        $konfirmasi_password = $this->input->post('konfirmasi_password');
        $email  = $this->input->post('email');
        $username =  $this->input->post('username');
        // buat data yang akan diubah
        $data = array(
            'email' => $email,
            'username' => $username
        );
        if (!empty($password_baru)) {
            // PASTIKAN PASSWORD BARU DAN KONFIRMASI SAMA
            if ($password_baru === $konfirmasi_password) {
                // Hash Password baru
                $data['password'] =  md5($password_baru);
            } else {
                $this->sesion->set_flashdata('message', 'Password  Baru dan Konfirmasi Harus Sama');
                redirect(base_url('admin/user'));
            }
        }
        // lakukan pembaruan data
        $this->session->set_userdata($data);
        $update_result = $this->m_model->ubah_data('admin', $data, array('id' => $this->session->userdata('id')));

        if ($update_result) {
            redirect(base_url('admin/user'));
        } else {
            redirect(base_url('admin/user'));
        }
        $this->load->view('admin/user', $data);
    }
   
    public function update($id)
    {
        $data['siswa'] = $this->m_model->get_by_id('siswa', 'id_siswa', $id)->result();
        $data['kelas'] = $this->m_model->get_data('kelas')->result();
        $this->load->view('admin/update', $data);
    }
    public function aksi_ubah_siswa()
	{
		$foto = $_FILES['foto']['name'];
		$foto_temp = $_FILES['foto']['tmp_name'];

		// Jika ada foto yang diunggah
		if ($foto) {
			$kode = round(microtime(true) * 1000);
			$file_name = $kode . '_' . $foto;
			$upload_path = './images/siswa/' . $file_name;

			if (move_uploaded_file($foto_temp, $upload_path)) {
				// Hapus foto lama jika ada
				$old_file = $this->m_model->get_siswa_foto_by_id($this->input->post('id_siswa'));
				if ($old_file && file_exists('./images/siswa/' . $old_file)) {
					unlink('./images/siswa/' . $old_file);
				}

				$data = [
					'foto' => $file_name,
					'nama_siswa' => $this->input->post('nama'),
					'nisn' => $this->input->post('nisn'),
					'gender' => $this->input->post('gender'),
					'id_kelas' => $this->input->post('kelas'),
				];
			} else {
				// Gagal mengunggah foto baru
				redirect(base_url('admin/update/' . $this->input->post('id_siswa')));
			}
		} else {
			// Jika tidak ada foto yang diunggah
			$data = [
				'nama_siswa' => $this->input->post('nama'),
				'nisn' => $this->input->post('nisn'),
				'gender' => $this->input->post('gender'),
				'id_kelas' => $this->input->post('kelas'),
			];
		}

		// Eksekusi dengan model ubah_data
		$eksekusi = $this->m_model->ubah_data('siswa', $data, array('id_siswa' => $this->input->post('id_siswa')));

		if ($eksekusi) {
			redirect(base_url('admin/daftar_siswa'));
		} else {
			redirect(base_url('admin/update/' . $this->input->post('id_siswa')));
		}
	}
    public function tambah_siswa()
    {
        $data['kelas'] = $this->m_model->get_data('kelas')->result();
        $this->load->view('admin/tambah_siswa', $data);
    }

    public function daftar_siswa()
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->result();
        $this->load->view('admin/daftar_siswa', $data);
    }
    public function hapus_siswa($id)
    {
        $this->m_model->delete('siswa', 'id_siswa', $id);
        redirect(base_url('admin/daftar_siswa'));
    }
   
//    public function hapus_siswa($id){
//     $siswa=$this->m_model->get_by_id('siswa','id_siswa' ,$id)->row();
// if ($siswa) {
//    if ($siswa->foto !== 'User.png') {
// $file_path = './images/siswa'. $siswa->foto;
// if (file_exists($file_path)) {
// if (unlink($upload_path)) {
//     //hapus file berhasil menggunakan metode delete
//     $this->m_model->delete('siswa','id_siswa',$id);
//     redirect(base_url('admin/daftar_siswa')); 


// }else {
//     // GAGALL
//     echo 'File tidak ditemukan';
// }
    
// }else {
//     // file tidak ditemukan
//     echo 'File tidak ditemukan';
// }

// }else {
// // tanpa hapus file user.png
// $this->m_model->delete('siswa','id_siswa',$id);
// redirect(base_url('admin/daftar_siswa'));
// }
// }else {
//     echo 'siswa tidak ditemukan';
// }
//    }
  
}