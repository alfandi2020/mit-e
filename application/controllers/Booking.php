<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Booking extends CI_Controller {

    public function  __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('M_Pricelist');
        $this->load->model('M_Booking');
    }
    function index()
	{
		$data = [
			"title" => "Booking"
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/booking');
		$this->load->view('temp/footer');
	}
    function get_data_booking()
    {
        $postData = $this->input->post();
        $data = $this->M_Booking->get_datatables($postData);
        echo json_encode($data);
    }
    function status()
    {
        $id = $this->uri->segment(3);
        $status = $this->uri->segment(4);
        // $nominal = $this->uri->segment(4);
        if ($status == 'approve') {
            $get_agent = $this->db->query("SELECT *,b.saldo - a.all_in * a.weight as total FROM booking as a left join dt_agent as b on(a.id_user=b.id_user) where a.id='$id'")->row_array();
            // $total = 
            $this->db->set('saldo',$get_agent['total']);
            $this->db->where('id_user',$get_agent['id_user']);
            $x = $this->db->update('dt_agent');
       
            $this->db->set('status',$status);
            $this->db->where('id',$id);
            $this->db->update('booking');
        }elseif ($status == 'reject') {
            $this->db->set('status',$status);
            $this->db->where('id',$id);
            $this->db->update('booking');
        }else if($this->input->post('status') == 'upload_smu'){
            $idd = $this->input->post('id_book');
            $no_smu = $this->input->post('no_smu');
            $config['upload_path']          = './upload/smu/';
            $config['allowed_types']        = 'jpg|png|pdf';
            // $config['file_name']        = $banner;
            $config['encrypt_name'] = true;
            
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file_smu'))
            {
                $data = $this->upload->data();
                // var_dump($data['file_name']);
                $this->db->set('no_smu',$no_smu);
                $this->db->set('file_smu',$data['file_name']);
                $this->db->where('id',$idd);
                $this->db->update('booking');
                    // $this->load->view('upload_form', $error);
            }

        }elseif ($this->input->post('status') == 'selesai') {
            $idd = $this->input->post('id_book');
            $this->db->set('status','selesai');
            $this->db->where('id',$idd);
            $this->db->update('booking');
        }
        redirect('booking');
        
    }
   public function b()
    {
        $id_user = $this->session->userdata('id_user');
        if ($id_user == true) {
            $id = $this->uri->segment(3);
            $weight = $this->uri->segment(4);
            $list = $this->db->get_where('mite_pricelist',['id' => $id])->row_array();
            $get_user = $this->db->get_where('dt_agent',['id_user' => $id_user])->row_array();
            if ($get_user['saldo'] < $list['all_in']) {
                echo '<script>history.back()</script';
            }else{
                $data = [
                    "role" => 1,//role untuk admin approve
                    "id_pricelist" => $id,
                    "all_in" => $list['all_in'],
                    "weight" => $weight
                ];
                $this->db->insert('booking',$data);
            }
            // echo '<script>location.replace("https://www.menindo.com")</script>';
        }else{
            $this->session->set_flashdata('msg','<div>Silahkan login terlebih dahulu untuk melakukan booking</div>');
            echo '<script>location.replace("https://www.menindo.com")</script>';
        }
    }
    
}