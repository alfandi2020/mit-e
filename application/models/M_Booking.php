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
      // $this->db->where('status','Waiting');
      $records = $this->db->get($this->table)->result();
      $totalRecords = $records[0]->allcount;
      // $this->db->where('status','Waiting');
      $this->db->select('count(*) as allcount');
      // if($searchQuery != '')
      //    $this->db->where($searchQuery);
      if ($searchValue != '') {
         $this->db->or_like('destinasi',$searchValue);
         }
         $this->db->order_by('id', 'DESC');
      $records = $this->db->get($this->table)->result();
      $totalRecordwithFilter = $records[0]->allcount;
      $this->db->limit($rowperpage, $start);
      if ($searchValue != '') {
         $this->db->or_like('destinasi',$searchValue);
         }
      // $this->db->where('b.status','Waiting');
      $this->db->select('*,b.status as status_booking,b.id as id_book');
      $this->db->join('mite_pricelist as a','b.id_pricelist=a.id');
      $this->db->order_by('b.id', 'DESC');
      $records = $this->db->from('booking as b')->get()->result();

      $data = array();
      // aa

      $no = 1;

      foreach ($records as $record) {
            $role = $this->session->userdata('role');
            if ($record->product == 'Door to Port') {
               $charge_product = 3000;
            }else{
               $charge_product = 0;
            }
            if ($role == '1') {

               if ($record->status_booking == 'approve') {
                  if ($record->file_smu == true) {
                     $file_smu = '<a class="btn btn-primary" download href="upload/smu/'.$record->file_smu.'">'.$record->file_smu.' <i class="feather icon-download"></i></a>';
                     $invs = 'invisible';
                     $color_smu = 'success';
                     $invs_smu = '';
                  }else{
                     $file_smu = '';
                     $invs = '';
                     $color_smu = 'primary';
                     $invs_smu = 'invisible';

                  }
                  $action_status = '<button type="button" class="btn btn-'.$color_smu.'" data-toggle="modal" data-target="#exampleModal2'.$record->id_book.'">
                  SMU
                  </button>
                  <div class="modal fade" id="exampleModal2'.$record->id_book.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                     <form action="booking/status" method="POST" enctype="multipart/form-data">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">SMU</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                    <div class="col-xl-12">
                                    <label>Nomor SMU</label>
                                    <input type="text" class="form-control" name="no_smu">
                                    </div>
                              </div>
                              <br>
                              <div class="row">
                                    <div class="col-xl-12">
                                       <label>Upload SMU</label>
                                       <input type="file" class="form-control" name="file_smu">
                                       <input type="hidden" class="form-control" value='.$record->id_book.' name="id_book">
                                       <input type="hidden" value="upload_smu" name="status">
                                    </div>
                              </div>
                              <div class="row mt-2">
                                 <div class="col-xl-12">
                                    '.$file_smu.'
                                 </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                           <button type="submit" class="btn btn-primary '.$invs.'">Upload</button>
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cencel</button>
                           </div>
                        </div>
                     </form>
                  </div>
                  </div>
                  <button type="button" class="btn btn-warning '.$invs_smu.'" data-toggle="modal" data-target="#exampleModal3'.$record->id_book.'">
                     SELESAI ?
                  </button>
                  <div class="modal fade" id="exampleModal3'.$record->id_book.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                        <form action="booking/status" method="POST" enctype="multipart/form-data">
                           <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">SMU</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              <div class="modal-body ">
                                 <div class="row justify-content-center">
                                       <div class="col-xl-12">
                                          <h6>Apakah paket sudah sampai tujuan ?</h6>
                                          <h2 class="text-primary">Yakin Paket sudah sampai ?</h2>
                                          <input type="hidden" class="form-control" value='.$record->id_book.' name="id_book">
                                          <input type="hidden" value="selesai" name="status">
                                       </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cencel</button>
                              <button type="submit" class="btn btn-primary">Ok</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  ';
               }else if($record->status_booking == 'selesai'){
                  $action_status = '<b class="btn btn-success">SAMPAI TUJUAN</b>';
               }else{
                  $action_status = '<a class="btn btn-primary" href='.base_url().'booking/status/'.$record->id_book.'/approve>Approve</a> <a class="btn btn-danger" href='.base_url().'booking/status/'.$record->id_book.'/reject>Reject</a>';
               }
            }else {
               if ($record->status_booking == 'selesai') {
                  $action_status = '<b class="btn btn-success">SELESAI</b>';
               }else if($record->status_booking == 'approve'){
                  if ($record->file_smu == true) {
                     $file_smu = '<a class="btn btn-primary" download href="upload/smu/'.$record->file_smu.'">'.$record->file_smu.' <i class="feather icon-download"></i></a>';
                     $invs = 'invisible';
                     $color_smu = 'success';
                     $invs_smu = '';
                     $wait_smu = 'No SMU : '.$record->no_smu == "" ? "" : $record->no_smu.' <br>File SMU : <br>';
                  }else{
                     $file_smu = '';
                     $invs = '';
                     $color_smu = 'primary';
                     $invs_smu = 'invisible';
                     $wait_smu = 'Menunggu Upload SMU';
                  }
                  $action_status = '<button type="button" class="btn btn-'.$color_smu.'" data-toggle="modal" data-target="#exampleModal2'.$record->id_book.'">
                  SMU
                  </button>
                  <div class="modal fade" id="exampleModal2'.$record->id_book.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">SMU</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                    <div class="col-xl-12">
                                       <h4>File SMU</h4>
                                    </div>
                              </div>
                              <div class="row">
                                 <div class="col-xl-12">
                                 
                                 '.$wait_smu.'
                                    '.$file_smu.'
                                 </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cencel</button>
                           </div>
                        </div>
                  </div>
                  </div>
                  
                  ';
               }else{
                  $action_status = '';
               }
            }
            if ($record->net == "") {
               $net = '';
            }else{
               $net = "Rp." . number_format($record->net);
            }
            if ($record->fee_mite == "") {
              $feee = '';
            }else{
               $feee = "Rp." . number_format($record->fee_mite);
            }
         $data[] = array(
            // "nomor" => $no++,
            "origin" => $record->origin,
            "destinasi" => $record->destinasi,
            "price" => "Rp." . number_format($record->all_in + $charge_product),
            "weight" => $record->weight,
            "total" => "Rp." . number_format($record->all_in*$record->weight + $charge_product),
            "net" => $net,
            "fee" => "Rp." . number_format($feee),
            "tanggal" => $record->date_created,
            "action" => $action_status,
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