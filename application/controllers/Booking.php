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
        if ($this->session->userdata('id_user') == true) {
            $id = $this->uri->segment(3);
            $list = $this->db->get_where('mite_pricelist',['id' => $id])->row_array();
            $data = [
                "role" => 1,
                "id_pricelist" => $id,
                "all_in" => $list['all_in'],
            ];
            $this->db->insert('booking',$data);
            // echo '<script>location.replace("https://www.menindo.com")</script>';
        }else{
            $this->session->set_flashdata('msg','<div>Silahkan login terlebih dahulu untuk melakukan booking</div>');
            echo '<script>location.replace("https://www.menindo.com")</script>';
        }
    }
    
}