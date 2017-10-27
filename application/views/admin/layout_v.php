<?php 
    $idp = $this->session->userdata('id_admin');
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

        <style>

            th, td { white-space: nowrap; }
            div.dataTables_wrapper {
                overflow-y: auto;
            }
        </style>

    </head>
    <body> 
        <section class="vbox">
            <header class="header bg-black navbar navbar-inverse pull-in"> 
                <div class="navbar-header nav-bar aside aside-lg dk"> 
                    <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-primary"> 
                        <i class="icon-reorder"></i> 
                    </a> 
                    <a href="#" class="nav-brand">
                        inDosma
                    </a> 
                    <a class="btn btn-link visible-xs collapsed" data-toggle="collapse" data-target=".navbar-collapse"> 
                        <i class="icon-comment-alt"></i> 
                    </a> 
                </div> 
                <div class="navbar-collapse collapse" style="height: 1px;"> 
                    <ul class="nav navbar-nav navbar-right"> 
                        <li class="dropdown"> 
                            <a href="#" class="dropdown-toggle dker" data-toggle="dropdown"> 
                                <span class="thumb-sm avatar pull-left m-t-n-xs m-r-xs"> 
                                    <img src="<?=base_url()?>avatar/thumb/<?php echo $row_img->foto_profil; ?>" style="width: 28px; height: 28px;"> 
                                </span>Halo, <?=$nama_lengkap[0]?> <b class="caret"></b> 
                            </a> 
                            <ul class="dropdown-menu animated fadeInLeft"> 
                                <li>
                                    <a href="<?php echo base_url().'admin/profil/lihat/'.$this->session->userdata('id_admin').''; ?>">
                                        Profil
                                    </a>
                                </li> 
                                <li>
                                    <a href="<?php echo base_url().'admin/profil/ganti_password/'.$this->session->userdata('id_admin').''; ?>">
                                        Ganti Password
                                    </a>
                                </li> 
                                <li><?=anchor('admin/login/proses_logout', 'Log out');?></li> 
                            </ul> 
                        </li> 
                    </ul> 
                </div> 
            </header>
            <!-- .aside --> 
            <section>
                <section class="hbox stretch">
                    <aside class="aside aside-lg bg-dark" id="nav"> 
                        <section class="vbox">
                            <section class="w-f">
                                <!-- nav --> 
                                <nav class="nav-primary hidden-xs"> 
                                    <ul class="nav"> 
                                        <li class="<?php if($this->uri->segment(2) == 'dashboard'){ echo 'active';}else{ echo '';} ?>">
                                            <a href="<?=base_url()."admin/dashboard"?>"> <i class="icon-desktop"></i> 
                                                <span>Dashboard</span> 
                                            </a> 
                                        </li>
                                        <li class="dropdown-submenu <?php if($this->uri->segment(2) == 'laporan'){ echo 'active';}else{ echo '';} ?>">
                                            <a href="#"> <i class="icon-file"></i> 
                                                <span>Laporan</span> 
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li> <a href="<?=base_url()."admin/laporan/pengguna"?>">Laporan Data Pengguna</a></li>
                                                <li> <a href="<?=base_url()."admin/laporan/pt"?>">Laporan Data Perguruan Tinggi</a></li>
                                                <li> <a href="<?=base_url()."admin/laporan/kelas"?>">Laporan Data Kelas</a></li>
                                            </ul>
                                        </li>
                                        <li class="<?php if($this->uri->segment(2) == 'pengguna'){ echo 'active';}else{ echo '';} ?>">
                                            <a href="<?=base_url()."admin/pengguna"?>"> <i class="icon-user"></i> 
                                                <span>Data Pengguna</span> 
                                            </a>
                                        </li>
                                        <li class="<?php if($this->uri->segment(2) == 'pt'){ echo 'active';}else{ echo '';} ?>">
                                            <a href="<?=base_url()."admin/pt"?>"> <i class="icon-building"></i> 
                                                <span>Data Perguruan Tinggi</span> 
                                            </a>
                                        </li>
                                        <li class="<?php if($this->uri->segment(2) == 'kelas'){ echo 'active';}else{ echo '';} ?>">
                                            <a href="<?=base_url()."admin/kelas"?>"> <i class="icon-beaker"></i> 
                                                <span>Data Kelas</span> 
                                            </a>
                                        </li>
                                        <li class="<?php if($this->uri->segment(2) == 'pesan'){ echo 'active';}else{ echo '';} ?>">
                                            <a href="<?=base_url()."admin/pesan"?>"> <i class="icon-envelope"></i> 
                                                <span>Data Pesan</span> 
                                            </a>
                                        </li>
                                        <li class="<?php if($this->uri->segment(2) == 'jawabpesan'){ echo 'active';}else{ echo '';} ?>">
                                            <a href="<?=base_url()."admin/jawabpesan"?>"> <i class="icon-envelope-alt"></i> 
                                                <span>Data Jawaban Pesan</span> 
                                            </a>
                                        </li>
                                        <li class="<?php if($this->uri->segment(2) == 'status'){ echo 'active';}else{ echo '';} ?>">
                                            <a href="<?=base_url()."admin/status"?>"> <i class="icon-comments-alt"></i> 
                                                <span>Data Status</span> 
                                            </a>
                                        </li>
                                        <li class="<?php if($this->uri->segment(2) == 'komenstatus'){ echo 'active';}else{ echo '';} ?>">
                                            <a href="<?=base_url()."admin/komenstatus"?>"> <i class="icon-comment-alt"></i> 
                                                <span>Data Komentar Status</span> 
                                            </a>
                                        </li>
                                    </ul>
                                </nav> 
                                <!-- / nav --> 
                            </section>
                            <!-- <footer class="footer bg-gradient hidden-xs"> 
                                <a href="<?=base_url()."admin/login/proses_logout"?>" class="btn btn-sm btn-link m-r-n-xs pull-right">
                                    <i class="icon-off"></i> 
                                </a>
                            </footer> -->
                        </section>
                    </aside> <!-- /.aside -->
                    <!-- .vbox --> 
                    <section> 
                        <section class="vbox">
                            <section class="scrollable">
                                <div class="header b-b bg-white-only"> 
                                    <div class="row"> 
                                        <div class="col-sm-4">
                                            <h4 class="m-t m-b-none"><?=$title_box?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrapper">
                                    <?php
                                        if(isset($content)){ 
                                            $this->load->view($content);
                                        }
                                    ?>
                                </aside>
                            </section>
                        </section> 
                    </section> 
                    <!-- /.vbox -->
                </section>
            </section>
        </section>
        
        <!-- App -->
        <script>
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