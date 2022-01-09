<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SearchResult  extends CI_Controller
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

}
