<?php
    $idp = $this->session->userdata('idp');
?>
<script>
    $().ready(function(){
        $("#btnkirim").click(function(){     /*Ketika tombol Simpan di klik*/            
            var id_pengirim     = $("#id_pengirim").val();
            var id_tujuan       = $("#select2-option").val();
            var judul_pesan     = $("#judul_pesan").val();
            var isi_pesan       = $("#isi_pesan").val();

            /*Pengecekan form. tidak boleh kosong*/
            if($("#judul_pesan").val() == "" || $("#isi_pesan").val() == "" || $("#select2-option").val() == "")
                $.ajax({
                    success: function(html){
                        $("#notifikasi").html('Form tambah pesan harap diisi');
                        $("#notifikasi").fadeIn(2500);
                        $("#notifikasi").fadeOut(2500); 
                    }
                });
            else
            
            $.ajax({
                url : "<?php echo base_url() ?>pesan/kirim",
                type: "POST",
                beforeSend: function(){
                                    $("#loading").fadeIn(3000).html('<img src="<?php echo base_url(); ?>assets/img/loading.gif">');
                                },
                data    : "id_pengirim="+id_pengirim+"&id_tujuan="+id_tujuan+"&judul_pesan="+judul_pesan+"&isi_pesan="+isi_pesan,
                success:    function(html){
                                $("#data_pesan").load("<?php echo base_url() ?>pesan #data_pesan");
                                document.getElementById("bbb").reset();
                                $('#form_pesan').modal('hide');
                            }
            });
        });
    });

    function hapus_pesan(id){
        if(confirm('Anda yakin menghapus pesan ini?')){
            $().ready(function(){                                        
                $.ajax({                    
                    url : "<?php echo base_url() ?>pesan/hapus_pesan/"+id,        
                    beforeSend: function(){
                                        // $("#data_status").html("Loading...");
                                    },                                                
                    success:    function(html){
                                    $("#data_pesan").load("<?php echo base_url() ?>pesan #data_pesan");
                                }                
                });                    
            });    
        }        
    }

    $(document).ready(function(){
        var timer = $.timer(function() {
            $("#data_pesan").load("<?php echo base_url() ?>pesan #data_pesan");
        });
        timer.set({ time : 5000, autostart : true });
    });
</script>
<section id="list-pesan" class="vbox"> 
    <header class="bg-light lter b-b header clearfix"> 
        <div class="btn-group pull-right">
            <?=anchor('#', '<i class="icon-plus"></i> Tambah Pesan', array('class' => 'btn btn-success btn-sm pull-right', 'data-toggle' => 'modal', 'data-target' => '.pesan-form'));?>
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
        <div class="wrapper">
            <div class="row">
                <section class="vbox"> 
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="wizard clearfix" id="form-wizard">
                                <ul class="steps"> <li data-target="" class="active" style="color: #404040;">List <?=$title_box?></li></ul>
                            </div>
                            <ul id="data_pesan" class="list-group list no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
                                <?php

                                    $where = "id_pengirim = '$idp' OR id_tujuan = '$idp'";
                                    $this->db->where($where);
                                    $this->db->from('pesan');
                                    $this->db->join('pengguna', 'pengguna.id_pengguna = pesan.id_tujuan', 'left');
                                    
                                    $jml = $this->db->count_all_results();

                                    if ($jml == 0) {
                                        echo '
                                            <div class="alert alert-warning alert-block m-t m-r m-l"> 
                                                <h5><i class="icon-bell-alt"></i>Pemberitahuan!</h5> 
                                                <p class="h5">Data pesan belum ada</p> 
                                            </div>
                                        ';
                                    }

                                ?>
                                <?php
                                    foreach ($query as $row) {
                                        $query_cek_pengirim = $this->db->query("SELECT nama_lengkap FROM pengguna WHERE id_pengguna = '$row->id_pengirim'");
                                        $row_pengirim = $query_cek_pengirim->row(); 
                                        if ($row->id_pengirim == $idp) {
                                            $pengirim = "Saya";
                                        }else{
                                            $pengirim = $row_pengirim->nama_lengkap;
                                        }

                                        if ($row->id_tujuan == $idp) {
                                            $tujuan = "Saya";
                                        }else{
                                            $tujuan = $row->nama_lengkap;
                                        }
                                ?>
                                <li class="list-group-item">
                                    <?php 
                                        if($idp == $row->id_pengirim){
                                    ?>
                                        <span style="margin-left: 2px; cursor:pointer;" class="label bg-danger pull-right" onclick="hapus_pesan('<?php echo $row->id_pesan ?>')">Hapus</span>
                                    <?php } ?>
                                    <a href="#" class="thumb-sm pull-left m-r-sm"> 
                                        <img src="<?=base_url()?>avatar/thumb/<?php echo $row->foto_profil; ?>" style="width: 36px; height:36px" class="img-circle"> 
                                    </a> 
                                    <a href="<?=base_url()?>pesan/buka/<?=$row->id_pesan?>" class="clear"> 
                                        <small class="pull-right timeago" title="<?=$row->datecreated?>"></small> 
                                        Dari : <strong class="pengirim"><?=$pengirim?></strong>  <br> ke : <strong class="tujuan"><?=$tujuan?></strong>
                                        <span class="text-ellipsis">
                                            <strong class="judul"><?=$row->judul_pesan?></strong> <span class="pesan"><?=$row->isi_pesan?></span>
                                        </span> 
                                    </a>
                                    <?php
                                        //cek sudah dibaca atau belum
                                        $q_cek_pesan_baca = $this->db->query("SELECT status_dilihat FROM pesan WHERE id_pesan = '$row->id_pesan' AND id_tujuan = '$idp' AND status_dilihat = '0'");
                                        
                                        $q_cek_jawaban_baca = $this->db->query("SELECT status_dilihat FROM jawaban_pesan WHERE id_pesan = '$row->id_pesan' AND id_tujuan = '$idp' AND status_dilihat = '0'");
                                        
                                        if(($q_cek_pesan_baca->num_rows() > 0) || ($q_cek_jawaban_baca->num_rows() > 0)){
                                            echo '<span style="cursor:pointer;" class="label bg-warning">Baru</span>';
                                        }
                                    ?>
                                </li>
                                <?php } //end foreach ?>
                            </ul>
                        </div>
                    </div>
                </section> 
            </div>
        </div>
    </section>
</section>
<?php $this->load->view('pesan/form'); ?>
<script>
    var monkeyList = new List('list-pesan', { 
        valueNames: ['pengirim', 'tujuan','pesan', 'judul'], 
        plugins: [ ListFuzzySearch() ] 
    });
</script>