<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
//		$this->load->spark('example-spark/1.0.0');      # We always specify the full path from the spark folder
//		$this->example_spark->printHello();             # echo's "Hello from the example spark!"
		
		
//		$this->load->spark('doctrine2/1.0');
//		$this->em = $this->doctrine2->em;
		
		// your Entity Manager is now quickly available
//		$this->em(...);
		

//		$this->load->spark('markdown/1.2');
//		$html = parse_markdown("* aaa \r\n 	* bbb \r\n	");
//		echo $html;
		
		echo APPPATH.'  '.FCPATH;
		echo br(2);

		echo dirname(__FILE__);
		echo br(2);
		echo basename(__FILE__);
		echo br(2);
		echo getControllerCIPath(__FILE__);
		echo br(2);
		echo realpath(__FILE__);
		echo br(2);
		
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */