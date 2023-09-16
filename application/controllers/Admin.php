<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url() . 'login');
        }
    }

    public function index()
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->num_rows();

        $this->load->view('admin/index', $data);
    }
    public function update($id)
    {
        $data['siswa'] = $this->m_model->get_by_id('siswa', 'id_siswa', $id)->result();
        $data['kelas'] = $this->m_model->get_data('kelas')->result();
        $this->load->view('admin/update', $data);
    }
    public function aksi_update_siswa()
    {
        $data = array(
            'nama_siswa' => $this->input->post('nama_lengkap'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('id_kelas'),
        );
        $eksekusi = $this->m_model->ubah_data('siswa', $data, array('id_siswa' => $this->input->post('id_siswa')));
        if ($eksekusi) {
            $this->session->set_flashdata('sukses', 'berhasil');
            redirect(base_url('admin/daftar_siswa'));
        } else {
            $this->session->set_flashdata('error', 'gagal');
            redirect(base_url('admin/update/' . $this->input->post('id_siswa')));
        }

        $this->load->view('admin/update');
    }
    public function tambah_siswa()
    {
        $data['kelas'] = $this->m_model->get_data('kelas')->result();
        $this->load->view('admin/tambah_siswa', $data);
    }
    public function aksi_tambah_siswa()
    {
        $data = [
            'nama_siswa' => $this->input->post('nama'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('id_kelas'),

        ];
        $this->m_model->tambah_data('siswa', $data);
        redirect(base_url('admin/daftar_siswa'));
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
}
