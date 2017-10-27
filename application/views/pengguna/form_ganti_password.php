<?php $statusp = $this->session->userdata('status_pengguna'); ?>
<section id="list-kelas" class="vbox"> 
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
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>Password Baru</p>
                                        <div class="controls">
                                            <input class="form-control parsley-validated" value="" name="password" id="passwd" placeholder="Password Baru" type="password" data-required="true" data-rule-minlength="5" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>Konfirmasi Password Baru</p>
                                        <div class="controls">
                                            <input class="form-control parsley-validated" value="" name="confirm-password" placeholder="Konfirmasi Password Baru" type="password" data-equalto="#passwd" data-required="true" />
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