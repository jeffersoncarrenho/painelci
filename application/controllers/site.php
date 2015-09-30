<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index()	{
		echo "Home do site";	
	}
	
	public function pagina(){
		$slug = $this->uri->segment(2);
		//busca pelo slug
		echo 'busca pelo slug: '. $slug;
	}
	
	public function post(){
		$slug = $this->uri->segment(2);
		//busca pelo slug
		echo 'busca pelo slug: '. $slug;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */