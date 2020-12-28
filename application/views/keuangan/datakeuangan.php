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
	<table class="table table-bordered" id="tblpeserta_show">
	<thead>
		<tr><th>No</th><th>NAMA</th>
		<th>Perusahaan</th><th>Biaya Kursus</th><th>Diskon</th><th>Action</th></tr>
	</thead>
	<tbody>
	</tbody>
		
	</table>
</div>

<div id="div_tbl_peserta" class="col-sm-12">
	
</div>

<!-- Modal PAYMENT -->
<div id="modal-payment" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">PAYMENT</h4>
              </div>
              <div class="modal-body">
          
          </div>
          <div class="modal-body">
              <div id="" style="padding: 5px 20px;">

            <form id="form-payment" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
            
                <div id="id_peserta_daftar" type="text"></div>

				<label><b>Payment 1</b></label>
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">TTP :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="ttp1" name="ttp1" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Status Bayar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="sts_bayar1" name="sts_bayar1" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>    
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Tanggal Bayar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="tgl_bayar1" name="tgl_bayar1" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>   
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Jumlah Bayar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="jml_bayar1" name="jml_bayar1" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>  

				<hr>

				<label><b>Payment 2</b></label>
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">TTP :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="ttp2" name="ttp2" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Status Bayar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="sts_bayar2" name="sts_bayar2" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>    
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Tanggal Bayar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="tgl_bayar2" name="tgl_bayar2" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>   
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Jumlah Bayar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="jml_bayar2" name="jml_bayar2" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>  

				<hr>

				<label><b>Payment 3</b></label>
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">TTP :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="ttp3" name="ttp3" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Status Bayar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="sts_bayar3" name="sts_bayar3" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>    
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Tanggal Bayar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="tgl_bayar3" name="tgl_bayar3" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>   
				<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Jumlah Bayar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="jml_bayar3" name="jml_bayar3" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>  

				<hr>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
	$('#tblpeserta_show').DataTable({
		dom: 'Bfrtip',
		buttons: [
		'csv'
		]
	});

});

function loadtahunpelatihan(){
	var url='<?php echo base_url();?>Keuangan/loadtahunpelatihan';
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
			url: '<?php echo base_url();?>Keuangan/loadpelatihan',
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
			url: '<?php echo base_url();?>Keuangan/loadkdpelatihan',
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
	$.ajax({
			url: '<?php echo base_url();?>Keuangan/loadpeserta',
			type: "POST",
			data  : id,
			dataType: "JSON",
			success:function(d){
				$('#tblpeserta').hide();
				var no='1';
				var el='';

				el+="<br><span><b>DATA KEUANGAN</b></span><br>";
			
				el+='<table id="datatable-fixed-header1" class="table table-striped table-bordered">';
				el+="<thead>";
				el+="<tr>";

				el+="<th>No</th>";
				el+="<th>Nama</th>";
				el+="<th>Perusahaan</th>";
				el+="<th>Biaya Kursus</th>";
				el+="<th>Diskon</th>";

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
							el+="<td>"+b.nama+"</td>";
							el+="<td>"+b.nama_kantor+"</td>";
							el+="<td>"+b.investasi+"</td>";
							el+="<td></td>";
						
							el+='<td>';
							el+='<a type="button" onClick="return payment(\''+b.id_peserta_daftar+'\');" data-toggle="tooltip" title="Payment" class="btn btn-sm btn-info"><i class="fa fa-money"></i></a>';
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
});

// Payment
function payment(id){
      var url   = "<?php echo site_url('Keuangan/modalPayment'); ?>";
      var param   = { 'id' : id };
      var modalid = '#modal-payment';
      $.ajax({
        url         : url,
        type        : 'POST',
        data        : param,
        dataType    : 'JSON',
        beforeSend  : function (){
          $(modalid).modal('show');
        },
        success : function(data) {

          var id_peserta_daftar = '';
		  var sts_bayar1 = '';
		  var tgl_bayar1 = '';
		  var jml_bayar1 = '';

		  var sts_bayar2 = '';
		  var tgl_bayar2 = '';
		  var jml_bayar2 = '';

		  var sts_bayar3 = '';
		  var tgl_bayar3 = '';
		  var jml_bayar3 = '';
          
          if(data.id_peserta_daftar.length == 1){
			  
            $.each(data.id_peserta_daftar,function(a,b){
              id_peserta_daftar+= '<input type="hidden" name="id_peserta_daftar" id="id_peserta_daftar" value="'+b.id_peserta_daftar+'">';
			
			  sts_bayar1 = data.id_peserta_daftar[0].sts_pembayaran;
			  tgl_bayar1 = data.id_peserta_daftar[0].tgl_transfer;
			  jml_bayar1 = data.id_peserta_daftar[0].total_bayar;
            });
          }

		  else if(data.id_peserta_daftar.length == 2){
            $.each(data.id_peserta_daftar,function(a,b){
              id_peserta_daftar+= '<input type="hidden" name="id_peserta_daftar" id="id_peserta_daftar" value="'+b.id_peserta_daftar+'">';
			
			  sts_bayar1 = data.id_peserta_daftar[0].sts_pembayaran;
			  tgl_bayar1 = data.id_peserta_daftar[0].tgl_transfer;
			  jml_bayar1 = data.id_peserta_daftar[0].total_bayar;

			  sts_bayar2 = data.id_peserta_daftar[1].sts_pembayaran;
			  tgl_bayar2 = data.id_peserta_daftar[1].tgl_transfer;
			  jml_bayar2 = data.id_peserta_daftar[1].total_bayar;
            });
          }

		  else if(data.id_peserta_daftar.length == 3){
            $.each(data.id_peserta_daftar,function(a,b){
              id_peserta_daftar+= '<input type="hidden" name="id_peserta_daftar" id="id_peserta_daftar" value="'+b.id_peserta_daftar+'">';
			
			  sts_bayar1 = data.id_peserta_daftar[0].sts_pembayaran;
			  tgl_bayar1 = data.id_peserta_daftar[0].tgl_transfer;
			  jml_bayar1 = data.id_peserta_daftar[0].total_bayar;

			  sts_bayar2 = data.id_peserta_daftar[1].sts_pembayaran;
			  tgl_bayar2 = data.id_peserta_daftar[1].tgl_transfer;
			  jml_bayar2 = data.id_peserta_daftar[1].total_bayar;

			  sts_bayar3 = data.id_peserta_daftar[2].sts_pembayaran;
			  tgl_bayar3 = data.id_peserta_daftar[2].tgl_transfer;
			  jml_bayar3 = data.id_peserta_daftar[2].total_bayar;
            });
          }

		  else {
			  
		  }

          $(modalid+' #id_peserta_daftar').empty().html(id_peserta_daftar);
		  $(modalid+' #sts_bayar1').val(sts_bayar1);
		  $(modalid+' #tgl_bayar1').val(tgl_bayar1);
		  $(modalid+' #jml_bayar1').val(jml_bayar1);

		  $(modalid+' #sts_bayar2').val(sts_bayar2);
		  $(modalid+' #tgl_bayar2').val(tgl_bayar2);
		  $(modalid+' #jml_bayar2').val(jml_bayar2);

		  $(modalid+' #sts_bayar3').val(sts_bayar3);
		  $(modalid+' #tgl_bayar3').val(tgl_bayar3);
		  $(modalid+' #jml_bayar3').val(jml_bayar3);
          $('#form-payment').show();
        }   
      });
}

</script>