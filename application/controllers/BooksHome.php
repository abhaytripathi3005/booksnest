<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BooksHome extends CI_Controller {
	public function __construct() {

        //load parent class constructor
        parent::__construct();
		$this->load->helper('common');
    }

	public function index()
	{
		$requestData = [];
		if($_GET['qrStr'])
		{
			parse_str($_GET['qrStr'], $requestData);
		}
		else
		{
			$requestData['page'] = $_GET['page'] ? $_GET['page'] : 1;
			if($_GET['search'])
			{
				$requestData['search'] = $_GET['search'];
			}
			if($_GET['topic'])
			{
				$requestData['topic'] = $_GET['topic'];
			}
			if($_GET['languages'])
			{
				$requestData['languages'] = $_GET['languages'];
			}
		}
		$books = getBookList($requestData);
		$data['books'] = (array)json_decode($books);

		if($_GET['from_view']=="yes")
		{
			$responseArr = [];
			$responseArr['status']="success";
			$responseArr['message']="success";
			$responseArr['html'] = $this->load->view('book-list-ajax-view',$data,TRUE);
			echo json_encode($responseArr);
		}
		else
		{
			$this->load->view('book-list',$data);
		}
	}
}
