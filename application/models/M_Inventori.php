<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Inventori extends CI_Model
{

   var $table = 'inventori';
   var $column_order = array(null, 'nama_barang', 'jumlah', 'berat', 'pengirim');
   var $column_search = array(null, 'nama_barang', 'jumlah', 'berat', 'pengirim');
   var $order = array('nama_barang' => 'asc');

   // public function __construct() {
   //    parent::__construct();
   //    $this->load->database();
   // }

   // public function barang_list() 
   // {
   //    $hasil = $this->db->query("SELECT nama_barang, jumlah, berat, pengirim FROM inventori");
   //    return $hasil->result();
   // }

   public function get_datatables($postData)
   {
      $response = array();

      //value
      $draw = $postData['draw'];
      $start = $postData['start'];
      $rowperpage = $postData['length'];
      $columnIndex = $postData['order'][0]['column'];
      $columnName = $postData['columns'][$columnIndex]['data'];
      $columnSortOrder = $postData['order'][0]['dir'];
      $searchValue = $postData['search']['value'];

      $this->db->select('count(*) as allcount');
      if ($searchValue != '') {
         $this->db->or_like('nama_barang', $searchValue);
      }
      $records = $this->db->get($this->table)->result();
      $totalRecords = $records[0]->allcount;

      $this->db->select('count(*) as allcount');
      // if($searchQuery != '')
      //    $this->db->where($searchQuery);
      if ($searchValue != '') {
         $this->db->or_like('nama_barang', $searchValue);
      }
      $records = $this->db->get($this->table)->result();
      $totalRecordwithFilter = $records[0]->allcount;
      $this->db->limit($rowperpage, $start);
      if ($searchValue != '') {
         $this->db->or_like('nama_barang', $searchValue);
      }

      $records = $this->db->from('inventori')->join('dt_pengirim', 'dt_pengirim.id = inventori.pengirim')->order_by('nama_barang', 'ASC')->get()->result();

      $data = array();
      // aa

      $no = 1;

      foreach ($records as $record) {

         $delete = '<a class="btn btn-danger" href=' . base_url() . 'inventori/delete/' . $record->id . '><i class="feather icon-trash"></i></a>';

         $data[] = array(
            // "nomor" => $no++,
            "nama_barang" => $record->nama_barang,
            "jumlah" => $record->jumlah,
            "berat" => $record->berat,
            "pengirim" => $record->nama_pengirim,
            "action" => '<a class="btn btn-primary" href=' . base_url() . 'inventori/edit/' . $record->id . '><i class="feather icon-edit"></i></a> ' . $delete . '',
         );
         // $no++;
      }

      // response
      $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordwithFilter,
         "aaData" => $data,
      );

      return $response;
   }
}
