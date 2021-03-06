<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dynamic_model');
	}
	public function index()
	{
		$data['provinsi'] = $this->Dynamic_model->getDataProv();
		$this->load->view('dynamicselect/getdata', $data);
	}
	public function getKabupaten()
	{
		$idprov = $this->input->post('id');
		$data = $this->Dynamic_model->getDataKabupaten($idprov);
		$output = '<option value="">--Pilih Kabupaten--</option>';
		foreach($data as $row) {
			$output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	
	public function getKecamatan()
	{
		$idkabupaten = $this->input->post('id');
		$data = $this->Dynamic_model->getDataKecamatan($idkabupaten);
		$output = '<option value="">--Pilih Kecamatan--</option>';
		foreach($data as $row) {
			$output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	
	public function getDesa()
	{
		$idkecamatan = $this->input->post('id');
		$data = $this->Dynamic_model->getDataDesa($idkecamatan);
		$output = '<option value="">--Pilih Desa--</option>';
		foreach($data as $row) {
			$output .= '<option value="' . $row->id . '">' . $row->nama . '</option>';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
}