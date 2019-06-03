<div id="infoMessage"> 
<?php echo $this->session->flashdata('message');?> </div> 
<p> Anda belum login.<br /> 
untuk login silakan klik <a href="<?php echo site_url('auth/login'); ?>">login</a>.<br /> 
untuk membuat akun baru, silakan klik <a href="<?php echo site_url('auth/registrasi'); ?>">registrasi</a>. </p>