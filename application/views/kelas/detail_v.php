<?php 
    $idp = $this->session->userdata('idp');
    $status_pengguna = $this->session->userdata('status_pengguna');
    $kdk = $default['id'];
?>
<section id="" class="vbox"> 
    <header class="bg-light lter b-b header clearfix"> 
        <p class="h4"><?=$title_box?> : <?php echo set_value('nama_kelas', isset($default['nama_kelas']) ? $default['nama_kelas'] : ''); ?></p>
    </header>
    <section class="scrollable"> 
        <div class="wrapper">
            <div class="row">
                <!-- content -->
                <div class="col-lg-12">
                    <section class="panel"> 
                        <?php                                
                                echo '<a class="btn btn-xs btn-default pull-right">Kode Kelas : '.$default['id'].'</a>';
                            ?>
                        <div class="panel-body">
                            <div class="clearfix text-center m-t">
                                <div class="inline">
                                    <div class="thumb-lg"> 
                                        <img src="<?=base_url()?>avatar/<?php echo set_value('foto_profil', isset($default['foto_profil']) ? $default['foto_profil'] : ''); ?>" style="width: 90px; height: 90px;" class="img-circle"> 
                                    </div> 
                                    <div class="h4 m-t m-b-xs"><?php echo set_value('nama_lengkap', isset($default['nama_lengkap']) ? $default['nama_lengkap'] : ''); ?></div> 
                                    <small class="text-muted m-b">Dosen</small> 
                                </div> 
                            </div> 
                        </div> 
                        <footer class="panel-footer bg-dark lter text-center"> 
                            <div class="row pull-out"> 
                                <div class="col-xs-4"> 
                                    <div class="padder-v"> 
                                        <span class="m-b-xs h4 block">
                                            <?php
                                                $this->db->where('kode_kelas', $default['id']);
                                                $this->db->from('kelas_pengguna');
                                                $jml_siswa = $this->db->count_all_results()-1;
                                                echo $jml_siswa;
                                            ?>
                                        </span> 
                                        <small class="text-muted">Mahasiswa</small> 
                                    </div> 
                                </div> 
                                <div class="col-xs-4 bg-success"> 
                                    <div class="padder-v"> 
                                        <span class="m-b-xs h4 block">
                                            <?php
                                                $this->db->where('kode_kelas', $default['id']);
                                                $this->db->from('materi');
                                                $jml_materi = $this->db->count_all_results();
                                                echo $jml_materi;
                                            ?>
                                        </span> 
                                        <small class="text-muted">Materi</small> 
                                    </div> 
                                </div> 
                                <div class="col-xs-4"> 
                                    <div class="padder-v"> 
                                        <span class="m-b-xs h4 block">
                                            <?php
                                                $this->db->where('kode_kelas', $default['id']);
                                                $this->db->from('tugas');
                                                $jml_materi = $this->db->count_all_results();
                                                echo $jml_materi;
                                            ?>
                                        </span> 
                                        <small class="text-muted">Tugas</small> 
                                    </div> 
                                </div> 
                            </div> 
                        </footer> 
                    </section>
                </div>
                <div class="clear"></div>
                <div class="col-lg-12">
                    <section class="panel"> 
                        <header class="panel-heading bg-light lt"> 
                            <ul class="nav nav-tabs nav-justified"> 
                                <li id="notif_diskusi" class="active">
                                    <a href="#diskusi" data-toggle="tab"><i class="icon-comments"></i> Diskusi
                                        <?php
                                            $q_hitung_diskusi_baru = $this->db->query("SELECT COUNT(*) AS jml_diskusi_baru FROM notifikasi WHERE status_dilihat = '0' AND id_pengguna = '$idp' AND kode_mark = '$kdk' AND tipe_notifikasi = 'diskusi' OR tipe_notifikasi = 'komendiskusi'");
                                            $r_jml_diskusi_baru = $q_hitung_diskusi_baru->row();

                                            if ($r_jml_diskusi_baru->jml_diskusi_baru > 0) {
                                                //echo '<label class="label bg-warning">'.$r_jml_diskusi_baru->jml_diskusi_baru.'</label>';
                                            }
                                        ?>
                                    </a>
                                </li> 
                                <li id="notif_materi" class="">
                                    <a href="#materi" data-toggle="tab"><i class="icon-book"></i> Materi
                                        <?php
                                            $q_hitung_materi_baru = $this->db->query("SELECT COUNT(*) AS jml_materi_baru FROM notifikasi WHERE tipe_notifikasi = 'materi' AND status_dilihat = '0' AND id_pengguna = '$idp' AND kode_mark = '$kdk'");
                                            $r_jml_materi_baru = $q_hitung_materi_baru->row();

                                            if ($r_jml_materi_baru->jml_materi_baru > 0) {
                                                echo '<label class="label bg-warning">'.$r_jml_materi_baru->jml_materi_baru.'</label>';
                                            }
                                        ?>
                                    </a>
                                </li> 
                                <li id="notif_tugas" class="">
                                    <a href="#tugas" data-toggle="tab"><i class="icon-file-text"></i> Tugas 
                                        <?php
                                            $q_hitung_tugas_baru = $this->db->query("SELECT COUNT(*) AS jml_tugas_baru FROM notifikasi WHERE tipe_notifikasi = 'tugas' AND status_dilihat = '0' AND id_pengguna = '$idp' AND kode_mark = '$kdk'");
                                            $r_jml_tugas_baru = $q_hitung_tugas_baru->row();

                                            if ($r_jml_tugas_baru->jml_tugas_baru > 0) {
                                                echo '<label class="label bg-warning">'.$r_jml_tugas_baru->jml_tugas_baru.'</label>';
                                            }
                                        ?>
                                    </a>
                                </li>
                            </ul> 
                        </header> 
                        <div class="panel-body"> 
                            <div class="tab-content">
                                <!-- diskusi -->
                                <div class="tab-pane active" id="diskusi">
                                    <?php $this->load->view('diskusi/diskusi_v'); ?>
                                </div> 
                                <!-- materi -->
                                <div class="tab-pane" id="materi">
                                    <?php $this->load->view('materi/materi_v'); ?>
                                </div>
                                <!-- materi -->
                                <div class="tab-pane" id="tugas">
                                    <?php $this->load->view('tugas/tugas_v'); ?>
                                </div>
                            </div>
                        </div> 
                    </section>
                </div>
            </div>
        </div>
    </section> 
</section> 