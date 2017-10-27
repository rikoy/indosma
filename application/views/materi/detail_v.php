<?php
    $idp = $this->session->userdata('idp');
    $kdk = $this->uri->segment(4);
    $nama_mtri = $default['nama_materi'];
?>
<?php 
    $data_notifikasi = array(
       'status_dilihat' => '1'
    );

    $this->db->where('kode_mark', $kdk);
    $this->db->where('id_pengguna', $idp);
    $this->db->where('id_pemeberitahuan', $nama_mtri);
    $this->db->update('notifikasi', $data_notifikasi);
?>
<section class="vbox"> 
    <header class="bg-light lter b-b header clearfix">
        <p class="h4 text-ellipsis"><?=$title_box?> : <?php echo set_value('nama_materi', isset($default['nama_materi']) ? $default['nama_materi'] : ''); ?></p>
    </header> 
    <footer class="footer bg-light lter b-t hidden-xs">
        <div class="m-t-sm"> 
            <span class="text-muted text-sm"><i class="icon-time"></i> <?php echo set_value('datecreated', isset($default['datecreated']) ? $default['datecreated'] : ''); ?></span>
            <div class="pull-right btn-group">
                <?php
                    $file_materi = $default['file_materi'];
                    if(!empty($file_materi)){
                        echo anchor('materi/download/'.$default['id'].'', '<i class="icon-cloud-download"></i>Download ', array('class' => 'btn btn-default btn-xs')); 
                    }

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
    </footer>
    <section class="scrollable">  
        <div class="hbox stretch">
            <!-- content -->
            <div class="vbox"> 
                <section class="paper" id="materi-detail">
                    <textarea type="text" class="form-control"><?php echo set_value('isi_materi', isset($default['isi_materi']) ? $default['isi_materi'] : ''); ?></textarea>
                </section> 
            </div>
        </div>
    </section> 
</section> 

