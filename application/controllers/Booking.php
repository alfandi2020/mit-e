<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Pricelist extends CI_Controller {

    public function  __construct()
    {
        parent::__construct();
        // $this->load->library('Pdf');
        $this->load->model('M_Pricelist');
    }
    function index()
    {
        echo $this->uri->segment(3);
    }
    
}