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
		// var_dump($sheet);
		// $data = array();
		// foreach ($sheet as $x ) {
		// array_push(
		// 	$data, 
		// 	array(
		// 		'tes' => $x['A'],
		// 		'tesa' => $x['B']
		// 	)
		// );
		// }

		echo json_encode($sheet);
		// echo $_FILES['file']['tmp_name'];
		// foreach ($sheet as $x) {
		// 	// $this->session->set_userdata('data_excel',$sheet);
		// 	// redirect('user/upload');
			// echo $x['A'];
			// echo $x['B'];
		// 	// $this->session->unset_userdata('some_name');
		// }

	  }
	  function submit_upload(){
		  $data = $this->input->post();
		  foreach (array_slice($data,1) as $x) {
				$insert = [
					"A" => $x['A']
				];
				$this->db->insert('dt_excel',$insert);
				echo $insert;
		  }
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
