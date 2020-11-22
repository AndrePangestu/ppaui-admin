<?php
class Frontoffice extends CI_Controller{
    
    var $folder =   "frontoffice";
    var $tables =   "data_frontoffice";
    var $pk     =   "id";
    var $title  =   "Data Penerimaan Telepon Peserta Pelatihan";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $query="SELECT data_frontoffice.id, data_frontoffice.tgl, data_frontoffice.nama, data_frontoffice.no_hp, data_frontoffice.email, 
				data_frontoffice.pel, data_frontoffice.prodis, data_frontoffice.ket, data_frontoffice.tgltin,
				app_users.username, data_frontoffice.tindakan
				FROM (data_frontoffice 
				LEFT JOIN app_users ON data_frontoffice.id_users = app_users.id_users) 
				group by data_frontoffice.id";		
				
        $data['record']=  $this->db->query($query)->result();
        $data['title']  = $this->title;
        $data['desc']    =   "";
	$this->template->load('template', $this->folder.'/view',$data);
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $tgl       	=   $this->input->post('tgl'); 
			$nama       =   $this->input->post('nama');
            $pel 	    =   $this->input->post('pel');
			$prodis    	=   $this->input->post('prodis');
			$no_hp      =   $this->input->post('no_hp');
			$email     	=   $this->input->post('email');
			$ket		=	$this->input->post('ket');
			$tgltin		=	$this->input->post('tgltin');
			$tindakan	=	$this->input->post('tindakan');
			$username	=	$this->input->post('username');
			
            $data       =   array(  'tgl'=>$tgl,
									'nama'=>$nama,
									'pel'=>$pel,
									'prodis'=>$prodis,
									'no_hp'=>$no_hp,
									'email'=>$email,
									'ket'=>$ket,
									'tgltin'=>$tgltin,
									'tindakan'=>$tindakan,
									'id_users'=>$username);

            $this->db->insert($this->tables,$data);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
    
    
    function edit()
    {
        if(isset($_POST['submit']))
        {
            
            $id     	= 	$this->input->post('id');
			$tgl       	=   $this->input->post('tgl'); 
            $nama       =   $this->input->post('nama');           
            $pel      	=   $this->input->post('pel');
			$prodis     =   $this->input->post('prodis');
			$no_hp		=	$this->input->post('no_hp');
			$email   	=   $this->input->post('email');
			$ket		=	$this->input->post('ket');
			$tgltin		=	$this->input->post('tgltin');
			$tindakan	=	$this->input->post('tindakan');
			$username	=	$this->input->post('username');
			
            $data       =   array(  'tgl'=>$tgl,
									'nama'=>$nama,
									'pel'=>$pel,
									'prodis'=>$prodis,
									'no_hp'=>$no_hp,
									'email'=>$email,
									'ket'=>$ket,
									'tgltin'=>$tgltin,
									'tindakan'=>$tindakan,
									'id_users'=>$username);
                                    
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/edit',$data);
        }
    }
    
    function delete()
    {
        $id     =  $this->uri->segment(3);
        $chekid = $this->db->get_where($this->tables,array($this->pk=>$id));
        if($chekid->num_rows()>0)
        {
            $this->mcrud->delete($this->tables,  $this->pk,  $this->uri->segment(3));
        }
        redirect($this->uri->segment(1));
    }
}