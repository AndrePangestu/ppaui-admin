<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
<?php
echo form_open_multipart($this->uri->segment(1).'/post');
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Entry Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
    <tr>
        <td width="150">Nama Pelatihan</td>
        <td>
        <div class="col-sm-7">
        <select class="form-control" id="nama_pelatihan" name="kd_pelatihan" required="required">
            <option value="">-- Pilih nama pelatihan --</option>
        </select>
        <input type='hidden' id='nama_pelatihan1' name='nama_pelatihan1' class="form-control">
        </div>
        
        </td>
    </tr>
    <tr>
        <td width="200">Angkatan Pelatihan</td>
        <td>
            <div class='col-sm-4'>
                <input type='text' id='kd_angkatan' name='kd_angkatan' class="form-control">
            </div>            
        </td>
    </tr>
    <tr>
        <td width="150">Lokasi</td>
        <td>
            <!-- <?php echo buatcombo('gedung','app_gedung','col-sm-7','nama_gedung','gedung_id','',''); ?> -->
            <div class="col-sm-7">
            <select class="form-control" id="lokasi" name="lokasi" required="required">
                <option value="">-- Pilih Lokasi --</option>
                <option value="DEPOK">DEPOK</option>
                <option value="SALEMBA">SALEMBA</option>
            </select>
            </div>
            

        </td>
    </tr>
   
    <tr>
        <td width="200">Hari</td>
        <td>
            <?php echo inputan('text', 'hari','col-sm-6','...', 0, '','');?>
        </td>
    </tr>
    <tr>
        <td width="150">Jam Mulai</td>
        <td>
            <?php echo inputan('text', 'jam_mulai','col-sm-4','Jam mulai', 0, '',array('id'=>'timepicker'));?>
        </td>
    </tr>
    <tr>
        <td width="150">Jam Selesai</td>
        <td>
            <?php echo inputan('text', 'jam_selesai','col-sm-4','Jam selesai', 0, '',array('id'=>'timepicker1'));?>
        </td>
    </tr>
    <tr>
        <td width="150">Tanggal Mulai</td>
        <td>
            <?php echo inputan('text', 'tgl_mulai','col-sm-4','Tanggal Mulai', 0, '',array('id'=>'datepicker'));?>
        </td>
    </tr>
    <tr>
        <td width="150">Tanggal Selesai</td>
        <td>
            <?php echo inputan('text', 'tgl_selesai','col-sm-4','Tanggal Selesai', 0, '',array('id'=>'datepicker1'));?>
        </td>
    </tr>
    <tr>
        <td width="150">Investasi</td>
        <td>
            <?php echo inputan('number', 'investasi','col-sm-4','', 0, '','');?>
        </td>
    </tr>

    <tr>
        <td width="150">Periode</td>
        <td>
            <?php echo inputan('number', 'periode','col-sm-4','', 0, '','');?>
        </td>
    </tr>
    <tr>
        <td width="150">Tahun</td>
        <td>
            <?php echo inputan('number', 'tahun','col-sm-4','', 0, '','');?>
        </td>
    </tr>
    <tr>
    <tr>
        <td width="150">Jumlah Pertemuan</td>
        <td>
            <?php echo inputan('number', 'jml_pertemuan','col-sm-2','', 0, '','');?>
        </td>
    </tr>
    <tr>
        <td width="150">Tipe Pelatihan</td>
        <td>
            <div class="col-md-4 col-sm-4 col-xs-12">
            <select class="form-control" id="tipe_pelatihan" name="tipe_pelatihan">
                <option value="">Pilih Tipe Pelatihan ...</option>
                <option value="SERTIFIKASI">Sertifikasi</option>
                <option value="REGULER">Reguler</option>
            </select>
            </div>
        </td>
    </tr>
    <tr>
        <td width="150">Status Pelatihan</td>
        <td>
            <div class="col-md-4 col-sm-4 col-xs-12">
            <select class="form-control" id="sts_pelatihan" name="sts_pelatihan">
                <option value="Belum mulai">Belum Mulai</option>
                <option value="Sedang mulai">Sedang Mulai</option>
                <option value="Sudah selesai">Sudah Selesai</option>
            </select>
            </div>
        </td>
    </tr>
    <tr>
        <td width="150">Status Aktif</td>
        <td>
            <div class="col-md-4 col-sm-4 col-xs-12">
            <select class="form-control" id="sts_aktif" name="sts_aktif">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
            </div>
        </td>
    </tr>
    <tr>
        <td width="150">Status Aktif Pendaftaran</td>
        <td>
            <div class="col-md-4 col-sm-4 col-xs-12">
            <select class="form-control" id="sts_aktif_daftar" name="sts_aktif_daftar">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
            </div>
        </td>
    </tr>
    <!-- <tr>
        <td width="150">Discount %</td>
        <td>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type='text' id='discount' name='discount' class="form-control">
            </div>
        </td>
    </tr> -->
    <tr>
         <td></td>
         <td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td>
    </tr>
    
    
</table>
  </div></div>
</form> 
<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    loadnamapel();
});


function loadnamapel(){
    var url='<?php echo base_url();?>Prodi/loadnamapelatihan';
    $.ajax({
            type  : 'POST',
            url   : url,
            dataType: 'JSON',
            beforeSend: function (){
            },
            success: function(data) {
                $.each(data, function(i, data) {
                    $('#nama_pelatihan').append("<option value='" + data.kd_pelatihan + "'>" + data.nama_pelatihan + "</option>");
                });
            }
    });
}

$('#nama_pelatihan').on('change', function() {
	var pelatihanID = $(this).val();
	var dataparam = {kdpelatihan: $("#nama_pelatihan").val()};

    var url='<?php echo base_url();?>Prodi/getNamaPelatihan';
    $.ajax({
        url: url,
        type: "POST",
        data  : dataparam,
        dataType: "JSON",
        success:function(data) {

        console.log(data);
        $('#kd_angkatan').val(data.kd_angkatan);
        $('#nama_pelatihan1').val(data.nama_pelatihan);        

        }
    });	
});


</script>