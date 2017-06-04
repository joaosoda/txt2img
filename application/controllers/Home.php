<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->model(array('api_model'));
    }

    public function index()
    {
        $this->load->view('home');
    }

    public function upload()
    {
        if(!isset($_FILES['file'])) redirect('/');
        if($_FILES['file']['size'] == 0) redirect('/');

        $imagedata = file_get_contents($_FILES['file']['tmp_name']);
        $base64 = base64_encode($imagedata);

        $content = $this->api_model->insert(array('content' => $base64));

        redirect('/'.$content['md5']);
    }

    public function image($md5 = null)
    {
        if(is_null($md5)) redirect('/');
        $content = $this->api_model->get($md5);

        header("Content-type: image/jpg");
        echo base64_decode($content['content']);
    }
}