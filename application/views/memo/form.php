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
                        <div class="step-content"> 
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" class="" data-validate="parsley" id="bbb">
                                <input type="hidden" name="id_pengguna" value="<?=$this->session->userdata('idp')?>">
                                <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($default['id']) ? $default['id'] : ''); ?>">                        
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>Judul Memo</p>
                                        <div class="controls">
                                            <input id="" name="judul_memo" type="text" class="form-control" placeholder="Judul Memo" data-required="true" value="<?php echo set_value('judul_memo', isset($default['judul_memo']) ? $default['judul_memo'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>Isi Memo</p>
                                        <div class="controls">
                                            <textarea name="isi_memo" id="" class="form-control" cols="" rows="10" placeholder="Isi Memo" data-required="true"><?php echo set_value('isi_memo', isset($default['isi_memo']) ? $default['isi_memo'] : ''); ?></textarea>   
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</section> 

