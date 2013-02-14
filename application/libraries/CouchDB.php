<?php
class CouchDB {

	private $username;
	private $password;
	private $url;

	function __construct() {
		// Include required file
		require(BASEPATH.'../application/libraries/CouchDBRequest.php');
		require(BASEPATH.'../application/libraries/CouchDBResponse.php');
		
		// Get couchdb lib
		$CI =& get_instance();
		
		$this->host = $CI->config->item('couchdb_host');
		$this->port = $CI->config->item('couchdb_port');
		$this->username = $CI->config->item('couchdb_user');
		$this->password = $CI->config->item('couchdb_pass');
		$this->db  = $CI->config->item('couchdb_db');
	}

	static function decode_json($str) {
		return json_decode($str);
	}

	static function encode_json($str) {
		return json_encode($str);
	}

	function send($url, $method = 'get', $data = NULL) {
		$this->url = '/'.$this->db.'/'.$url;
		$request = new CouchDBRequest($this->host, $this->port, $this->url, $method, $data, $this->username, $this->password);
		return $request->send();
	}
	
	function send_view($design, $view_name, $offset = NULL, $limit = NULL, $other_option = NULL)
	{
		$this->url = '/'.$this->db;
		$this->url .= '/_design/'.$design;
		$this->url .= '/_view/'.$view_name;
		
		$additional_param = '?';
		
		if($limit !== NULL)
		{
			$additional_param .= 'limit='.$limit.'&';
		}
		
		if($offset !== NULL)
		{
			$additional_param .= 'skip='.$offset.'&';
		}
		
		if($other_option !== NULL)
		{
			$additional_param .= $other_option;
		}
		
		$this->url .= $additional_param;
		$request = new CouchDBRequest($this->host, $this->port, $this->url, 'GET', NULL, $this->username, $this->password);
		return $request->send();
	}

	// get document from given document's id
	function get_item($id) {
		return $this->send('/'.$id);
	}
	
	// parse body from couchdbresponse object to json object
	function parse_body($response)
	{
		try
		{
			$response = json_decode($response->getBody());
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		
		return $response;
	}
	
	//get last url executed
	function get_url()
	{
		return $this->url;
	}
}