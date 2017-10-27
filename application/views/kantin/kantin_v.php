<?php 
    $idp = $this->session->userdata('idp');
    //cari kode pt
    $query_cari_pt = $this->db->query("SELECT kode_pt FROM pt_pengguna WHERE id_pengguna = '$idp'");
    $row_pt = $query_cari_pt->row();

    $query_img = $this->db->query("SELECT foto_profil FROM pengguna WHERE id_pengguna = '$idp'");
    $row_img = $query_img->row();

    $data_notifikasi_status = array(
       'status_dilihat' => '1'
    );

    $where_status = "tipe_notifikasi = 'status' AND id_pengguna = '$idp'";
    $this->db->where($where_status);
    $this->db->update('notifikasi', $data_notifikasi_status);

    $data_notifikasi_komen = array(
       'status_dilihat' => '1'
    );

    $where_komen = "tipe_notifikasi = 'komentar' AND id_pengguna = '$idp'";
    $this->db->where($where_komen);
    $this->db->update('notifikasi', $data_notifikasi_komen);
?>
<script>
    $(document).ready(function(){
        // Update Status
        $(".btnBagikan").click(function(){
            var id_pengguna = $("#id_pengguna").val();
            var kode_pt     = $("#kode_pt").val();
            var isi_status  = $("#isi_status").val();

            var dataString = 'id_pengguna='+id_pengguna+'&kode_pt='+kode_pt+'&isi_status='+isi_status;

            if(isi_status == '')
            {
                $("#notifikasi").html('Harap isi status mu dulu');
                $("#notifikasi").fadeIn(1500);
                $("#notifikasi").fadeOut(1500); 
            }
            else
            {
                $("#flash").show();
                $("#flash").fadeIn(400).html('Loading Update...');
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url() ?>status/buat",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $("#flash").fadeOut('slow');
                        // $("#data_status").prepend(html);
                        $("#data_status").load("<?php echo base_url() ?>dashboard #data_status");
                        $("#isi_status").val('');   
                        
                    }
                });
            }
            return false;
        });

        //commment Submint
        // $('.btnKomen').live("click",function(){
        // $(".btnKomen").click(function(){
        // $("#post").on("click", ".btnKomen", function() {
            $(document).on('click', '.btnKomen', function(e) {

            var ID = $(this).attr("id");

            var id_pengguna     = $("#id_pengguna"+ID).val();
            var id_status       = $("#id_status"+ID).val();
            var isi_komentar    = $("#isi_komentar"+ID).val();

            var dataString = 'id_pengguna='+id_pengguna+'&id_status='+id_status+'&isi_komentar='+isi_komentar;

            if(isi_komentar=='')
            {
                alert("Tuliskan komentar mu");
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url() ?>status/komen",
                    data: dataString,
                    cache: false,
                    success: function(html){
                        // $("#commentload"+ID).append(html);
                        $("#data_komen"+ID).load("<?php echo base_url() ?>dashboard #data_komen"+ID);
                        $("#isi_komentar"+ID).val('');
                        // timer.toggle();
                        timer.play();
                    }
                });
            }
            return false;
        });

    });

    function hapus_status(id){
        if(confirm('Anda yakin menghapus status ini?')){
            $().ready(function(){                                        
                $.ajax({                    
                    url : "<?php echo base_url() ?>status/hapus_status/"+id,        
                    beforeSend: function(){ 
                        // $("#data_status").html("Loading...");
                    },                                                
                    success: function(html){
                        $("#data_status").load("<?php echo base_url() ?>dashboard #data_status");
                    }                
                });                    
            });    
        }        
    }

    function hapus_komen(id){
        if(confirm('Anda yakin menghapus komentar ini?')){
            $().ready(function(){                                        
                $.ajax({                    
                    url : "<?php echo base_url() ?>status/hapus_komen/"+id,        
                    beforeSend: function(){
                        // $("#data_status").html("Loading...");
                    },                                                
                    success: function(html){
                        $("#data_status").load("<?php echo base_url() ?>dashboard #data_status");
                    }                
                });                    
            });    
        }        
    }

    // $(document).ready(function(){
        var timer = $.timer(function() {
            $("#data_status").load("<?php echo base_url() ?>dashboard #data_status");
        });
        timer.set({ time : 3000, autostart : true });
    // });
</script>
<section id="list-status" class="vbox"> 
    <header class="bg-light lter b-b header clearfix">
        <p class="h4"><?=$title_box?></p>
    </header> 
    <section class="scrollable"> 
        <div class="wrapper list">
            <!-- content -->
            <?php 
                if ($query_cari_pt->num_rows() <= 0) {
                    echo '
                            <div class="">
                                <div class="alert alert-warning alert-block"> 
                                    <h5><i class="icon-bell-alt"></i>Pemberitahuan!</h5> 
                                    <p class="h5">Data perguruan tinggi belum ada</p> 
                                </div>
                            </div>
                        ';
                }else{
            ?>
                <div id="notifikasi" style="display:none" class="alert alert-danger"></div>
                <section class="panel"> 
                    <form id="bbb" method="post" action="">
                        <input type="hidden" name="id_pengguna" id="id_pengguna" value="<?=$idp?>">
                        <input type="hidden" name="kode_pt" id="kode_pt" value="<?php echo set_value('kode_pt', isset($row_pt->kode_pt) ? $row_pt->kode_pt : ''); ?>">
                        <textarea name="isi_status" id="isi_status" class="form-control no-border" rows="5" placeholder="Bagi informasi untuk teman mu..."></textarea> 
                    </form> 
                    <footer class="panel-footer bg-light lt"> 
                        <!-- <button id="btnBagikan" class="btnBagikan btn btn-success pull-right btn-sm">Bagikan</button> -->
                        <input type="submit" value="Bagikan" id="btnBagikan" class="btnBagikan btn btn-success btn-sm pull-right"/>
                        <ul class="nav nav-pills nav-sm"></ul>
                    </footer> 
                </section>
                <div id='flashmessage'>
                    <div id="flash" align="left"></div>
                </div>
                <div id="data_status">
                    <?php
                        $this->db->select('status.*, pengguna.nama_lengkap, pengguna.foto_profil, pengguna.status_pengguna');
                        $this->db->from('status');
                        $this->db->join('pengguna', 'pengguna.id_pengguna = status.id_pengguna', 'left');
                        $this->db->where('kode_pt', $row_pt->kode_pt);
                        $this->db->order_by('id_status','DESC');
                        $query_status = $this->db->get();

                        if ($query_status->num_rows() == 0) {
                            echo '
                                <div class="">
                                    <div class="alert alert-warning alert-block"> 
                                        <h5><i class="icon-bell-alt"></i>Pemberitahuan!</h5> 
                                        <p class="h5">Data status belum ada</p> 
                                    </div>
                                </div>
                            ';
                        }else{

                            foreach ($query_status->result() as $row) {
                            //status
                    ?>
                            <section class="panel"> 
                                <div class="panel-body"> 
                                    <div class="clearfix m-b">
                                        <?php if($idp == $row->id_pengguna){?>
                                            <div class="actions pull-right">
                                                <a href="#" onclick="hapus_status('<?php echo $row->id_status; ?>')" class="label label-danger">Hapus</a>
                                            </div>
                                        <?php } ?>
                                        <small class="text-muted pull-right timeago" title="<?=$row->datecreated?>"></small> 
                                        <a href="#" class="thumb-sm pull-left m-r"> 
                                            <img src="<?=base_url()?>avatar/thumb/<?php echo $row->foto_profil; ?>" alt="" style="width: 36px; height: 36px;" class="img-circle">
                                        </a> 
                                        <div class="clear"> 
                                            <a href="#"><strong><?=$row->nama_lengkap?></strong></a> 
                                            <small class="block text-muted" style="text-transform: capitalize;"><?=$row->status_pengguna?></small> 
                                        </div> 
                                    </div> 
                                    <p><?=$row->isi_status?></p> 
                                </div>
                                <footer class="panel-footer pos-rlt bg-light lt">
                                    <div id="data_komen<?=$row->id_status?>">
                                        <?php
                                            //komentar
                                            $query_komen = $this->db->query("SELECT a.*, b.nama_lengkap, b.foto_profil, b.status_pengguna FROM komentar_status AS a LEFT JOIN pengguna AS b ON a.id_pengguna = b.id_pengguna WHERE a.id_status = '$row->id_status' ORDER BY a.id_komentar_status ASC");
                                            if ($query_komen->num_rows() > 0)
                                            {
                                               foreach ($query_komen->result() as $row_komen)
                                               {
                                        ?>
                                                <div class="media">
                                                    <a class="pull-left thumb-sm" href="#">
                                                        <img src="<?=base_url()?>avatar/thumb/<?php echo $row_komen->foto_profil; ?>" alt="" style="width: 36px; height: 36px;" class="img-circle">
                                                    </a>
                                                    <div class="media-body">
                                                        <?php if($idp == $row_komen->id_pengguna){?>
                                                            <div class="actions pull-right">
                                                                <a href="#" onclick="hapus_komen('<?php echo $row_komen->id_komentar_status; ?>')" class="label label-danger">Hapus</a>
                                                            </div>
                                                        <?php } ?>
                                                        <small class="text-muted pull-right timeago" title="<?=$row_komen->datecreated?>"></small> 
                                                        <div class="clear"> 
                                                            <a href="#"><strong><?=$row_komen->nama_lengkap?></strong></a> 
                                                            <small class="block text-muted" style="text-transform: capitalize;"><?=$row_komen->status_pengguna?></small> 
                                                        </div> 
                                                        <p><?=$row_komen->isi_komentar?></p>
                                                    </div>
                                                </div>
                                        <?php   } //end if
                                            } //end foreach ?>
                                    </div>
                                    <div id="post">
                                        <div class="media">
                                            <a class="pull-left thumb-sm" href="#">
                                                <img src="<?=base_url()?>avatar/thumb/<?php echo $row_img->foto_profil; ?>" alt="" style="width: 36px; height: 36px;" class="media-object img-circle">
                                            </a>
                                            <div class="media-body">
                                                <form method="post" action="">
                                                    <textarea class="form-control form_isi_komentar" cols="50" id="isi_komentar<?=$row->id_status?>" name="isi_komentar" placeholder="Beri komentar..." rows="3" onfocus="timer.stop();" onblur="timer.play();"></textarea>
                                                    <input type="hidden" name="id_pengguna" id="id_pengguna<?=$row->id_status?>" value="<?=$idp?>">
                                                    <input type="hidden" name="id_status" id="id_status<?=$row->id_status?>" value="<?php echo set_value('id_status', isset($row->id_status) ? $row->id_status : ''); ?>">
                            
                                                    <div class="button-komen">
                                                        <!-- <input type="submit" value="Kirim" class="btnKomen btn btn-success btn-sm" id="<?=$row->id_status?>"> -->
                                                        <input type="submit"  value="Kirim"  id="<?=$row->id_status?>"  class="btnKomen btn btn-success btn-sm"/>
                                                        <!-- <button id="<?=$row->id_status?>" class="btnKomen btn btn-success btn-sm" type="button">Kirim</button> -->
                                                        <button class="btn btn-default btn-sm" type="reset">Batal</button>
                                                    </div>
                                                </form>
                                           </div>
                                        </div>
                                    </div>
                                </footer> 
                            </section> 
                    <?php
                        } //end foerach
                    } //end if status masih kosong
                    ?>
                </div>
            <?php } //end if pt belum ada ?>
        </div>
    </section> 
</section>