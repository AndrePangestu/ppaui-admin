<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
 
 <?php
echo anchor($this->uri->segment(1).'/post',"<i class='fa fa-pencil-square-o'></i> Tambah Data",array('class'=>'btn btn-danger   btn-sm','title'=>'Tambah Data'))
?>
      
<table id="example-datatables" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="10"></th>
            <th width="5">No.</th>
            <th width="10">Nama Pelatihan</th>

            <th width="5">Hari</th>
            <th width="10">Lokasi</th>
       
            <th width="50">Tgl Mulai</th> 
            <th width="50">Tgl Selesai</th>  
            <th width="50">Periode</th> 
            <th width="50">Status Aktif</th>  
            <th width="50">Action</th>        
        </tr>
    </thead>
    <tbody>
        
        <?php
        $i=1;
        foreach ($record as $r)
        {
        ?>
        
        <tr>
            <td class="text-center">
                <div class="btn-group">
                    <a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->id_m_pelatihan;?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo base_url().''.$this->uri->segment(1).'/delete/'.$r->id_m_pelatihan;?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
            </td>

            <td width="5" style="text-align:center;"><?php echo $i;?></td>
            <td><?php echo strtoupper($r->nama_pelatihan);?></td>
            <td width="5"><?php echo $r->hari;?></td>
            
            <td><?php echo $r->lokasi;?></td>

            <td><?php if(!empty($r->tgl_mulai)){
                echo date('j-M-Y',strtotime($r->tgl_mulai));
            } echo '';?></td>
            <td><?php if(!empty($r->tgl_selesai)){
                echo date('j-M-Y',strtotime($r->tgl_selesai));
            } echo '';?></td>
            <td><?php echo $r->periode.'-'.$r->tahun;?></td>
            <td><?php if($r->status == 1){
                echo 'Aktif';
            }else{
                echo 'Tidak aktif';
            }?></td>
            <td><a type="button" onClick="return detailData(<?php echo $r->id_m_pelatihan;?>);" data-toggle="tooltip" title="Detail" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></a></td>
        </tr>
        <?php $i++;}?>
        
    </tbody>
</table>
<!-- END Datatables -->

<!-- Edit DATA FILE Modal -->
<div id="modal-detailData" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Input data file</h4>
          </div>
          <div class="modal-body">
              <div id="" style="padding: 5px 20px;">

            <form id="form-detaildata" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left" novalidate>
            
                <div id="input_hidden_datareport" type="text"></div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Nama Pelatihan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nama_pelatihan" name="nama_pelatihan" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Kode Pelatihan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="kd_pelatihan" name="kd_pelatihan" class="form-control col-md-7 col-xs-12" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Waktu Pelatihan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="waktu" name="waktu" class="form-control col-md-7 col-xs-12" readonly>
                  </div>    
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Jumlah Pertemuan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="jml_pertemuan" name="jml_pertemuan" class="form-control col-md-7 col-xs-12" readonly>
                  </div>    
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Investasi :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="investasi" name="investasi" class="form-control col-md-7 col-xs-12" readonly>
                  </div>    
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Tipe Pelatihan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="tipe_pelatihan" name="tipe_pelatihan" class="form-control col-md-7 col-xs-12" readonly>
                  </div>    
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Status Pelatihan :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="sts_pelatihan" name="sts_pelatihan" class="form-control col-md-7 col-xs-12" readonly>
                  </div>    
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Status Aktif Daftar :
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="sts_aktif_daftar" name="sts_aktif_daftar" class="form-control col-md-7 col-xs-12" readonly>
                  </div>    
                </div>
                            
            </form>
            </div>
          </div>
          
    </div>
  </div>
</div>

<script src="<?php echo base_url()?>uadmin/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   
});

function detailData(id_m_pelatihan){
      var url   = "<?php echo site_url('Prodi/modalDetailData'); ?>";
      var param   = { 'id_m_pelatihan' : id_m_pelatihan };
      var modalid = '#modal-detailData';
      $.ajax({
        url         : url,
        type        : 'POST',
        data        : param,
        dataType    : 'JSON',
        beforeSend  : function (){
          $(modalid).modal('show');
        //   $('#form-editmodul').hide();
        //   $(modalid+' #spinner_modal').empty().html('<div class="text-center"><i class="fa fa-spinner fa-2x fa-spin"></i></div>');
        },
        success : function(data) {

          console.log(data);
        
          var input_hidden_datareport = '';
          var kd_pelatihan = '';
          var jam_mulai = '';
          var jam_selesai = '';
          var jml_pertemuan = '';
          var investasi = '';
          var tipe_pelatihan = '';
          var sts_pelatihan = '';
          var sts_aktif_daftar = '';
          
          if(data.id_m_pelatihan.length>0){
            $.each(data.id_m_pelatihan,function(a,b){
                nama_pelatihan = b.nama_pelatihan;
                kd_pelatihan = b.kd_pelatihan;
                jam_mulai = b.jam_mulai;
                jam_selesai = b.jam_selesai;
                jml_pertemuan = b.jml_pertemuan;
                investasi = b.investasi;
                tipe_pelatihan = b.tipe_pelatihan;
                sts_pelatihan = b.sts_pelatihan;
                sts_aktif_daftar = b.sts_aktif_daftar;
            });
          }
 
          var jam_mulai = jam_mulai.slice(0, 5);
          var jam_selesai = jam_selesai.slice(0, 5);

          if(sts_aktif_daftar == 1){
            sts_aktif_daftar = 'aktif';
          }else{
            sts_aktif_daftar = 'tidak aktif';
          }

          $(modalid+' #input_hidden_datareport').empty().html(input_hidden_datareport);
          $(modalid+' #nama_pelatihan').val(nama_pelatihan);
          $(modalid+' #kd_pelatihan').val(kd_pelatihan);
          $(modalid+' #waktu').val(jam_mulai+' - '+jam_selesai);
          $(modalid+' #jml_pertemuan').val(jml_pertemuan+' x');
          $(modalid+' #investasi').val('Rp. '+investasi);
          $(modalid+' #tipe_pelatihan').val(tipe_pelatihan);
          $(modalid+' #sts_pelatihan').val(sts_pelatihan);
          $(modalid+' #sts_aktif_daftar').val(sts_aktif_daftar);
          $('#form-detaildata').show();
        }   
      });
      }
</script>
