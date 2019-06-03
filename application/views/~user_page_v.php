<p> Ini adalah halaman <strong>User/Member</strong> dengan email 
<?php echo $this->session->userdata('username'); ?>.<br /> 
Untuk keluar silakan klik link <a href="<?php echo site_url('auth/logout'); ?>">logout</a>.
</p>