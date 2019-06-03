<!DOCTYPE html>
<html>
  <head>
    <title>SIM PPA FEB UI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
     <style>
		.btn-file {
		    position: relative;
		    overflow: hidden;
		}
		.btn-file input[type=file] {
		    position: absolute;
		    top: 0;
		    right: 0;
		    min-width: 100%;
		    min-height: 100%;
		    font-size: 999px;
		    text-align: right;
		    filter: alpha(opacity=0);
		    opacity: 0;
		    background: red;
		    cursor: inherit;
		    display: block;
		}
		input[readonly] {
			background-color: white; !important;
			cursor: text !important;
		}
	body {
	background-image: url(/pelatihan_ppa/assets/images/gray_jean.png);
}
</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
  <body>
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  
</nav>
      <div class="container">
          <div class="col-md-3"></div>
          <div class="col-md-5">
              <?php
              echo form_open('auth/login');
              ?>
              <table class="table table-bordered">
              <tr>
                <td width="160" rowspan="5"><div align="center"><img src="/pelatihan_ppa/assets/images/sisfo_ppa_logo3.png" width="106" height="107"></div></td>
                <td width="61">Username</td><td width="252">  
                      <div class="input-group">
                          <input type="text" name="username" required="" placeholder="Username ..." autofocus="" class="form-control">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>                  </div></td></tr>
              <tr>
                <td>Password</td><td> <div class="input-group">
                          <input type="password" name="password" placeholder="Password" required="" class="form-control">
  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
</div></td></tr>
              <tr>
                <td colspan="2"><div class="col-md-8">
                          <input type="text" name="kode_aman" placeholder="Masukan Kode Keamanan" required="" class="form-control"><?php echo $image;?></div></td></tr>
              <tr></tr>
              <tr>
                <td colspan="2"><div align="center">
                  <input type="submit" name="submit" value="Login" class="btn btn-danger">
                </div></td></tr>
          </table>   
          </form>
          </div>    
           <div class="col-md-3"></div>
           
      </div>
      
      <hr>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>assets/js/1.8.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/icons.jpg">
    	<link rel="stylesheet" href="<?php echo base_url();?>assets/themes/base/jquery.ui.all.css">
	<script src="<?php echo base_url();?>assets/js/jquery-1.9.1.js"></script>
	<script src="<?php echo base_url();?>assets/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>assets/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>assets/ui/jquery.ui.datepicker.js"></script>
	
        	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true,
				yearRange : '-50:+15'
                });

                $( "#datepicker1" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true,
				yearRange : '-50:+15'
                });

                $( "#datepicker2" ).datepicker({
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true,
				yearRange : '-50:+15'
                });
	});
	</script>
  </body>
</html>