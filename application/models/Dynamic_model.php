<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic_model extends CI_Model 
{
	public function getDataProv()
	{
		return $this->db->get('wilayah_provinsi')->result_array();
	}

	public function getDataKabupaten($idprov)
	{
		return $this->db->get_where('wilayah_kabupaten', ['provinsi_id' => $idprov])->result();
	}
	public function getDataKecamatan($idkabupaten)
	{
		return $this->db->get_where('wilayah_kecamatan', ['kabupaten_id' => $idkabupaten])->result();
	}
	public function getDataDesa($idkecamatan)
	{
		return $this->db->get_where('wilayah_desa', ['kecamatan_id' => $idkecamatan])->result();
	}
	public function create($input)
	{
		$this->db->insert('m_customer', $input);
		return $this->db->affected_rows();
	}

	public function getDataCustomer()
	{
		$this->db->select('a.nama as customer,a.alamat,b.nama as provinsi,c.nama as kabupaten,d.nama as kecamatan,e.nama as desa');
		$this->db->from('m_customer as a');
		$this->db->join('wilayah_provinsi as b', 'a.provinsi_id=b.id');
		$this->db->join('wilayah_kabupaten as c', 'a.kabupaten_id=c.id');
		$this->db->join('wilayah_kecamatan as d', 'a.kecamatan_id=d.id');
		$this->db->join('wilayah_desa as e', 'a.desa_id=e.id');
		return $this->db->get()->result_array();
		
	}

}