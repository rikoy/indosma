<?php
    $idp = $this->session->userdata('idp');
    $kdk = $this->uri->segment(4);
    $nama_tgs = $default['nama_tugas'];
?>
<?php 
    $data_notifikasi = array(
       'status_dilihat' => '1'
    );

    $this->db->where('kode_mark', $kdk);
    $this->db->where('id_pengguna', $idp);
    $this->db->where('id_pemeberitahuan', $nama_tgs);
    $this->db->update('notifikasi', $data_notifikasi);
?>
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
                                <input type="hidden" name="kode_kelas" value="<?php echo set_value('kode_kelas', isset($default['kode_kelas']) ? $default['kode_kelas'] : $this->uri->segment(4)); ?>">
                                <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($default['id']) ? $default['id'] : $this->uri->segment(3)); ?>">                        
                                <div class="form-group">
                                    <div class="control-group">
                                        <p><strong>Nama Tugas : <?php echo set_value('nama_tugas', isset($default['nama_tugas']) ? $default['nama_tugas'] : ''); ?></strong></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-group">
                                        <p>File Jawaban Tugas</p>
                                        <div class="controls">
                                            <input type="file" name="file_tugas" data-required="true" id="file_tugas" title="Lampirkan Jawaban Tugas" class="btn btn-sm btn-info m-b-sm">
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