<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        $this->load->library('upload');
        if ($this->session->userdata('logged_in') != true && $this->session->userdata('role') != 'admin') {
            redirect(base_url() . 'login');
        }
    }

    public function index()
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->num_rows();
        $data['keuangan'] = $this->m_model->get_data('keuangan')->num_rows();

        $this->load->view('admin/index', $data);
    }
    public function upload_img($value)
{
    $kode = round(microtime(true) * 1000);
    $config['upload_path'] = './images/siswa/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
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
    $file_name = $_FILES['foto']['name'];
    $file_temp = $_FILES['foto']['tmp_name'];
    $kode = round(microtime(true) * 1000);
    $file_name = $kode . '_' . $file_name;
    $upload_path = './images/siswa/' . $file_name;

    if (move_uploaded_file($file_temp, $upload_path)) {
      $data = [
        'foto' => $file_name,
        'nama_siswa' => $this->input->post('nama'),
        'nisn' => $this->input->post('nisn'),
        'gender' => $this->input->post('gender'),
        'id_kelas' => $this->input->post('kelas'),
      ];
      $this->m_model->tambah_data('siswa', $data);
      redirect(base_url('admin/daftar_siswa'));
    } else {
      $data = [
        'foto' => 'User.png',
        'nama_siswa' => $this->input->post('nama'),
        'nisn' => $this->input->post('nisn'),
        'gender' => $this->input->post('gender'),
        'id_kelas' => $this->input->post('kelas'),
      ];
      $this->m_model->tambah_data('siswa', $data);
      redirect(base_url('admin/daftar_siswa'));
    }
  }
    // public function keuangan()
    // {
    //     $data['uang'] = $this->m_model->get_data('keuangan')->result();

    //     $this->load->view('admin/keuangan', $data);
    // } 
    // public function add_keuangan()
    // {
    //     $data['uang'] = $this->m_model->get_data('keuangan')->result();
    //     $this->load->view('admin/add_keuangan', $data);
    // }
    // public function aksi_add_keuangan(){
    //     $data =[
    //         'pemasukan'=> $this->input->post('pemasukan'),
    //         'pengeluaran '=> $this->input->post('pengeluaran'),
    //         'tanggal '=> $this->input->post('tanggal'),
    //     ]; 
    //     // if (!empty('pemasukan') && !empty('pengeluaran')) {
    //     //  !empty('pemasukan') - !empty('pengeluaran') == 
    //     // }
    //     $this->m_model->tambah_data('keuangan',$data);
    //     redirect(base_url('admin/keuangan'));
    // }
    // public function update_keuangan($id)
    // {
    //     $data['uang'] = $this->m_model->get_by_id('keuangan', 'id', $id)->result();
     
    //     $this->load->view('admin/update_keuangan', $data);
    // }
    // public function aksi_update_uang()
    // {
    //     $data = array(
    //         'pemasukan' => $this->input->post('nama_lengkap'),
    //         'pengeluaran' => $this->input->post('pengeluaran'),
    //         'tanggal' => $this->input->post('tanggal'),
            
    //     );
    //     $eksekusi = $this->m_model->ubah_data('keuangan', $data, array('id' => $this->input->post('id')));
    //     if ($eksekusi) {
    //         $this->session->set_flashdata('sukses', 'berhasil');
    //         redirect(base_url('admin/keuangan'));
    //     } else {
    //         $this->session->set_flashdata('error', 'gagal');
    //         redirect(base_url('admin/update_keuangan/' . $this->input->post('id')));
    //     }

    //     $this->load->view('admin/keuangan');
    // }

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
    // public function hapus_siswa($id)
    // {
    //     $this->m_model->delete('siswa', 'id_siswa', $id);
    //     redirect(base_url('admin/daftar_siswa'));
    // }
   
   public function hapus_siswa($id){
    $siswa=$this->m_model->get_by_id('siswa','id_siswa' ,$id)->row();
if ($siswa) {
   if ($siswa->foto !== 'User.png') {
$file_path = './images/siswa'. $siswa->$foto;
if (file_exists($file_path)) {
if (unlink($upload_path)) {
    //hapus file berhasil menggunakan metode delete
    $this->m_model->delete('siswa','id_siswa',$id);
    redirect(base_url('admin/daftar_siswa')); 


}else {
    // GAGALL
    echo 'File tidak ditemukan';
}
    
}else {
    // file tidak ditemukan
    echo 'File tidak ditemukan';
}

}else {
// tanpa hapus file user.png
$this->m_model->delete('siswa','id_siswa',$id);
redirect(base_url('admin/daftar_siswa'));
}
}else {
    echo 'siswa tidak ditemukan';
}
   }
  
}