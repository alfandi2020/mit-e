<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Produk extends CI_Model
{
   var $table = 'produk';
   var $column_order = array(null, 'nama_paket');
   var $column_search = array(null, 'nama_paket');
   var $order = array('id' => 'asc');

   public function get_datatables($postData)
   {
      $response = array();

      // value
      $draw = $postData['draw'];
      $start = $postData['start'];
      $rowperpage = $postData['length'];
      $columnIndex = $postData['order'][0]['column'];
      $columnName = $postData['columns'][$columnIndex]['data'];
      $columnSortOrder = $postData['order'][0]['dir'];
      $searchValue = $postData['search']['value'];

      $this->db->select('count(*) as allcount');
      if ($searchValue != '') {
         $this->db->or_like('nama_paket', $searchValue);
      }
      $records = $this->db->get($this->table)->result();
      $totalRecords = $records[0]->allcount;

      $this->db->select('count(*) as allcount');
      // if($searchQuery != '')
      //    $this->db->where($searchQuery);
      if ($searchValue != '') {
         $this->db->or_like('nama_paket', $searchValue);
      }
      $records = $this->db->get($this->table)->result();
      $totalRecordwithFilter = $records[0]->allcount;
      $this->db->limit($rowperpage, $start);
      if ($searchValue != '') {
         $this->db->order_by('nama', 'ASC');
         $this->db->or_like('nama_paket', $searchValue);
      }

      $records = $this->db->get($this->table)->result();

      $data = array();

      foreach ($records as $record) {

         $edit = '<a class="btn btn-primary" href=' . base_url() . 'produk/edit/' . $record->id . ' title="Edit nama paket"><i class="feather icon-edit"></i></a> ';

         $delete = '<a class="btn btn-danger" href=' . base_url() . 'produk/delete/' . $record->id . ' title="Hapus paket"><i class="feather icon-trash"></i></a> ';

         $set_isi = '<a class="btn btn-primary" href=' . base_url() . 'produk/set_paket/' . $record->id . ' title="Pilih isi paket"><i class="feather icon-folder-plus"></i></a> ';

         // query cek isi paket
         $cek_isi_paket = $this->db->select('count(Id) as count')->from('detail_produk')->where('kode_produk', $record->id)->get()->result();

         $isi_paket = $cek_isi_paket[0]->count;

         // apabila isi paket belum ada, button tambah paket tidak bisa diklik
         if ($isi_paket < 1) {
            $tambah_disabled = "disabled";
         } else {
            $tambah_disabled = "";
         }

         $tambah = '<a class="btn btn-primary ' . $tambah_disabled . '" href=' . base_url() . 'produk/tambah_paket/' . $record->id . ' title="Tambah paket"><i class="feather icon-plus"></i></a> ';

         // query cek jumlah paket berdasarkan id dan status = 'in'
         $kondisi_in = array('kode_produk' => $record->id, 'status' => "in");
         $query_stok_in = $this->db->select('sum(jumlah_paket) as jumlah')->from('history_produk')->where($kondisi_in)->get()->result();

         $stok_in = $query_stok_in[0]->jumlah;

         // query cek jumlah paket berdasarkan id dan status = 'out'
         $kondisi_out = array('kode_produk' => $record->id, 'status' => "out");
         $query_stok_out = $this->db->select('sum(jumlah_paket) as jumlah')->from('history_produk')->where($kondisi_out)->get()->result();

         $stok_out = $query_stok_out[0]->jumlah;

         $sisa_stok = $stok_in - $stok_out;

         $data[] = array(
            "nama_paket" => $record->nama_paket,
            "stok" => number_format($sisa_stok),
            "isi_paket" => $isi_paket,
            "action" => $edit . $delete . $set_isi . $tambah
         );
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
