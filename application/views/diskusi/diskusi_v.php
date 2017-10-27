<?php 
    $idp = $this->session->userdata('idp');
    $kode_kelas = $this->uri->segment(3);

    $query_img = $this->db->query("SELECT foto_profil, nama_lengkap FROM pengguna WHERE id_pengguna = '$idp'");
    $row_img = $query_img->row();

    $data_notifikasi = array(
       'status_dilihat' => '1'
    );

    $where = "(kode_mark = '$kode_kelas' AND id_pengguna = '$idp') AND tipe_notifikasi = 'diskusi' OR tipe_notifikasi = 'komendiskusi'";
    $this->db->where($where);
    $this->db->update('notifikasi', $data_notifikasi);
?>
<script>
    $(document).ready(function(){
        // Update Status
        $(".btnDiskusi").click(function(){
            var id_pengguna = $("#id_pengguna").val();
            var kode_kelas  = $("#kode_kelas").val();
            var isi_diskusi = $("#isi_diskusi").val();

            var dataString = 'id_pengguna='+id_pengguna+'&kode_kelas='+kode_kelas+'&isi_diskusi='+isi_diskusi;

            if(isi_diskusi == '')
            {
                $("#notifikasi").html('Harap isi diskusi mu dulu');
                $("#notifikasi").fadeIn(1500);
                $("#notifikasi").fadeOut(1500); 
            }
            else
            {
                $("#flash").show();
                $("#flash").fadeIn(400).html('Loading Update...');
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url() ?>diskusi/buat",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $("#flash").fadeOut('slow');
                        // $("#data_status").prepend(html);
                        $("#data_diskusi").load("<?php echo base_url() ?>kelas/masuk/<?=$kode_kelas?> #data_diskusi");
                        $("#isi_diskusi").val('');   
                        $("#isi_diskusi").focus();

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

            var id_pengguna         = $("#id_pengguna"+ID).val();
            var id_diskusi          = $("#id_diskusi"+ID).val();
            var isi_jawab_diskusi   = $("#isi_jawab_diskusi"+ID).val();
            var kode_kelas          = $("#kode_kelas"+ID).val();

            var dataString = 'id_pengguna='+id_pengguna+'&id_diskusi='+id_diskusi+'&isi_jawab_diskusi='+isi_jawab_diskusi+'&kode_kelas='+kode_kelas;

            if(isi_jawab_diskusi=='')
            {
                alert("Tuliskan komentar mu");
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url() ?>diskusi/komen",
                    data: dataString,
                    cache: false,
                    success: function(html){
                        // $("#commentload"+ID).append(html);
                        $("#data_komen"+ID).load("<?php echo base_url() ?>kelas/masuk/<?=$kode_kelas?> #data_komen"+ID);
                        $("#isi_jawab_diskusi"+ID).val('');
                        timer.play();
                    }
                });
            }
            return false;
        });
    });

    function hapus_diskusi(id){
        if(confirm('Anda yakin menghapus diskusi ini?')){
            $().ready(function(){                                        
                $.ajax({                    
                    url : "<?php echo base_url() ?>diskusi/hapus_diskusi/"+id,        
                    beforeSend: function(){ 
                        // $("#data_status").html("Loading...");
                    },                                                
                    success: function(html){
                        $("#data_diskusi").load("<?php echo base_url() ?>kelas/masuk/<?=$kode_kelas?> #data_diskusi");
                    }                
                });                    
            });    
        }        
    }

    function hapus_komen(id){
        if(confirm('Anda yakin menghapus komentar diskusi ini?')){
            $().ready(function(){                                        
                $.ajax({                    
                    url : "<?php echo base_url() ?>diskusi/hapus_komen/"+id,        
                    beforeSend: function(){
                        // $("#data_status").html("Loading...");
                    },                                                
                    success: function(html){
                        $("#data_diskusi").load("<?php echo base_url() ?>kelas/masuk/<?=$kode_kelas?> #data_diskusi");
                    }                
                });                    
            });    
        }        
    }

    // $(document).ready(function(){
        var timer = $.timer(function() {
            $("#data_diskusi").load("<?php echo base_url() ?>kelas/masuk/<?=$kode_kelas?> #data_diskusi");
        });
        timer.set({ time : 3000, autostart : true });
    // });
</script>
<div id="notifikasi" style="display:none" class="alert alert-danger"></div>
<section class="panel"> 
    <form id="bbb" method="post" action="">
        <input type="hidden" name="id_pengguna" id="id_pengguna" value="<?=$idp?>">
        <input type="hidden" name="kode_kelas" id="kode_kelas" value="<?=$kode_kelas?>">
        <textarea class="form-control no-border" name="isi_diskusi" id="isi_diskusi" rows="5" placeholder="Ajukan diskusi mu..."></textarea> 
    </form> 
    <footer class="panel-footer bg-light lt">
        <input type="submit" value="Kirim" id="btnDiskusi" class="btnDiskusi btn btn-success btn-sm"/>
        <ul class="nav nav-pills nav-sm"></ul>
    </footer> 
</section>
<div id="data_diskusi">
<?php 
    $this->db->select('diskusi.*, pengguna.nama_lengkap, pengguna.foto_profil, pengguna.status_pengguna');
    $this->db->from('diskusi');
    $this->db->join('pengguna', 'pengguna.id_pengguna = diskusi.id_pengguna', 'left');
    $this->db->where('kode_kelas', $kode_kelas);
    $this->db->order_by('id_diskusi','DESC');
    $query_diskusi = $this->db->get();

    if ($query_diskusi->num_rows() == 0) {
        echo '
            <div class="">
                <div class="alert alert-warning alert-block"> 
                    <h5><i class="icon-bell-alt"></i>Pemberitahuan!</h5> 
                    <p class="h5">Data diskusi belum ada</p> 
                </div>
            </div>
        ';
    }else{
        foreach ($query_diskusi->result() as $row) {
           
?>
<section class="panel"> 
    <div class="panel-body"> 
        <div class="clearfix m-b">
            <?php if($idp == $row->id_pengguna){?>
                <div class="actions pull-right">
                    <a href="#" onclick="hapus_diskusi('<?php echo $row->id_diskusi; ?>')" class="label label-danger">Hapus</a>
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
        <p><?=$row->isi_diskusi?></p> 
    </div>
    <footer class="panel-footer pos-rlt bg-light lt">
        <div id="data_komen<?=$row->id_diskusi?>">
            <?php
                //komentar
                $query_komen = $this->db->query("SELECT a.*, b.nama_lengkap, b.foto_profil, b.status_pengguna FROM jawab_diskusi AS a LEFT JOIN pengguna AS b ON a.id_pengguna = b.id_pengguna WHERE a.id_diskusi = '$row->id_diskusi' ORDER BY a.id_jawab_diskusi ASC");
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
                                    <a href="#" onclick="hapus_komen('<?php echo $row_komen->id_jawab_diskusi; ?>')" class="label label-danger">Hapus</a>
                                </div>
                            <?php } ?>
                            <small class="text-muted pull-right timeago" title="<?=$row_komen->datecreated?>"></small> 
                            <div class="clear"> 
                                <a href="#"><strong><?=$row_komen->nama_lengkap?></strong></a> 
                                <small class="block text-muted" style="text-transform: capitalize;"><?=$row_komen->status_pengguna?></small> 
                            </div> 
                            <p><?=$row_komen->isi_jawab_diskusi?></p>
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
                        <textarea class="form-control" cols="50" id="isi_jawab_diskusi<?=$row->id_diskusi?>" name="isi_jawab_diskusi" placeholder="Beri komentar..." rows="3" onfocus="timer.stop();" onblur="timer.play();"></textarea>
                        <input type="hidden" name="id_pengguna" id="id_pengguna<?=$row->id_diskusi?>" value="<?=$idp?>">
                        <input type="hidden" name="id_diskusi" id="id_diskusi<?=$row->id_diskusi?>" value="<?php echo set_value('id_diskusi', isset($row->id_diskusi) ? $row->id_diskusi : ''); ?>">
                        <input type="hidden" name="kode_kelas" id="kode_kelas<?=$row->id_diskusi?>" value="<?=$kode_kelas?>">

                        <div class="button-komen">
                            <!-- <input type="submit" value="Kirim" class="btnKomen btn btn-success btn-sm" id="<?=$row->id_diskusi?>"> -->
                            <input type="submit"  value="Kirim"  id="<?=$row->id_diskusi?>"  class="btnKomen btn btn-success btn-sm"/>
                            <!-- <button id="<?=$row->id_diskusi?>" class="btnKomen btn btn-success btn-sm" type="button">Kirim</button> -->
                            <button class="btn btn-default btn-sm" type="reset">Batal</button>
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </footer> 
</section>
<?php 
    }//end foreach
}//end if dikusi ada ?>
</div>