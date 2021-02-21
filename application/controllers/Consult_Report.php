<?php
class Consult_report extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('mconsult_report');
    }

    function index() {
        $tahun=date('Y');
        $data['report'] = $this->mconsult_report->get_list_report();
        $data['jumlah_bulan'] = $this->mconsult_report->get_jumlah_bulan();
        $data['user_role'] = $this->session->userdata('role');
        $data['breadcrumb'] = 'report/vreport_breadcrumb';
        $data['content'] = 'report/vreport.php';
        $data['js'] = 'template/vdatatable_js.php';
        $data['css'] = 'template/vdatatable_css.php';;
        $this->load->view('template/vtemplate.php', $data);
    }
}  


