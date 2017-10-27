<?php 
    $statusp = $this->session->userdata('status_pengguna'); 
    $idp = $this->session->userdata('idp');
?>
<section id="list-kelas" class="vbox"> 
    <header class="bg-light lter b-b header clearfix"> 
        <div class="btn-group pull-right">
            <a href="#" data-toggle="modal" data-target=".kelas-form" class="pull-right btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Tambah" data-original-title="Tambah">
                <i class="icon-plus"></i> Tambah Kelas
            </a>
        </div> 
        <p class="h4"><?=$title_box?></p>
    </header> 
    <footer class="footer bg-light lter b-t hidden-xs">
        <div class="m-t-sm"> 
            <div class="input-group"> 
                <input type="text" class="input-sm form-control input-s-sm fuzzy-search" placeholder="Cari"> 
                <div class="input-group-btn"> 
                    <button class="btn btn-sm btn-white"><i class="icon-search"></i></button> 
                </div> 
            </div> 
        </div>
    </footer> 
    <section class="scrollable"> 
        <div class="wrapper list row">
            <!-- content -->
            <?php 
                $this->db->where('id_pengguna', $idp);
                $this->db->from('kelas_pengguna');
                $jml = $this->db->count_all_results();

                if ($jml == 0) {
                    echo '
                        <div class="col-lg-12">
                            <div class="alert alert-warning alert-block"> 
                                <h5><i class="icon-bell-alt"></i>Pemberitahuan!</h5> 
                                <p class="h5">Data kelas belum ada</p> 
                            </div>
                        </div>
                    ';
                }
            ?>
            <?php foreach ($query as $row){ ?>
                <div class="col-lg-4 memo"> 
                    <section class="panel"> 
                            <header class="panel-heading font-bold nama_kelas"><?=$row->nama_kelas?></header> 
                            <div class="panel-body"> 
                                <a href="#" class="thumb pull-left m-r"> 
                                    <img src="<?=base_url()?>avatar/thumb/<?=$row->foto_profil?>" style="width: 64px; height: 64px;" class="img-circle"> 
                                </a> 
                                <div class="clear"> 
                                    <a href="#" class="text-info nama_dosen"><?=$row->nama_lengkap?></a>
                                    <small class="block text-muted">
                                        <?php
                                            $this->db->where('kode_kelas', $row->kode_kelas);
                                            $this->db->from('kelas_pengguna');
                                            $jml_siswa = $this->db->count_all_results()-1;
                                            echo $jml_siswa." siswa";
                                        ?>
                                    </small>
                                    <div class="btn-group">
                                        <?=anchor('kelas/masuk/'.$row->kode_kelas.'', 'Masuk', array('class' => 'btn btn-xs btn-success m-t-xs'));?>
                                        <?php 
                                            if ($statusp == "dosen") {
                                                echo anchor('kelas/ubah/'.$row->kode_kelas.'', 'Edit', array('class' => 'btn btn-xs btn-warning m-t-xs'));
                                                echo anchor('kelas/hapus_kelas/'.$row->kode_kelas.'', 'Hapus', array('class' => 'btn btn-xs btn-danger m-t-xs', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));
                                            }else{
                                                echo anchor('kelas/hapus/'.$row->kode_kelas.'', 'Hapus', array('class' => 'btn btn-xs btn-danger m-t-xs', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));
                                            }
                                        ?>
                                    </div>
                                </div> 
                            </div>
                            <footer class="panel-footer text-sm">Kode kelas: <span class="kode_kelas"><?=$row->kode_kelas?></span></footer>
                    </section> 
                </div>
            <?php } //end foreach ?>
        </div>
    </section> 
</section> 
<script>
    var monkeyList = new List('list-kelas', { 
        valueNames: ['nama_kelas', 'kode_kelas','nama_dosen'], 
        plugins: [ ListFuzzySearch() ] 
    });
</script>