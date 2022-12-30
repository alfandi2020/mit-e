<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Booking extends CI_Controller {

    public function  __construct()
    {
        parent::__construct();
        // $this->load->library('Pdf');
        $this->load->model('M_Pricelist');
    }
   public function b()
    {
        echo $this->uri->segment(3);
    }
    
}