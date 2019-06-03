<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
 
<script src="<?php echo base_url()?>assets/js/jquery.min.js">
</script>

<script>
	$(document).ready(function(){
			  loadjurusan();    
	  });
</script>

<script>
	$(document).ready(function(){
	  $("#prodi").change(function(){
		  loadjurusan()
	  });
	});
</script>

<script>
	$(document).ready(function(){
	  $("#konsentrasi").change(function(){
		  loadpeserta();
	  });
	});
</script>

<script>
	$(document).ready(function(){
	  $("#tahun_angkatan").change(function(){
		  loadjurusan()
	  });
	});
</script>

<script type="text/javascript">
	function loadpeserta()
	{
		var konsentrasi=$("#konsentrasi").val();
		var tahun_angkatan=$("#tahun_angkatan").val();
		$.ajax({
		url:"<?php echo base_url();?>peserta/tampilkanpeserta",
		data:"konsentrasi=" + konsentrasi + "&tahun_angkatan=" + tahun_angkatan ,
		success: function(html)
		   {
			  $("#peserta").html(html);
		   }
		   });
	}
	</script>

<script type="text/javascript">
	function loadjurusan()
	{
		var prodi=$("#prodi").val();
		$.ajax({
		url:"<?php echo base_url();?>peserta/tampilkankonsentrasi",
		data:"prodi=" + prodi ,
		success: function(html)
		{
				$("#konsentrasi").html(html);
				loadpeserta();
				
		}
		});
	}
</script>


<script type="text/javascript">
	function hapus(id)
	{
		
		$.ajax({
		url:"<?php echo base_url();?>peserta/delete",
		data:"id=" + id ,
		success: function(html)
		{
				$("#hide"+id).hide(300);   
		}
		});
	   
	}
</script>

	<?php
	if($this->ion_auth->get_users_groups()->row()->id==1)
	{
		$param="";
	}
	else
	{
		$param=array('prodi_id'=>$this->session->userdata('keterangan'));
	}
	?>
	
<div class="col-sm-5">
    <table class="table table-bordered"> 

	<tr>
		<!-- <td>Tahun Pelatihan
            <?php echo buatcombo('tahun_angkatan', 'student_angkatan', '', 'keterangan', 'angkatan_id', '', array('id'=>'tahun_angkatan'))?>
    	</td> -->
		<td>Tahun Pelatihan
			<select class="form-control" id="thn_pelatihan" name="thn_pelatihan">
			<option value="" selected disabled="disabled">Pilih tahun pelatihan...</option>
			</select>
		</td>
	</tr>
    <tr>
		<!-- <td>Jenis Pelatihan<?php echo buatcombo('prodi', 'akademik_prodi', '', 'nama_prodi', 'prodi_id', $param, array('id'=>'prodi'))?>
		</td> -->
		<td>Jenis Pelatihan
			<select class="form-control" id="jns_pelatihan" name="jns_pelatihan">
			<option value="" selected disabled="disabled">Pilih jenis pelatihan...</option>
			</select>
		</td>
	</tr>
	<tr>
	<!-- <td>Angkatan Pelatihan<?php echo combodumy('konsentrasi', 'konsentrasi')?></td> -->
	<td>Angkatan Pelatihan
		<select class="form-control" id="kd_angkatan" name="kd_angkatan">
			<option value="" selected disabled="disabled">Pilih angkatan pelatihan...</option>
		</select></td>
	</tr>

    

    <!-- <tr><td><?php echo anchor('peserta/post','Input Data',array('class'=>'btn btn-primary  btn-sm'));?></td></tr> -->
</table>
</div>
						
<div class="col-sm-12" id="tblpeserta">
<br>
<span><b>PESERTA AKTIF PELATIHAN</b></span><br>
	<table class="table table-bordered" id="tblpeserta_show">
	<thead>
		<tr><th>No</th><th>NIP</th><th>NAMA</th>
		<th>L/P</th><th>Email</th><th>No. HP</th>
		<th>Keterangan</th><th>Validasi</th><th>Action</th></tr>
	</thead>
	<tbody>
	</tbody>
	</table><br><br>
</div>

<div class="col-sm-12" id="tblpeserta_btl">
<span><b>PESERTA BATAL PELATIHAN</b></span><br>
	<table class="table table-bordered" id="tblpeserta_btl_show">
	<thead>
	<tr><th>No</th><th>NIP</th><th>NAMA</th>
		<th>L/P</th><th>Email</th><th>No. HP</th>
		<th>Keterangan</th><th>Validasi</th><th>Action</th></tr>
	</thead>
	<tbody>
	</tbody>
	</table>
</div>


<div id="div_tbl_peserta" class="col-sm-12"></div>

<div id="div_tbl_peserta_btl" class="col-sm-12"></div>

<div id="modal-datadaftar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Data Peserta Daftar</h4>
              </div>
              <div class="modal-body">
          
          </div>
          <div class="modal-body">
              <div id="" style="padding: 5px 20px;">

            <form id="form-datadaftar" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
            
                <div id="id_peserta_daftar" type="text"></div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Nama Peserta :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nama" name="nama" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Tanggal Lahir :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Alamat Rumah :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="alamat_rumah" name="alamat_rumah" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Kode pos rumah :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="kode_pos_rumah" name="kode_pos_rumah" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Jenis Kelamin :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">No HP :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="no_hp" name="no_hp" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Email :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Agama :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="agama" name="agama" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Pekerjaan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="pekerjaan" name="pekerjaan" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">No KTP :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="no_ktp" name="no_ktp" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
                
                <div class="form-group">
                	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">foto KTP :
                  	</label>
                  	<div id="foto_ktp" class="col-md-6 col-sm-6 col-xs-12">
											<!-- <img id="ktp" src="http://www.ppa-febui.com/peserta/assets/images/ppa/ppa_logo.png" class="img-responsive"> -->
                  	</div>
                </div>
								
								<div class="form-group">
                	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name"><b>Informasi Tempat Kerja</b>
                  </label>
                </div>

								<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kantor :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nama_kantor" name="nama_kantor" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

								<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Bidang Usaha :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="bidang_usaha" name="bidang_usaha" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

								<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Kantor :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="alamat_kantor" name="alamat_kantor" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
								<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Pos :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="kode_pos_kantor" name="kode_pos_kantor" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
								<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">No telp :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="no_telp" name="no_telp" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
								<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="jabatan" name="jabatan" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
								<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Divisi/bagian :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="div_bagian" name="div_bagian" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

								<div class="form-group">
                	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name"><b>Informasi Tempat Kuliah</b>
                  </label>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            
            </form>

            </div>
          </div>
          
    </div>
  </div>
</div>

<div id="modal-bataldaftar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Batal Mengikuti Pelatihan</h4>
              </div>
              <div class="modal-body">
          
          </div>
          <div class="modal-body">
              <div id="" style="padding: 5px 20px;">

            <form id="form-bataldaftar" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
            
                <div id="id_peserta_daftar" type="text"></div>
				<div id="kd_angkatan" type="text"></div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Nama Peserta :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nama" name="nama" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Nama Pelatihan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nama_pelatihan" name="nama_pelatihan" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Alasan Batal :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea rows="3" id="alasan_batal" name="alasan_batal" class="form-control col-md-7 col-xs-12" required="required"></textarea>
                    </div>
                  </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                  <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            
            </form>

            </div>
          </div>
          
    </div>
  </div>
</div>

<div id="modal-jadidaftar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Jadi Mengikuti Pelatihan</h4>
              </div>
              <div class="modal-body">
          
          </div>
          <div class="modal-body">
              <div id="" style="padding: 5px 20px;">

            <form id="form-jadidaftar" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
            
                <div id="id_peserta_daftar" type="text"></div>
				<div id="kd_angkatan" type="text"></div>

				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Nama Peserta :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nama" name="nama" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Nama Pelatihan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nama_pelatihan" name="nama_pelatihan" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>            

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                  <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            
            </form>

            </div>
          </div>
          
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	loadtahunpelatihan();

	$('#tblpeserta_show').DataTable({});
	$('#tblpeserta_btl_show').DataTable({});

});

function loadtahunpelatihan(){
	var url='<?php echo base_url();?>Peserta/loadtahunpelatihan';
	$.ajax({
			type  : 'POST',
			url   : url,
			dataType: 'JSON',
			beforeSend: function (){
			},
			success: function(data) {
				$.each(data, function(i, data) {
					$('#thn_pelatihan').append("<option value='" + data.tahun + "'>" + data.tahun + "</option>");
				});
			}
	});
}

$('#thn_pelatihan').on('change', function() {
	var pelatihanID = $(this).val();
	var dataparam = {tahunpelatihan: $("#thn_pelatihan").val()};
		$.ajax({
			url: '<?php echo base_url();?>Peserta/loadpelatihan',
			type: "POST",
			data  : dataparam,
			dataType: "JSON",
			success:function(data) {
				$('#jns_pelatihan').empty();
				$('#jns_pelatihan').append('<option value="" selected disabled="disabled">Pilih jenis pelatihan...</option>');
				$.each(data, function(key, value) {
					$('#jns_pelatihan').append('<option value="'+ value.nama_pelatihan +'">'+ value.nama_pelatihan +'</option>');
				});
			}
		});
});

$('#jns_pelatihan').on('change', function() {
	var pelatihanID = $(this).val();
	var dataparam = {namapelatihan: $("#jns_pelatihan").val()};
		$.ajax({
			url: '<?php echo base_url();?>Peserta/loadkdpelatihan',
			type: "POST",
			data  : dataparam,
			dataType: "JSON",
			success:function(data) {
				$('#kd_angkatan').empty();
				$('#kd_angkatan').append('<option value="" selected disabled="disabled">Pilih angkatan pelatihan...</option>');
				$.each(data, function(key, value) {
					$('#kd_angkatan').append('<option value="'+ value.kd_angkatan +'">'+ value.kd_angkatan +'</option>');
				});
			}
		});
});

$('#kd_angkatan').on('change', function() {
	var pelatihanID = $(this).val();
	var id = {kdpelatihan: $("#kd_angkatan").val()};
	console.log(id);
	
	pesertaaktif(id);
	pesertabatal(id);
		
});

function pesertaaktif(id){
	$.ajax({
			url: '<?php echo base_url();?>Peserta/loadpeserta',
			type: "POST",
			data  : id,
			dataType: "JSON",
			success:function(d){
				$('#tblpeserta').hide();
				$('#tblpeserta_btl').hide();
				var no='1';
				var el='';

				el+="<br><span><b>PESERTA AKTIF PELATIHAN</b></span><br>";
			
				el+='<table id="datatable-fixed-header1" class="table table-striped table-bordered">';
				el+="<thead>";
				el+="<tr>";

				el+="<th>No</th>";
				el+="<th>NIP</th>";
				el+="<th>Nama</th>";
				el+="<th>L/P</th>";
				el+="<th>Email</th>";
				el+="<th>No HP</th>";
				// el+="<th>Pelatihan</th>";
				// el+="<th>Bukti Pembayaran</th>";
				el+="<th>Keterangan</th>";
				// el+="<th>Status</th>";
				el+="<th>Action</th>";
			
				el+="</tr>";
				el+="</thead>";
					el+="<tbody>";
			
					if(d.rows.length>0){
						$.each(d.rows,function(a,b){
							var sts_aktif_peserta = b.sts_aktif_peserta;
							if(sts_aktif_peserta == 1){
								sts_aktif_peserta = 'Aktif'
							} else {
								sts_aktif_peserta = 'Batal'
							}
							var no_peserta = b.no_peserta;
							if(no_peserta == null){
								no_peserta = ''
							} else {
								no_peserta
							}
							el+="<tr id='trdatafile-"+b.id_peserta_daftar+"'>";
							el+="<td class='text-center'>"+no+"</td>";
							el+="<td>"+no_peserta+"</td>";
							el+="<td>"+b.nama+"</td>";
							el+="<td>"+b.jenis_kelamin+"</td>";
							el+="<td>"+b.email+"</td>";
							el+="<td>"+b.no_hp+"</td>";
							// el+="<td>"+b.nama_pelatihan+"</td>";
							// el+='<td><a type="button" onClick="return lihatBukti(\''+b.id_peserta_daftar+'\'); data-toggle="tooltip" title="Lihat" class="btn btn-sm btn-info">Lihat Bukti</i></a></td>';
							el+="<td>"+b.keterangan+"</td>";
							// el+="<td>"+sts_aktif_peserta+"</td>";
							
							el+='<td>';
							el+='<a type="button" onClick="return batalDaftar(\''+b.id_peserta_daftar+'\');" data-toggle="tooltip" title="Batal" class="btn btn-sm btn-info"><i class="fa fa-times"></i></a>';
							el+='<a type="button" onClick="return dataDaftar(\''+b.id_peserta_daftar+'\');" data-toggle="tooltip" title="View" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>';
							el+='</td>';
					
							el+="</tr>";
							no++;
							return (b == null) ? '' : b;
							});
						}
					el+="</tbody></table><br><br>";
				$("#div_tbl_peserta").empty().html(el);
				$('#datatable-fixed-header1').DataTable({
				});
			}
		});
}
function pesertabatal(id){
	$.ajax({
			url: '<?php echo base_url();?>Peserta/loadpesertabatal',
			type: "POST",
			data  : id,
			dataType: "JSON",
			success:function(d){
				$('#tblpeserta2').hide();
				var no='1';
				var el='';

				el+='<br><span><b>PESERTA BATAL PELATIHAN</b></span><br>';			
				el+='<table id="datatable-fixed-header2" class="table table-striped table-bordered">';
				el+="<thead>";
				el+="<tr>";

				el+="<th>No</th>";
				el+="<th>NIP</th>";
				el+="<th>Nama</th>";
				el+="<th>L/P</th>";
				el+="<th>Email</th>";
				el+="<th>No HP</th>";
				// el+="<th>Pelatihan</th>";
				// el+="<th>Bukti Pembayaran</th>";
				el+="<th>Keterangan</th>";
				// el+="<th>Status</th>";
				el+="<th>Action</th>";
			
				el+="</tr>";
				el+="</thead>";
					el+="<tbody>";
			
					if(d.rows.length>0){
						$.each(d.rows,function(a,b){
							var sts_aktif_peserta = b.sts_aktif_peserta;
							if(sts_aktif_peserta == 1){
								sts_aktif_peserta = 'Aktif'
							} else {
								sts_aktif_peserta = 'Batal'
							}
							var no_peserta = b.no_peserta;
							if(no_peserta == null){
								no_peserta = ''
							} else {
								no_peserta
							}
							el+="<tr id='trdatafile-"+b.id_peserta_daftar+"'>";
							el+="<td class='text-center'>"+no+"</td>";
							el+="<td>"+no_peserta+"</td>";
							el+="<td>"+b.nama+"</td>";
							el+="<td>"+b.jenis_kelamin+"</td>";
							el+="<td>"+b.email+"</td>";
							el+="<td>"+b.no_hp+"</td>";
							// el+="<td>"+b.nama_pelatihan+"</td>";
							// el+='<td><a type="button" onClick="return lihatBukti(\''+b.id_peserta_daftar+'\'); data-toggle="tooltip" title="Lihat" class="btn btn-sm btn-info">Lihat Bukti</i></a></td>';
							el+="<td>"+b.keterangan+"</td>";
							// el+="<td>"+sts_aktif_peserta+"</td>";
							
							el+='<td>';
							el+='<a type="button" onClick="return jadiDaftar(\''+b.id_peserta_daftar+'\');" data-toggle="tooltip" title="Jadi" class="btn btn-sm btn-info"><i class="fa fa-check"></i></a>';
							el+='<a type="button" onClick="return dataDaftar(\''+b.id_peserta_daftar+'\');" data-toggle="tooltip" title="View" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>';
							el+='</td>';
					
							el+="</tr>";
							no++;
							return (b == null) ? '' : b;
							});
						}
					el+="</tbody></table>";
				$("#div_tbl_peserta_btl").empty().html(el);
				$('#datatable-fixed-header2').DataTable({
				});
			}
		});
}

// BATAL DAFTAR //

function batalDaftar(id){
      var url   = "<?php echo site_url('Peserta/modalBatalDaftar'); ?>";
      var param   = { 'id' : id };
      var modalid = '#modal-bataldaftar';
      $.ajax({
        url         : url,
        type        : 'POST',
        data        : param,
        dataType    : 'JSON',
        beforeSend  : function (){
		document.getElementById("form-bataldaftar").reset();
          $(modalid).modal('show');
        },
        success : function(data) {

          console.log(data);
          var id_peserta_daftar = '';
          var kd_angkatan = '';
		  var nama = '';
          var nama_pelatiahan = '';
          
          if(data.id_peserta_daftar.length>0){
            $.each(data.id_peserta_daftar,function(a,b){
              id_peserta_daftar+= '<input type="hidden" name="id_peserta_daftar" id="id_peserta_daftar" value="'+b.id_peserta_daftar+'">';
              kd_angkatan+= '<input type="hidden" name="kd_angkatan" id="kd_angkatan" value="'+b.kd_angkatan+'">';
              nama = b.nama;
			  nama_pelatihan = b.nama_pelatihan;
            });
          }

          $(modalid+' #id_peserta_daftar').empty().html(id_peserta_daftar);
          $(modalid+' #kd_angkatan').empty().html(kd_angkatan);
		  $(modalid+' #nama').val(nama);
          $(modalid+' #nama_pelatihan').val(nama_pelatihan);
          $('#form-bataldaftar').show();
        }   
      });
}

$("#form-bataldaftar").on('submit',(function(e) {
        validasi = $("#form-bataldaftar").valid();
        if(validasi) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url   : "<?php echo base_url(); ?>Peserta/batalPelatihan",
                type  : "POST",
                data  : data,
                dataType: "JSON",
                contentType: false,
                cache : false,
                processData:false,
                beforeSend : function (){   
                },
                success: function(data){
				
                  $('#modal-bataldaftar').modal('hide');
                  document.getElementById("form-bataldaftar").reset();						
				  var id = {kdpelatihan: data.kd_angkatan};
				  
                  pesertaaktif(id);
				  pesertabatal(id);
                }         
            });
        }
}));

// JADI DAFTAR //

function jadiDaftar(id){
      var url   = "<?php echo site_url('Peserta/modalJadiDaftar'); ?>";
      var param   = { 'id' : id };
      var modalid = '#modal-jadidaftar';
      $.ajax({
        url         : url,
        type        : 'POST',
        data        : param,
        dataType    : 'JSON',
        beforeSend  : function (){
		document.getElementById("form-jadidaftar").reset();
          $(modalid).modal('show');
        },
        success : function(data) {

          console.log(data);
          var id_peserta_daftar = '';
          var kd_angkatan = '';
		  var nama = '';
          var nama_pelatiahan = '';
          
          if(data.id_peserta_daftar.length>0){
            $.each(data.id_peserta_daftar,function(a,b){
              id_peserta_daftar+= '<input type="hidden" name="id_peserta_daftar" id="id_peserta_daftar" value="'+b.id_peserta_daftar+'">';
              kd_angkatan+= '<input type="hidden" name="kd_angkatan" id="kd_angkatan" value="'+b.kd_angkatan+'">';
              nama = b.nama;
			  nama_pelatihan = b.nama_pelatihan;
            });
          }

          $(modalid+' #id_peserta_daftar').empty().html(id_peserta_daftar);
          $(modalid+' #kd_angkatan').empty().html(kd_angkatan);
		  $(modalid+' #nama').val(nama);
          $(modalid+' #nama_pelatihan').val(nama_pelatihan);
          $('#form-jadidaftar').show();
        }   
      });
}

$("#form-jadidaftar").on('submit',(function(e) {
        validasi = $("#form-jadidaftar").valid();
        if(validasi) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url   : "<?php echo base_url(); ?>Peserta/jadiPelatihan",
                type  : "POST",
                data  : data,
                dataType: "JSON",
                contentType: false,
                cache : false,
                processData:false,
                beforeSend : function (){   
                },
                success: function(data){
                  $('#modal-jadidaftar').modal('hide');
                  document.getElementById("form-bataldaftar").reset();					
				  var id = {kdpelatihan: data.kd_angkatan};				  

                  pesertaaktif(id);
				  pesertabatal(id);
                }         
            });
        }
}));

function dataDaftar(id){
      var url   = "<?php echo site_url('Peserta/modalDataDaftar'); ?>";
      var param   = { 'id' : id };
      var modalid1 = '#modal-datadaftar';
      $.ajax({
        url         : url,
        type        : 'POST',
        data        : param,
        dataType    : 'JSON',
        beforeSend  : function (){
          $(modalid1).modal('show');
        },
        success : function(data) {
          console.log(data);

          var id_peserta_daftar = '';
          var nama = '';
          var tempat_lahir = '';
          var tanggal_lahir = '';
          var alamat_rumah = '';
          var kode_pos_rumah = '';
          var jenis_kelamin = '';
          var no_hp = '';
          var email = '';
          var agama = '';
          var pekerjaan = '';
          var no_ktp = '';
					var ktp = '';
					var base_url = 'http://www.ppa-febui.com/peserta/';

					var nama_kantor = '';
					var bidang_usaha = '';
					var alamat_kantor = '';
					var kode_pos_kantor = '';
					var no_telp = '';
					var jabatan = '';
					var div_bagian = '';

					// var nama_kantor = '';
					// var nama_kantor = '';
					// var nama_kantor = '';
					// var nama_kantor = '';
					// var nama_kantor = '';
					// var nama_kantor = '';

          
          if(data.id_peserta_daftar.length>0){
            $.each(data.id_peserta_daftar,function(a,b){
              id_peserta_daftar+= '<input type="hidden" name="id_peserta_daftar" id="id_peserta_daftar" value="'+b.id_peserta_daftar+'">';
              
              nama = b.nama;
							tempat_lahir = b.tempat_lahir;
							tanggal_lahir = b.tgl_lahir;
							alamat_rumah = b.alamat;
							kode_pos_rumah = b.kode_pos;
							email = b.email
							jenis_kelamin = b.jenis_kelamin;
							no_hp = b.no_hp;
							agama = b.agama;
							pekerjaan = b.pekerjaan;
							no_ktp = b.no_ktp;
							ktp = b.file_ktp;

							nama_kantor = b.nama_kantor
							bidang_usaha = b.bidang_usaha
							alamat_kantor = b.alamat_kantor
							kode_pos_kantor = b.kode_pos_kantor
							no_telp = b.no_tlp
							jabatan = b.jabatan
							div_bagian = b.div_bagian


            });
          }

          $(modalid1+' #id_peserta_daftar').empty().html(id_peserta_daftar);
					$(modalid1+' #nama').val(nama);
					$(modalid1+' #tempat_lahir').val(tempat_lahir);
					$(modalid1+' #tanggal_lahir').val(tanggal_lahir);
					$(modalid1+' #alamat_rumah').val(alamat_rumah);
					$(modalid1+' #kode_pos_rumah').val(kode_pos_rumah);
					$(modalid1+' #email').val(email);
					$(modalid1+' #jenis_kelamin').val(jenis_kelamin);
					$(modalid1+' #no_hp').val(no_hp);
					$(modalid1+' #agama').val(agama);
					$(modalid1+' #pekerjaan').val(pekerjaan);
					$(modalid1+' #no_ktp').val(no_ktp);
					$('#foto_ktp').html('<img src="'+base_url+'uploads/ktp/'+ktp+'" class="img-responsive">');
					
					$(modalid1+' #nama_kantor').val(nama_kantor);
					$(modalid1+' #bidang_usaha').val(bidang_usaha);
					$(modalid1+' #alamat_kantor').val(alamat_kantor);
					$(modalid1+' #kode_pos_kantor').val(kode_pos_kantor);
					$(modalid1+' #no_telp').val(no_telp);
					$(modalid1+' #jabatan').val(jabatan);
					$(modalid1+' #div_bagian').val(div_bagian);
					
          $('#form-datadaftar').show();
        }   
      });
}



</script>