<?php

defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');
class Produk extends CI_Controller
{

   public function  __construct()
   {
      parent::__construct();
      // $this->load->library('Pdf');
      $this->load->helper('string');
      $this->load->library('session');
      $this->load->model('M_Produk');
      $this->load->helper('date');
   }

   function clean2($string)
   {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   }

   function index()
   {
      $data = [
         'title' => 'Produk'
      ];

      $this->load->view('temp/header', $data);
      $this->load->view('body/produk/index');
      $this->load->view('temp/footer');
   }

   function get_data_produk()
   {
      $postData = $this->input->post();
      $data = $this->M_Produk->get_datatables($postData);

      echo json_encode($data);
   }

   function create()
   {
      $data = [
         'title' => 'Buat Paket'
      ];

      $this->load->view('temp/header', $data);
      $this->load->view('body/produk/create');
      $this->load->view('temp/footer');
   }

   function simpan_paket()
   {
      $format = "%Y-%m-%d %h:%i:%s";

      $insert = [
         "nama_paket" => $this->input->post('inputNama'),
         "user_input" => $_SESSION['id_user'],
         "post_date" => mdate($format)
      ];

      $this->db->insert('produk', $insert);
      $this->session->set_flashdata('message_name', '<div class="alert alert-primary" role="alert">Success</div>');

      redirect("produk/index");
   }

   // function edit()
   // {
   //    $id = $this->uri->segment(3);
   //    $this->db->where('id', $id);
   //    $tampil = $this->db->get('inventori')->row_array();

   //    $data = [
   //       'title' => 'Edit inventori',
   //       'inventori' => $tampil,
   //       'pengirim' => $this->db->order_by('nama_pengirim', 'asc')->get('dt_pengirim')->result()
   //    ];

   //    $this->load->view('temp/header', $data);
   //    $this->load->view('body/inventori/create');
   //    $this->load->view('temp/footer');
   // }

   function set_paket()
   {
      $id = $this->uri->segment(3);
      $data = [
         'title' => 'Pilih isi paket',
         // 'id' => $id,
         "paket" => $this->db->order_by('Id', 'asc')->get('detail_produk')->result(),
         "inventori" => $this->db->order_by('nama_barang', 'asc')->get('inventori')->result(),
      ];

      $this->load->view('temp/header', $data);
      $this->load->view('body/produk/create');
      $this->load->view('temp/footer');
   }

   function tambah_set_paket()
   {
      $format = "%Y-%m-%d %h:%i:%s";

      $insert = [
         "kode_produk" => $this->input->post('idPaket'),
         "kode_barang" => $this->input->post('idInventori'),
         "jumlah" => $this->input->post('inputJumlah'),
         "user_input" => $_SESSION['id_user'],
         "post_date" => mdate($format)
      ];

      // print_r($insert);
      // exit;

      $this->db->insert('detail_produk', $insert);
      $this->session->set_flashdata('message_name', '<div class="alert alert-primary" role="alert">Success</div>');

      redirect("produk/set_paket/" . $this->input->post('idPaket'));
   }

   function update_isi_paket()
   {
      $format = "%Y-%m-%d %h:%i:%s";

      $data = [
         "kode_produk" => $this->input->post('idPaket'),
         "kode_barang" => $this->input->post('idInventori'),
         "jumlah" => $this->input->post('inputJumlah'),
         "user_input" => $_SESSION['id_user'],
         "post_date" => mdate($format)
      ];

      $this->db->where('Id', $this->input->post('idDetail'));
      $this->db->update('detail_produk', $data);
      $this->session->set_flashdata('message_name', '<div class="alert alert-primary" role="alert">Berhasil diperbarui</div>');

      redirect("produk/set_paket/" . $this->input->post('idPaket'));
   }

   function tambah_paket()
   {
      $id = $this->uri->segment(3);

      $data = [
         'title' => 'Pilih isi paket',
         'id' => $id,
         "paket" => $this->db->order_by('Id', 'asc')->get('detail_produk')->result(),
         "inventori" => $this->db->order_by('nama_barang', 'asc')->get('inventori')->result(),
      ];

      $this->load->view('temp/header', $data);
      $this->load->view('body/produk/create');
      $this->load->view('temp/footer');
   }

   function tambah_jumlah_paket()
   {
      $jumlah = $this->input->post('inputJumlahPaket');
      $idPaket = $this->input->post('idPaket');

      $records = $this->db->select('kode_barang, jumlah')->from('detail_produk')->where('kode_produk', $idPaket)->get()->result();
      // $records = $this->db->where('kode_produk', $idPaket)->get('detail_produk')->result();

      $records = $this->db->select('kode_barang, nama_barang, detail_produk.jumlah')->from('detail_produk')->join('inventori', 'inventori.id = detail_produk.kode_barang')->where('kode_produk', $idPaket)->get()->result();


      foreach ($records as $r) {
         $r_jumlah = $r->jumlah * $jumlah;

         $kode_barang = $r->kode_barang;
         $nama_barang = $r->nama_barang;

         $cek = $this->db->select('jumlah')->from('inventori')->where('id', $kode_barang)->get()->result();

         foreach ($cek as $c) {
            echo $c->jumlah . ' | ' . $kode_barang . ' | ' . $r_jumlah . '<br>';
            if ($r_jumlah >= $c->jumlah) {
               $this->session->set_flashdata('message_name', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Stok ' . $nama_barang . ' tidak cukup.</div>');

               redirect("produk/tambah_paket/" . $idPaket);

               // echo 'stok <strong>' . $nama_barang . '</strong> tidak cukup <br>';
            } else {
               echo 'stok <strong>' . $nama_barang . '</strong> cukup <br>';
            }
         }
      }

      // foreach ($b as $c) {
      //    echo $c . '<br>';
      // }
      // echo '<pre>';
      // var_dump($b);
      // '</pre>';
      exit;
   }
}
