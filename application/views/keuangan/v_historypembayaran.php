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


<div id="div_tbl_konfirmasi" class="row">
    
</div>




<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        loadkonfirmasi();
    }); 
    function loadkonfirmasi(){
      var url="<?=base_url()?>Keuangan/loadhistoryPembayaran";
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

          el+="<th class='text-center'>NO.</th>";
          el+="<th>Order ID</th>";
          el+="<th>Nama</th>";
          el+="<th>Tagihan</th>";
          el+="<th>Tipe Pembayaran</th>";
          el+="<th>Bank</th>";
          
          el+="<th>VA Number</th>"
          el+="<th>Waktu </th>";
          el+="<th>Status</th>";
          
          if(d.rows.length>0){
            $.each(d.rows,function(a,b){


            var investasi = b.gross_amount;
            var cur_investasi = investasi.toString(),
              sisa  = cur_investasi.length % 3,
              rupiah  = cur_investasi.substr(0, sisa),
              ribuan  = cur_investasi.substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
              separator = sisa ? '.' : '';
              rupiah += separator + ribuan.join('.');
            }

            el+='<tr>';
            
            el+="<td class='text-center'>"+no+"</td>";
            el+="<td>"+b.order_id+"</td>";
            el+="<td>"+b.nama+"</td>";
            el+="<td>"+rupiah+"</td>";
            el+="<td>"+b.payment_type+"</td>";
            el+="<td>"+b.bank+"</td>";
            el+="<td>"+b.va_number+"</td>";
            el+="<td>"+b.transaction_time+"</td>";
            
            if(b.transaction_status == "pending"){
              var statusCode = "<span class='label label-warning'>"+b.transaction_status+"</span>";
        
            } else if(b.transaction_status == "settlement"||b.transaction_status == "capture"){
              var statusCode = "<span class='label label-success'>"+b.transaction_status+"</span>";
            }
            else {
              var statusCode = "<span class='label label-danger'>"+b.transaction_status+"</span>";
            }
            el+="<td>"+statusCode+"</td>";


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

</script>