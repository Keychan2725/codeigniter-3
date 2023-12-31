<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Keuangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        if ($this->session->userdata('logged_in') != true || $this->session->userdata('role') != 'keuangan') {
            redirect(base_url() . 'login');
        }
    }
    public function index()
    {
        $this->load->view('Keuangan/index');
    }
	public function  export_pembayaran(){
		$data['data_pembayaran']=$this->m_model->get_data('pembayaran')->result();
		$data['nama']= 'pembayaran';
		if ($this->uri->segment(3)== 'pdf') {
			$this->load->library('pdf');
			$this->pdf->load_view('keuangan/export_data_pembayaran',$data);
			$this->pdf->render();
			$this->pdf->stream('data_pembayaran.pdf', array("Attachment" =>false));


			
		}else {
			$this->load->view('keuangan/download_data_pembayaran',$data);
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
		$sheet->setCellValue('A1','DATA PEMBAYARAN');
		$sheet->mergeCells('A1:E1');
		$sheet->getStyle('A1')->getFont()->setBold(true);

		$sheet->setCellValue('A3','ID');
		$sheet->setCellValue('B3','JENIS PEMBAYARAN');
		$sheet->setCellValue('C3','TOTAL PEMBAYARAN');
		$sheet->setCellValue('D3','NAMA SISWA');
		$sheet->setCellValue('E3','NISN');
		$sheet->setCellValue('F3','KELAS');

		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
// get data dari database
		$data_pembayaran = $this->m_model->get_data('pembayaran')->result();
// isi
		$no=1;
		$numrow=4;
		foreach ($data_pembayaran as $data) {
		$sheet->setCellValue('A'.$numrow,$data->id);
		$sheet->setCellValue('B'.$numrow,$data->jenis_pembayaran);
		$sheet->setCellValue('C'.$numrow,$data->total_pembayaran);
		$sheet->setCellValue('D'.$numrow,tampil_full_siswa($data->id_siswa));
		$sheet->setCellValue('E'.$numrow,tampil_nisn($data->id_siswa));
		$sheet->setCellValue('F'.$numrow,tampil_full_kelas_byid(tampil_id_kelas($data->id_siswa)));

$sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
$sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
$sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
$sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
$sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
$sheet->getStyle('F'.$numrow)->applyFromArray($style_row);

$no++;
$numrow++;
}


		$sheet->getColumnDimension('A')->setWidth(5);
		$sheet->getColumnDimension('B')->setWidth(25);
		$sheet->getColumnDimension('C')->setWidth(25);
		$sheet->getColumnDimension('D')->setWidth(20);
		$sheet->getColumnDimension('E')->setWidth(25);
		$sheet->getColumnDimension('F')->setWidth(30);

		$sheet->getDefaultRowDimension()->setRowHeight(-1);

		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		$sheet->setTitle("LAPORAN DATA PEMBAYARAN");


		header('Content-Type: aplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Pembayaran.xlsx"');
		header('cache-Control: max-age=0');

		$writer =new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
public function import(){

	if (isset($_FILES["file"]["name"])) {
		$path = $_FILES["file"]["tmp_name"];
		$object = PhpOffice\PhpSpreadsheet\IOFACTORY::load($path);
		foreach ($object->getWorksheetIterator() as $worksheet) {
$highestrow = $worksheet->getHighestRow();
$highestColumn= $worksheet->getHighestColumn();
for ($row=4; $row <= $highestrow ; $row++) { 
	$jenis_pembayaran= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
	$total_pembayaran= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
	$nisn= $worksheet->getCellByColumnAndRow(5, $row)->getValue();

$get_id_by_nisn= $this->m_model->get_by_nisn($nisn);
$data =array(
	'jenis_pembayaran'=> $jenis_pembayaran,
	'total_pembayaran'=> $total_pembayaran,
	'id_siswa'=> $get_id_by_nisn
);

$this->m_model->tambah_data('pembayaran',$data);
redirect(base_url('keuangan/pembayaran'));
}
}
}else {
	echo "Invalid errror";
}
}
		





    public function pembayaran()
    {
        $data['pembayaran']=$this->m_model->get_data('pembayaran')->result();
        // $data['kelas']=$this->m_model->get_data('kelas')->result();
        $this->load->view('Keuangan/pembayaran',$data);
    }
    public function tambah_pembayaran()
	{

		
		$data['siswa'] = $this->m_model->get_data('siswa')->result();
		// $data['kelas'] = $this->m_model->get_data('kelas')->result();
		$data['pembayaran'] = $this->m_model->get_data('pembayaran')->result();
		$this->load->view('keuangan/tambah_pembayaran', $data);
	}
    public function aksi_tambah_pembayaran()
	{
		$data = [
			'id_siswa' => $this->input->post('id_siswa'),
			// 'id_kelas' => $this->input->post('id_kelas'),
			'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
			'total_pembayaran' => $this->input->post('total_pembayaran'),
	

		];


		$this->m_model->tambah_data('pembayaran', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
		Data Berhasil Ditambahkan
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	
	  </div>');
		redirect(base_url('keuangan/pembayaran'));
	}
	
    public function update_pembayaran($id)
    {		
        
        $data['siswa'] = $this->m_model->get_data('siswa')->result();
        // $data['kelas'] = $this->m_model->get_data('kelas')->result();

        $data['pembayaran'] = $this->m_model->get_by_id('pembayaran', 'id', $id)->result();
     
        $this->load->view('keuangan/update_pembayaran', $data);
    }
    public function aksi_update_pembayaran()
	{
		$data = array(
			'id_siswa' => $this->input->post('id_siswa'),
			// 'id_kelas' => $this->input->post('id_kelas'),
			'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
			'total_pembayaran' => $this->input->post('total_pembayaran'),
		);
		$eksekusi = $this->m_model->ubah_data(
			'pembayaran',
			$data,
			array('id' => $this->input->post('id'))

		);
		if ($eksekusi) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Data Berhasil Diubah
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		
		  </div>');
			redirect(base_url('keuangan/pembayaran'));
		} else {

			redirect(base_url('keuangan/update_pembayaran/' . $this->input->post('id')));
		}

		$this->load->view('keuangan/pembayaran');
	}
    public function hapus_data($id)
    {
        $this->m_model->delete('pembayaran', 'id', $id);
        redirect(base_url('keuangan/pembayaran'));
    }
}
?>