<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Pelatihan</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="formdaftar1" class="form-horizontal form-label-left" name="formdaftar1" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="daftar">Jenis Pelatihan<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" required="required" disabled>
                                <option value=""><?php echo $lengkapdaftar[0]->nama_pelatihan;?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="daftar">Jenis Pelatihan<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" required="required" disabled>
                                <option value=""><?php echo $lengkapdaftar[0]->lokasi;?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="daftar">Jenis Pelatihan<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" required="required" disabled>
                                <option value=""><?php echo $lengkapdaftar[0]->hari;?></option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Pribadi Peserta</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="formdaftar2" class="form-horizontal form-label-left" name="formdaftar2" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alumni ? <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <?php if($lengkapdaftar[0]->alumni == 1) { ?>
                              <input type="text" id="first-name" name="nama" class="form-control col-md-7 col-xs-12" value="Alumni" readonly>
                            <?php } else {?>
                              <input type="text" id="first-name" name="nama" class="form-control col-md-7 col-xs-12" value="Non Alumni" readonly>
                            <?php } ?>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="first-name" name="nama" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->nama;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tempat Lahir <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="first-name" name="tempat_lahir" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $lengkapdaftar[0]->tempat_lahir;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal-lahir">Tanggal Lahir</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class='input-group date' id='myDatepicker'>
                                    <input type='text' id="tanggal-lahir" name="tgl_lahir" class="form-control col-md-7 col-xs-12" data-inputmask="'mask': '99/99/9999'" placeholder="DD/MM/YYYY" required="required" value="<?php $newDate = date("d-m-Y", strtotime($lengkapdaftar[0]->tgl_lahir)); echo $newDate;?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea rows="3" id="alamat" name="alamat" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $lengkapdaftar[0]->alamat;?>" readonly><?php echo $lengkapdaftar[0]->alamat;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kodepos" class="control-label col-md-3 col-sm-3 col-xs-12">Kode Pos</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="kodepos" class="form-control col-md-7 col-xs-12" type="number" name="kode_pos" required="required" value="<?php echo $lengkapdaftar[0]->kode_pos;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Upload foto <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <img class="p-10" width="50%" height="50%" id="foto1" src="<?=base_url()?>uploads/foto/<?php echo $lengkapdaftar[0]->file_foto;?>" alt="-- Foto Anda --" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Jenis Kelamin <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <input id="jeniskelamin" class="form-control col-md-7 col-xs-12" type="text" name="jenis_kelamin" required="required" value="<?php echo $lengkapdaftar[0]->jenis_kelamin;?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hp">No. HP <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" id="hp" name="no_hp" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $lengkapdaftar[0]->no_hp;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" id="email" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->email;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agama">Agama <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" id="agama" name="agama" required="required" disabled>
                                    <option value=""><?php echo $lengkapdaftar[0]->agama;?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="haritempat" style="">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pekerjaan" >Pekerjaan <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" id="pekerjaan" name="pekerjaan" required="required" disabled>
                                    <option value=""><?php echo $lengkapdaftar[0]->pekerjaan;?></option> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Upload KTP <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <img class="p-10" width="60%" height="50%" id="foto1" src="<?=base_url()?>uploads/ktp/<?php echo $lengkapdaftar[0]->file_ktp;?>" alt="-- Foto Anda --" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Informasi Tempat Kerja <small>(Diisi oleh peserta yang sudah bekerja)</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="formdaftar3" class="form-horizontal form-label-left" name="formdaftar3" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" >Nama Kantor / Institusi</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="nama-kantor" name="nama_kantor" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->nama_kantor;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" >Bidang Usaha</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="bidang-usaha" name="bidang_usaha" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->bidang_usaha;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" >Alamat Kantor</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea rows="3" id="alamat_kantor" name="alamat_kantor" class="form-control col-md-7 col-xs-12" readonly><?php echo $lengkapdaftar[0]->alamat_kantor;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kodepos" class="control-label col-md-4 col-sm-4 col-xs-12">Kode Pos</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="kodeposkantor" class="form-control" type="number" name="kode_pos_kantor" value="<?php echo $lengkapdaftar[0]->kode_pos_kantor;?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">No Telp Kantor</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" name="no_tlp" class="form-control" value="<?php echo $lengkapdaftar[0]->no_tlp;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" >Jabatan</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="nama-kantor" name="jabatan" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->jabatan;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" >Divisi/Bagian</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" id="bidang-usaha" name="div_bagian" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->div_bagian;?>" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Informasi Tempat Kuliah <small>(Diisi oleh peserta yang sedang kuliah)</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="formdaftar4" class="form-horizontal form-label-left" name="formdaftar4" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" >Nama Universitas</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="nama-univ" name="nama_univ" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->nama_univ;?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" >Semester</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" id="semester" name="semester" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->semester;?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" >Jurusan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="jurusan" name="jurusan" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->jurusan;?>" readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $lengkapdaftar[0]->file_smp;?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Informasi Sistem Pembayaran </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="formdaftar5" class="form-horizontal form-label-left" name="formdaftar5" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="first-name" required="required" name="id_peserta_daftar" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->id_peserta_daftar;?>">
                    <input type="hidden" id="first-name" required="required" name="id_akun_peserta" class="form-control col-md-7 col-xs-12" value="<?php echo $lengkapdaftar[0]->id_akun_peserta;?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="daftar">Jenis Pembayaran <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran" required="required">
                                <option value="">Pilih jenis pembayaran...</option>
                                <option value="<?php echo $lengkapdaftar[0]->jenis_pembayaran;?>"><?php echo $lengkapdaftar[0]->jenis_pembayaran;?></option>
                            </select>
                        </div>

                        <div class="bayar cicilan" id="cicilan">
                            <div class="form-group">
                                <br><br>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Upload SMP <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type='file' id="file_smp_cicilan" name="file_smp1" onchange="readURLsmp1(this);" class="form-control btn-warning"/>
                                    <img class="p-10" id="file_smp1" src="#" alt="-- Dokumen SMP --" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bayar perusahaan" id="perusahaan" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Upload SMP <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type='file' id="file_smp_perusahaan" name="file_smp2" onchange="readURLsmp2(this);" class="form-control btn-warning"/>
                                <img class="p-10" id="file_smp2" src="#" alt="-- Dokumen SMP --" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Upload GL <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type='file' id="file_gl" name="file_gl" onchange="readURLgl(this);" class="form-control btn-warning"/>
                                <img class="p-10" id="file_gl1" src="#" alt="-- Dokumen GL --" />
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>
                            <button type="submit" class="btn btn-success">Validasi</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function(){
 
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".bayar").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".bayar").hide();
                }
            });
        }).change();

        $("#jenis_pembayaran").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".bayar").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".bayar").hide();
                }
            });
        }).change();

        $("#jenis_cicilan").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".cicilannya").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".cicilannya").hide();
                }
            });
        }).change();

    });
    function readURLsmp1(input) {
        if (input.files && input.files[0]) {
            var reader1 = new FileReader();

            reader1.onload = function (e) {
                $('#file_smp1')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };
            reader1.readAsDataURL(input.files[0]);
        }
    }

    function readURLsmp2(input) {
        if (input.files && input.files[0]) {
            var reader2 = new FileReader();

            reader2.onload = function (e) {
                $('#file_smp2')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };
            reader2.readAsDataURL(input.files[0]);
        }
      }

    function readURLgl(input) {
        if (input.files && input.files[0]) {
            var reader3 = new FileReader();

            reader3.onload = function (e) {
                $('#file_gl1')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };
            reader3.readAsDataURL(input.files[0]);
        }
    }

    $('#formdaftar5').on('submit', function(e){
        var formdata = new FormData(this);

        var myForm = document.formdaftar5;

        if ((myForm.file_smp_cicilan.value != "") || (myForm.file_smp_perusahaan.value != "" && myForm.file_gl.value != "")){
            
            e.preventDefault();
                $.ajax({
                    url:"<?=base_url()?>Peserta/approvevalidasi",
                    method:"POST",
                    data: formdata,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        // console.log(data)
                        // if(data == 'berhasil'){
                            window.location.href = "<?=base_url()?>Peserta/validasiadmin/";
                        // }else{
                        //     alert('data belum lengkap');
                        //     $("#daftarsection").show();
                        //     $("#loading").hide();
                        //     return false;
                        // }
                    }
                });
        } else {
        
            alert("Berkas Belum di Upload");
            return false;

        }
    });
</script>