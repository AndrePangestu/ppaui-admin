<?php
class Konsentrasi extends CI_Controller{
    
    var $folder =   "konsentrasi";
    var $tables =   "akademik_konsentrasi";
    var $pk     =   "konsentrasi_id";
    var $title  =   "Konsentrasi";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $query="SELECT akademik_konsentrasi.nama_konsentrasi, akademik_prodi.nama_prodi, app_gedung.nama_gedung, app_waktu.nama_waktu, akademik_konsentrasi.tglmulai, akademik_konsentrasi.tglakhir, akademik_konsentrasi.konsentrasi_id, keuangan_biaya_kuliah.jumlah
				FROM (((akademik_konsentrasi LEFT JOIN app_gedung ON akademik_konsentrasi.gedung_id = app_gedung.gedung_id) 
				LEFT JOIN app_waktu ON akademik_konsentrasi.waktu_id = app_waktu.waktu_id) 
				LEFT JOIN akademik_prodi ON akademik_konsentrasi.prodi_id = akademik_prodi.prodi_id) 
				LEFT JOIN keuangan_biaya_kuliah ON akademik_konsentrasi.konsentrasi_id = keuangan_biaya_kuliah.konsentrasi_id
				
				group by akademik_konsentrasi.konsentrasi_id";
				
				//where keuangan_biaya_kuliah.jumlah >0 
				
        $data['record']=  $this->db->query($query)->result();
        $data['title']  = $this->title;
        $data['desc']    =   "";
	$this->template->load('template', $this->folder.'/view',$data);
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama       =   $this->input->post('nama');
            $prodi      =   $this->input->post('prodi');
			$gedung     =   $this->input->post('gedung');
			$waktu      =   $this->input->post('waktu');
			$tglmulai	=	$this->input->post('tglmulai');
			$tglakhir   =   $this->input->post('tglakhir');
            //$ketua      =   $this->input->post('ketua');
			//$kode       =   $this->input->post('kode');
            //$gelar      =   $this->input->post('gelar');
            //$jenjang    =   $this->input->post('jenjang');
            //$semester   =   $this->input->post('semester');
            $data       =   array(  'nama_konsentrasi'=>$nama,
									'prodi_id'=>$prodi,
									'gedung_id'=>$gedung,
									'waktu_id'=>$waktu,
									'tglmulai'=>$tglmulai,
									'tglakhir'=>$tglakhir);
            //                        'ketua'=>$ketua,
            //                        'kode_nomor'=>$kode,
            //                        'gelar'=>$gelar,
            //                        'jenjang'=>$jenjang,
            //                        'jml_semester'=>$semester,
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
            $nama       =   $this->input->post('nama');           
            $prodi      =   $this->input->post('prodi');
			$gedung     =   $this->input->post('gedung');
			$waktu      =   $this->input->post('waktu');
			$tglmulai	=	$this->input->post('tglmulai');
			$tglakhir   =   $this->input->post('tglakhir');
			//$ketua      =   $this->input->post('ketua');
            //$kode       =   $this->input->post('kode');
            //$gelar      =   $this->input->post('gelar');
            //$jenjang    =   $this->input->post('jenjang');
            //$semester   =   $this->input->post('semester');
            $data       =   array(  'nama_konsentrasi'=>$nama,
									'prodi_id'=>$prodi,
									'gedung_id'=>$gedung,
									'waktu_id'=>$waktu,
									'tglmulai'=>$tglmulai,
									'tglakhir'=>$tglakhir);
                                    //'ketua'=>$ketua,
                                    //'kode_nomor'=>$kode,
                                    //'gelar'=>$gelar,
                                    //'jenjang'=>$jenjang,
                                    //'jml_semester'=>$semester,
                                    
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