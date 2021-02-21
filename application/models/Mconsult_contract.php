<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mconsult_contract extends CI_Model {

	function getDataContract() {
		$this->db->order_by('contract_end', 'ASC');
		$this->db->order_by('contract_cancel', 'ASC');
		$this->db->order_by('total_attendances', 'ASC');
		$this->db->order_by('contract_id', 'ASC');
		$this->db->order_by('user_code', 'ASC');
		return $this->db->get('fis_vconsult_contracts')->result();
	}

	function getDataPack() {
		return $this->db->get("fis_vconsult_packages")->result();
	}

	function getDataRes() {
		return $this->db->get("fis_rresources")->result();
	}

	function getDataBaseApp() {
		return $this->db->get("fis_rbase_applications")->result();
	}

	function findDataContract($contract_id) {
		return $this->db->get_where('fis_vconsult_contracts', array('contract_id'=>$contract_id), 1)->row();
	}

	function findDataConsult($id_consult) {
		return $this->db->get_where('fis_vconsult_contracts', array('consultation_id'=>$id_consult), 1)->row();
	}

	function getDataDiscount($contract_id) {
		return $this->db->get_where('fis_dservice_consult_contracts', array('sccontr_id'=>$contract_id), 1)->row();	
	}

	function updateContract($data, $id) {
		if($this->db->update('fis_dservice_consult_contracts', $data, array('sccontr_id' => $id))){
			return true;
		} else return false;
	}
	
	function endContract($contract_id){
		$this->db->set('sccontr_end', 1)
			 ->where('sccontr_id', $contract_id)
			 ->update('fis_dservice_consult_contracts'); 
	}

	function insertContract($data){
		return $this->db->insert('fis_dservice_consult_contracts', $data);
	}

	function updateStatus($consultation_id, $active_user){
		$this->db->set('scons_status_fk', 5)
			->set('user_update', $active_user)
			->where('scons_id', $consultation_id)
			->update('fis_dservice_consultations'); 
	}

	function findAddFee($contract_id){
		return $this->db->get_where('fis_dservice_consult_additional_fees', array('scadd_fee_scccontr_fk'=>$contract_id))->result();
	}

	function findAddFeeById($id){
		return $this->db->get_where('fis_dservice_consult_additional_fees', array('scadd_fee_id'=>$id))->row();
	}

	function insertAddFee($data){
		return $this->db->insert('fis_dservice_consult_additional_fees', $data);	
	}

	function getDataCategories(){
		return $this->db->get_where('fis_rfile_categories', array('fcategory_id'=>3))->result();
	}

	function saveData($dataItem){
		$this->db->insert('fis_dservice_consult_files',$dataItem);
	}

	public function get_active_contract() { //added by nurhasanhilmi
		$array = array('contract_cancel' => 0);
		$this->db->order_by('user_code', 'ASC');
		$query = $this->db->get_where('fis_vconsult_contracts', $array);
		return $query->result();
	}

	function getDataFee($id_fee){
		return $this->db->get_where('fis_dservice_consult_additional_fees', array('scadd_fee_id'=>$id_fee))->row();	
	}

	function updateAddFee($data, $id){
		if($this->db->update('fis_dservice_consult_additional_fees', $data, array('scadd_fee_id' => $id))){
			return true;
		} else return false;	
	}

	function deleteAddFee($id){
		return $this->db->delete('fis_dservice_consult_additional_fees', array('scadd_fee_id' => $id)); 
	}

	function batalKontrak($id){
		return $this->db->set('contract_cancel', 1)
			->where('contract_id', $id)
			->update('fis_vconsult_contracts'); 
	}

	function pulihkanKontrak($id){
		return $this->db->set('contract_cancel', 0)
			->where('contract_id', $id)
			->update('fis_vconsult_contracts'); 
	}

	function lanjutkanKontrak($id){
		return $this->db->set('contract_cancel', 0)
			->set('contract_end', 0)
			->where('contract_id', $id)
			->update('fis_vconsult_contracts'); 
	}

	function findContract($contract_id){
		return $this->db->get_where('fis_vconsult_contracts', array('contract_id'=>$contract_id), 1)->row();
	}
}

/* End of file Mconsult_contract.php */
/* Location: ./application/models/Mconsult_contract.php */
