<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat  extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //모델로드
//        $this->load->model('admin_plan');
//        $this->load->model('admin_member');
//        $this->load->model('common');
        //CSRF 방지
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('array');
    }
    public function _remap($method)
    {
        if (method_exists($this, $method)) {
            $this->{"{$method}"}();
        }
    }
    public function index()
    {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: POST,GET, OPTIONS");
        $data=Array();
		$this->load->view('layout/header');
		$this->load->view('chat/index',$data);
		$this->load->view('layout/footer');
//        redirect('product/estimate_form');
    }
}
