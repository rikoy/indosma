<?php
    $idp = $this->session->userdata('idp');
    $kdpesan = $this->uri->segment(3);
?>
<?php 
    $data_notifikasi = array(
       'status_dilihat' => '1'
    );

    $this->db->where('id_pesan', $kdpesan);
    $this->db->where('id_tujuan', $idp);
    $this->db->update('pesan', $data_notifikasi);

    $data_notifikasi2 = array(
       'status_dilihat' => '1'
    );

    $this->db->where('id_pesan', $kdpesan);
    $this->db->where('id_tujuan', $idp);
    $this->db->update('jawaban_pesan', $data_notifikasi2);
?>
<script>
    $().ready(function(){
        $("#btnBalas").click(function(){     /*Ketika tombol Simpan di klik*/            
            var id_pengirim         = $("#id_pengirim").val();
            var id_tujuan           = $("#id_tujuan").val();
            var id_pesan            = $("#id_pesan").val();
            var isi_jawaban_pesan   = $("#isi_jawaban_pesan").val();

            /*Pengecekan form. tidak boleh kosong*/
            if($("#isi_jawaban_pesan").val() == "")
                $.ajax({
                    success: function(html){
                        $("#notifikasi").html('Form balas pesan harap diisi');
                        $("#notifikasi").fadeIn(2500);
                        $("#notifikasi").fadeOut(2500); 
                    }
                });
            else
            
            $.ajax({
                url : "<?php echo base_url() ?>pesan/balas",
                type: "POST",
                beforeSend: function(){
                                    $("#loading").fadeIn(3000).html('<img src="<?php echo base_url(); ?>assets/img/loading.gif">');
                                },
                data    : "id_pengirim="+id_pengirim+"&id_tujuan="+id_tujuan+"&id_pesan="+id_pesan+"&isi_jawaban_pesan="+isi_jawaban_pesan,
                success:    function(html){
                                $("#data_jawaban").load("<?php echo base_url() ?>pesan/buka/"+id_pesan+" #data_jawaban");
                                $("#isi_jawaban_pesan").val('');
                            }
            });
        });
    });

    function hapus_jawaban(id){
        if(confirm('Anda yakin menghapus pesan ini?')){
            var id_pesan = $("#id_pesan").val();

            $().ready(function(){                                        
                $.ajax({                    
                    url : "<?php echo base_url() ?>pesan/hapus_jawaban/"+id,        
                    beforeSend: function(){
                                        // $("#data_status").html("Loading...");
                                    },                                                
                    success:    function(html){
                                    $("#data_jawaban").load("<?php echo base_url() ?>pesan/buka/"+id_pesan+" #data_jawaban");
                                }                
                });                    
            });    
        }        
    }
    
    $(document).ready(function(){
        var id_pesan = $("#id_pesan").val();
        var timer = $.timer(function() {
            $("#data_jawaban").load("<?php echo base_url() ?>pesan/buka/"+id_pesan+" #data_jawaban");
        });
        timer.set({ time : 3000, autostart : true });
    });
</script>
<section id="list-memo" class="vbox"> 
    <header class="bg-light lter b-b header clearfix"> 
        <p class="h4"><?=$title_box?> : <?php echo set_value('judul_pesan', isset($default['judul_pesan']) ? $default['judul_pesan'] : ''); ?></p>
    </header>
    <section class="scrollable"> 
        <div class="wrapper">
            <div class="row">
                <section class="vbox"> 
                    <div class="col-lg-12">
                        <section class="panel"> 
                            <div class="panel-body"> 
                                <div class="clearfix m-b"> 
                                    <small class="text-muted pull-right timeago" title="<?php echo set_value('datecreated', isset($default['datecreated']) ? $default['datecreated'] : ''); ?>"></small> 
                                    <a href="#" class="thumb-sm pull-left m-r"> 
                                        <img src="<?=base_url()?>avatar/thumb/<?php echo set_value('foto_profil', isset($default['foto_profil']) ? $default['foto_profil'] : ''); ?>" class="img-circle" style="width:36px; height: 36px;"> 
                                    </a> 
                                    <div class="clear"> 
                                        <a href="#"><strong><?php echo set_value('nama_lengkap', isset($default['nama_lengkap']) ? $default['nama_lengkap'] : ''); ?></strong></a> 
                                        <small class="block text-muted" style="text-transform: capitalize;"><?php echo set_value('status_pengguna', isset($default['status_pengguna']) ? $default['status_pengguna'] : ''); ?></small> 
                                    </div> 
                                </div> 
                                <p><?php echo set_value('isi_pesan', isset($default['isi_pesan']) ? $default['isi_pesan'] : ''); ?></p> 
                            </div> 
                        </section>
                    </div>
                </section>
                <div id="data_jawaban">
                <?php
                    foreach ($query as $row) {
                ?>
                    <section class="vbox"> 
                        <div class="col-lg-12">
                            <section class="panel"> 
                                <div class="panel-body"> 
                                    <div class="clearfix m-b">
                                        <?php 
                                            if($idp == $row->id_pengirim){
                                        ?>
                                            <span style="margin-left: 2px; cursor:pointer;" class="label bg-danger pull-right" onclick="hapus_jawaban('<?php echo $row->id_jawaban_pesan ?>')">Hapus</span>
                                        <?php } ?>
                                        <small class="text-muted pull-right timeago" title="<?=$row->datecreated?>"></small> 
                                        <a href="#" class="thumb-sm pull-left m-r"> 
                                            <img src="<?=base_url()?>avatar/thumb/<?=$row->foto_profil?>" class="img-circle" style="width:36px; height: 36px;"> 
                                        </a> 
                                        <div class="clear"> 
                                            <a href="#"><strong><?=$row->nama_lengkap?></strong></a> 
                                            <small class="block text-muted" style="text-transform: capitalize;"><?=$row->status_pengguna?></small> 
                                        </div> 
                                    </div> 
                                    <p><?=$row->isi_jawaban_pesan?></p> 
                                </div> 
                            </section>
                        </div>
                    </section>
                <?php } ?>
                </div>
                <section class="vbox"> 
                    <div class="col-lg-12">
                        <section class="panel"> 
                            <div class="panel-body"> 
                                <div class="clearfix m-b"> 
                                    <a href="#" class="thumb-sm pull-left m-r"> 
                                        <img src="<?=base_url()?>avatar/thumb/<?=$this->session->userdata('avatar')?>" style="width:36px; height: 36px;" class="img-circle"> 
                                    </a> 
                                    <div class="clear"> 
                                        <a href="#"><strong><?=$this->session->userdata('nama_lengkap')?></strong></a> 
                                        <small class="block text-muted" style="text-transform: capitalize;"><?=$this->session->userdata('status_pengguna')?></small> 
                                    </div> 
                                </div>
                                <div id="notifikasi" style="display:none" class="alert alert-danger"></div>
                                <form id="bbb">
                                    <input type="hidden" name="id_pengirim" id="id_pengirim" value="<?=$this->session->userdata('idp')?>">
                                    <!-- <input type="hidden" name="id_tujuan" id="id_tujuan" value="<?php echo set_value('id_tujuan', isset($default['id_tujuan']) ? $default['id_tujuan'] : ''); ?>"> -->
                                    <input type="hidden" name="id_tujuan" id="id_tujuan" value="<?php if($idp == $default['id_pengirim']){echo $default['id_tujuan'];}elseif($idp == $default['id_tujuan']){echo $default['id_pengirim'];} ?>"/>
                                    <input type="hidden" name="id_pesan" id="id_pesan" value="<?php echo set_value('id', isset($default['id']) ? $default['id'] : ''); ?>">
                                    <textarea class="form-control" cols="50" id="isi_jawaban_pesan" name="isi_jawaban_pesan" placeholder="Balas pesan..." rows="3"></textarea>                    
                                    <div class="button-komen">
                                        <button class="btn btn-success btn-sm" type="button" id="btnBalas">Kirim</button>
                                        <button class="btn btn-default btn-sm" type="reset">Batal</button>
                                    </div>
                                </form>
                            </div> 
                        </section>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
<?php $this->load->view('pesan/form'); ?>