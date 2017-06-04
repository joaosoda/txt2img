<?php
class Api_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->client = new GuzzleHttp\Client();
        $this->api = 'http://txt2sav.herokuapp.com/api/';
    }

    public function insert($post)
    {
        $response = $this->client->post($this->api.'newp', array('form_params' => $post));
        return $this->json($response);
    }

    public function get($md5)
    {
        $response = $this->client->get($this->api.'get/'.$md5);
        $string = (string) $response->getBody();
        return $content = (array) json_decode($string);
    }

    private function json(GuzzleHttp\Psr7\Response $response)
    {
        $string = (string) $response->getBody();
        $content = (array) json_decode($string);
        return $content;
    }
}