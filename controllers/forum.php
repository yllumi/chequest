<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends Public_Controller {
	
	public function __construct()
    {
        parent::__construct();

		$this->load->model('chequest/activity_m');
		
		// Load css/js
		$this->template
			 ->append_css('module::chequest.css')
			 ->append_js('module::chequest.js')
			 ->set('context', 'forum');
		
		// Set Sidenav
		$this->_set_sidenav();
	}
	
	public function index($id = 1)
	{
		if(!$id) $id = $this->session->userdata('user_id');
		
		if(!is_int($id)) $activities = $this->activity_m->get_many_by(array('username'=>$id));
	 		else $activities = $this->activity_m->get_many($id);

		// Build page
		//$this->template->build('product');
		
		$this->template->set_partial('content', 'forum/index.php');
			 
		self::build();
	}
	
	function _set_sidenav(){
		$this->load->model('chequest/context_m');
		
		// get context for context navs
		$data['navs'] = $this->context_m->get_all();
		$this->template->set_partial('sidenav', 'sidenav.php', $data);
	}
	
	function build($layout = 'layout'){
		$this->template->build($layout);
	}
    
}
