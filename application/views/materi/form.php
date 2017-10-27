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
                                        <p>Nama Materi</p>
                                        <div class="controls">
                                            <input id="" name="nama_materi" type="text" class="form-control" placeholder="Nama Materi" data-required="true" value="<?php echo set_value('nama_materi', isset($default['nama_materi']) ? $default['nama_materi'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>Isi Materi</p>
                                        <div class="controls">
                                            <textarea name="isi_materi" id="" class="form-control" cols="" rows="10" placeholder="Isi Materi" data-required="true"><?php echo set_value('isi_materi', isset($default['isi_materi']) ? $default['isi_materi'] : ''); ?></textarea>   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>File Materi</p>
                                        <div class="controls">
                                            <p>
                                            <?php echo set_value('file_materi', isset($default['file_materi']) ? $default['file_materi'] : ''); ?>
                                            </p>
                                            <input type="file" name="file_materi" id="file_materi" title="Lampirkan Materi" class="btn btn-sm btn-info m-b-sm">
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

