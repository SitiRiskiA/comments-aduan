<?php
	class Dashboard extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->helper('url');
			$this->load->model("Penduduk/ModelPenduduk");

		}

		public function index() {
			$data["active"] = "dashboard";
			$data["content"] = "dashboard/main";
			$this->load->view('templates/content', $data);
		}
	}
?>
