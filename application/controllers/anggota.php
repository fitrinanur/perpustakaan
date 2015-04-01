<?php 
class Anggota extends CI_Controller{
	private $limit=20;

	function __construct(){
		parent::__construct();
		$this->load->library(array('template','pagination','form_validation','upload'));
		$this->load->model('m_anggota');

		if(!$this->session->userdata('nama')){
            redirect('web');
	}
}
	function index($offset =0, $order_column='id', $order_type='asc' )
	{
		if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='nis';
        if(empty($order_type)) $order_type='asc';

        //load data
        $data['anggota']=$this->m_anggota->all($this->$limit,$offset,$order_type,$order_column)->result();
        $data['title']="Data Anggota";
        //config
        $config['base_url'] = site_url('anggota/index/');
        $config['total_rows'] = $this->m_anggota->count_all();
        $config['per_page']= $this->$limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        if($this->uri->segment(3)=="delete_success")
        	$data['message'] = "<div class='alert alert-success> Data has been deleted!</div>";
        else if($this->uri->segment(3)=="add_success")
        	$data['message'] = "<div class = 'alert alert-success'> Data saved successfuly!</div>";
        else
        	$data['message'] ="";
        	$this->template->display('anggota/index',$data);

	}
	function edit($id)
	{
		$data['title'] = "Edit Data Anggota";
		$this->_set_rules();
		if($this->form_validation->run()==true)
		{
			$id=$this->input->post('id');
			//config image
			$config['upload_path'] = './assets/img/';
		    $config['allowed_types'] = 'gif|jpg|png';
		    $config['max_size']	= '1000';
		    $config['max_width']  = '2000';
		    $config['max_height']  = '1024';

		    $this->upload->initialize($config);
		     if(!$this->upload->do_upload('gambar')){
		     	$gambar="";
		     }else{
		     	$gambar=$this->upload->file_name;
		     }
		     $info = array(
		     	'nama' => $this->input->post('nama'),
		     	'pekerjaan' => $this->input->post('pekerjaan'),
		     	'no_hp' => $this->input->post('no_hp')
		     	'gambar' => $gambar;
		     	);
		     //update anggota
		     $this->m_anggota->update($id,$info);
		     //show message
		     $data['message'] = "<div class='alert alert-success'> Data has been modified !</div>";
		     //show anggota
		     $data['anggota'] = $this->m_anggota->check($id)->row_array();
		     $this->template->display('anggota/edit',$data);
		 }else{
		 	 $data['anggota']=$this->m_anggota->check($id)->row_array();
             $data['message']="";
             $this->template->display('anggota/edit',$data);
		 }
	}

	function add()
	{
		$data['title'] = "Add Anggota";
		$this->_set_rules();
		if($this->form_validation->run()==true){
			$id=$this->input->post('id');
			$cek=$this->m_anggota->check($id);
			if($cek->num_rows()>0){
				$data['message']= "<div class='alert-alert warning'>ID has been used by other!</div>";
				$this->template->display('anggota/tambah',$data);
			}else{
				//setting config image
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '2000';
				$config['max_height']  = '1024';

				$this->upload->initialize($config);
                if(!$this->upload->do_upload('gambar')){
                    $gambar="";
                }else{
                    $gambar=$this->upload->file_name;
                }
                $info=array(
                    'nama'=>$this->input->post('nama'),
                    'pekerjaan'=>$this->input->post('pekerjaan'),
                    'no_hp'=>$this->input->post('no_hp'),
                    'gambar'=>$gambar
                );
                $this->m_anggota->save($info);
                redirect('anggota/index/add_success');
			}
		}else{
			$data['message']="";
            $this->template->display('anggota/add',$data);
		}
	}
	function delete()
	{
		$kode = $this->input->post('kode');
		$detail = $this->m_anggota->check($kode)->result();
		foreach($detail as $det):
	    	unlink("assets/img/".$det->image);
		endforeach;
        $this->m_anggota->delete($kode);
	}
	function search()
	{
		$data['title'] = "Search";
		$search = $this->input->post('cari');
		$check = $this->m_anggota->search($search);
		if($check->num_rows()>0){
			$data['message']="";
			$data['anggota'] = $check->result();
			$this->template->display('anggota/search',$data);
		}else{
			$data['message']="<div class='alert alert-warning'>Data not found.</div> ";
			$data['anggota']=$check->result();
			$this->template->display('anggota/search',$data);
		}
	}
	function _set_rules()
	{
        $this->form_validation->set_rules('id','id','required|max_length[10]');
        $this->form_validation->set_rules('nama','nama','required|max_length[50]');
        $this->form_validation->set_rules('pekerjaan','pekerjaan','required|max_length[2]');
        $this->form_validation->set_rules('no_hp','no_hp','required');
        $this->form_validation->set_rules('image','image','required|max_length[10]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
	

?>