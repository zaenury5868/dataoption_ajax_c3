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
		$data['title'] = 'Data customer';
		$data['pelanggan'] = $this->Dynamic_model->getDataCustomer();
		$this->load->view('dynamicselect/index', $data);
	}
	
	public function add()
	{
		$data['provinsi'] = $this->Dynamic_model->getDataProv();
		$data['title'] = 'Tambah customer';
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('dynamicselect/getdata', $data);
		} else {
			$input = [
				'nama' => htmlspecialchars($this->input->post('nama'), true),
				'alamat' => htmlspecialchars($this->input->post('alamat'), true),
				'provinsi_id' => $this->input->post('provinsi'),
				'kabupaten_id' => $this->input->post('kabupaten'),
				'kecamatan_id' => $this->input->post('kecamatan'),
				'desa_id' => $this->input->post('desa'),
				'date_created' => time(),
				'date_modified' => time(),
			];

			if($this->Dynamic_model->create($input) > 0){
				$this->session->set_flashdata('status', 'Data berhasil disimpan');
				redirect('select');
			} else {
				$this->session->set_flashdata('status', 'Server gangguan');
			};
		}
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