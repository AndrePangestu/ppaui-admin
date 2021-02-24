<?php
class Keuangan extends CI_Controller
{
    
    var $folder =   "keuangan";
    var $tables =   "";
    var $pk     =   "";
    var $title  =   "Keuangan";
    
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('M_masterdata');
    }
    
    function index()
    {
        if(isset($_POST['submit']))
        {
            $data['tanggal1']=  $this->input->post('tanggal1');
            $data['tanggal2']=  $this->input->post('tanggal2');
        }
        else
        {
            $data['tanggal1']="";
            $data['tanggal2']="";
        }
        $query="SELECT sm.nama,sm.nim,jb.keterangan,pd.tanggal,pd.jumlah,pd.semester,pd.no_ttp,pd.tipe,ak.nama_konsentrasi
                FROM keuangan_pembayaran_detail as pd,keuangan_jenis_bayar as jb,student_mahasiswa as sm,akademik_konsentrasi as ak
                WHERE pd.jenis_bayar_id=jb.jenis_bayar_id and ak.konsentrasi_id=sm.konsentrasi_id and sm.nim=pd.nim and left(pd.tanggal,10) 
                BETWEEN '".$data['tanggal1']."' and '".$data['tanggal2']."'";
        $data['transaksi']=  $this->db->query($query)->result();
        $this->template->load('template', 'keuangan/view',$data);
    }
    
    function laporan()
    {
        $data['title']=  'Laporan Keuangan';
        $data['tahun_angkatan']=  $this->db->get('akademik_tahun_akademik')->result();
        $this->template->load('template', 'keuangan/laporan',$data);
    }

    function nameAutocomplete(){
        //get search term
        $searchTerm = $_GET['term'];
        
        //get matched data from skills table
        $query = $db->query("SELECT * FROM tbl_peserta_akun WHERE nama LIKE '%".$searchTerm."%' ORDER BY nama ASC");
        while ($row = $query->fetch_assoc()) {
            $data[] = $row['nama'];
        }
    
        //return json data
        echo json_encode($data);
    }
    
    function cetak()
    {
        $jenis="SELECT * FROM 'keuangan_jenis_bayar' WHERE jenis_bayar_id not in('3') ";
        $data['tahun_akademik']=  $this->input->post('tahun');
        $data['konsentrasi_id']=  $this->input->post('konsentrasi');
        $data['tahun']=  $this->db->get('student_angkatan')->result();
        $data['jenis_bayar']=  $this->db->query($jenis);
        $this->load->view('keuangan/cetaklap',$data);
    }
    
    
    function tampilkandata2($konsentrasi,$tahun_angkatan)
    {
        echo   "<table class='table table-bordered'>
                <tr><td width='150'>Konsentrasi</td><td>". strtoupper( getField('akademik_konsentrasi', 'nama_konsentrasi', 'konsentrasi_id', $konsentrasi))."</td></tr>
                <tr><td>Tahun Angkatan</td><td>".  getField('student_angkatan', 'keterangan', 'angkatan_id', $tahun_angkatan)."</td></tr>
                </table>";
        $jenis_bayar=  $this->db->get('keuangan_jenis_bayar');
        echo   "<table class='table table-bordered'>
                <tr><th rowspan='2' width='7'>No</th><th width='16' rowspan='2'>NIP</th>
                <th  rowspan='2' width='200'>NAMA</th>";
                // head atas
                foreach ($jenis_bayar->result() as $j)
                {
                    echo "<th colspan='2' align='center'>".  strtoupper($j->keterangan)."</th>";
                }
        echo   "</tr><tr>";
                 // head keterangan bawah
                foreach ($jenis_bayar->result() as $j)
                {
                    echo "<th>01</th><th>02</th>";
                }
        echo   "</tr>";
        $no=1;
        $mahassiwa =  $this->db->get_where('student_mahasiswa',array('konsentrasi_id'=>$konsentrasi,'angkatan_id'=>$tahun_angkatan))->result();
        foreach ($mahassiwa as $m)
        {
            echo"<tr><td>$no</td><td>$m->nim</td><td>$m->nama</td>";
               // data bayaran
                foreach ($jenis_bayar->result() as $j)
                {
                    $harus_bayar=chek_bayar($m->nim, $j->jenis_bayar_id, 01);
                    $sudah_bayar=chek_bayar($m->nim, $j->jenis_bayar_id, 02);
                    $sisa1=$harus_bayar-$sudah_bayar;
                    $sisa=$sisa1==0?'Lunas':rp((int) $sisa1);
                    echo "<td>$sudah_bayar</td><td>$sisa1</td>";
                }
            echo"</tr>";
            $no++;
        }
        echo   "<table>";
    }


    function loadlaporan()
    {
        $konsentrasi    =$_GET['konsentrasi'];
        $tahun_akademik =$_GET['tahun_angkatan'];
        //$this->tampilkandata2($konsentrasi, $tahun_angkatan);
        //die;
        if($tahun_akademik==0)
        {
            // foreach tahun_aakdemik
            $tahun=  $this->db->get('student_angkatan')->result();
            foreach ($tahun as $t)
            {
                 $this->tampilkandata($konsentrasi, $t->angkatan_id);
                 for($grs=1;$grs<=227;$grs++)
                 {
                     echo "-";
                 }
            }
            // end foreach
        }
        else
        {
            $this->tampilkandata($konsentrasi, $tahun_akademik);
        }
    }
    

    function tampilkandata($konsentrasi,$tahun_akademik)
    {
        // fires else
            $data=  $this->db->get_where('student_mahasiswa',array('konsentrasi_id'=>$konsentrasi,'angkatan_id'=>$tahun_akademik))->result();
            $jenis_bayar=  $this->db->get('keuangan_jenis_bayar');
            
            echo"<table class='table table-bordered'>
                <tr><th width='170'>Angkatan Pelatihan</th><th>".  strtoupper(getField('akademik_konsentrasi', 'nama_konsentrasi', 'konsentrasi_id', $konsentrasi))."</th></tr>
                <tr><th>Tahun</th><th>".  getField('student_angkatan', 'keterangan', 'angkatan_id', $tahun_akademik)."</th></tr>
               
                </table>";
            echo"<table class='table table-bordered'>
                <tr><th rowspan=2>No</th><th rowspan=2>NIP</th><th rowspan='2' width='200'>Nama Lengkap</th>";
            foreach ($jenis_bayar->result() as $j)
            {
                echo "<th colspan=3><p align='center'>".  strtoupper($j->keterangan)."</p></th>";
            }
            echo"<th rowspan=2>Total Tunggakan</th></tr>
                <tr>";
            foreach ($jenis_bayar->result() as $j)
            {
                echo "<th>Biaya</th><th>Terbayar</th><th>Piutang</th>";
            }
            echo"</tr>";
            $no=1;

            $tunggakan=0;
            foreach ($data as $r)
            {
                // zebra
                $bgcolor=$no % 2!=0?'#CCCCCC':'#FFFFFF';
                // end zebra

                echo"<tr bgcolor='$bgcolor'>
                    <td>$no</td>
                    <td>".strtoupper($r->nim)."</td>
                    <td width='200'>".strtoupper($r->nama)."</td>";
                    // foreach kolom value
                    $tunggakanmsw=0;
                    foreach ($jenis_bayar->result() as $jb)
                    {
                        $harus_bayar=chek_bayar($r->nim, $jb->jenis_bayar_id, 01);
                        $sudah_bayar=chek_bayar($r->nim, $jb->jenis_bayar_id, 02);
                        $sisa1=$harus_bayar-$sudah_bayar;
                        $sisa=$sisa1==0?'Lunas':rp((int) $sisa1);
                        echo "<td>".  rp((int)$harus_bayar)."</td>
                            <td>".  rp((int)$sudah_bayar)."</td>
                            <td>".  $sisa."</td>";
                        $tunggakanmsw=$tunggakanmsw+$sisa1;
                        //
                    }
                    echo"<td>".rp((int) $tunggakanmsw)."</td></tr>";
                    $tunggakan=$tunggakan+$tunggakanmsw;
                    $no++;
            }

            echo"<tr class='success'>
                <td colspan=".(($jenis_bayar->num_rows()*3)+0)."></td>
                <td colspan=3>Total Tunggakan</td><td><b>".rp((int)$tunggakan)."</b></td>
                </tr></table>";
                    // hitung sudah berapa tahun kuliah berdasarkan tahun akademik
            $tahun_sekarang=date('Y');
            $jml_semester=($tahun_akademik-$tahun_sekarang)+1;
            $smt_aktif= getField('student_mahasiswa', 'semester_aktif', 'angkatan_id', $_GET['tahun_angkatan']);
            //$spp_bayar    =   jml_spp_konsentrasi($konsentrasi, $_GET['tahun_angkatan']);
            //echo"<table class='table table-bordered'>
            //    <tr class='success'>
            //    <th colspan=".($smt_aktif+4).">PEMBAYARAN SPP | BIAYA SPP PERSEMESTER = RP. ". rp((int) $spp_bayar) ."</th>
            //    </tr>
            //    <tr>
            //    <th width='10'>No</th>
            //    <th width='60'>NIP</th>
            //    <th>NAMA</th>";
            // looping semester
            // get semester aktif
            
            //for($i=1;$i<=$smt_aktif;$i++)
            //{
            //   echo"<th><p align='center'>SEMESTER $i</p></th>";
            //}
            //echo"<th>Tunggakan</th></tr>";

            //$no=1;
            //$tot_tunggakan=0;
            //foreach ($data as $r)
            //{
            //    $tunggakan_smt=0;
            //   // zebra
            //    $bgcolor=$no % 2!=0?'#CCCCCC':'#FFFFFF';
                // end zebra
            //    echo "<tr bgcolor='$bgcolor'><td>$no</td>                
            //        <td>".strtoupper($r->nim)."</td>
            //        <td width='200'>".strtoupper($r->nama)."</td>";
                // looping kolom bayar
            //        for($i=1;$i<=$smt_aktif;$i++)
            //        {
            //            $spp=  chek_bayar_semester($r->nim, $i);
            //            echo "<td>".rp((int) $spp)."</td>";
            //            $tunggakan_smt=$tunggakan_smt+($spp_bayar-$spp);
            //        }
                // end looping kolom bayar
            //        echo"<td>".rp((int) $tunggakan_smt)."</td></tr>";
            //        $tot_tunggakan=$tot_tunggakan+$tunggakan_smt;
            //    $no++;
            //}
            // echo"<tr><td colspan='".($smt_aktif+3)."'>Jumlah Tunggakan</td><td>".rp((int) $tot_tunggakan)."</td></tr></table>";
            // end else
    }

    function pembayaran()
    {
        if(isset($_POST['submit']))
        {
            $nim    = $this->input->post('nim');
            $chek   = $this->db->get_where('student_mahasiswa',array('nim'=>$nim))->num_rows();
            if($chek>0)
            {
            $this->session->set_userdata('pembayaran_mahasiswa_nim',$nim);
            }
            else
            {
                $this->session->set_flashdata('pesan', "<div class='alert alert-success'><i class='fa fa-bullhorn'></i> NIP YANG ANDA MASUKAN TIDAK DITEMUKAN DI DATABASE</div>");
            }
            redirect('keuangan/pembayaran');
        }
        elseif(isset($_POST['submit2']))
        {
            // simpan transaksi
            $jenis  	=   $this->input->post('jenis');
            $jumlah 	=   $this->input->post('jumlah');
			$tanggal 	=	$this->input->post('tanggal');
			$no_ttp		=	$this->input->post('no_ttp');
			$tipe		=	$this->input->post('tipe');
            $semester	=  	$this->input->post('semester');
            // chek dulu udah lunas belum jenis bayarnya, jika sudah berikan pesan
            $idnim=$this->session->userdata('pembayaran_mahasiswa_nim');
            $tahun_akademik = getField('student_mahasiswa', 'angkatan_id', 'nim', $idnim);
            $konsentrasi_id = getField('student_mahasiswa', 'konsentrasi_id', 'nim', $idnim);
            //$semester_aktif = getField('student_mahasiswa', 'semester_aktif', 'nim', $idnim);
            $jumlah_bayar   = get_biaya_kuliah($tahun_akademik, $jenis, $konsentrasi_id, 'jumlah');
            $sudah_bayar    = get_biaya_sudah_bayar($idnim, $jenis);
            $sisa           = $jumlah_bayar-$sudah_bayar;
            // end chek
            
            // chek jenis inputan
            // jika spp maka chek dia semetter berapa dan apakah dy sudah lunas untuk semester itu
            // jika selain spp chek sudah lunas atau belum
            
             if($jenis==3)
             {
                 if($semester>$semester_aktif)
                 {
                     // semester yang dipilih lebih tinggi daripada semeser aktif
                    $this->session->set_flashdata('pesan', "<div class='alert alert-danger'><i class='fa fa-bullhorn'></i> SEMESTER YANG ANDA INPUTKAN TIDAK SESUAI DENGAN DATA PESERTA</div>");
                 }
                 else
                 {
                     // chek spp semester itu udah lunas belum
                    $sdh_bayar_semester= $this->chek_sudah_bayar_semester($idnim, $semester);
                    if($jumlah_bayar<=$sdh_bayar_semester)
                    {
                        $this->session->set_flashdata('pesan', "<div class='alert alert-danger'><i class='fa fa-bullhorn'></i> PEMBAYARAN UNTUK SEMESTER $semester <B>SUDAH LUNAS</B></div>");
     
                        
                    }
                    else
                    {
                        // save bayar semester
                    $data   =   array(  'jenis_bayar_id'=>$jenis,
                                        'jumlah'=>$jumlah,
                                        'id_users'=>$this->session->userdata('id_users'),
                                        'tanggal'=>$tanggal,
										'no_ttp'=>$no_ttp,
										'tipe'=>$tipe,
                                        'semester'=>$semester,
                                        'nim'=>$this->session->userdata('pembayaran_mahasiswa_nim'));
                    $this->db->insert('keuangan_pembayaran_detail',$data);
                    }
                 }
             }
             else
             {
                 // chek udah lunas belum
                 // kalau udah lunas tampilkan pesan udah lunas
                 // kalau belum lunas save
                 
                if($sisa<=0)
                {
                    // sudah lunas
                     $this->session->set_flashdata('pesan', "<div class='alert alert-danger'><i class='fa fa-bullhorn'></i> PEMBAYARAN <b> ".  strtoupper(getField('keuangan_jenis_bayar', 'keterangan', 'jenis_bayar_id', $jenis))." </b> SUDAH LUNAS</div>");
                }
                elseif($jumlah>$sisa)
                {
                    $this->session->set_flashdata('pesan', "<div class='alert alert-danger'><i class='fa fa-bullhorn'></i> PEMBAYARAN LEBIH !! </div>");
                }
                else
                {
                    // save pembayaran perjenis 
                    $data   =   array(  'jenis_bayar_id'=>$jenis,
                                        'jumlah'=>$jumlah,
                                        'id_users'=> $this->session->userdata('id_users'),
                                        'tanggal'=>$tanggal,
										'no_ttp'=>$no_ttp,
										'tipe'=>$tipe,
                                        'nim'=>$this->session->userdata('pembayaran_mahasiswa_nim'));
            $this->db->insert('keuangan_pembayaran_detail',$data);
                    
                }
             }
            redirect('keuangan/pembayaran');
        }
        else
        {
            $nim_session=$this->session->userdata('pembayaran_mahasiswa_nim');
            $query2=   "SELECT au.nama,kj.keterangan,kd.tanggal,kd.jumlah,kd.pembayara_detail_id,kd.jenis_bayar_id,kd.semester,kd.no_ttp,kd.tipe
                        FROM  keuangan_pembayaran_detail as kd,keuangan_jenis_bayar as kj,app_users as au
                        WHERE kd.jenis_bayar_id=kj.jenis_bayar_id and kd.id_users=au.id_users and kd.nim='$nim_session'
						ORDER BY tanggal";
            $query=     "SELECT sm.nama,ak.nama_konsentrasi,ap.nama_prodi
                        FROM student_mahasiswa as sm,akademik_konsentrasi as ak,akademik_prodi as ap
                        WHERE sm.konsentrasi_id=ak.konsentrasi_id and ap.prodi_id=ak.prodi_id and sm.nim='$nim_session'";
            $data['transaksi']=  $this->db->query($query2)->result();
            $data['profile']=  $this->db->query($query)->row_array();
            if($nim_session=="emptyy")
            {
                $data['statuss']="kosong";
            }
            else
            {
                $data['statuss']="ada";
            }
            $data['jenis_bayar']=  $this->db->query('select * from keuangan_jenis_bayar where jenis_bayar_id not in("3")')->result();
            $data['nim']=$nim_session;
            $data['semester']=getField('student_mahasiswa', 'semester', 'nim', $nim_session);
            $data['title']=  $this->title;
            $this->template->load('template', 'keuangan/bayar/view',$data);
        }
    }
    
    
    function chek_sudah_bayar_semester($nim,$semester)
    {
        $sql=   "SELECT sum(jumlah) as jumlah 
                FROM keuangan_pembayaran_detail
                WHERE jenis_bayar_id=3 and nim='$nim' and semester='$semester'";
        $data=  $this->db->query($sql)->row_array();
        if($data['jumlah']==null)
        {
            return 0;
        }
        else
        {
            return $data['jumlah'];
        }
    }
    
    function reset()
    {
        $this->session->set_userdata('pembayaran_mahasiswa_nim','emptyy');
        redirect('keuangan/pembayaran');
    }

    function cetakpersonal()
    {
        $session=$this->session->userdata('pembayaran_mahasiswa_nim');
        if($session=="")
        {
            redirect($this->index());
        }
        else
        {
            $query="SELECT sm.nim,sm.nama,ak.nama_konsentrasi,ta.keterangan
                    FROM student_mahasiswa as sm,akademik_konsentrasi as ak,student_angkatan as ta
                    WHERE sm.konsentrasi_id=ak.konsentrasi_id and ta.angkatan_id=sm.angkatan_id and sm.nim='$session'";
            $nim_session=$this->session->userdata('pembayaran_mahasiswa_nim');
            $data['jenis_bayar']=  $this->db->query('select * from keuangan_jenis_bayar where jenis_bayar_id not in("3")')->result();
            $data['biodata']=  $this->db->query($query)->row_array();
            $data['semester']=getField('student_mahasiswa', 'semester_aktif', 'nim', $nim_session);
           $this->load->view('keuangan/cetakpersonal',$data); 
        }
    }
    
    function laporanpembayaran()
    {
        $tanggal1=  $this->uri->segment(3);
        $tanggal2=  $this->uri->segment(4);
        $query="SELECT sm.nama,sm.nim,jb.keterangan,pd.tanggal,pd.jumlah,pd.semester,pd.no_ttp,pd.tipe,ak.nama_konsentrasi
                FROM keuangan_pembayaran_detail as pd,keuangan_jenis_bayar as jb,student_mahasiswa as sm,akademik_konsentrasi as ak
                WHERE pd.jenis_bayar_id=jb.jenis_bayar_id and ak.konsentrasi_id=sm.konsentrasi_id and sm.nim=pd.nim and pd.tanggal 
                BETWEEN '".$tanggal1."' and '".$tanggal2."'";
        $data['transaksi']=  $this->db->query($query)->result();
        $this->load->view('keuangan/laporanpembayaran',$data);
    }
    
    function jurnalkhusus()
    {
        if(isset($_POST['submit']))
        {
            $data['tanggal1']=$this->input->post('tanggal1');
            $data['tanggal2']=$this->input->post('tanggal2');
            $query="SELECT sm.nim,sm.nama,jb.keterangan as jenis_bayar,pd.tanggal,pd.jenis_bayar_id,pd.jumlah,pd.no_ttp,pd.tipe
                    FROM keuangan_pembayaran_detail as pd,student_mahasiswa as sm,keuangan_jenis_bayar as jb
                    WHERE sm.nim=pd.nim and pd.jenis_bayar_id=jb.jenis_bayar_id and left(pd.tanggal,10) BETWEEN '".$data['tanggal1']."' and '".$data['tanggal2']."' ";
            $data['transaksi']=  $this->db->query($query)->result();
            $this->template->load('template','keuangan/jurnalkhusus',$data);
        }
        else
        {
            $data['tanggal1']='';
            $data['tanggal2']='';
            $this->template->load('template','keuangan/jurnalkhusus',$data);
        }
    }
    
    function cetakjurnalkhusus()
    {-
        $data['tanggal1']=  $this->uri->segment(3);
        $data['tanggal2']=$this->uri->segment(4);
        $query="SELECT sm.nim,sm.nama,jb.keterangan as jenis_bayar,pd.tanggal,pd.jenis_bayar_id,pd.jumlah,pd.no_ttp,pd.tipe
                    FROM keuangan_pembayaran_detail as pd,student_mahasiswa as sm,keuangan_jenis_bayar as jb
                    WHERE sm.nim=pd.nim and pd.jenis_bayar_id=jb.jenis_bayar_id 
                    and pd.tanggal BETWEEN '".$data['tanggal1']."' and '".$data['tanggal2']."'";
        $data['transaksi']=  $this->db->query($query)->result();
        $this->load->view('keuangan/cetakjurnalkhusus',$data);
    }
    
    
        function delete()
    {
         $id     =  $this->uri->segment(3);
         $this->mcrud->delete('keuangan_pembayaran_detail',  'pembayara_detail_id',  $id);
         redirect('keuangan/pembayaran');
    }
    
    function sms()
    {
        // looping kosentrasi
        // cari mahassiwa yang aktif
        // chek biaya yang belum dibayar
        // kirim sms ke no hp yang di daftarkan
        
        $tahun_akademik=  $this->db->get('student_angkatan')->result();
        foreach ($tahun_akademik as $t)
        {
            $konsentrasi=  $this->db->get('akademik_konsentrasi')->result();
            foreach ($konsentrasi as $k)
            {
                // mahassiwa
                $mahasiswa=  $this->db->get_where('student_mahasiswa',array('angkatan_id'=>$t->angkatan_id,'konsentrasi_id'=>$k->konsentrasi_id))->result();
                foreach ($mahasiswa as $m)
                {
                    $tunggakan_permahasiswa=0;
                    $tunggakan=0;
                    $jenis_bayar=  $this->db->get('keuangan_jenis_bayar')->result();
                    foreach ($jenis_bayar as $j)
                    {
                        // HB = harus bayar & SB = Sudah bayar
                        $hb     =  chek_bayar($m->nim, $j->jenis_bayar_id, 01);
                        $sb     =  chek_bayar($m->nim, $j->jenis_bayar_id, 02);
                        $sisa   =   $hb-$sb;
                        $tunggakan=$tunggakan+$sisa;
                    }
                    // chek tunggakan semester
                    $tahun_masuk    = substr(getField('student_angkatan', 'keterangan', 'angkatan_id', $m->angkatan_id),0,4);
                    $tahun_sekarang = date('Y');
                    $semester       = ($tahun_sekarang-$tahun_masuk)+1;
                    for($i=1;$i<=$semester;$i++)
                    {
                        $biaya_spp      = jml_spp_konsentrasi($m->konsentrasi_id, $t->angkatan_id);
                        $sdh_bayarspp   = chek_bayar_semester($m->nim, $i);
                        $tunggakan=$tunggakan+($biaya_spp-$sdh_bayarspp);
                    }
                    // kirim sms
                    $pesan="Biaya Tunggakan anda adalah $tunggakan";
                    $this->_kirim_sms($m->no_hp_ortu, $pesan);
                    // end kirim sms
                }
            }
        }
        
        echo "SMS SUDAH DIKIRIM";
    }
    
    function _kirim_sms($noHp,$pesan)
    {
            if($noHp!='')
            {
                $pesan  =   str_replace("'", "/", $pesan);
        $jmlSms = ceil(strlen($pesan)/153);
        if($jmlSms==1)
        {
            // kirim ke outbox
            //get senderID
            $sender=  $this->db->get('phones')->row_array();
            $senderID=$sender['ID'];
            $data   =   array(  'DestinationNumber'=>$noHp,
                            'TextDecoded'=>$pesan,
                            'SenderID'=>$senderID,
                            'CreatorID'=>'Nuris');
            $this->db->insert('outbox',$data);
        }
            }
    }

    public function loadKonfirmasi()
    {
        $search= $this->M_masterdata->get_loadkonfirmasi();
        $jsonArr=array(
            'rows'=>$search
        );
        echo json_encode($jsonArr);
    }

    /* Edit Modal Modul ***/
    public function modalEditData() 
    {
        $stack = array();
        //$data = $this->get_session();
        $data['id_konfirmasi_bayar'] = $this->M_masterdata->getdatafile_id();   
        $jsonArr=array(
            'id_konfirmasi_bayar'=>$data['id_konfirmasi_bayar']
        );
        echo json_encode($jsonArr);
    }

    public function do_edit(){
        $id_konfirmasi_bayar = $this->input->post('id_konfirmasi_bayar');
        $id_peserta_daftar = $this->input->post('id_peserta_daftar');

        $grabdata = $this->M_masterdata->getdatafile_id(); 
        $data_ttp = $this->M_masterdata->get_data_ttp($id_konfirmasi_bayar);
        $today = date('j F Y');

        $no_ttp = 1;
        $found = false;
        while($found == false){
            $a = $this->M_masterdata->ttp_exists($no_ttp);
            if($a == 'ada') {
                $no_ttp++;
            } else {
                $found = true;
            }
        }
        $data = array(  
            'sts_konfirm_admin' => 1,
            'tgl_konfirm_admin' => date('Y-m-d H:i:s'),
            'no_ttp' => $no_ttp
        );
        $this->M_masterdata->update_sts_konfirmasi($id_konfirmasi_bayar, $data);

        $data1 = array(  
            'status_pembayaran' => $this->input->post('status_pembayaran'),
            'keterangan' => $this->input->post('update_keterangan'),
        );
        $this->M_masterdata->update_sts_pendaftaran($id_peserta_daftar, $data1);

       $this->createttp($no_ttp,$data_ttp,$today);
       $this->sendEmailTtp($no_ttp,$data_ttp,$today);

        echo 'success';
    }

    public function datakeuangan(){
        $data['title']	=  "Data Keuangan";
        $data['desc']	=  "";
        $this->template->load('template', $this->folder.'/datakeuangan',$data);
    }

    public function searchPeserta(){
        $json = [];
            if(!empty($this->input->get("q"))){
            $this->db->like('nama', $this->input->get("q"));
                $query = $this->db->select('id_akun_peserta,nama as text')
                            ->get("tbl_peserta_akun");
                $json = $query->result();
            }
		echo json_encode($json);
    }

    public function Search(){
        $keyword=$this->input->post('keyword');
        $data=$this->M_masterdata->GetRow($keyword);        
        echo json_encode($data);
    }

    public function generateDetailPeserta(){
        $idpeserta = $this->input->post('id');
        $data=$this->M_masterdata->GetDetailPeserta($idpeserta);        
        echo json_encode($data);
    }

    public function loadTransaksi(){
        $idpeserta = $this->input->post('valueid');
        $search= $this->M_masterdata->getTransaksiPeserta($idpeserta);
        $jsonArr=array(
            'rows'=>$search
        );
        echo json_encode($jsonArr);
    }

    /* Menu Update Pembayaran */
    public function updatePembayaran(){
        $data['title']	=  "Update Pembayaran";
        $data['desc']	=  "";
        $this->template->load('template', $this->folder.'/v_update_pembayaran',$data);
    }

    public function createttp($no_ttp,$data_ttp,$today){
        // Require composer autoload

        $a = require_once (APPPATH.'libraries/mpdf/vendor/autoload.php');
        // Create an instance of the class:
        $mpdf = new \Mpdf\Mpdf();

        $tgl_transfer = $data_ttp[0]->tgl_transfer;
        $hasil_tgl_transfer = date('d/m/Y',strtotime($tgl_transfer));
        $mpdf->Bookmark('Start of the document');

        // Write some HTML code:
        $mpdf->WriteHTML('<page style="background: white; display: block; margin: 0 auto; margin-bottom: 0.5cm; box-shadow: 0 0 0.5cm rgba(0,0,0,0.5); width: 21cm; height: 29.7cm;"> 
        <div style="color:#333333;">
            <section style="padding:20px;">
                <div style="height:120px; margin-bottom:1px; border-bottom:2px solid;">
                    <div style="width:38%; float:left;">
                        <img src="http://www.ppa-febui.com/peserta/assets/images/ppa/ppa-logo-long.png" style="max-width:270px; padding:20px 0;">
                    </div>
                    <div style="width:60%; float:right;">
                        <h2 style="font-size:18px; padding-bottom:4px; margin-bottom:4px;">PUSAT PENGEMBANGAN AKUNTANSI FEB UI</h2>
                        <p style="font-size:12px; font-weight:400; margin-top:2px;">Jl. Salemba Raya No. 4 Jakarta Pusat, Telp. (021) 390-8966, Fax. (021) 390-8967<br>
                        Gd. Dept. Akuntansi FEUI Lt. 1 Depok, Telp. (021) 7888-6407, Fax. (021) 7888-6407<br>
                        http://www.ppa-feui.com, e-mail: mail@ppa-feui.com</p>
                    </div>
                </div>
                <hr style="margin-top:1px; margin-bottom:30px;">
                <div style="margin-bottom:0; padding-bottom:0;">
                    <div style="width:100%; display: block; text-align:center;">                       
                        <p>
                            <strong style="text-decoration: underline;">TANDA TERIMA PESERTA </strong>
                            <br>
                            No. '.$no_ttp.'<span>&nbsp; </span> S /PPA/PLT/20                            
                        </p>
                    </div>
                </div>
                <div style="width:90%; margin:20px 30px;">
                    <div>
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="200">Telah terima dari</td>
                                    <td>:</td>
                                    <td>'.$data_ttp[0]->nama.'</td>
                                </tr>
                                <tr>
                                    <td width="200">Nama / Instansi</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="200">Untuk Kegiatan / Kode</td>
                                    <td>:</td>
                                    <td>'.$data_ttp[0]->kd_pelatihan.'</td>
                                </tr>
                                <tr>
                                    <td width="200">Jumlah-nett</td>
                                    <td>:</td>
                                    <td>Rp.'.$data_ttp[0]->total_bayar.'</td>
                                </tr>
                                <tr>
                                    <td width="200">Terbilang</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="width:50%; margin:20px 30px;">
                    <div>
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="160">Diskon</td>
                                    <td> : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="160">Metode Pembayaran</td>
                                    <td>:</td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="margin-left:40px;">
                            <tbody>
                                <tr style="margin-left:30px;">
                                    <td>1. '.$data_ttp[0]->sts_pembayaran.'</td>
                                </tr>
                                <tr style="margin-left:30px;">
                                    <td>2. Transfer</td><td>:</td><td>Tgl '.$hasil_tgl_transfer.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="float:right;">
                    <div style="width:200px; text-align:center;">
                        <p>Jakarta, '.$today.'</p>
                        <p>Penerima</p>
                        <div style="height:70px;"></div>
                        <p>( Admin )</p>
                    </div>
                </div>
            </section>
        </div>
    </page>');

        $name_file = "TTP".$no_ttp;
        // Output a PDF file directly to the browser
        $filename = './ttp/'.$name_file.'.pdf';
        //$filename = 'TTP.pdf';
        //$mpdf->Output($filename ,'I');
        $mpdf->Output($filename, \Mpdf\Output\Destination::FILE);
    }
    
    public function sendEmailTtp($no_ttp,$data_ttp,$today)
    {
      //Load email library
      $this->load->library('email');
      $this->load->library('encrypt');

      // SMTP & mail configuration
    //   $config = array(
    //       'protocol'  => 'POP3',
    //       'smtp_host' => 'mail.ppa-febui.com',
    //       'smtp_port' => 995,
    //       'smtp_user' => 'admin@ppa-febui.com',
    //       'smtp_pass' => 'febui@2018',
    //       'mailtype'  => 'html',
    //       'charset'   => 'utf-8'
    //   );

      $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'littlebossid.official@gmail.com', // change it to yours
        'smtp_pass' => 'L1ttl3B055', // change it to yours
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'newline' => "\r\n",
        'wordwrap' => TRUE
    );
      $this->email->initialize($config);
      $this->email->set_mailtype("html");
      $this->email->set_newline("\r\n");

      $htmlContent = "Dear ".$data_ttp[0]->nama."<br><br>";
      $htmlContent .= 'Konfirmasi pembayaran anda sudah berhasil di approve oleh admin<br><br>';
     
      $htmlContent .= 'Silahkan unduh attachment di bawah ini sebagai bukti pembayaran yang sah<br>';

      $this->email->to($data_ttp[0]->email);
      $this->email->from('info@ppa-ui.divrow.com','PPA UI ADMIN');
      $this->email->subject('Approval Konfirmasi Bayar Berhasil');
      $this->email->message($htmlContent);
      $name_file = "TTP".$no_ttp;
      $attched_file = $_SERVER["DOCUMENT_ROOT"]."/pelatihan_ppa/ttp/$name_file.pdf";
      //Send email
      $this->email->attach($attched_file);
      if($this->email->send())
      {
          echo 'Email_sent.';
      }
    else
       {
        show_error($this->email->print_debugger());
       }
    }

    /* Data Keuangan */
    public function loadtahunpelatihan(){
		$result=$this->M_masterdata->get_loadtahunpelatihan();
		echo json_encode($result);
	}

	public function loadpelatihan(){
		$tahunpelatihan = $this->input->post('tahunpelatihan');
		$result=$this->M_masterdata->get_loadpelatihan($tahunpelatihan);
		echo json_encode($result);
	}

	public function loadkdpelatihan(){
		$namapelatihan = $this->input->post('namapelatihan');
		$result=$this->M_masterdata->get_loadkdpelatihan($namapelatihan);
		echo json_encode($result);
    }
    
    public function loadpeserta(){
		$kdpelatihan = $this->input->post('kdpelatihan');
		$result=$this->M_masterdata->get_loadpeserta_keu($kdpelatihan);
		$jsonArr=array(
			'rows'=>$result
		);
		echo json_encode($jsonArr);
    }
    
    public function modalPayment() 
    {
        $stack = array();
        $id = $this->input->post('id');
        $data['id_peserta_daftar'] = $this->M_masterdata->get_payment_byid($id);   
        $jsonArr=array(
            'id_peserta_daftar'=>$data['id_peserta_daftar']
        );
        $this->output->set_output(json_encode($jsonArr));
    }

    public function historyPembayaran(){
        $data['title']	=  "History Pembayaran Midtrans";
        $data['desc']	=  "";
        $this->template->load('template', $this->folder.'/v_historypembayaran',$data);
    }

    public function loadhistoryPembayaran()
    {
        $search= $this->M_masterdata->get_loadhistoryPembayaran();
        $jsonArr=array(
            'rows'=>$search
        );
        echo json_encode($jsonArr);
    }
}

?>
