<?php
class Posts_model extends CI_Model {  
    // get all postings  
    function getPosts()  
    {  
        $resp = $this->couchdb->send_view('blog','blog_post');	//,0,2 == offset, limit 	offset itu data yang keberape yg diambil..     dan limit, berape jumlah data yang ditampilin
		$resp = json_decode($resp->getBody());											// di couchdbnye pake design yang list_Game dan page_Game     huruf G nye gede!!!!
		$ret_val = array();
		if( ! isset($resp->error))
		{
			foreach($resp->rows as $rows)
			{
				$ret_val[] = $rows;
			}
		}
		return $ret_val; 
    }  
}  

?>