<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Booking extends CI_Model {

   var $table = 'booking';
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
      if ($searchValue != '') {
         $this->db->or_like('destinasi',$searchValue);
         }
      $records = $this->db->get($this->table)->result();
      $totalRecords = $records[0]->allcount;

      $this->db->select('count(*) as allcount');
      // if($searchQuery != '')
      //    $this->db->where($searchQuery);
      if ($searchValue != '') {
         $this->db->or_like('destinasi',$searchValue);
         }
      $records = $this->db->get($this->table)->result();
      $totalRecordwithFilter = $records[0]->allcount;
      $this->db->limit($rowperpage, $start);
      if ($searchValue != '') {
         $this->db->or_like('destinasi',$searchValue);
         }
      
      $records = $this->db->from($this->table)->get()->result();

      $data = array();
      // aa

      $no = 1;

      foreach ($records as $record) {
         if ($record->status == '1') {
            $delete = '<a class="btn btn-danger" href='.base_url().'pricelist/delete/'.$record->id.'><i class="feather icon-trash"></i></a>';
         }else{
            $delete = '<a class="btn btn-success" href='.base_url().'pricelist/delete/'.$record->id.'/back><i class="feather icon-refresh-ccw"></i></a>';
         }
         $data[] = array(
            // "nomor" => $no++,
            "maskapai_id" => $record->all_in,
            "origin" => $record->status,
            "destinasi" => $record->date_created,
            "action" => '<a class="btn btn-primary" href='.base_url().'pricelist/edit/'.$record->id.'><i class="feather icon-edit"></i></a> '.$delete.'
            
            ',
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