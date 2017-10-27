<?php
    $idp = $this->session->userdata('idp');
?>
<section class="vbox"> 
    <header class="bg-light lter b-b header clearfix">       
        <p class="h5"><?=$title_box?></p>
    </header> 
    <section class="scrollable">  
        <div class="wrapper">
            <div class="row">
                <!-- content -->
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="wizard clearfix" id="form-wizard">
                            <ul class="steps"> <li data-target="" class="active" style="color: #404040;">Form <?=$title_box?></li></ul>
                        </div>
                        <div class="step-content">
                            <form id="bbb" action="<?=$form_action?>" method="post" enctype="multipart/form-data" data-validate="parsley">
                                <input type="hidden" name="id" value="<?php echo set_value('id', isset($default['id']) ? $default['id'] : '-'); ?>">
                                <div class="form-group">    
                                    <div class="control-group">
                                        <label class="control-label" for="userid">Nama Perguruan Tinggi</label>
                                        <div class="controls">
                                            <input id="" name="nama_pt" type="text" class="form-control" placeholder="" class="input-medium" data-required="true" value="<?php echo set_value('nama_pt', isset($default['nama_pt']) ? $default['nama_pt'] : '-'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <label class="control-label" for="userid">Alamat Perguruan Tinggi</label>
                                        <div class="controls">
                                            <!-- <input id="" name="" type="text" class="form-control" placeholder="" class="input-medium"> -->
                                            <textarea name="alamat_pt" id="" class="form-control" placeholder="" rows="2" data-required="true"><?php echo set_value('alamat_pt', isset($default['alamat_pt']) ? $default['alamat_pt'] : '-'); ?></textarea>    
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <label class="control-label" for="userid">Kode POS Perguruan Tinggi</label>
                                        <div class="controls">
                                            <input id="" name="kode_pos_pt" type="text" class="form-control" placeholder="" class="input-medium" data-minlength="5" data-trigger="change" data-type="digits" value="<?php echo set_value('kode_pos_pt', isset($default['kode_pos_pt']) ? $default['kode_pos_pt'] : '-'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <label class="control-label" for="userid">No Telepon Perguruan Tinggi</label>
                                        <div class="controls">
                                            <input id="" name="no_telp_pt" type="text" class="form-control" placeholder="" class="input-medium" data-required="true" data-number="true" data-trigger="change" data-type="digits" value="<?php echo set_value('no_telp_pt', isset($default['no_telp_pt']) ? $default['no_telp_pt'] : '-'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group m-t">
                                        <div class="controls">
                                            <input type="submit" class="btn btn-success btn-sm" name="" value="Simpan" id="">
                                            <input type="reset" class="btn btn-warning btn-sm" name="" value="Batal" id="">
                                            <?php
                                                if ( ! empty($link_back))
                                                {
                                                    foreach($link_back as $links)
                                                    {
                                                        echo $links;
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</section> 

