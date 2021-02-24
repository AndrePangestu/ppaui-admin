<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>

<link rel="stylesheet" href="<?php echo base_url()?>assets/css/easy-autocomplete.min.css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/easy-autocomplete.themes.min.css"/>

<div id="tbl_validasi" class="row">
    
</div>

<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        loadvalidasi();
    }); 
    function loadvalidasi(){
      var url="<?=base_url()?>Peserta/loadvalidasi";
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

        el+='<table id="datatable-validasi" class="table table-striped table-bordered">';

        el+="<thead>";
        el+="<tr>";

        el+="<th>#</th>";
        el+="<th>Nama</th>";
        el+="<th class='col-sm-4'>Nama Pelatihan</th>";
        el+="<th>Jenis Pembayaran</th>";
        // el+="<th>Total Bayar</th>";
        // el+="<th>Tanggal Transfer</th>";
        el+="<th>Keterangan</th>";
        el+="<th>Action</th>";

        el+="</tr>";
        el+="</thead>";
           el+="<tbody>";

           if(d.rows.length>0){

            $.each(d.rows,function(a,b){
            el+="<tr id='trdatafile-"+b.id_peserta_daftar+"'>";
            el+="<td class='text-center'>"+no+"</td>";
            el+="<td>"+b.nama+"</td>";
            el+="<td>"+b.nama_pelatihan+"</td>";
            el+="<td>"+b.jenis_pembayaran+"</td>";
            // el+="<td>"+b.total_bayar+"</td>";
            // el+="<td>"+b.tgl_transfer+"</td>";
            // el+="<td>"+b.keterangan+"</td>";
            if(b.status_validasi == 1){
              el+="<td>Pengecekan Berhasil</td>";
            }
            else{
              el+="<td>Belum Dikonfirmasi</td>";
            }

            // if(b.keterangan == "Pengecekkan berhasil"){
            // var action = '<div class="btn-group">'
            //             // +'<a class="group2" href="<?php echo base_url();?>assets/images/sisfo_ppa_logo3.png" title="On the Ohoopee as a child"><i class="fa fa-pencil-square-o"></i></a>'
            //             +'<a type="button" disabled onClick="return editData(\''+b.id_konfirmasi_bayar+'\');" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></a>'
            //             +'</div>';
            // } else {
            //     var action = '<div class="btn-group">'
            //             // +'<a class="group2" href="<?php echo base_url();?>assets/images/sisfo_ppa_logo3.png" title="On the Ohoopee as a child"><i class="fa fa-pencil-square-o"></i></a>'
            //             +'<a type="button" onClick="return editData(\''+b.id_konfirmasi_bayar+'\');" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></a>'
            //             +'</div>';
            // }

            if(b.status_validasi == 1){
                var action = '<a type="button" disabled class="btn btn-sm btn-danger">Validasi</a>';
            }
            else{
                var action = '<a type="button" class="btn btn-sm btn-danger" onClick="toLengkapDaftar(\''+b.id_peserta_daftar+'\')">Validasi</a>';
            }

            el+="<td>"+action+"</td>";
            el+="</tr>";
            no++;
            });
            }

           el+="</tbody></table></div>";
           $("#tbl_validasi").empty().html(el);
           $('#datatable-validasi').DataTable({
              dom: 'Bfrtip',
              buttons: [
                'excel'
              ]
           });
        }
      })
    }

    function toLengkapDaftar(id){
      var param = { 'id' : id };
      window.location.href = "<?=base_url()?>Peserta/updatevalidasi/"+id;
    // window.location.href = "<?=base_url()?>Peserta/updatevalidasi";

    }

    
</script>