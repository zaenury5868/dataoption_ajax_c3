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
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}