<div id="form_pesan" class="modal fade pesan-form" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="bs-example bs-example-tabs">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#form-tambah-pt" data-toggle="tab">Form Tambah Pesan</a></li>
                </ul>
            </div>
            <div class="modal-body">
                <div id="myTabContent" class="tab-content">
                    <!-- form tambah -->
                    <div class="tab-pane fade active in" id="form-tambah-pt">
                        <div id="notifikasi" style="display:none" class="alert alert-danger"></div>
                        <form class="form-horizontal" data-validate="parsley" id="bbb">
                            <input type="hidden" name="id_pengirim" id="id_pengirim" value="<?=$this->session->userdata('idp')?>">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="userid">Nama Tujuan</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('id_tujuan', $options_pengguna, (isset($default['id_pengguna']) ? $default['id_pengguna'] : ''), 'data-required="true" class="select2-offscreen" style="width:100%" id="select2-option"'); ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="userid">Judul Pesan</label>
                                    <div class="controls">
                                        <input id="judul_pesan" name="judul_pesan" type="text" placeholder="Judul Pesan" class="form-control input-medium" data-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="userid">Isi Pesan</label>
                                    <div class="controls">
                                        <textarea name="isi_pesan" id="isi_pesan" cols="" rows="4" placeholder="Isi Pesan" class="form-control"></textarea>    
                                    </div>
                                </div>
                                <br>
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="button" class="btn btn-success btn-sm" name="" value="Kirim" id="btnkirim">
                                        <input type="reset" class="btn btn-warning btn-sm" name="" value="Batal" id="">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Keluar</button>
                </center>
            </div>
        </div>
    </div>
</div>