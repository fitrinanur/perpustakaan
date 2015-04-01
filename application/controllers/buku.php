<?php 
class Anggota extends CI_Controller{
	private $limit=20;

	function __construct(){
		parent::__construct();
		$this->load->library(array('template','pagination','form_validation','upload'));
		$this->load->model('m_buku');

		if(!$this->session->userdata('nama')){
            redirect('web');
	}
}
	function index($offset =0, $order_column='id', $order_type='asc' )
	{
		if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id';
        if(empty($order_type)) $order_type='asc';

        //load data
        $data['buku']=$this->m_buku->all($this->$limit,$offset,$order_type,$order_column)->result();
        $data['title']="Data buku";
        //config
        $config['base_url'] = site_url('anggota/index/');
        $config['total_rows'] = $this->m_buku->count_all();
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
        	$this->template->display('buku/index',$data);

	}

	function add()
	{
		$data['title'] = "Add Buku";
		$this->_set_rules();
		if($this->form_validation->run()==true){
			$id=$this->input->post('id');
			$cek=$this->m_buku->check($id);
			if($cek->num_rows()>0){
				$data['message']= "<div class='alert-alert warning'>Id buku sudah ada</div>";
				$this->template->display('buku/add',$data);
			}else{
				//setting config image
                $info=array(
                    'id_lokasi'=>$this->input->post('id_lokasi'),
                    'judul'=>$this->input->post('judul'),
                    'pengarang'=>$this->input->post('pengarang'),
                    'kuantitas'=>$this->input->post('kuantitas')
                );
                $this->m_buku->save($info);
                redirect('buku/index/add_success');
			}
		}else{
			$data['message']="";
            $this->template->display('buku/add',$data);
		}
	}
	function edit($id)
	{
		$data['title'] = "Edit Data Buku";
		$this->_set_rules();
		if($this->form_validation->run()==true)
		{
			$id=$this->input->post('id');
			
		     $info=array(
                    'id_lokasi'=>$this->input->post('id_lokasi'),
                    'judul'=>$this->input->post('judul'),
                    'pengarang'=>$this->input->post('pengarang'),
                    'kuantitas'=>$this->input->post('kuantitas')
                );
		     //update buku
		     $this->m_buku->update($id,$info);
		     //show buku
		     $data['message'] = "<div class='alert alert-success'> Data has been modified !</div>";
		     //show anggota
		     $data['buku'] = $this->m_buku->check($id)->row_array();
		     $this->template->display('buku/edit',$data);
		 }else{
		 	 $data['buku']=$this->m_buku->check($id)->row_array();
             $data['message']="";
             $this->template->display('buku/edit',$data);
		 }
	}

	function delete()
	{
		$kode = $this->input->post('kode');
		$detail = $this->m_buku->check($kode)->result();
		
        $this->m_buku->delete($kode);
	}
	function search()
	{
		$data['title'] = "Search";
		$search = $this->input->post('cari');
		$check = $this->m_buku->search($search);
		if($check->num_rows()>0){
			$data['message']="";
			$data['buku'] = $check->result();
			$this->template->display('buku/cari',$data);
		}else{
			$data['message']="<div class='alert alert-warning'>Data not found.</div> ";
			$data['buku']=$check->result();
			$this->template->display('buku/cari',$data);
		}
	}
	function _set_rules()
	{
        $this->form_validation->set_rules('id','id','required|max_length[10]');
        $this->form_validation->set_rules('id_lokasi','id_lokasi','required|max_length[50]');
        $this->form_validation->set_rules('judul','judul','required|max_length[2]');
        $this->form_validation->set_rules('pengarang','pengarang','required');
        $this->form_validation->set_rules('kuantitas','kuantitas','required|max_length[10]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
	

?>