<?php 
    $statusp = $this->session->userdata('status_pengguna');
    //jika dosen
    if($statusp == "dosen"){ //jika dosen
?>
<div class="modal fade pt-form" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="bs-example bs-example-tabs">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#form-tambah-pt" data-toggle="tab">Form Tambah Perguruan Tinggi</a></li>
                    <li class=""><a href="#form-cari-pt" data-toggle="tab">Form Pencarian Perguruan Tinggi</a></li>
                </ul>
            </div>
            <div class="modal-body">
                <div id="myTabContent" class="tab-content">
                    <!-- form tambah -->
                    <div class="tab-pane fade active in" id="form-tambah-pt">
                        <form id="bbb" action="<?=$form_pt?>" method="post" enctype="multipart/form-data" class="form-horizontal" data-validate="parsley">
                            <input type="hidden" name="id_pengguna" value="<?=$this->session->userdata('idp')?>">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="userid">Nama Perguruan Tinggi</label>
                                    <div class="controls">
                                        <input id="" name="nama_pt" type="text" class="form-control" placeholder="" class="input-medium" data-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="userid">Alamat Perguruan Tinggi</label>
                                    <div class="controls">
                                        <!-- <input id="" name="" type="text" class="form-control" placeholder="" class="input-medium"> -->
                                        <textarea name="alamat_pt" id="" class="form-control" placeholder="" rows="2" data-required="true"></textarea>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                        <div class="control-group">
                                            <label class="control-label" for="userid">Kode POS Perguruan Tinggi</label>
                                            <div class="controls">
                                                <input id="" name="kode_pos_pt" type="text" class="form-control" placeholder="" class="input-medium" data-minlength="5" data-trigger="change" data-type="digits">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                        <div class="control-group">
                                            <label class="control-label" for="userid">No Telepon Perguruan Tinggi</label>
                                            <div class="controls">
                                                <input id="" name="no_telp_pt" type="text" class="form-control" placeholder="" class="input-medium" data-required="true" data-number="true" data-trigger="change" data-type="digits">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="submit" class="btn btn-success" name="" value="Simpan" id="">
                                        <input type="reset" class="btn btn-warning" name="" value="Batal" id="">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- form cari -->
                    <div class="tab-pane fade" id="form-cari-pt">
                        <form action="<?=$form_cari_pt?>" id="ccc" class="form-horizontal" enctype="multipart/form-data" method="post" data-validate="parsley">
                            <input type="hidden" name="id_pengguna" value="<?=$this->session->userdata('idp')?>">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="Email">Kode Perguruan Tinggi</label>
                                    <div class="controls">
                                        <input id="cari_kode_pt" name="kode_pt" class="form-control" type="text" placeholder="" autocomplete="off" class="input-large" data-required="true">
                                    </div>
                                </div>
                                <div id='extra-combo'></div>
                                <div class="control-group">
                                    <div class="controls">
                                        <br>
                                        <input type="submit" class="btn btn-success" name="" value="Simpan" id="">
                                        <input type="reset" class="btn btn-warning" name="" value="Batal" id="">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </center>
            </div>
        </div>
    </div>
</div>
<?php }else{ //jika mahasiswa ?>
<div class="modal fade pt-form" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="bs-example bs-example-tabs">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#form-cari-pt" data-toggle="tab">Form Pencarian Perguruan Tinggi</a></li>
                </ul>
            </div>
            <div class="modal-body">
                <div id="myTabContent" class="tab-content">
                    <!-- form cari -->
                    <div class="tab-pane fade active in" id="form-cari-pt">
                        <form action="<?=$form_cari_pt?>" id="bbb" class="form-horizontal" enctype="multipart/form-data" method="post" data-validate="parsley">
                            <input type="hidden" name="id_pengguna" value="<?=$this->session->userdata('idp')?>">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="Email">Kode Perguruan Tinggi</label>
                                    <div class="controls">
                                        <input id="cari_kode_pt" name="kode_pt" class="form-control" type="text" placeholder="" autocomplete="off" class="input-large" data-required="true">
                                    </div>
                                </div>
                                <div id='extra-combo'></div>
                                <div class="control-group">
                                    <div class="controls">
                                        <br>
                                        <input type="submit" class="btn btn-success" name="" value="Simpan" id="">
                                        <input type="reset" class="btn btn-warning" name="" value="Batal" id="">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </center>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<script>
    var site_url = "<?php echo site_url();?>";
    function load_uri(uri,dom)
    {
        $.ajax({
            url: site_url+'/'+uri,
            success: function(response){            
            $(dom).html(response);
            },
        dataType:"html"         
        });
        return false;
    }
    
    function show_extra_combo(combo,combo_level)
    {
        var id = $(combo).val();
        // buat dom '.combo-level' di dalam extra-combo jika belum ada
        var domcombo = 'combo-'+combo_level;
        if($('.'+domcombo).length == 0)
        {
            $('#extra-combo').append('&nbsp;<div class="'+domcombo+'"></div>');
        }
        load_uri("dashboard/show_pt/"+id+"/"+combo_level,'.'+domcombo);
    }

    $.event.special.inputchange = {
        setup: function() {
            var self = this, val;
            $.data(this, 'timer', window.setInterval(function() {
                val = self.value;
                if ( $.data( self, 'cache') != val ) {
                    $.data( self, 'cache', val );
                    $( self ).trigger( 'inputchange' );
                }
            }, 20));
        },
        teardown: function() {
            window.clearInterval( $.data(this, 'timer') );
        },
        add: function() {
            $.data(this, 'cache', this.value);
        }
    };

    $('#cari_kode_pt').on('inputchange', function() {
        show_extra_combo(this,1);
    }).change();
</script>