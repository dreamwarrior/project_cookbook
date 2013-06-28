<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approve_order extends CI_Controller {

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
	
	public function __construct() {
        parent::__construct();
		$this->load->model('admin_model');
		$this->load->database();
		$is_logged_in_user=$this->session->userdata('is_logged_in_user');
		$is_logged_in_admin=$this->session->userdata('is_logged_in_admin');
		
        if ((!isset($is_logged_in_user) || $is_logged_in_user != TRUE)&&(!isset($is_logged_in_admin) || $is_logged_in_admin != TRUE))  {

            redirect();

        }
    }
	
	public function get_order_info()
	{
	$data['record']=$this->admin_model->get_order_info();
	$this->load->view('approve_order_view',$data);
	}
	public function approve()
	{
	$data['ACTIVE']=1;
	$this->admin_model->update_order($data);
	$this->get_order_info();
	}
	public function delete()
	{
	$this->admin_model->delete_order();
	$this->get_order_info();
	}
}