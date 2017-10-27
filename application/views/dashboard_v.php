<?php 
    $idp = $this->session->userdata('idp');
    $query_img = $this->db->query("SELECT foto_profil, nama_lengkap FROM pengguna WHERE id_pengguna = '$idp'");
    $row_img = $query_img->row();

    $nama_lengkap = explode(" ", $row_img->nama_lengkap);
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8"> 
        <title>Sistem Informasi Interaksi Dosen dan Mahasiswa</title> 
        <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 

        <link rel="stylesheet" href="<?=base_url()?>assets/app/css/app.v1.css"> 
        <link rel="stylesheet" href="<?=base_url()?>assets/app/css/mystyle.css"> 

        <link rel="stylesheet" href="<?=base_url()?>assets/app/css/font.css" cache="false">
        <link rel="stylesheet" href="<?=base_url()?>assets/app/pnotify/pnotify.custom.min.css" cache="false"> 
        <!--[if lt IE 9]> 
        <script src="<?=base_url()?>assets/app/js/ie/respond.min.js" cache="false">
        </script> 
        <script src="<?=base_url()?>assets/app/js/ie/html5.js" cache="false">
        </script> 
        <script src="<?=base_url()?>assets/app/js/ie/fix.js" cache="false">
        </script> <![endif]-->

        <script src="<?=base_url()?>assets/app/js/app.v1.js"></script>
        <script src="<?=base_url()?>assets/app/js/bootstrap3-typeahead.js"></script>
        <script src="<?=base_url()?>assets/app/pnotify/pnotify.custom.min.js"></script>
        <!-- Bootstrap --> 
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?=base_url()?>assets/app/jasny/css/jasny-bootstrap.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?=base_url()?>assets/app/jasny/js/jasny-bootstrap.min.js"></script>
        <!-- time ago -->
        <script src="<?=base_url()?>assets/app/js/jquery.livequery.js"></script>
        <script src="<?=base_url()?>assets/app/js/jquery.timeago.js"></script>
        <!-- listjs -->
        <script src="<?=base_url()?>assets/app/list/list.js"></script>
        <script src="<?=base_url()?>assets/app/list/list.fuzzysearch.js"></script>
        <!-- timer -->
        <script src="<?=base_url()?>assets/app/js/jquery.timer.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $(".timeago").livequery(function() // LiveQuery 
                {
                    $(this).timeago(); // Calling Timeago Funtion 
                });
            });
        </script>

        <script>
            $(document).ready(function(){
                var Example2 = new (function() {
                    var uri = $("#uri").val();
                    var timer = $.timer(function() {
                        $("#notif_status").load("<?php echo base_url() ?>index.php/"+uri+" #notif_status");
                        $("#notif_pesan").load("<?php echo base_url() ?>index.php/"+uri+" #notif_pesan");
                    });
                    timer.set({ time : 3000, autostart : true });
                });
            });
        </script>

    </head>
    <body>
        <input type="hidden" id="uri" value="<?php echo $this->uri->segment(1); ?>">
        <section class="hbox stretch"> 
            <!-- .aside --> 
            <aside class="bg-primary dk aside-sm nav-vertical only-icon" id="nav"> 
                <section class="vbox"> 
                    <header class="dker nav-bar"> 
                        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"> <i class="icon-reorder"></i> </a>
                        <span class="icon-stack icon-2x visible-sm visible-md visible-lg btn btn-sm btn-link"> 
                            <i class="icon-sign-blank text-primary icon-stack-base"></i> 
                            <i class="icon-group icon-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="inDosma"></i> 
                        </span>
                        <a href="#" class="nav-brand visible-xs" data-toggle="">inDosma</a> 
                        <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> <i class="icon-comment-alt"></i> </a> 
                    </header> 
                    <footer class="footer lt hidden-xs text-center" data-toggle="tooltip" data-placement="right" title="" data-original-title="Logout"> 
                        <?=anchor('home/logout', '<i class="icon-off"></i>', array('class' => 'btn btn-sm btn-link'));?>
                    </footer> 
                <section> 
                    <!-- user --> 
                    <div class="lt nav-user hidden-xs pos-rlt"> 
                        <div class="nav-avatar pos-rlt"> 
                            <a href="#" class="thumb-sm avatar" style="margin: 0 auto;" data-toggle="dropdown">
                                <img src="<?=base_url()?>avatar/thumb/<?php echo $row_img->foto_profil; ?>" alt="" style="width: 28px; height: 28px;" class="visible-sm visible-md visible-lg text-ellipsis" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$nama_lengkap[0]?>">
                                <img src="<?=base_url()?>avatar/thumb/<?php echo $row_img->foto_profil; ?>" alt="" style="width: 148px; height: 148px;" class="visible-xs">
                            </a> 
                            <ul class="dropdown-menu m-t-sm animated fadeInLeft"> 
                                <span class="arrow top"></span> 
                                <li><a href="<?php echo base_url().'teman/profil/'.$this->session->userdata('idp').''; ?>">Profil</a></li> 
                                <li><a href="<?php echo base_url().'pengguna/ganti_password/'.$this->session->userdata('idp').''; ?>">Ganti Password</a></li> 
                                <li><?=anchor('home/logout', 'Log out');?></li> 
                            </ul>
                            <div class="text-center visible-xs m-t m-b text-ellipsis"> 
                                <a href="<?php echo base_url().'teman/profil/'.$this->session->userdata('idp').''; ?>" class="h4"><?=$this->session->userdata('nama_lengkap')?> </a> 
                                <p class="text-muted" style="text-transform: capitalize;"><?=$this->session->userdata('status_pengguna')?> </p> 
                            </div>
                        </div> 
                    </div> 
                    <!-- / user --> 
                    <!-- nav --> 
                    <nav class="nav-primary hidden-xs"> 
                        <ul class="nav"> 
                            <li class="<?php if($this->uri->segment(1) == 'dashboard'){ echo 'active';}else{ echo '';} ?>">
                                <a href="<?=base_url()."dashboard"?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Kantin">
                                    <div id="notif_status">
                                        <?php
                                            $q_hitung_status = $this->db->query("SELECT COUNT(*) AS jml_status FROM notifikasi WHERE tipe_notifikasi = 'status' AND status_dilihat = '0' AND id_pengguna = '$idp'");
                                            $r_jml_status = $q_hitung_status->row();

                                            $q_hitung_komen = $this->db->query("SELECT COUNT(*) AS jml_komen FROM notifikasi WHERE tipe_notifikasi = 'komentar' AND status_dilihat = '0' AND id_pengguna = '$idp'");
                                            $r_jml_komen = $q_hitung_komen->row();

                                            $r_jml_status_komen = $r_jml_status->jml_status+$r_jml_komen->jml_komen;

                                            if ($r_jml_status_komen > 0) {
                                                echo '<b class="badge bg-danger pull-right">'.$r_jml_status_komen.'</b>';
                                            }
                                        ?>
                                    </div>
                                    <i class="icon-comments-alt"></i> 
                                    <span>Kantin</span> 
                                </a> 
                            </li>
                            <li class="<?php if($this->uri->segment(1) == 'kelas' || $this->uri->segment(1) == 'materi' || $this->uri->segment(1) == 'tugas'){ echo 'active';}else{ echo '';} ?>">
                                <a href="<?=base_url()."kelas"?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Kelas"> <i class="icon-beaker"></i> 
                                    <span>Kelas</span> 
                                </a>
                            </li>
                            <li class="<?php if($this->uri->segment(1) == 'memo'){ echo 'active';}else{ echo '';} ?>">
                                <a href="<?=base_url()."memo"?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Memo"> <i class="icon-folder-open-alt"></i> 
                                    <span>Memo</span> 
                                </a>
                            </li>
                            <li class="<?php if($this->uri->segment(1) == 'pesan'){ echo 'active';}else{ echo '';} ?>">
                                <a href="<?=base_url()?>pesan/" data-toggle="tooltip" data-placement="right" title="" data-original-title="Pesan">
                                    <div id="notif_pesan">
                                        <?php 
                                            $q_hitung_pesan = $this->db->query("SELECT COUNT(*) AS jml_pesan FROM pesan WHERE id_tujuan = '$idp' AND status_dilihat = '0'");
                                            $r_pesan = $q_hitung_pesan->row();

                                            $q_hitung_jawaban = $this->db->query("SELECT COUNT(*) AS jml_jawaban FROM jawaban_pesan WHERE id_tujuan = '$idp' AND status_dilihat = '0'");
                                            $r_jawaban = $q_hitung_jawaban->row();

                                            if ($r_jawaban->jml_jawaban > 0) {
                                                $jml_jawaban = 1;
                                            }else{
                                                $jml_jawaban = 0;
                                            }

                                            $jml_pesan = $r_pesan->jml_pesan + $jml_jawaban;

                                            if ($jml_pesan > 0) {
                                                echo '<b class="badge bg-danger pull-right">'.$jml_pesan.'</b>';
                                            }
                                        ?>
                                    </div>
                                    <i class="icon-envelope-alt"></i>
                                    <span>Pesan</span>
                                </a>
                            </li>
                            <li class="<?php if($this->uri->segment(1) == 'teman'){ echo 'active';}else{ echo '';} ?>">
                                <a href="<?=base_url()."teman"?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Teman"> <i class="icon-user"></i> 
                                    <span>Teman</span> 
                                </a>
                            </li>
                        </ul>
                    </nav> 
                    <!-- / nav --> 
                    </section>
                </section>
            </aside> <!-- /.aside -->
            <!-- .vbox --> 
            <section id="content"> 
                <section class="hbox stretch"> 
                    <aside class="aside-lg bg-light"> 
                        <section class="vbox lter b-r">
                            <header class="header text-center bg-white pos-rlt navbar navbar-default show"> 
                                <p class="h5">Interaksi Dosen dan Mahasiswa</p> 
                                <span class="arrow left"></span>
                            </header>
                            <div class="wrapper">
                                <!-- <section class="panel"> 
                                    <ul class="list-group alt"> 
                                        <li class="list-group-item"> 
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="text-ellipsis" style="width: 180px">
                                                        <a href="<?=base_url()?>teman/profil/<?=$idp?>"><?=$this->session->userdata('nama_lengkap')?></a>                                                        
                                                    </div>
                                                    <span class="text-muted" style="text-transform: capitalize"><?=$this->session->userdata('status_pengguna')?></span>
                                                </div> 
                                            </div>
                                        </li> 
                                    </ul> 
                                </section> -->
                                <!-- PT -->
                                <?php
                                    $idp = $this->session->userdata('idp');
                                    $q_pt = $this->db->query("SELECT a.* FROM perguruan_tinggi AS a LEFT JOIN pt_pengguna AS b ON a.kode_pt = b.kode_pt WHERE b.id_pengguna = '$idp'");
                                    $jml_pt = $q_pt->num_rows();
                                    $r_pt = $q_pt->row();
                                ?>
                                <section class="panel"> 
                                    <header class="panel-heading"> Perguruan Tinggi
                                        <?php if($jml_pt <= 0){ ?>
                                            <a href="#" data-toggle="modal" data-target=".pt-form" class="pull-right btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Tambah" data-original-title="Tambah">
                                                <i class="icon-plus"></i>
                                            </a>
                                        <?php  } ?>
                                    </header> 
                                    <ul class="list-group alt"> 
                                        <li class="list-group-item"> 
                                            <div class="media">
                                                <?php if($jml_pt > 0){ ?>
                                                    <div class="media-body"> 
                                                        <div>
                                                            <?=anchor('pt/lihat/'.$r_pt->kode_pt.'', $r_pt->nama_pt, array('class' => ''));?>
                                                        </div>
                                                        <span class='text-muted'>Kode : <?=$r_pt->kode_pt?></span>
                                                    </div> 
                                                <?php }else{
                                                    echo "<span class='text-muted'>Belum ada</span>";
                                                } ?>
                                            </div> 
                                        </li> 
                                    </ul> 
                                    <!-- <footer class="panel-footer text-sm">Check more data</footer>  -->
                                </section>
                                <!-- Kelas -->
                                <section class="panel"> 
                                    <header class="panel-heading">Kelas
                                        <a href="#" data-toggle="modal" data-target=".kelas-form" class="pull-right btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Tambah" data-original-title="Tambah">
                                            <i class="icon-plus"></i>
                                        </a>
                                    </header> 
                                    <ul class="list-group alt">
                                        <?php 
                                            $q_kelas = $this->db->query("SELECT b.nama_kelas, b.kode_kelas, b.jurusan, c.nama_lengkap FROM kelas_pengguna AS a 
                                                                            LEFT JOIN kelas AS b ON a.kode_kelas = b.kode_kelas
                                                                            LEFT JOIN pengguna AS c ON b.id_pengguna = c.id_pengguna
                                                                            WHERE a.id_pengguna = '$idp'
                                                                        ");

                                            if ($q_kelas->num_rows() > 0)
                                            {
                                                foreach ($q_kelas->result() as $r_kelas)
                                                {
                                                    echo '<li class="list-group-item"> 
                                                            <div class="media"> 
                                                                <div class="media-body"> 
                                                                    <div>
                                                                        <a href="'.base_url().'kelas/masuk/'.$r_kelas->kode_kelas.'">'.$r_kelas->nama_kelas.'</a>
                                                                    </div> 
                                                                    <small class="text-muted">Kode : '.$r_kelas->kode_kelas.'</small> 
                                                                </div> 
                                                            </div> 
                                                        </li>';
                                                }
                                            }else{
                                                echo '<li class="list-group-item"> 
                                                            <div class="media"> 
                                                                <div class="media-body"> 
                                                                    <div>
                                                                        <a href="#" class="text-muted">Belum ada</a>
                                                                    </div>
                                                                </div> 
                                                            </div> 
                                                        </li>';
                                            }
                                        ?>
                                    </ul> 
                                    <?php if($q_kelas->num_rows() > 0){ ?>
                                        <footer class="panel-footer text-sm">
                                            <?=anchor('kelas', 'List Kelas', array('class' => 'label bg-info'));?>
                                        </footer> 
                                    <?php } ?>
                                </section>
                            </div>        
                        </section> 
                    </aside>
                    <aside class="bg-light">
                        <?php
                            if(isset($content)){ 
                                $this->load->view($content);
                            }
                        ?>
                    </aside>
                </section> 
            </section> 
            <!-- /.vbox --> 
        </section>
        <!-- form tambah PT -->
            <?php $this->load->view('pt/form_modal'); ?>
        <!-- end form tambah pt -->
            
        <!-- form tambah kelas -->
            <?php $this->load->view('kelas/form_modal'); ?>
        <!-- end form tambah kelas -->
        
        <?php 
            $query_cari_pt = $this->db->query("SELECT * FROM perguruan_tinggi");
            $data_pt = array();
            foreach ($query_cari_pt->result() as $rpt)
            {
                $data_pt[] = $rpt->nama_pt;
            }
        ?>
        <!-- App -->
        <script>
            $('.modal').on('hidden.bs.modal', function(){
                $(this).find('form')[0].reset();
                $(this).find('#bbb')[0].reset();
                $(this).find('#ccc')[0].reset();
                $('#bbb').parsley().reset();
                $('#ccc').parsley().reset();
                // $("span.tdk_ada").remove();
                // $("ul.parsley-error-list").remove();
                // $(".form-control").removeClass("parsley-error");
            });
            var cari_nama_pt = <?php echo json_encode($data_pt); ?>;
 
            $('#cari_nama_pt').typeahead({source: cari_nama_pt});

            $(document).ready(function(){
                $('.dataTable').dataTable({
                    "scrollX": true
                });
            });
        </script>
        <?php 
            $flashmessage = $this->session->flashdata('message');
            if (!empty($flashmessage)) {
        ?>
            <script type="text/javascript">
                $(function(){
                    new PNotify({
                        title: 'Notifikasi',
                        type: 'success',
                        text: '<?=$flashmessage?>'
                    });
                });
            </script>
        <?php
        }
        if(validation_errors()){
            $error = preg_replace("/(\n)+/m", ' ', validation_errors());
        ?>
            <script type="text/javascript">
                $(function(){
                    new PNotify({
                        title: 'Notifikasi',
                        type: 'error',
                        text: '<?=$error?>'
                    });
                });
            </script>
        <?php } ?>
    </body>
</html>