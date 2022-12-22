<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pricelist extends CI_Model {

   var $table = 'mite_pricelist';
   var $column_order = array(null, 'maskapai_id', 'origin', 'destinasi', 'all_in');
   var $column_search = array(null, 'maskapai_id', 'origin', 'destinasi', 'all_in');
   var $order = array('id' => 'asc');

   // public function __construct() {
   //    parent::__construct();
   //    $this->load->database();
   // }

   public function get_datatables($postData) {
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
      $records = $this->db->get($this->table)->result();
      $totalRecords = $records[0]->allcount;

      $this->db->select('count(*) as allcount');
      if($searchQuery != '')
         $this->db->where($searchQuery);
      $records = $this->db->get($this->table)->result();
      $totalRecordwithFilter = $records[0]->allcount;
      
      $records = $this->db->from($this->table)->get()->result();

      $data = array();
      // aa

      $no = 1;

      foreach ($records as $record) {
         $data[] = array(
            "nomor" => $no,
            "maskapai_id" => $record->maskapai_id,
            "origin" => $record->origin,
            "destinasi" => $record->destinasi,
            "all_in" => $record->all_in,
            // "action" => '<a href='.base_url().'pricelist/edit/'.$record->id.'>',
         );
         $no++;
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