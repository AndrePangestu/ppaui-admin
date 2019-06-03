<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>

<link rel="stylesheet" href="<?php echo base_url()?>assets/css/easy-autocomplete.min.css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/easy-autocomplete.themes.min.css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/select2.css"/>

<!--  <script>
  $( document ).ready(function() { 
      hidesemster();
  });
</script>-->

<!-- <script type="text/javascript">
$(document).ready(function(){
    $("#jenis_pembayaran").change(function(){ 
        hidettp;
        });
  
  });
</script> -->

<!-- <script type="text/javascript">
function hidesemster()
{
     var jenis_pembayaran=$("#jenis_pembayaran").val();
        if(jenis_pembayaran==3)
            {
                $("#semester").show()
            }
            else
                {
                     $("#semester").hide()
                }
}
</script> -->

<?php
echo $this->session->flashdata('pesan');
$status=array(0=>'Lunas',1=>'Pembayaran Ke 1',2=>'Pembayaran Ke 2',3=>'Pembayaran Ke 3',4=>'Pembayaran Ke 4');
?>
<?php
echo form_open('keuangan/pembayaran');
?>
    
<div class="col-sm-6">    
<table class="table table-bordered">
    <tr class="success"><th colspan="3">Data Peserta </th></tr>
    <!-- <tr><td width="120">NIP</td><td> <?php echo inputan('text', 'nim','col-sm-6','Masukan NIP ..', 1, '','');?> 
	<input type="submit" value="OK" name="submit" class="btn btn-danger"> 
		<?php echo anchor('keuangan/reset','RESET',array('class'=>'btn btn-danger'));?></td>
        <td wisth="90" align="center" rowspan="3"><img src="<?php echo base_url()?>assets/images/noprofile.gif" width="85"></td>
    </tr> -->

    <tr><td width="120">Nama</td>
    <td>  
        <!-- <select id="language" class="itemName form-control select2" style="width:300px" name="peserta"></select> -->
        <input id="namapeserta" class="col-md-2 col-sm-2" style="width:100px" placeholder="Masukkan Nama Peserta"/>
                
    </td>
        <!-- <td wisth="90" align="center" rowspan="3"><img src="<?php echo base_url()?>assets/images/noprofile.gif" width="85"></td> -->
    </tr>
    <tr hidden><td>Nama</td><td><input id="id-peserta" class="form-control" readonly/></td></tr>
	<tr><td>NIP</td><td><input id="id-nip" class="form-control" readonly/></tr>
    <tr><td>Pelatihan</td><td><input id="id-pelatihan" class="form-control" readonly/></td></tr>
    <tr><td>Angkatan</td><td><input id="id-angkatan" class="form-control" readonly/></td></tr>
    <tr><td>Biaya</td><td><input id="id-biaya" class="form-control" readonly/></td></tr>
    <tr><td>Jenis Pembayaran</td><td><input id="id-jns_pembayaran" class="form-control" readonly/></td></tr>
</table>
</form>
</div>
<a href="<?php echo base_url(); ?>Keuangan/sendttp" class="btn btn-primary">Save changes</a>
<?php
echo form_open('keuangan/pembayaran');
?>
<div class="col-sm-6">
    <table class="table table-bordered">
        <tr class="success"><th colspan="2">Form Transaksi</th></tr>
        <tr><td width="180">Jenis Harga - No. TTP</td><td>
            <?php echo buatcombo('jenis','keuangan_jenis_bayar','col-sm-6','keterangan','jenis_bayar_id','',array('id'=>'jenis_pembayaran')); ?> 
			<?php echo inputan('text','no_ttp','col-md-6','Nomor TTP ..',1,'','');?>
                <!--<div class="col-md-6">
                     <select name="semester" id="semester" class="form-control">
                    //    <?php 
                    //   for($sms=1;$sms<=8;$sms++)
                    //    {
                    //        echo "<option VALUE='$sms'>SEMESTER $sms</option>";
                    //    }
                    //    ?>
                    </select>
                </div> -->
            </td></tr>
       
        <tr><td>Nominal - Tanggal Bayar</td><td><?php echo inputan('text', 'jumlah','col-sm-6','Nominal ..', 1, '','');?> 
		<?php echo inputan('text', 'tanggal','col-sm-6','Tanggal Bayar ..', 0, '',array('id'=>'datepicker'));?></td>
		<tr><td>Tipe Pembayaran</td><td><div class="col-md-6"><?php echo form_dropdown('tipe',array('TRANSFER'=>'TRANSFER','TUNAI'=>'TUNAI'),'',"class='form-control'");?></td></tr>
		<tr><th colspan="2"><input type="submit" name="submit2" value="SUBMIT" class="btn btn-danger"></th></tr>
    </table>
</div>
</form>


<div class="col-sm-12" id="tbltransaksi">
<span><b>Riwayat Transaksi</b></span>
	<table class="table table-bordered" id="tbltransaksi_show">
	<thead>
		<tr>
            <th>Pembayaran 1</th>
            <th>Pembayaran 2</th>
            <th>Pembayaran 3</th>
            <th>Sisa Bayar</th>
            <th>Status Pembayaran</th>
        </tr>
	</thead>
	<tbody>
            <th>0</th>
            <th>0</th>
            <th>0</th>
            <th>0</th>
            <th>-</th>
	</tbody>
		
	</table><br><br>
</div>

<div id="div_tbl_transaksi"></div>

<!-- <?php
if($statuss!="kosong"){
?>
<table class="table table-bordered">
    <tr class="success"><th colspan="8">Riwayat Transaksi</th></tr>
    <tr><th width="10">No</th>
        <th width="150">Jenis Harga</th>
        <th width="180">Biaya</th>
        <th width="180">Sudah Dibayar</th>
        <th width="180">Sisa</th>
        <th width="150">Persentase %</th>
        <th>Keterangan</th></tr>
    
    <?php
    
    // tahun akademik ketika masuk
    $tahun_akademik_id=  getField('student_mahasiswa', 'angkatan_id', 'nim', $nim);
    // konsentrasi
    $konsentrasi_id=getField('student_mahasiswa', 'konsentrasi_id', 'nim', $nim);
    $no=1;
        foreach ($jenis_bayar as $jb)
        {
            $jumlah_bayar   = (int)get_biaya_kuliah($tahun_akademik_id, $jb->jenis_bayar_id, $konsentrasi_id, 'jumlah');
            $sudah_bayar    = (int)get_biaya_sudah_bayar($nim, $jb->jenis_bayar_id);
            $sisa           = $jumlah_bayar-$sudah_bayar;
            $ket           	= $sisa<=0?'Lunas':'Tunggakan '.rp($sisa);
            echo "<tr><td>$no</td>
                <td>".  strtoupper($jb->keterangan)."</td>
                <td>".rp($jumlah_bayar)."</td>
                <td>".rp($sudah_bayar)."</td>
                <td>".rp($sisa)."</td>
                <td>".  get_persentase_pembayaran($jumlah_bayar, $sudah_bayar)." %</td>
                <td>$ket</td>
                </tr>";
            $no++;
        }
       // get semester aktif
       $smt_aktif = getField('student_mahasiswa', 'semester_aktif', 'nim', $nim);
        // looping semester
        //for($i=1;$i<=$smt_aktif;$i++)
        //{
            //$spp            =   (int) get_biaya_kuliah($tahun_akademik_id, 3, $konsentrasi_id, 'jumlah');
            //$spp_udah_bayar =   (int)get_semester_sudah_bayar($nim, $i);
            //$sisa           =   $spp-$spp_udah_bayar;
            //$keterangan     =   $sisa<=0?'Lunas':'Tunggakan '.$sisa;
            //echo "<tr><td>$no</td>
            //    <td>SPP SEMESTER $i</td>
            //    <td>".rp($spp)."</td>
            //    <td>".rp($spp_udah_bayar)."</td>
            //    <td>$sisa</td>
            //    <td>".  rp(get_persentase_pembayaran($spp, $spp_udah_bayar))." %</td>
            //    <td>$keterangan</td></tr>";
            //$no++;
        //}
    ?>
    <tr><td colspan="8"><?php echo anchor('keuangan/cetakpersonal','Cetak Data',array('class'=>'btn btn-danger','target'=>'new'))?></td></tr>
</table>

<table class="table table-striped table-bordered table-hover">
    <tr class="success"><th colspan="9">Riwayat Transaksi Detail</th></tr>
    <tr><th width="10">No</th>
        <th width="120">Jenis Harga</th>
		<th width="160">Nomor TTP</th>
		<th width="120">Tipe Bayar</th>
        <th width="160">Tanggal</th>
        <th width="160">Jumlah</th>
        <th width="120">User</th>
		<th width="10">Hapus</th></tr>
    <?php
    $i=1;
    
    foreach ($transaksi as $r)
    {
        $smt=$r->jenis_bayar_id==3?$r->semester:'';
        echo "<tr>
            <td>$i</td>
            <td>".  strtoupper($r->keterangan)." $smt</td>
			<td>".($r->no_ttp)."</td>
			<td>".($r->tipe)."</td>
            <td>".tgl_indo($r->tanggal)."</td>
            <td>Rp. ".rp((int)$r->jumlah)."</td>
            <td>".  strtoupper($r->nama)."</td>
            <td align='center'>".anchor('keuangan/delete/'.$r->pembayara_detail_id,'<i class="fa fa-trash-o"></i>',array('title'=>'Hapus Catatan'))."</td></tr>";
        $i++;
    }
    ?> 
</table> -->

<div id="div_tbl_konfirmasi" class="row">
    
</div>

<!-- Edit DATA FILE Modal -->
<div id="modal-editData" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Input data file</h4>
          </div>
          <div class="modal-body">
              <div id="" style="padding: 5px 20px;">

            <form id="form-editdatafile" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left" novalidate>
            
                <div id="input_hidden_datakonfirmasi" type="text"></div>
                <div id="id_peserta_daftar" type="text"></div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Nama :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nama" name="nama" class="form-control col-md-7 col-xs-12" readonly>
                    <span id="nama" name="nama"></span>
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Jenis Pembayaran :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="jenis_pembayaran" name="jenis_pembayaran" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="file-name">Pengecekkan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="update_keterangan" name="update_keterangan">
                            <option value="">Pilih Status Pengecekkan ...</option>
                            <option value="Pengecekkan berhasil">Approve</option>
                            <option value="Pengecekkan gagal">Decline</option>
                        </select>
                  </div>
                </div>

                <div id="sts_pembayaran" class="form-group">
                  <label class="control-label col-md-3 col-sm-4 col-xs-12" for="file-name">Status Pembayaran :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="status_pembayaran" name="status_pembayaran">
                            <option value="Belum Lunas">Belum Lunas</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            
            </form>

            </div>
          </div>
          
    </div>
  </div>
</div>

<?php
}
else
{
?>

<?php } ?>

<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/select2.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        loadkonfirmasi();
        $('#tbltransaksi_show').DataTable({
            "paging":   false,
            "ordering": false,
            "info":     false
	    });
        
        $(".group2").colorbox({rel:'group2', transition:"fade"});
        var options = {
            url: "<?=base_url()?>Keuangan/Search",
            getValue: function(element) {
                return element.nama;
            },
            template: {
                type: "description",
                fields: {
                    description: "kd_angkatan"
                }
            },
            list: {	
                onSelectItemEvent: function() {
                    var valueid = $("#namapeserta").getSelectedItemData().id_peserta_daftar;
                    var valuepelatihan = $("#namapeserta").getSelectedItemData().nama_pelatihan;
                    var valueangkatan = $("#namapeserta").getSelectedItemData().kd_angkatan;
                    var valuebiaya = $("#namapeserta").getSelectedItemData().investasi;
                    var valuejenisbayar = $("#namapeserta").getSelectedItemData().jenis_pembayaran;

                    var investasi = valuebiaya;
                    var cur_investasi = investasi.toString(),
                    sisa  = cur_investasi.length % 3,
                    rupiah  = cur_investasi.substr(0, sisa),
                    ribuan  = cur_investasi.substr(sisa).match(/\d{3}/gi);
                        
                    if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                    }

                    var biaya = 'Rp '+rupiah;

                    $("#id-peserta").val(valueid).trigger("change");
                    $("#id-pelatihan").val(valuepelatihan).trigger("change");
                    $("#id-angkatan").val(valueangkatan).trigger("change");
                    $("#id-biaya").val(biaya).trigger("change");
                    $("#id-jns_pembayaran").val(valuejenisbayar).trigger("change");

                    loadtransaksi(valueid);

                }, 
                match: {
                        enabled: true
                },   
                highlightPhrase: false,
                maxNumberOfElements: 10,
                
            },
            theme: "square"
        };
        $("#namapeserta").easyAutocomplete(options);
      
    }); 
  
    $('.itemName').select2({
        placeholder: 'Select for tag',
        ajax: {
          url: '<?=base_url()?>Keuangan/searchPeserta',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
    });

    function loadkonfirmasi(){
      var url="<?=base_url()?>Keuangan/loadKonfirmasi";
      $.ajax({
        type  : 'POST',
        url   : url,
        dataType: 'JSON',
        beforeSend: function (){
        },
        success:function(d){
     
        var no='1';
        var el='';
        el+='<div class="col-md-12 col-sm-12 col-xs-12">';
        el+='<p class="font-13 m-b-30" style="font-weight:bold;">Data Peserta Pelatihan yang Telah melakukan transaksi</p>';

        el+='<table id="datatable-fixed-header" class="table table-striped table-bordered">';

        el+="<thead>";
        el+="<tr>";

        el+="<th>#</th>";
        el+="<th>Nama</th>";
        el+="<th class='col-sm-4'>Nama Pelatihan</th>";
        el+="<th>Jenis Pembayaran</th>";
        el+="<th>Total Bayar</th>";
        el+="<th>Tanggal Transfer</th>";
        el+="<th>Keterangan</th>";
        el+="<th>Action</th>";

        el+="</tr>";
        el+="</thead>";
           el+="<tbody>";

           if(d.rows.length>0){

            $.each(d.rows,function(a,b){
            el+="<tr id='trdatafile-"+b.id_konfirmasi_bayar+"'>";
            el+="<td class='text-center'>"+no+"</td>";
            el+="<td>"+b.nama+"</td>";
            el+="<td>"+b.nama_pelatihan+"</td>";
            el+="<td>"+b.jenis_pembayaran+"</td>";
            el+="<td>"+b.total_bayar+"</td>";
            el+="<td>"+b.tgl_transfer+"</td>";
            el+="<td>"+b.keterangan+"</td>";

            if(b.keterangan == "Pengecekkan berhasil"){
            var action = '<div class="btn-group">'
                        // +'<a class="group2" href="<?php echo base_url();?>assets/images/sisfo_ppa_logo3.png" title="On the Ohoopee as a child"><i class="fa fa-pencil-square-o"></i></a>'
                        +'<a type="button" disabled onClick="return editData(\''+b.id_konfirmasi_bayar+'\');" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></a>'
                        +'</div>';
            } else {
                var action = '<div class="btn-group">'
                        // +'<a class="group2" href="<?php echo base_url();?>assets/images/sisfo_ppa_logo3.png" title="On the Ohoopee as a child"><i class="fa fa-pencil-square-o"></i></a>'
                        +'<a type="button" onClick="return editData(\''+b.id_konfirmasi_bayar+'\');" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></a>'
                        +'</div>';
            }

            el+="<td>"+action+"</td>";

            el+="</tr>";
            no++;
            });
            }

           el+="</tbody></table></div>";
           $("#div_tbl_konfirmasi").empty().html(el);
           $('#datatable-fixed-header').DataTable({
           
           });
        }
      })
    }

    function editData(id){
      var url   = "<?php echo site_url('Keuangan/modalEditData'); ?>";
      var param   = { 'id' : id };
      var modalid = '#modal-editData';
      $.ajax({
        url         : url,
        type        : 'POST',
        data        : param,
        dataType    : 'JSON',
        beforeSend  : function (){
          $(modalid).modal('show');
          /*$('#form-editmodul').hide();
          $(modalid+' #spinner_modal').empty().html('<div class="text-center"><i class="fa fa-spinner fa-2x fa-spin"></i></div>');*/
        },
        success : function(data) {

          var input_hidden_datakonfirmasi = '';
          var id_peserta_daftar = '';
          var nama = '';
          var nama_pelatihan = '';
          var jenis_pembayaran = '';
          var sts_pembayaran = '';
          
          if(data.id_konfirmasi_bayar.length>0){
            $.each(data.id_konfirmasi_bayar,function(a,b){
              input_hidden_datakonfirmasi+= '<input type="hidden" name="id_konfirmasi_bayar" id="id_konfirmasi_bayar" value="'+b.id_konfirmasi_bayar+'">';
              id_peserta_daftar+= '<input type="hidden" name="id_peserta_daftar" id="id_peserta_daftar" value="'+b.id_peserta_daftar+'">';
              nama = b.nama;
              sts_pembayaran = b.sts_pembayaran;
              nama_pelatihan = b.nama_pelatihan;
              jenis_pembayaran = b.sts_pembayaran;
              keterangan = b.keterangan;
            });
          }

          $(modalid+' #input_hidden_datakonfirmasi').empty().html(input_hidden_datakonfirmasi);
          if(sts_pembayaran == "cicilan1"){
            $(modalid+' #sts_pembayaran').hide();
          } else{
            $(modalid+' #sts_pembayaran').show();
          }
          $(modalid+' #id_peserta_daftar').empty().html(id_peserta_daftar);
          $(modalid+' #nama').val(nama);
          $(modalid+' #nama_pelatihan').val(nama_pelatihan);
          $(modalid+' #jenis_pembayaran').val(jenis_pembayaran);
          $('#form-editmodul').show();
        }   
      });
      }

      /* AJAX EDIT DATA */
      $("#form-editdatafile").on('submit',(function(e) {
        validasi = $("#form-editdatafile").valid();
        if(validasi) {
            e.preventDefault();
            
            var data = new FormData(this);
            $.ajax({
                url   : "<?php echo base_url(); ?>Keuangan/do_edit",
                type  : "POST",
                data  : data,
                dataType: "JSON",
                contentType: false,
                cache : false,
                processData:false,
                beforeSend : function (){
                },
                success: function(data){
                  $('#modal-editData').modal('hide');
                  if (data.status=='success'){
                    //alert('Data Telah di Update');
                    loadkonfirmasi();
                  }
                  document.getElementById("form-editdatafile").reset();
                  loadkonfirmasi();
                }
                              
            });
        }
        }));

        
    function loadtransaksi(valueid){
      var param   = { 'valueid' : valueid };
      var url="<?=base_url()?>Keuangan/loadTransaksi";
      $.ajax({
        type  : 'POST',
        url   : url,
        data : param,
        dataType: 'JSON',
        beforeSend: function (){

        },
        success:function(d){
        $('#tbltransaksi').hide();
        var no='1';
        var el='';
        el+='<div class="col-md-12 col-sm-12 col-xs-12">';
        el+='<span><b>Riwayat Transaksi</b></span>';
        el+='<table id="datatable-transaksi" class="table table-striped table-bordered">';

        el+="<thead>";

        el+="<tr>";

        el+="<th>#</th>";
        el+="<th>Pembayaran 1</th>";
        el+="<th>Pembayaran 2</th>";
        el+="<th>Pembayaran 3</th>";
        el+="<th>Sisa Bayar</th>";
        el+="<th>Status Pembayaran</th>";

        el+="</tr>";
        el+="</thead>";
           el+="<tbody>";
                
           if(d.rows.length>0){
                $.each(d.rows,function(a,b){

                var sisa_bayar = b.investasi - b.pembayaran1 - b.pembayaran2 - b.pembayaran3;
                el+="<tr id='trdatafile-"+b.id_konfirmasi_bayar+"'>";
                el+="<td class='text-center'>"+no+"</td>";
                el+="<td>"+b.pembayaran1+"</td>";
                el+="<td>"+b.pembayaran2+"</td>";
                el+="<td>"+b.pembayaran3+"</td>";
                el+="<td>"+sisa_bayar+"</td>";
                el+="<td>"+b.status_pembayaran+"</td>";

                el+="</tr>";
                no++;
                });
            } 
           el+="</tbody></table><br><br></div>";
           $("#div_tbl_transaksi").empty().html(el);
           $('#datatable-transaksi').DataTable({
            "paging":   false,
            "ordering": false,
            "info":     false
           });
        }
      })
    }
</script>
