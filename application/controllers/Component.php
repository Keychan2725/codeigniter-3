<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Component extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
    }

    public function index()
    {

        $this->load->view('component/navbar');
    }
    public function sidebar()
    {

        $this->load->view('component/sidebar');
    }
}
