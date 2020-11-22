<?php
if (!$this->ion_auth->logged_in())
{
    redirect('auth/login');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPRO FEB UI</title>
        <link rel="stylesheet" href="<?php echo base_url()?>uadmin/css/bootstrap.css">
        
        <link rel="stylesheet" href="<?php echo base_url()?>uadmin/css/plugins.css">
        <link rel="stylesheet" href="<?php echo base_url()?>uadmin/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url()?>uadmin/css/themes.css">
        <!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-timepicker.css"> -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.timepicker.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/colorbox.css" />

        
        <!-- Datatables -->
    <link href="<?php echo base_url();?>assets/dataTables/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dataTables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dataTables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dataTables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dataTables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

        <script src="<?php echo base_url()?>uadmin/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
  </head>
  <body>
      <!-- Navbars -->
                
    <!-- Inverse Navbar - You can replace 'navbar-inverse' with 'navbar-default' for a light navbar -->
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="javascript:void(0)"> <i class="fa fa-barcode"></i> Link</a></li>
                <?php
                
                $mainmenu=$this->db->get_where('mainmenu',array('aktif'=>'y','group_id'=>$this->ion_auth->get_users_groups()->row()->id))->result();
                //$mainmenu=$this->db->get_where('mainmenu',array('aktif'=>'y','level'=>$this->session->userdata('level')))->result();
                foreach ($mainmenu as $m)
                {
                    // chek sub menu
                    $submenu=$this->db->get_where('submenu',array('id_mainmenu'=>$m->id_mainmenu,'aktif'=>'y'));
                    if($submenu->num_rows()>0)
                    {
                        //looping
                        echo "<li class='dropdown'>
                    <a href='javascript:void(0)' class='dropdown-toggle' data-toggle='dropdown'> <i class='".$m->icon."'></i> ".  strtoupper($m->nama_mainmenu)." <b class='caret'></b></a>
                    <ul class='dropdown-menu'>";
                        foreach ($submenu->result() as $s)
                        {
                            echo "<li>".  anchor($s->link,  '<i class="'.$s->icon.'"></i> '.strtoupper($s->nama_submenu))."</li>";
                        }
                    echo"</ul>
                    </li>";
                        // end looping
                    }
                    else
                    {
                        echo "<li>".  anchor($m->link,  '<i class="'.$m->icon.'"></i> '.strtoupper($m->nama_mainmenu))."</li>";
                    }
                }
                ?>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="javascript:;" id="notification-icon" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="fa fa-bell alertNotificacao" ></span>
                    <span class='badge badge-danger' id="notification-count"></span>
                    <span class="caret"></span></a>

                    <ul id="notif-detail" class="list-notificacao dropdown-menu" style="min-width:280px; max-height:340px; overflow:auto;">
                    
                    <!-- <li id='item_notification_1'>
                        <div class="media">
                            <div class="media-left"> 
                                <a href="#"> 
                                <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWZhMWJmZmI3MCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZmExYmZmYjcwIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40Njg3NSIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true" style="float:left;"> </a> 
                            </div>
                            <div class="media-body" style="padding-left:10px;">
                                <div class='exclusaoNotificacao' style="float:right;"><button class='btn btn-danger btn-xs button_exclusao' id='1' onclick='excluirItemNotificacao(this)'>x</button>
                                </div>
                                <h4 class="media-heading">ITEM 1</h4>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                            </div>
                        </div>
                    </li>    
                    <li id='item_notification_2'>
                        <div class="media">
                            <div class="media-left"> 
                                <a href="#"> 
                                <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWZhMWJmZmI3MCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZmExYmZmYjcwIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40Njg3NSIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true" style="float:left;"> </a> 
                            </div>
                            <div class="media-body" style="padding-left:10px;">
                                <div class='exclusaoNotificacao' style="float:right;"><button class='btn btn-danger btn-xs' id='2' onclick='excluirItemNotificacao(this)'>x</button>
                                </div>
                                <h4 class="media-heading">ITEM 2</h4>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                            </div>
                        </div>
                    </li> -->

                    </ul>
                </li>                
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo strtoupper($this->session->userdata('username'));?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><?php echo anchor('users/profile',"<i class='fa fa-cogs'></i> Account");?></li>
                        <li><?php echo anchor('auth/logout',"<i class='fa fa-sign-out'></i> Logout");?></li>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END Inverse Navbar -->
    <!-- END Navbars -->

     <div class="container" style="background: white;">
      <!-- Example row of columns -->
      <div class="row">

        <div class="col-md-12">
            
            <?php echo $contents; ?>     
        </div>
      <hr>

      
    </div> 
      <div class="clear:both"></div>
      <hr>
      <p align='center' style="font-weight: bold;" >&copy; SISFO | PPA FEB UI 2016</p>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script> 
    <!-- <script src="<?php echo base_url()?>uadmin/js/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script> -->
    <script>!window.jQuery && document.write(unescape('%3Cscript src="js/vendor/jquery-1.11.0.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js -->
        <script src="<?php echo base_url()?>uadmin/js/vendor/bootstrap.min.js"></script>



        <!-- Jquery plugins and custom javascript code -->
        <script src="<?php echo base_url()?>uadmin/js/plugins.js"></script>
        <script src="<?php echo base_url()?>uadmin/js/main.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
        <!-- <script src="<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js"></script>  -->
        <script src="<?php echo base_url();?>assets/js/jquery.timepicker.min.js"></script> 
                
	<script src="<?php echo base_url();?>assets/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>assets/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>assets/ui/jquery.ui.datepicker.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/themes/base/jquery.ui.all.css">

    <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.easy-autocomplete.min.js"></script>

  <script src="<?php echo base_url();?>assets/dataTables/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="<?php echo base_url();?>assets/dataTables/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/custom.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.colorbox.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
        load_unseen_notification();
    });

    $(document).on('click', '#notification-icon', function(){
        //alert('aa');
        // $('.count').html('');
        load_unseen_notification('yes');
    });

    function load_unseen_notification(view = ''){
    $.ajax({
        url:"<?=base_url()?>Auth/pushnotif",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data){
            var el='';
            var count = data.rows.length;
            var notif = data.notif.length;        
            if(notif>0){
                $("#notification-count").text(count);

                $.each(data.notif,function(a,b){
                    el+="<li id='item_notification_1'>";
                    el+="<div class='media'>";
                        el+="<div class='media-left'>";
                            el+="<a href='#'>";
                            //el+='<img alt="64x64" class="media-object" data-src="holder.js/64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWZhMWJmZmI3MCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZmExYmZmYjcwIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40Njg3NSIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true" style="float:left;">';
                            // el+='<a href="<?=base_url()?>'+b.link+'">';
                        
                            // el+='<span class="image"><img src="<?=base_url()?>assets/images/img.jpg" alt="Profile Image" /></span>';
                            // el+='<span>';
                            //     el+='<span><b>'+b.title+'</b></span>';
                            // el+='</span>';
                            // el+='<span class="message">';
                            //     el+='<span>'+b.notification+'</span>';
                            // el+='</span>';
                            el+="</a>";
                        el+="</div>";
                        el+='<div class="media-body" style="padding-left:10px;">';
                            el+="<div class='exclusaoNotificacao' style='float:right;'><button class='btn btn-danger btn-xs button_exclusao' id='1' onclick='excluirItemNotificacao(this)'>x</button>";
                            el+="</div>";
                            el+='<h4 class="media-heading">'+b.title+'</h4>';
                            el+='<p>'+b.notification+'</p>';
                        el+='</div>';

                    el+="</div>";
                    el+="</li>";

                    $('#notif-detail').empty().html(el);
                });
            }else{
                $("#notification-count").text(0);
            }
        }
        });
    }
    </script>
  <script type="text/javascript">
	$(function() {
		$( "#datepicker" ).datepicker({
            changeMonth: true,
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            yearRange : '-50:+15'
        });

        $( "#datepicker1" ).datepicker({
            changeMonth: true,
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            yearRange : '-50:+15'
        });

        $( "#datepicker2" ).datepicker({
            changeMonth: true,
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            yearRange : '-50:+15'
        });

        $( "#datepicker3" ).datepicker({
            changeMonth: true,
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            yearRange : '-50:+15'
        });

        $( "#datepicker4" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        yearRange : '-50:+15'
        });
        
        $( "#datepicker5" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        yearRange : '-50:+15'
        });
        
        $( "#datepicker6" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        yearRange : '-50:+15'
        });
        
        $( "#datepicker7" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        yearRange : '-50:+15'
        });

        $("#timepicker").timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            minTime: '6',
            maxTime: '22',
            dynamic: false,
            dropdown: true,
            scrollbar: true,
        });

        $("#timepicker1").timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            minTime: '6',
            maxTime: '22',
            dynamic: false,
            dropdown: true,
            scrollbar: true,
        });

        

	});
	</script>

    
        

        <!-- Javascript code only for this page -->
        <script>
            $(function() {
                /* Initialize Datatables */
                $("#example-datatables").dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [0]}]});
                $(".dataTables_filter input").addClass("form-control").attr("placeholder", "Search");
                 
            });
            
            function excluirItemNotificacao(e){
              $("#item_notification_"+e.id).remove()
            }

 
        </script>
  </body>
</html>


