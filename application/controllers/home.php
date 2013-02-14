<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	*membuat blog sederhana menggunakan couchdb
	*ada fitur update dan insertnya
	 */

	public function __construct() {  
	            parent::__construct();
	            $this->load->model('modelcrud');
	}
	function index()
	{
		$data['ret_val'] = $this->modelcrud->lihat_blog();
		//$this->load->view('view_lihatblog', $data);
		$data2['noblog'] = $this->modelcrud->hitung_komen();
		//$this->load->view('view_lihatblog', $data2);
		$dataarray=array('data1'=>$data,
						  'data2'=>$data2);
		$dataarraylagi=array('dataarray'=>$dataarray);
		$this->load->view('view_lihatblog', $dataarray);

	}

	function mau_nulis()
	{
		$this->load->view('view_buatpost');
	}

	function nulis_blog() //ini buat menerima inputan dari form nulis blog variable yang diambil mulai dari judul sampe tags
	{
		$judul=trim(@$_POST["judul"]);
        $judul=str_replace("/(<\/?)(p)([^>]*>)", "",$judul);
        $judul=htmlspecialchars($judul,ENT_QUOTES);
        $isi=trim(@$_POST["isi"]);
        $isi=str_replace("/(<\/?)(p)([^>]*>)", "",$isi);
        $isi=htmlspecialchars($isi,ENT_QUOTES);
        $tags=trim(@$_POST["tags"]);
        $tags=str_replace("/(<\/?)(p)([^>]*>)", "",$tags);
        $tags=htmlspecialchars($tags,ENT_QUOTES);
		
        //mendeklarasikan bagian variable dari blog

        $tanggal=date("F j, Y, g:i a");
        $type = "blogpost";

		$result=$this->modelcrud->simpan($judul, $isi, $tanggal, $tags, $type);
        

	}

	function lihat_post_komen()
	{			
				$emit = $this->input->get ('emit');

				$data['ret_val'] = $this->modelcrud->lihat_post($emit);
				$datacomment['ret_val_comment'] = $this->modelcrud->lihat_komen($emit);
				$data_array = array (
									'data1' => $data,
									'data2' => $datacomment
									);
				$this->load->view('view_postkomen', $data_array);
	}

	function komen()
    {		
    	 $comment = $this->input->post('comment');
		 $noblog = $this->input->get ('noblog'); 

		 $this->modelcrud->komenin($noblog,$comment);  	
    }


	function select_database()
	{	
		$offset=0;
		$data['ret_val'] = $this->modelcrud->admin_liat_topik(); 
		//echo "<pre>";
		//print_r($data);
		//echo "</pre>";
		$this->load->view('welcome_message', $data);
	}
	function delete_post()
	{	
		$noblog = $this->input->get ('noblog');
		$lapor_post=$this->modelcrud->delete_post($noblog);
		$lapor_comment=$this->modelcrud->delete_comment($noblog);
		
		if (($lapor_post== TRUE) && ($lapor_comment==TRUE)) 
		{
			redirect('home');
		} else 
		{
			echo "gagal";
		}
		//echo "<pre>";
		//print_r ($ret_val);
		//echo "</pre>";
	}
	function delete_comment()
	{
		$id = $this->input->get ('id');
		$rev = $this->input->get ('rev');
		$noblog = $this->input->get ('noblog');
		$this->modelcrud->delete_comment_self($id,$rev,$noblog);
	}
	function update_post()
	{
		$noblog = $this->input->get('noblog');
		$datablog['ret_val']=$this->modelcrud->update_post($noblog);
		$this->load->view('view_updatepost',$datablog); 
	}
	function diupdate()
	{
		//disini buat masukan kueri terus redirect , nah varible yang tadi semua harus bisa didapetinbuat update data mana aja yang bisa diupdate
		$id = $this->input->post ('id');
		$rev = $this->input->post ('rev');
		$tanggal = $this->input->post ('create_date');
		$noblog = $this->input->post ('noblog');
		$type = $this->input->post ('type');
		$judul = $this->input->post ('judul');
		$isi = $this->input->post ('isi');
		$tags = $this->input->post ('tags');
		$this->modelcrud->diupdate($id,$rev,$tanggal,$noblog,$type,$judul,$isi,$tags);

	}
	function tulis()
	{
		$this->load->view('view_tulis');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */