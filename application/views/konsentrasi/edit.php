<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
     <?php
echo form_open_multipart($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[konsentrasi_id]'>";
//$jenjang    =array('d1'=>'D1','d2'=>'D2','d3'=>'D3','d4'=>'D4','s1'=>'S1');
//$semester   =array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8);
$class      ="class='form-control'";
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
    <tr>
    <td width="150">Nama Pelatihan</td><td>
        <?php echo editcombo('prodi', 'akademik_prodi', 'col-sm-6', 'nama_prodi', 'prodi_id', '', '',$r['prodi_id']);?>
    </td>
    </tr>
    <tr>
    <td width="150">Angkatan Pelatihan</td><td>
        <?php echo inputan('text', 'nama','col-sm-2','...', 1, $r['nama_konsentrasi'],'');?>
    </td>
    </tr>
	<tr>
    <td width="150">Lokasi</td><td>
        <?php echo editcombo('gedung', 'app_gedung', 'col-sm-6', 'nama_gedung', 'gedung_id', '', '',$r['gedung_id']);?>
    </td>
    </tr>
    <tr>
    <td width="150">Waktu</td><td>
        <?php echo editcombo('waktu', 'app_waktu', 'col-sm-6', 'nama_waktu', 'waktu_id', '', '',$r['waktu_id']);?>
    </td>
    </tr>
    <tr>
    <td width="150">Tanggal Mulai</td><td>
		<?php echo inputan('text', 'tglmulai','col-sm-3','Tanggal Mulai ..', 0, $r['tglmulai'],array('id'=>'datepicker'));?>
    </td>
    </tr>
    <tr>
    <td width="150">Tanggal Akhir</td><td>
        <?php echo inputan('text', 'tglakhir','col-sm-3','Tanggal Akhir ..', 0, $r['tglakhir'],array('id'=>'datepicker1'));?>
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