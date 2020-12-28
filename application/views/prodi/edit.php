<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
     <?php
echo form_open($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[id_m_pelatihan]'>";
?>
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
   
    <tr>
    <td width="150">Nama Pelatihan</td><td>
        <?php echo inputan('text', 'nama_pelatihan','col-sm-6','...', 1, $r['nama_pelatihan'],'');?>
    </td>
    </tr>
    <tr>
    <td width="200">Singkatan Pelatihan</td><td>
        <?php echo inputan('text', 'kd_pelatihan','col-sm-2','...', 0, $r['kd_pelatihan'],'');?>
    </td>
    </tr>

    <tr>
        <td width="150">Lokasi</td>
        <td>
        <div class="col-md-4 col-sm-4 col-xs-12">
        <select class="form-control" id="lokasi" name="lokasi">
            <option value="SALEMBA" <?php if($r['lokasi'] == 'SALEMBA'){ echo 'selected="selected"';} ?>>SALEMBA</option>
            <option value="DEPOK" <?php if($r['lokasi'] == 'DEPOK'){ echo 'selected="selected"';} ?>>DEPOK</option>
        </select>
        </div>
        </td>
    </tr>
    <!-- <tr>
        <td width="200">Hari</td>
        <td>
            <div class="col-md-4 col-sm-4 col-xs-12">
            <select class="form-control" id="hari" name="hari">
                <option value="">Pilih Hari ...</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>
            </div>
        </td>
    </tr> -->
    <tr>
    <td width="200">Hari</td><td>
        <?php echo inputan('text', 'hari','col-sm-6','...', 0, $r['hari'],'');?>
    </td>
    </tr>
    <tr>
        <td width="150">Jam Mulai</td>
        <td>
            <?php echo inputan('text', 'jam_mulai','col-sm-4','Jam mulai', 0,substr($r['jam_mulai'],0,5),array('id'=>'timepicker'));?>
        </td>
    </tr>
    <tr>
        <td width="150">Jam Selesai</td>
        <td>
            <?php echo inputan('text', 'jam_selesai','col-sm-4','Jam selesai', 0,substr($r['jam_selesai'],0,5),array('id'=>'timepicker1'));?>
        </td>
    </tr>
    <tr>
        <td width="150">Tanggal Mulai</td>
        <td>
            <?php echo inputan('text', 'tgl_mulai','col-sm-4','Tanggal Mulai', 0, date('d-m-Y', strtotime($r['tgl_mulai'])),array('id'=>'datepicker2'));?>
        </td>
    </tr>
    <tr>
        <td width="150">Tanggal Selesai</td>
        <td>
            <?php echo inputan('text', 'tgl_selesai','col-sm-4','Tanggal Selesai', 0,date('d-m-Y', strtotime($r['tgl_selesai'])),array('id'=>'datepicker3'));?>
        </td>
    </tr>
    <tr>
        <td width="150">Investasi</td>
        <td>
            <?php echo inputan('number', 'investasi','col-sm-4','', 0,$r['investasi'],'');?>
        </td>
    </tr>

    <tr>
        <td width="150">Periode</td>
        <td>
            <?php echo inputan('number', 'periode','col-sm-4','', 0, $r['periode'],'');?>
        </td>
    </tr>
    <tr>
        <td width="150">Tahun</td>
        <td>
            <?php echo inputan('number', 'tahun','col-sm-4','', 0,$r['tahun'],'');?>
        </td>
    </tr>
    <tr>
    <tr>
        <td width="150">Jumlah Pertemuan</td>
        <td>
            <?php echo inputan('number', 'jml_pertemuan','col-sm-2','', 0,$r['jml_pertemuan'],'');?>
        </td>
    </tr>
    <tr>
        <td width="150">Tipe Pelatihan</td>
        <td>
            <div class="col-md-4 col-sm-4 col-xs-12">
            <select class="form-control" id="tipe_pelatihan" name="tipe_pelatihan">
                <option value="SERTIFIKASI" <?php if($r['tipe_pelatihan'] == 'SERTIFIKASI'){ echo 'selected="selected"';} ?>>Sertifikasi</option>
                <option value="REGULER" <?php if($r['tipe_pelatihan'] == 'REGULER'){ echo 'selected="selected"';} ?>>Reguler</option>
            </select>
            </div>
        </td>
    </tr>
    <tr>
        <td width="150">Status Pelatihan</td>
        <td>
            <div class="col-md-4 col-sm-4 col-xs-12">
            <select class="form-control" id="sts_pelatihan" name="sts_pelatihan">
                <option value="Belum mulai" <?php if($r['sts_pelatihan'] == 'Belum mulai'){ echo 'selected="selected"';} ?>>Belum mulai</option>
                <option value="Sedang mulai" <?php if($r['sts_pelatihan'] == 'Sedang mulai'){ echo 'selected="selected"';} ?>>Sedang mulai</option>
                <option value="Sudah selesai" <?php if($r['sts_pelatihan'] == 'Sudah selesai'){ echo 'selected="selected"';} ?>>Sudah selesai</option>
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
                <option value="1" <?php if($r['sts_aktif_daftar'] == '1'){ echo 'selected="selected"';} ?>>Aktif</option>
                <option value="0" <?php if($r['sts_aktif_daftar'] == '0'){ echo 'selected="selected"';} ?>>TIdak Aktif</option>
            </select>
            </div>
        </td>
    </tr>
    <tr>
        <td width="150">Discount %</td>
        <td>
            <?php echo inputan('text', 'discount','col-sm-6','...', 0, $r['discount'],'');?>
        </td>
    </tr>

    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div></div>
</form>