<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{	
		parent:: __construct();
		$this->load->model('siswa_model');
		$this->load->helper('url');
	}

	function index()
	{
		$data['siswa'] = $this->siswa_model->get_all_siswa();
		$this->load->view('siswa_view', $data);
	}

	function create()
	{
		$data = array(
			
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
			);

		$create = $this->siswa_model->create($data);
		echo json_encode(array("status" => true));
	}

	public function ajax_edit($id)
	{
		$data = $this->siswa_model->get_by_id($id);
		echo json_encode($data);
	}

	public function update($id)
	{
		$data = array(
			
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
			);

		$this->siswa_model->update($data);
		echo json_encode(array("status" => true));
	}

	public function delete($id)
	{
		$this->siswa_model->delete($id);
		echo json_encode(array("status" => true));
	}
}
