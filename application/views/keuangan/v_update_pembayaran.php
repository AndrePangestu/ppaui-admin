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

<div id="div_tbl_transaksi"></div>

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
                	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="file-name">Bukti Transfer :
                  	</label>
                  	<div id="bukti_transfer" class="col-md-6 col-sm-6 col-xs-12">
											<!-- <img id="ktp" src="http://www.ppa-febui.com/peserta/assets/images/ppa/ppa_logo.png" class="img-responsive"> -->
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


<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        loadkonfirmasi();
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
              dom: 'Bfrtip',
              buttons: [
                'excel'
              ]
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
          var bukti_transfer= '';
          var url = window.location.pathname.split('/');
					var base_url = window.location.protocol + "//" + window.location.host + '/' + url[1];
          
          if(data.id_konfirmasi_bayar.length>0){
            $.each(data.id_konfirmasi_bayar,function(a,b){
              input_hidden_datakonfirmasi+= '<input type="hidden" name="id_konfirmasi_bayar" id="id_konfirmasi_bayar" value="'+b.id_konfirmasi_bayar+'">';
              id_peserta_daftar+= '<input type="hidden" name="id_peserta_daftar" id="id_peserta_daftar" value="'+b.id_peserta_daftar+'">';
              nama = b.nama;
              sts_pembayaran = b.sts_pembayaran;
              nama_pelatihan = b.nama_pelatihan;
              jenis_pembayaran = b.sts_pembayaran;
              keterangan = b.keterangan;
              bukti_transfer = b.bukti_bayar;
            });
          }

          $(modalid+' #input_hidden_datakonfirmasi').empty().html(input_hidden_datakonfirmasi);
          if(sts_pembayaran == "cicilan1"){
            $(modalid+' #sts_pembayaran').hide();
          } else{
            $(modalid+' #sts_pembayaran').show();
          }
          $('#bukti_transfer').html('<img src="'+base_url+'/uploads/bukti_bayar/'+bukti_transfer+'" class="img-responsive">');
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
                contentType: false,
                cache : false,
                processData:false,
                beforeSend : function (){
                },
                success: function(data){
                  $('#modal-editData').modal('hide');
                  if (data=='success'){
                    alert('Data Telah di Update');
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