<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modelcrud extends CI_Model {
	

	function lihat_blog()
	{
		$resp = $this->couchdb->send_view('blog','blog_post', 0, 50, '&amp;include_docs=true');	//,0,2 == offset, limit 	offset itu data yang keberape yg diambil..     dan limit, berape jumlah data yang ditampilin
		$resp = json_decode($resp->getBody());											// di couchdbnye pake design yang list_Game dan page_Game     huruf G nye gede!!!!
		$ret_val = array();
		$noblogg = array();

		if( ! isset($resp->error))
		{
			foreach($resp->rows as $rows)
			{
				$ret_val[] = $rows;
			}
		}
		return $ret_val;
	}

	function hitung_komen()
	{
		$resp = $this->couchdb->send_view('blog','blog_post', 0, 50, '&amp;include_docs=true');	//,0,2 == offset, limit 	offset itu data yang keberape yg diambil..     dan limit, berape jumlah data yang ditampilin
		$resp = json_decode($resp->getBody());											// di couchdbnye pake design yang list_Game dan page_Game     huruf G nye gede!!!!
		
		$noblog = array();
		$tampung = array();

		if( ! isset($resp->error))
		{
			foreach($resp->rows as $rows)
			{

				$hitung = $this->couchdb->send_view('blog','blog_comment',0,50,'key="'.$rows->value->noblog.'"&amp;include_docs=false');
				$hitung = json_decode($hitung->getBody());
				$tampung[]=count($hitung ->rows);
			}

		}
		return $tampung;
	}

	function lihat_post($emit)
	{
		$resp = $this->couchdb->send_view('blog','blog_post',0,50,'key="'.$emit.'"&amp;include_docs=true');	//,0,2 == offset, limit 	offset itu data yang keberape yg diambil..     dan limit, berape jumlah data yang ditampilin
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

	function lihat_komen($emit)
	{
		$resp = $this->couchdb->send_view('blog','blog_comment', 0, 50, 'key="'.$emit.'"&amp;include_docs=true');	//,0,2 == offset, limit 	offset itu data yang keberape yg diambil..     dan limit, berape jumlah data yang ditampilin
		$resp = json_decode($resp->getBody());											// di couchdbnye pake design yang list_Game dan page_Game     huruf G nye gede!!!!
		$ret_val_comment = array();
		if( ! isset($resp->error))
		{
			foreach($resp->rows as $rows)
			{
				$ret_val_comment[] = $rows;
			}
		}
		return $ret_val_comment;
	}

	function simpan ($judul, $isi, $tanggal, $tags, $type)
	{
           
        $hitung = $this->couchdb->send_view('blog','blog_post');		 			//ini buat ngambil datanye ade berape
		$hitung = json_decode($hitung->getBody());
		$noblog = $hitung->total_rows + 1; 

            $data = array(
                "create_date"=>$tanggal, 
                "isi"=>$isi, 
                "judul"=>$judul, 
                "noblog"=>"blog-".$noblog,
                "tags"=>$tags, 
                "type"=>$type
            );

        $id_unik = 'blogBenyamin::Guest::'.intval(date('dmY')).'-'.time();
        //echo "<pre>";
        //print_r($data);  //nuat menguji hasil dari variable
        //echo "</pre>";
        $resp = $this->couchdb->send($id_unik, 'PUT', json_encode($data));
		$resp = json_decode($resp->getBody());

		if ($resp) {
			redirect('home');
		}

    }

    function komenin ($noblog,$comment)
    {
    	$tanggal=date("F j, Y, g:i a");
    	$type="comment";
    	$user="benyamin";
    	$data= array(
    			"date_create"=>	$tanggal,
    			"isi"=> $comment,
    			"noblog" => $noblog,
    			"type"=> $type,
    			"user" => $user 
    		);

    	$id_unik = 'commentBlog::Guest::'.intval(date('dmY')).'-'.time();
    	$resp = $this->couchdb->send($id_unik, 'PUT', json_encode($data));
		$resp = json_decode($resp->getBody());

		if ($resp) {
			redirect('home/lihat_post_komen?emit='.$noblog);
		}

		
    }

    function example()
    {	$emit="blog-4";
    	$hitung = $this->couchdb->send_view('blog','blog_comment', 0, 50,'key="'.$emit.'"&amp;include_docs=true');		 			//ini buat ngambil datanye ade berape
		$hitung = json_decode($hitung->getBody());
		$noblog = $hitung->rows;
		$noblog2 = count($noblog);

		return $noblog2;
    }

    function delete_post($noblog)
    {
    	$resp = $this->couchdb->send_view('blog','blog_post', 0, 50, 'key="'.$noblog.'"&amp;include_docs=true');	//,0,2 == offset, limit 	offset itu data yang keberape yg diambil..     dan limit, berape jumlah data yang ditampilin
		$resp = json_decode($resp->getBody());											// di couchdbnye pake design yang list_Game dan page_Game     huruf G nye gede!!!!
		$ret_val = array();
		if( ! isset($resp->error))
		{
			foreach($resp->rows as $rows)
			{
				$id = $rows->value->_id;
				$rev = $rows->value->_rev;
				$delete = $id.'?rev='.$rev;
				$result = $this->couchdb->send ($delete, 'DELETE');
			}
		}
		return TRUE;

    }
        function delete_comment($noblog)
    {
    	$resp = $this->couchdb->send_view('blog','blog_comment', 0, 50, 'key="'.$noblog.'"&amp;include_docs=true');	//,0,2 == offset, limit 	offset itu data yang keberape yg diambil..     dan limit, berape jumlah data yang ditampilin
		$resp = json_decode($resp->getBody());											// di couchdbnye pake design yang list_Game dan page_Game     huruf G nye gede!!!!
		$ret_val = array();
		if( ! isset($resp->error))
		{
			foreach($resp->rows as $rows)
			{
				$id = $rows->value->_id;
				$rev = $rows->value->_rev;
				$delete = $id.'?rev='.$rev;
				$result = $this->couchdb->send ($delete, 'DELETE');
			}
		}
		return TRUE;

    }
       	function delete_comment_self($id,$rev,$noblog)
    {
    		$delete = $id.'?rev='.$rev;
			$result = $this->couchdb->send ($delete, 'DELETE');

			if ($result)
			{
				redirect('home/lihat_post_komen?emit='.$noblog);
			}
    }
    	function update_post($noblog)
    	{
    		$resp = $this->couchdb->send_view('blog','blog_post', 0, 50, 'key="'.$noblog.'"&amp;include_docs=true');	//,0,2 == offset, limit 	offset itu data yang keberape yg diambil..     dan limit, berape jumlah data yang ditampilin
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
	    function diupdate ($id,$rev,$tanggal,$noblog,$type,$judul,$isi,$tags) // data y6ang udah diselect masukin ke dalam variable terus di 
	    {
           

            $data = array(
                "create_date"=>$tanggal, 
                "isi"=>$isi, 
                "judul"=>$judul, 
                "noblog"=>$noblog,
                "tags"=>$tags, 
                "type"=>$type
            );

        //echo "<pre>";
        //print_r($data);  //nuat menguji hasil dari variable
        //echo "</pre>";
        $delete = $id.'?rev='.$rev;
		$result = $this->couchdb->send ($delete, 'DELETE');    //jadi buat menggantikan data yang lama , data yang lama itu harus dihapus dulu

        $resp = $this->couchdb->send($id, 'PUT', json_encode($data));
		$resp = json_decode($resp->getBody());

		if ($resp) {
			redirect('home');
		}

    }



}

?>