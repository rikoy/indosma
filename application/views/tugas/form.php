<section class="vbox"> 
    <header class="bg-light lter b-b header clearfix">       
        <p class="h4"><?=$title_box?></p>
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
                        <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" class="" data-validate="parsley" id="bbb">
                            <div class="step-content"> 
                                <input type="hidden" name="id_pengguna" value="<?=$this->session->userdata('idp')?>">
                                <input type="hidden" name="kode_kelas" value="<?php echo set_value('kode_kelas', isset($default['kode_kelas']) ? $default['kode_kelas'] : $this->uri->segment(3)); ?>">
                                <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($default['id']) ? $default['id'] : ''); ?>">                        
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>Nama Tugas</p>
                                        <div class="controls">
                                            <input id="" name="nama_tugas" type="text" class="form-control" placeholder="Nama Tugas" data-required="true" value="<?php echo set_value('nama_tugas', isset($default['nama_tugas']) ? $default['nama_tugas'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>Batas Pengumpuan</p>
                                        <div class="controls">
                                            <input id="" name="batas_pengumpulan" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" placeholder="Batas Pengumpuan" data-required="true" value="<?php echo set_value('batas_pengumpulan', isset($default['batas_pengumpulan']) ? date("d-m-Y" ,strtotime($default['batas_pengumpulan'])) : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>Deskripsi Tugas</p>
                                        <div class="controls">
                                            <textarea name="isi_tugas" id="" class="form-control" cols="" rows="10" placeholder="Deskripsi Tugas" data-required="true"><?php echo set_value('isi_tugas', isset($default['isi_tugas']) ? $default['isi_tugas'] : ''); ?></textarea>   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>File Tugas</p>
                                        <div class="controls">
                                            <p>
                                            <?php echo set_value('file_tugas', isset($default['file_tugas']) ? $default['file_tugas'] : ''); ?>
                                            </p>
                                            <input type="file" name="file_tugas" id="file_tugas" title="Lampirkan Tugas" class="btn btn-sm btn-info m-b-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</section>