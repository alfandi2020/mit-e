<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Booking extends CI_Controller {

    public function  __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('M_Pricelist');
    }
   public function b()
    {
        $list = $this->db->get_where('mite_pricelist')->row_array();
        $id = $this->uri->segment(4);
        $data = [
            "role" => $this->session->userdata('role'),
            "id_pricelist" => $id,
            "all_in" => $list['all_in'],
        ];
        $this->db->insert('booking',$data);
        // echo '<script>location.replace("https://www.menindo.com")</script>';
    }
    
}