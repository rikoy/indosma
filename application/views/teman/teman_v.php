<?php 
    $idp = $this->session->userdata('idp');
?>
<section id="list-teman" class="vbox"> 
    <header class="bg-light lter b-b header clearfix"> 
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
        <div class="wrapper">
            <div class="row list">
                <!-- content -->
                <?php 
                    $where = "pengguna.id_pengguna != '$idp' AND kode_pt IN
                                        (SELECT kode_pt FROM pt_pengguna WHERE id_pengguna = '$idp') GROUP BY pengguna.id_pengguna";
                    $this->db->where($where);
                    $this->db->from('pt_pengguna');
                    $this->db->join('pengguna', 'pengguna.id_pengguna = pt_pengguna.id_pengguna', 'left');

                    $jml = $this->db->count_all_results();

                    if ($jml <= 0) {
                        echo '
                            <div class="col-lg-12">
                                <div class="alert alert-warning alert-block"> 
                                    <h5><i class="icon-bell-alt"></i>Pemberitahuan!</h5> 
                                    <p class="h5">Data teman belum ada</p> 
                                </div>
                            </div>
                        ';
                    }
                ?>
                <?php foreach ($query as $row){ ?>
                    <div class="col-lg-4">
                        <section class="panel clearfix">
                            <div class="panel-body">
                                <div class="thumb pull-left m-r"> 
                                    <img src="<?=base_url()?>avatar/thumb/<?php echo $row->foto_profil ?>" style="width: 64px; height: 64px;" class="img-circle"> 
                                </div> 
                                <div class="clear"> 
                                    <span class="text-info nama_lengkap"><?=$row->nama_lengkap?></span> 
                                    <small class="block text-muted status_pengguna" style="text-transform: capitalize;"><?=$row->status_pengguna?></small> 
                                    <a href="<?php echo base_url()."teman/profil/".$row->id_pengguna.""; ?>" class="btn btn-xs btn-success m-t-xs">Lihat</a>
                                </div>
                            </div> 
                        </section>
                    </div>
                <?php } //end foreach ?>
            </div>
        </div>
    </section> 
</section> 
<script>
    var monkeyList = new List('list-teman', { 
        valueNames: ['nama_lengkap', 'status_pengguna'], 
        plugins: [ ListFuzzySearch() ] 
    });
</script>