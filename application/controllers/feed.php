<?php
// belajar membuat rss

class Feed extends CI_Controller {  

      function __construct()  
      {  
        parent::__construct();  
        $this->load->helper('xml');  
        $this->load->helper('text');  
        $this->load->model('posts_model', 'posts');  
      }  
  	function index()  
	{  
    $data['feed_name'] = 'Agate Gempon blog'; // your website  
    $data['encoding'] = 'utf-8'; // the encoding  
    $data['feed_url'] = 'http://www.gempon.net'; // the url to your feed  
    $data['page_description'] = 'here it is'; // some description  
    $data['page_language'] = 'en-en'; // the language  
    $data['creator_email'] = 'byn@gempon.net'; // your email  
    $data['posts'] = $this->posts->getPosts();  
    header("Content-Type: application/rss+xml"); // important!
    $this->load->view('rss', $data);    
	}  
}

?>