<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once APPPATH."third_party/excel/Classes/PHPExcel.php";
class User extends CI_Controller {
	// private $param;
	private $filename = 'tes';

	public function __construct() {
        parent::__construct();
		$this->load->model(array('M_Registrasi','M_User'));
		if ($this->session->userdata('id_user') == false) {
			$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Opss anda blm login</div>");
            redirect('auth');
		}
	}
	public function index()
	{
		$data = [
			'user' => $this->db->get('users')->result(),
			'title' => 'List User'
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/user/view',$data);
		$this->load->view('temp/footer');
	}
	public function create()
	{
		$data = [
			'title' => 'Buat User'
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/user/create');
		$this->load->view('temp/footer');
	}
	function range_excel($start = 'A', $end = 'ZZ'){
		$return_range = [];
		for ($i = $start; $i !== $end; $i++){
			$return_range[] = $i;
		}
		return $return_range;
	}
	public function upload_file(){
	
	  
		  // Jika berhasil :
		//   $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
		//   var_dump($return['file']);
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$excelreader = new PHPExcel_Reader_Excel2007();    
		$loadexcel = $excelreader->load($_FILES['file']['tmp_name']); 
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);        
		
		array_unshift($sheet,"");//remove key
		unset($sheet[0]);
		echo json_encode($sheet);

	  }
	  function submit_upload(){
		  $data = $this->input->post();
		//   $saldo_akhir = '';
		// $arr = array();
		// $saldo_excel = 0;
		  foreach (array_slice($data,1) as $x) {
			  $id_agent = $x['Z'];
				$cek = $this->db->query("SELECT * FROM dt_agent where id_agent='$id_agent'")->row_array();
				// if ($cek == 1) {
					$saldo_excel = preg_replace('/[^\d.]/', '', $x['U']);
					$xxx =  $cek['saldo'] - $saldo_excel;
					$z = strtotime($x['F']);
					$datex =  date('d-m-Y',$z);
					$insert = [
						"A" => $x['A'],
						"B" => $x['B'],
						"C" => $x['C'],
						"D" => $x['D'],
						"E" => $x['E'],
						"F" => $datex,
						"G" => $x['G'],
						"H" => $x['H'],
						"I" => $x['I'],
						"J" => $x['J'],
						"K" => $x['K'],
						"L" => $x['L'],
						"M" => $x['M'],
						"N" => $x['N'],
						"O" => $x['O'],
						"P" => $x['P'],
						"Q" => $x['Q'],
						"R" => $x['R'],
						"S" => $x['S'],
						"T" => $x['T'],
						"U" => $x['U'],
						"V" => $x['V'],
						"W" => $x['W'],
						"X" => $x['X'],
						"Y" => $x['Y'],
						"Z" => $x['Z'],
						"saldo_akhir" => $xxx
					];
					$this->db->insert('dt_excel',$insert);
					$arr[] = $xxx;
					$sum_saldo[] = $saldo_excel;
					//update
					$this->db->set('saldo',$xxx);
					$this->db->where('id_agent',$id_agent);
					$this->db->update('dt_agent');
		  }
		//   $xx = [
		// 	"A" => "TOP UP",
		// 	"F" => date('d-m-Y'),
		// 	"U" => array_sum($sum_saldo)
		//   ];
		//   $this->db->insert('dt_excel',$xx);

		//   $im = implode(',',$arr);
		//   array_unshift($arr,2);
			array_unshift($arr,"");
			unset($arr[0]);
		  echo json_encode($arr);
	  }
	public function upload()
	{
		
			// include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			// $excelreader = new PHPExcel_Reader_Excel2007();    
			// $loadexcel = $excelreader->load('tes.xlsx'); 
			// $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);        
			$data = [
				'title' => 'Upload table',
				// 'upload' => $sheet,
			];
			
		$this->load->view('temp/header',$data);
		$this->load->view('body/user/upload',$data);
		$this->load->view('temp/footer'); 	
	}
	function clean2($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	 
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	 }
	 
	function topup(){
	$id_agent = $this->input->post('id_agent');
	$saldo = $this->input->post('saldo');
	if ($id_agent == true && $saldo == true) {
		//insert
		$cek = $this->db->query("SELECT * FROM dt_agent where id_agent='$id_agent'")->row_array();

		$insert = [
			"A" => "TOP UP",
			"F" => date('d-m-Y'),
			"U" => $this->clean2($saldo),
			"saldo_akhir" =>$cek['saldo']+ $this->clean2($saldo)
		];
		$this->db->insert('dt_excel',$insert);

		//update dt_agent saldo
		$this->db->set('saldo',$cek['saldo']+ $this->clean2($saldo));
		$this->db->where('id_agent',$id_agent);
		$this->db->update('dt_agent');
		$history = [
			"kode_agent" => $id_agent,
			"saldo" => $this->clean2($saldo),
			"date" => date('Y-m-d')
		];
		$this->db->insert('history_topup',$history);
		redirect('user/topup');
	}
	$data = [
			'title' => 'Topup',
			'agent' => $this->db->get('dt_agent')->result(),
	];
		
	$this->load->view('temp/header',$data);
	$this->load->view('body/topup',$data);
	$this->load->view('temp/footer'); 
	}
	function agent(){
		$nama = $this->input->post('nama');
		$data = [
			"id_agent" => 123,
			"nama" => $nama
		];
		$this->db->insert('dt_agent',$data);
		redirect('user/topup');
	}
	function submit_ljn()
	  {
		$data = $this->input->post();

		  foreach ($data as $x) {
			//   $id_agent = $x['Z'];
			// 	$cek = $this->db->query("SELECT * FROM dt_agent where id_agent='$id_agent'")->row_array();
				// if ($cek == 1) {
					// $saldo_excel = preg_replace('/[^\d.]/', '', $x['U']);
					// $xxx =  $cek['saldo'] - $saldo_excel;
					
					$insert = [
						"nama" => $x['A'],
						"alamat" => $x['B'],
						"telp" => $x['C'],
						"ktp" => $x['D'],
						"npwp" => $x['E'],
						"email" => $x['F'],
						"tindakan" => "Pribadi",
						"t_nama"=>$x['A'],
						"t_nomor_ktp"=>$x['D'],
						"t_telp"=>$x['C'],
						"t_email"=>$x['F'],
						"speed" => $x['G'],
						"media" => "Fiber Optik",
						"cpe" => $x['H'],
						"router" => $x['I'],
						"aktif" => $x['J'],
						"off" => $x['K'],
						"teknisi" => $x['L'],
						"group" => $x['M'],
						"status" => $x['N'],
					];
					$cek = $this->db->insert('dt_registrasi',$insert);
					// $arr[] = $xxx;
					//update
					// $this->db->set('saldo',$xxx);
					// $this->db->where('id_agent',$id_agent);
					// $this->db->update('dt_agent');
					echo json_encode($cek);
		  }
	  }
	function submit_user(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password_conf = $this->input->post('password_conf');
		$nama = $this->input->post('nama');
		$role = $this->input->post('role');
		$this->db->where('username',$username);
        $cek = $this->db->get('users')->num_rows();
		if ($username == true && $nama == true  && $password == true && $role == true) {
			if ($password == $password_conf) {
				if ($cek != true) {
					$data = [
						"nama" => $nama,
						"username" => $username,
						"password" => password_hash($password,PASSWORD_DEFAULT),
						"role" => $role
					];
					$this->db->insert('users',$data);
					$msg = [
						"response" => "success",
						"message" => "Data user $username berhasil ditambahakan"
					];
					echo json_encode($msg);
				
				}else{
					$msg = [
						"response" => "double",
						"message" => "Data user $username sudah ada"
					];
					echo json_encode($msg);
				}
			}else{
				$msg = [
					"response" => "error",
					"message" => "Password harus sama"
				];
				echo json_encode($msg);
			}
		}else{
			$msg = [
				"response" => "error",
				"message" => "Form tidak boleh kosong"
			];
			echo json_encode($msg);
			
		}
	}
	function get_user(){
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$data['user'] = $this->db->get('users')->row_array();
		$this->load->view('body/user/modal_update',$data);
	}
	function update(){
		if ($this->input->post('password') === $this->input->post('password_konf')) {
			$id = $this->input->post('id');
			$username = $this->input->post('username');
			$this->M_User->update_user($id);
			echo 'Data user '.$username.' berhasil diupdate';
		}else{
			echo "Password harus sama";
		}
	}
	function signature(){
		$key_pair = openssl_pkey_new(array(
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ));
		$details = openssl_pkey_get_details($key_pair);
		$public_key = $details['key'];

		$private_key = '';
		openssl_pkey_export($key_pair, $private_key);

		// check/print your public key and private key pair.
		echo $public_key . "<br><br>";
		echo $private_key;
	}
	function delete($id){
		$this->db->delete('users', array('id' => $id)); 
		redirect('user');
	}
	function paket(){
		$id = $this->input->post('id');
		$data = $this->M_Registrasi->get_paket($id);
		echo json_encode($data);
	}
	public function filter(){
        if($this->uri->segment(3)){
            $filter = $this->uri->segment(3);
            $this->session->set_userdata('menu-footer', $filter);
            redirect('home/'.$this->uri->segment(3));
        }
    }
}
