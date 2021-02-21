<?php
/**
 * Description of Barang
 *
 * @author samektaadi
 */
class Consult_payroll extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('mconsult_payroll');
    }

    function index($tahun=0) {
        $tahun = $tahun==0?date('Y'):$tahun;
      
        $data['penggajian'] = $this->mconsult_payroll->get_by_tahun($tahun);
        $data['tahun'] = $this->mconsult_payroll->get_tahun();
        $data['tahun_dipilih'] = $tahun;

        $data['user_role'] = $this->session->userdata('role');
        $data['breadcrumb'] = 'payroll/vconsult_payroll_breadcrumb';
        $data['content'] = 'payroll/vconsult_payroll.php';
        //$data['js'] = 'template/vdatatable_js.php';
        //$data['css'] = 'template/vdatatable_css.php';
        $this->load->view('template/vtemplate.php', $data);
    }
    function detail($id=1,$bulan=01,$tahun=2020,$sbulan="",$salary=1) {
        $data['tentor'] = $this->mconsult_payroll->get_by_id_tentor($id,$bulan,$tahun);
        $data['penggajian'] = $this->mconsult_payroll->get_by_id_mhs($id,$bulan,$tahun);
        $data['bulan'] = $sbulan;
        $data['tahun'] = $tahun;
        $data['salary'] = $salary;
        $data['user_role'] = $this->session->userdata('role');

        $data['breadcrumb'] = 'payroll/vconsult_payroll_invoice_breadcrumb';
        $data['content'] = 'payroll/vconsult_payroll_invoice.php';
        $data['js'] = 'template/vdatatable_js.php';
        $data['css'] = 'template/vdatatable_css.php';
        $this->load->view('template/vtemplate.php', $data);
    }
}  

