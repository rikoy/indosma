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
                            <ul class="steps"> <li data-target="" class="active" style="color: #404040;"><?=$title_box?></li></ul>
                        </div>
                        <div class="step-content">
                            <div> 
                                <span class="text-muted">Nama Perguruan Tinggi</span> 
                                <span class="h5 block">
                                    <?php echo set_value('nama_pt', isset($default['nama_pt']) ? $default['nama_pt'] : '-'); ?>
                                </span> 
                            </div>
                            <div class="m-t"> 
                                <span class="text-muted">Kode Perguruan Tinggi</span> 
                                <span class="h5 block">
                                    <?php echo set_value('id', isset($default['id']) ? $default['id'] : '-'); ?>
                                </span> 
                            </div>
                            <div class="m-t"> 
                                <span class="text-muted">Alamat</span> 
                                <span class="h5 block">
                                    <?php echo set_value('alamat_pt', isset($default['alamat_pt']) ? $default['alamat_pt'] : '-'); ?>
                                </span> 
                            </div>
                            <div class="m-t"> 
                                <span class="text-muted">Kode POS</span> 
                                <span class="h5 block">
                                    <?php echo set_value('kode_pos_pt', isset($default['kode_pos_pt']) ? $default['kode_pos_pt'] : '-'); ?>
                                </span> 
                            </div>
                            <div class="m-t"> 
                                <span class="text-muted">No. Telepon</span> 
                                <span class="h5 block">
                                    <?php echo set_value('no_telp_pt', isset($default['no_telp_pt']) ? $default['no_telp_pt'] : '-'); ?>
                                </span> 
                            </div>
                            <div class="m-t">
                                <?php
                                    if($idp == $default['id_pengguna']){
                                        echo anchor('pt/ubah/'.$default['id'].'', '<i class="icon-edit"></i> Edit', array('class' => 'btn btn-success btn-sm"'));
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</section> 

