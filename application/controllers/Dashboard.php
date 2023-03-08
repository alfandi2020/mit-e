<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	// private $param;

	public function __construct() {
        parent::__construct();
		if ($this->session->userdata('id_user') == false) {
			$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Opss anda blm login</div>");
            redirect('auth');
		}
	}
	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		$agent = $this->db->get_where('dt_agent',['id_user' => $id_user])->row_array();
		// $total = $this->db->query("SELECT *,SUM(saldo) as pending_saldo,COUNT(id) as pending FROM history_topup where status='waiting' and id_user='$id_user'")->row_array();
		$total = $this->db->query("SELECT *,SUM(saldo) as pending_saldo,COUNT(id) as pending FROM history_topup where status='waiting' and id_user='$id_user'")->row_array();
		$data = [
			"title" => "Dashboard",
			"saldoo" => $agent['saldo'],
			"pending_saldo" => $total['pending_saldo'],
			"total_pending" => $total['pending']
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/dashboard',$data);
		$this->load->view('temp/footer');
	}
	function logout(){
		$array_items = array('id_user', 'username');
		$this->session->unset_userdata($array_items);
		redirect('auth');
	}
    public function jam()
    {
        date_default_timezone_set('Asia/Jakarta'); //Menyesuaikan waktu dengan tempat kita tinggal
        echo date('H:i:s'); //Menampilkan Jam Sekarang
    }
	public function menu()
	{
		$this->load->view('temp/sidebar');
	}
	function profile(){
		$this->load->view('body/profile');
	}
	public function filter(){
        if($this->uri->segment(3)){
            $filter = $this->uri->segment(3);
            $this->session->set_userdata('menu-footer', $filter);
            redirect('home/'.$this->uri->segment(3));
        }
    }
}
