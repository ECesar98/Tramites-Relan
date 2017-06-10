<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send extends CI_Controller {

	public function index(){
	
		$this->load->view('send');
	
	}
	
	public function submit(){

		$this->form_validation->set_rules('name', '<b>Nombre(s)</b>', 'trim|required|max_length[100]');

		$this->form_validation->set_rules('dni', '<b>Dni(s)</b>', 'trim|required|max_length[100]');


		$this->form_validation->set_rules('email', '<b>Email</b>', 'trim|required|valid_email|max_length[100]');
		$this->form_validation->set_rules('subject', '<b>Asunto</b>', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('message', '<b>Mensaje</b>', 'trim|required');

		$arr['name'] = $this->input->post('name');
		$arr['dni'] = $this->input->post('dni');
		$arr['codsiage'] = $this->input->post('codsiage');
		$arr['celular'] = $this->input->post('celular');
		$arr['nbcolegio'] = $this->input->post('nbcolegio');
		$arr['email'] = $this->input->post('email');
		$arr['subject'] = $this->input->post('subject');
		$arr['message'] = $this->input->post('message');

		if ($this->form_validation->run() == FALSE) {

			$arr['success'] = false;
			$arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . validation_errors() . '</div>';

		} else {

			$this->db->insert('message',$arr);
			$detail = $this->db->select('*')->from('message')->where('id',$this->db->insert_id())->get()->row();
			$arr['name'] = $detail->name;
			$arr['dni'] = $detail->dni;

			$arr['codsiage'] = $detail->codsiage;
			$arr['celular'] = $detail->celular;
			$arr['nbcolegio'] = $detail->nbcolegio;
			$arr['email'] = $detail->email;
			$arr['subject'] = $detail->subject;
			$arr['created_at'] = $detail->created_at;
			$arr['id'] = $detail->id;
			$arr['new_count_message'] = $this->db->where('read_status',0)->count_all_results('message');
			$arr['success'] = true;
			$arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Su mensaje fue envíado de manera exitosa ...</div>';

		}
		
		echo json_encode($arr);
	}
}
