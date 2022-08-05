<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function index(){
        $data = [
			'title' => 'Laporan',
			'agent' => $this->db->get('dt_agent')->result(),
	    ];
        $this->load->view('temp/header',$data);
        $this->load->view('body/laporan',$data);
        $this->load->view('temp/footer');
    }
}