<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $head;
	var $foot;

		public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Data_lib','session'));
		$this->load->helper(array('url'));
		$data['regions'] = $this->data_lib->getRegions();
		if ($x = $this->input->cookie('region')) {
			$this->region = $x;
		}
		else {
			$this->region = $data['regions'][0]['region'];
			$cookie = array(
			    'name'   => 'region',
			    'value'  => $this->region,
			    'expire' => '0',
			    'path'   => '/',
			);
			$this->input->set_cookie($cookie);
		}
		$subCategory = $this->data_lib->getSubCategories();
		$data['isLoggedIn'] = $this->data_lib->auth();
		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_token'] = $this->security->get_csrf_hash();
		$data['subCategory'] = [];
		foreach ($subCategory as $key => $value) {
			if(!array_key_exists($value['category'],$data['subCategory'])){
				$data['subCategory'][$value['category']] = [];
			}
			array_push($data['subCategory'][$value['category']], $value['subcategory']);
		}
		$data['region'] = $this->region;
		$this->head =  $this->load->view('common/head',$data,true);
		$this->foot =  $this->load->view('common/foot',[],true);
	}	

	public function index()
	{
		$deals = $this->data_lib->getPrimaryDeals($this->region);
		foreach ($deals as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$deals[$key][$key2]['images'] = json_decode($value2['images'],true);
				$deals[$key][$key2]['city'] = json_decode($value2['city'],true);
				$deals[$key][$key2]['malls'] = json_decode($value2['malls'],true);
			}
		}
		$data['deals'] = $deals;
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('home', $data);
	}

	public function aboutus()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$content = $this->data_lib->getContent();
		$data['about'] = $content[0];
		$this->load->view('aboutus', $data);
	}

	public function merchant_account()
	{
		if($this->data_lib->auth()){
			redirect(base_url());
		}
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('merchant_account', $data);
	}

	public function merchant_add_offer()
	{		
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('merchant_add_offer', $data);
	}

	public function merchant_register()
	{
		if($this->data_lib->auth()){
			redirect(base_url());
		}		
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('merchant_register', $data);
	}

	public function registerMerchant(){
		$data['name'] = ($this->input->post('name'))?$this->input->post('name'):'';
		$data['email'] = ($this->input->post('email'))?$this->input->post('email'):'';
		$data['password'] = ($this->input->post('password'))?$this->input->post('password'):'';
		$data['contact'] = ($this->input->post('contact'))?$this->input->post('contact'):'';
		$data['region'] = ($this->input->post('region'))?$this->input->post('region'):'';
		if($data['name'] == '' || $data['email'] == '' || $data['password'] == '' || $data['contact'] == '' || $data['region'] == ''){
			die('Incomplete Details');
		}
		$result = $this->data_lib->checkMailExist($data['email'],'merchant');
		if ($result) {
			die('Email already exist..');
		}
		$result = $this->data_lib->registerMerchant($data);
		if ($result) {
			$result = $this->data_lib->login($data['email'],$data['password'],'merchant');
			if ($result) {
				redirect(base_url());
			}
			else {
				die('Some Error occured');
			}			
		}		
	}

	public function merchantLogin(){
		$email = ($this->input->post('email'))?$this->input->post('email'):'';
		$password = ($this->input->post('password'))?$this->input->post('password'):'';

		if ($email==''||$password=='') {
			die("Incomplete Details");
		}		

		$result = $this->data_lib->login($email,$password,'merchant');

		if ($result) {
			redirect(base_url());
		}
		else {
			die('Some Error occured');
		}			
	}

	public function user_change_password()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('user_change_password', $data);
	}

	public function user_profile()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('user_profile', $data);
	}

		
	public function contact_us()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->library('email');
		$config = Array(
	     'protocol' => 'smtp',
	     'smtp_host' => 'ssl://smtp.googlemail.com',
	     'smtp_timeout' => '7',
	     'smtp_port' => '465',
	     'smtp_user' => 'discountsdekho@gmail.com', // change it to yours
	     'smtp_pass' => 'discounts@999', // change it to yours
	     'mailtype' => 'html',
	     'newline'   => "\r\n",
	     'charset' => 'utf-8',
	     'wordwrap' => TRUE
		);
		$this->email->initialize($config);
		if($this->input->post('submit')) {
			$this->email->from('discountsdekho@gmail.com', "Admin Team");
			$this->email->to("v.nikhil323@gmail.com");
			$this->email->subject("Contact Us");
			$this->email->message('<p><strong>Email</strong> : '.$this->input->post('email').'</p><p><strong>Message</strong> : '.$this->input->post('message').'</p><p><strong>Mobile</strong> : '.$this->input->post('mobile').'</p><p><strong>Name</strong> : '.$this->input->post('name').'</p>');
		  	$this->email->send();
		}
		$this->load->view('contact_us', $data);
	}


		public function privacy_policy()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$content = $this->data_lib->getContent();
		$data['privacy'] = $content[1];
		$this->load->view('privacy_policy', $data);
	}

	public function disclaimer()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$content = $this->data_lib->getContent();
		$data['disclaimer'] = $content[2];
		$this->load->view('disclaimer', $data);
	}



		public function user_coupons()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('user_coupons', $data);
	}

	public function category($category = '')
	{
		if ($category == '') {
			die('No Category Given');
		}
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$category = urldecode($category);
		$data['categorydeals'] = $this->data_lib->getCategoryDeals($this->region,$category);
		$data['category'] = $category;
		$this->load->view('category', $data);
	}

	public function subcategory($subcategory = '')
	{
		if ($subcategory == '') {
			die('No Subcategory Given');
		}else{
			$subcategory = urldecode($subcategory);
		}
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		// $subcategory = $this->data_lib->getSubcategoryFromId($id);
		$subcategorydeals = $this->data_lib->getSubcategoryDeals($this->region,$subcategory);
		$data['subcategorydeals'] = $subcategorydeals;
		$data['subcategory'] = $subcategory;
		if (count($subcategorydeals) == 0) {
			$data['category'] = $this->data_lib->getCategoryFromSubcateogry($subcategory)[0]['category'];
		}
		else {
			$data['category'] = $subcategorydeals[0]['category'];
		}
		// $data['subcategoryid'] = $id;
		$this->load->view('subcategory',$data);
	}

	public function search()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('search', $data);
	}

	public function faq()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$data['faq'] = $this->data_lib->getFaq();
		$this->load->view('faq', $data);
	}

	public function advertise()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('advertise', $data);
	}

	public function login(){
		$email = ($this->input->post('email'))?$this->input->post('email'):'';
		$password = ($this->input->post('password'))?$this->input->post('password'):'';

		if ($email==''||$password=='') {
			die("Incomplete Details");
		}		

		$result = $this->data_lib->login($email,$password);

		if ($result) {
			redirect(base_url());
		}
		else {
			die('Some Error occured');
		}		

	}

	public function logout()
	{
    $this->session->set_userdata('userLoggedIn', false);
    $this->session->set_userdata('merchantLoggedIn',false);
    $this->session->set_userdata('user_data', []);
		redirect(base_url());
	}	

	public function signup() {
		$name = ($this->input->post('name'))?$this->input->post('name'):'';
		$email = ($this->input->post('email'))?$this->input->post('email'):'';
		$mobile = ($this->input->post('mobile'))?$this->input->post('mobile'):'';
		$dob = ($this->input->post('dob'))?$this->input->post('dob'):'';
		$password = ($this->input->post('password'))?$this->input->post('password'):'';
		$city = ($this->input->post('city'))?$this->input->post('city'):'';
		$gender = ($this->input->post('gender'))?$this->input->post('gender'):'';
			
		if ($name==''||$email==''||$mobile==''||$dob==''||$password==''||$city==''||$gender=='') {
			die("Incomplete Details");
		}

		$data = array(
			'name' => $name,
			'email' => $email,
			'mobile' => $mobile,
			'dob' => $dob,
			'sex' => $gender,
			'city' => $city,
			'password' => $password
			);
		
		$result = $this->data_lib->checkMailExist($email,'userdb');
		if ($result) {
			die('Email already exist..');
		}
		$result = $this->data_lib->signup($data);
		if ($result) {
			$result = $this->data_lib->login($email,$password,'userdb');
			if ($result) {
				redirect(base_url());
			}
			else {
				die('Some Error occured');
			}			
		}
	}
	
	public function listoffers()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->library('email');
		$config = Array(
	     'protocol' => 'smtp',
	     'smtp_host' => 'ssl://smtp.googlemail.com',
	     'smtp_timeout' => '7',
	     'smtp_port' => '465',
	     'smtp_user' => 'discountsdekho@gmail.com', // change it to yours
	     'smtp_pass' => 'discounts@999', // change it to yours
	     'mailtype' => 'html',
	     'newline'   => "\r\n",
	     'charset' => 'utf-8',
	     'wordwrap' => TRUE
		);
		$this->email->initialize($config);
		if($this->input->post('submit')) {
			$this->email->from('discountsdekho@gmail.com', "Admin Team");
			$this->email->to("v.nikhil323@gmail.com");
			$this->email->subject("Sales");
			$this->email->message('<p><strong>Email</strong> : '.$this->input->post('email').'</p><p><strong>Company Name</strong> : '.$this->input->post('company_name').'</p><p><strong>Brand Name</strong> : '.$this->input->post('brand_name').'</p><p><strong>Mobile</strong> : '.$this->input->post('mobile').'</p><p><strong>Link</strong> : '.$this->input->post('link').'</p>');
		  	$this->email->send();
		}
		$this->load->view('listoffers', $data);
	}

	public function media()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('media', $data);
	}

	public function merchant_add_coupon()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('merchant_add_coupon', $data);
	}

	public function merchant_settings()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('merchant_settings', $data);
	}

	public function merchant_offers_added()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('merchant_offers_added', $data);
	}

	public function merchant_coupons_issued()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$this->load->view('merchant_coupons_issued', $data);
	}

	public function deal($slug = '')
	{
		if ($slug == '') {
			die('Invalid URL given');
		}else{
			preg_match ('/([a-zA-z0-9-]+)-([0-9]+)/',$slug,$matches);
			if($matches){
				$title = str_replace('-', ' ', $matches[1]);
				$id = $matches[2];
			}else{
				die('No Id Given');
			}
		}
		$data['isLoggedIn'] = $this->data_lib->isLoggedIn();
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$dealData = $this->data_lib->getDealData($this->region,$id,$title);
		if ($dealData == array()) {
			redirect(base_url());
		}
		$dealData = $dealData[0];
		$dealData['city'] = json_decode($dealData['city']);
		$dealData['malls'] = json_decode($dealData['malls']);
		$dealData['images'] = json_decode($dealData['images'],true);
		if ($x = json_decode($dealData['subcategory'])) {
			$str = '';
			foreach ($x as $key => $value) {
				if ($key == (count($x)-1)) {
					$str .= $value;
				}
				else {
					$str .= $value.',';
				}
			}
			$dealData['subcategory'] = $str;
		}
		$dealData['start_date'] = date('d-F-Y',strtotime($dealData['start_date']));
		if ($dealData['end_date'] != '0000-00-00') {
			$dealData['end_date'] = date('d-F-Y',strtotime($dealData['end_date']));
		}
		else {
			$dealData['end_date'] = 'Limited Period Offer';	
		}
		$headData['csrf_token_name'] = $this->security->get_csrf_token_name();
		$headData['csrf_token'] = $this->security->get_csrf_hash();
		$data['reviews'] = $this->data_lib->getReviews($dealData['id']);
		$data['dealData'] = $dealData;
		$this->load->view('deal',$data);
	}

	public function testimonials()
	{
		$data['head'] = $this->head;
		$data['foot'] = $this->foot;
		$data['testimonials'] = $this->data_lib->getTestimonials();
		$this->load->view('testimonials', $data);
	}


}
