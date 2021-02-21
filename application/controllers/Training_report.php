<?php
class Training_report extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('mtraining_report');
    }

    function index() {
        $tahun=date('Y');   
        $data['report'] = $this->mtraining_report->get_list_report();
        $data['jumlah_bulan'] = $this->mtraining_report->get_jumlah_bulan();

        $data['user_role'] = $this->session->userdata('role');
        $data['breadcrumb'] = 'report/vtraining_report_breadcrumb';
        $data['content'] = 'report/vtraining_report.php';
        $data['js'] = 'template/vdatatable_js.php';
        $data['css'] = 'template/vdatatable_css.php';;
        $this->load->view('template/vtemplate.php', $data);
    }
}  

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template_b file, choose Tools | Templates
 * and open the template_b in the editor.
 */

