<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Pricelist extends CI_Controller {

    public function  __construct()
    {
        parent::__construct();
        // $this->load->library('Pdf');
        $this->load->helper('string');
        $this->load->model('M_Pricelist');
    }
    
    function index(){

        $data = [
			'title' => 'Daftar harga',
	    ];
        $this->load->view('temp/header',$data);
        $this->load->view('body/pricelist/index');
        $this->load->view('temp/footer');
    }
    function clean2($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	 
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	 }
     function status()
     {
        $id = $this->uri->segment(3);
        $saldo = $this->uri->segment(4);
        $id_user = $this->session->userdata('id_user');
        // $this->db->set('saldo',$saldo);
        $this->db->set('status','approve');
        $this->db->where('id',$id);
        $this->db->update('history_topup');

        $get_user = $this->db->query("SELECT * FROM dt_agent where id_user='$id_user'")->row_array();
        $total = $get_user['saldo'] + $saldo;
        $this->db->set('saldo',$total);
        $this->db->where('id_user',$id_user);
        $this->db->update('dt_agent');
        redirect('pricelist/topup');

     }
    function topup()
    {
        $saldo = $this->input->post('saldo');
        $id_user = $this->session->userdata('id_user');
        if ($saldo == true) {

            $nominal = $this->clean2($saldo);

            $sub = substr($nominal,-3);
			$sub2 = substr($nominal,-2);
			$sub3 = substr($nominal,-1);
 
			$total =  random_string('numeric', 3);
			$total2 =  random_string('numeric', 2);
			$total3 =  random_string('numeric', 1);
 
				if($sub==0){
					$hasil =  $nominal + $total; 
					// echo "No Unik :".$total."<br>"; 
					// echo "Nominal Transfer : Rp. ".number_format($hasil,0,",",".");
				} else if($sub2 == 0){
					$hasil = $nominal + $total2; 
					$no = substr($hasil,-3);
					// echo "No Unik :".$no."<br>"; 
					// echo "Nominal Transfer : Rp. ".number_format($hasil,0,",",".");
				} else if($sub3 == 0){
					$hasil = $nominal + $total3; 
					$no = substr($hasil,-3);
					// echo "No Unik :".$no."<br>"; 
					// echo "Nominal Transfer : Rp. ".number_format($hasil,0,",",".");
				}else{
					// echo "No Unik :".$sub."<br>"; 
					// echo "Nominal Transfer : Rp. ".number_format($nominal,0,",",".");
				}
            $data = [
                "kode_agent" => '111',
                "id_user" => $id_user,
                "saldo" => $hasil,
                "kode_unik" => $total,
                "status" => 'waiting'
            ];
            $this->db->insert('history_topup',$data);
            $this->session->set_flashdata('msg','no_rek');
            redirect('pricelist/topup');
        }
        $id_user = $this->session->userdata('id_user');
        if ($this->session->userdata('role') == '1') {
            $agent = $this->db->query("SELECT * from users as a left join history_topup as b on(a.id=b.id_user) where status='waiting'")->result();
        }else{
            $agent = $this->db->query("SELECT * from users as a left join history_topup as b on(a.id=b.id_user) where a.id='$id_user' and status='waiting'")->result();
        }
        $data = [
			"title" => "topup",
            'agent' => $agent

		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/topup');
		$this->load->view('temp/footer');
    }
    function get_data_pricelist() {
        $postData = $this->input->post();
        $data = $this->M_Pricelist->get_datatables($postData);

        echo json_encode($data);
    }
    function delete()
    {
        if ($this->uri->segment(4) == 'back') {
            $id = $this->uri->segment(3);
            $this->db->where('id',$id);
            $this->db->set('status','1');
            $this->db->update('mite_pricelist');
            redirect('pricelist/index');
        }else{
            $id = $this->uri->segment(3);
            $this->db->where('id',$id);
            $this->db->set('status','0');
            $this->db->update('mite_pricelist');
            redirect('pricelist/index');
        }
    }
    function create() {
        $data = [
			'title' => 'Tambah daftar harga',
			"destination" => $this->db->order_by('destinasi', 'asc')->get('mite_destinasi')->result(),
	    ];
        $this->load->view('temp/header', $data);
        $this->load->view('body/pricelist/create');
        $this->load->view('temp/footer');
    }
    function edit(){
        $id = $this->uri->segment(3);
        $this->db->where('id',$id);
        $data_des  =$this->db->get('mite_pricelist')->row_array();
        $data = [
			'title' => 'Edit daftar harga',
			"destination" => $data_des,
	    ];
        $this->load->view('temp/header', $data);
        $this->load->view('body/pricelist/create');
        $this->load->view('temp/footer');
    }

    function store() {
        $insert = [
            "maskapai_id" => $this->input->post('inputMaskapai'),
            "origin" => $this->input->post('inputOrigin'),
            "destinasi" => $this->input->post('inputDest'),
            "smu_basic" => $this->input->post('inputBasic'),
            "ppn_smu" => $this->input->post('inputTax'),
            "smuppn_price" => $this->input->post('inputBasicTax'),
            "r_a" => $this->input->post('inputRA'),
            "warehouse" => $this->input->post('inputWarehouse'),
            "ihc" => $this->input->post('inputIhc'),
            "handling" => $this->input->post('inputHandling'),
            "all_in" => $this->input->post('inputAllin'),
        ];
        // $inputMaskapai = $this->input->post('inputMaskapai');
        // $inputProduct = $this->input->post('inputProduct');
        // $inputOrigin = $this->input->post('inputOrigin');
        // $inputDest = $this->input->post('inputDest');
        // $inputBasic = $this->input->post('inputBasic');
        // $inputTax = $this->input->post('inputTax');
        // $inputBasicTax = $this->input->post('inputBasicTax');
        // $inputRA = $this->input->post('inputRA');
        // $inputWarehouse = $this->input->post('inputWarehouse');
        // $inputIhc = $this->input->post('inputIhc');
        // $inputHandling = $this->input->post('inputHandling');
        // $inputAllin = $this->input->post('inputAllin');

        $this->db->select('count(id) as id');
		// $this->db->where('product_type',$inputProduct);
		$this->db->where('maskapai_id',$inputMaskapai);
		$this->db->where('origin',$inputOrigin);
		$this->db->where('destinasi',$inputDest);

        $query = $this->db->get('mite_pricelist')->result();

        $hasil = $query[0]->id;

        if($hasil == 1) {
            ?>
            <!-- <script type="text/javascript">
                alert("Pricelist already added. Please update it");
                location = history.back();
            </script> -->
            <?php
            
            redirect('pricelist/create','<div class="alert alert-primary mb-2" role="alert">Price has been added before, please update it!</div>');
        } else if ($hasil == 0) {
            $this->db->insert('mite_pricelist', $insert);$this->session->set_flashdata('message_name', '<div class="alert  alert-primary" role="alert">Success</div>');
            // After that you need to used redirect function instead of load view such as 
            redirect("pricelist/create");

        }
    }
}