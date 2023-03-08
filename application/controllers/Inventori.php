<?php

defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');
class Inventori extends CI_Controller
{

   public function  __construct()
   {
      parent::__construct();
      // $this->load->library('Pdf');
      $this->load->helper('string');
      $this->load->library('session');
      $this->load->model('M_Inventori');
      // $this->load->model('M_Produk');
      $this->load->helper('date');
   }

   function index()
   {

      $data = [
         'title' => 'Daftar Inventori',
      ];

      $this->load->view('temp/header', $data);
      $this->load->view('body/inventori/index');
      $this->load->view('temp/footer');
   }

   function get_data_barang()
   {
      $postData = $this->input->post();
      $data = $this->M_Inventori->get_datatables($postData);

      echo json_encode($data);
   }

   function tambah_barang()
   {
      $data = [
         'title' => 'Tambah data barang',
         'pengirim' => $this->db->order_by('nama_pengirim', 'asc')->get('dt_pengirim')->result()
      ];

      $this->load->view('temp/header', $data);
      $this->load->view('body/inventori/create');
      $this->load->view('temp/footer');
   }

   function store()
   {

      $format = "%Y-%m-%d %h:%i:%s";
      // echo mdate($format);
      $nama_barang = $this->input->post('inputNama');

      $insert = [
         "nama_barang" => $this->input->post('inputNama'),
         "jumlah" => $this->input->post('inputJumlah'),
         "berat" => $this->input->post('inputBerat'),
         "pengirim" => $this->input->post('inputPengirim'),
         "tanggal_masuk" => $this->input->post('inputTanggalMasuk'),
         "user_input" => $_SESSION['id_user'],
         "post_date" => mdate($format),
      ];

      // echo '<pre>';
      // print_r($insert);exit;
      // '</pre>';


      $this->db->insert('inventori', $insert);
      $this->session->set_flashdata('message_name', '<div class="alert  alert-primary" role="alert">' . $nama_barang . ' berhasil ditambahkan ke inventori</div>');
      // After that you need to used redirect function instead of load view such as 
      redirect("inventori/index");
   }

   function edit()
   {
      $id = $this->uri->segment(3);
      $this->db->where('id', $id);
      $tampil = $this->db->get('inventori')->row_array();

      $data = [
         'title' => 'Edit inventori',
         'inventori' => $tampil,
         'pengirim' => $this->db->order_by('nama_pengirim', 'asc')->get('dt_pengirim')->result()
      ];

      $this->load->view('temp/header', $data);
      $this->load->view('body/inventori/create');
      $this->load->view('temp/footer');
   }
   function clean2($string)
   {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   }
}
