<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {

    public function  __construct()
    {
        parent::__construct();
        // $this->load->library('Pdf');
    }
    function index(){
        $data = [
			'title' => 'Laporan',
			'agent' => $this->db->get('dt_agent')->result(),
	    ];
        $this->load->view('temp/header',$data);
        $this->load->view('body/laporan',$data);
        $this->load->view('temp/footer');
    }
    function pdf($id){
        // require_once APPPATH . '../vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf([
                'tempDir' => '/tmp',
                'mode' => '',
                'format' => 'A4',
                'default_font_size' => 0,
                'default_font' => '',
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 5,
                'margin_bottom' => 0,
                // 'margin_header' => 10,
                // 'margin_footer' => 5,
                'orientation' => 'P',
            ]);
            $this->db->select('*');
            $this->db->from('dt_excel as a');
            $this->db->from('dt_agent as b');
            $this->db->where('a.Z',$id);
            $data['report'] = $this->db->get()->result();
            $mpdf->WriteHTML($this->load->view('body/pdf',$data,true));
            // $mpdf->SetHTMLFooter('
            // <img style="margin-bottom: -34px;" src="assets/images/footer.png" alt="">
            // ');
        $mpdf->Output();
        // $filename=$target_x."/assets/$filenamex.pdf";
        // $mpdf->Output($filename, 'F');
    }
}