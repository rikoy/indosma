<?php 
    $idp = $this->session->userdata('idp');
?>
<section id="list-memo" class="vbox"> 
    <header class="bg-light lter b-b header clearfix"> 
        <div class="btn-group pull-right">
            <?=anchor('memo/tambah/', '<i class="icon-plus"></i> Tambah Memo', array('class' => 'btn btn-success btn-sm pull-right"'));?>
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
                <!-- content -->
                <?php 
                    $this->db->where('id_pengguna', $idp);
                    $this->db->from('memo');
                    $jml = $this->db->count_all_results();

                    if ($jml == 0) {
                        echo '
                            <div class="col-lg-12">
                                <div class="alert alert-warning alert-block"> 
                                    <h5><i class="icon-bell-alt"></i>Pemberitahuan!</h5> 
                                    <p class="h5">Data memo belum ada</p> 
                                </div>
                            </div>
                        ';
                    }
                ?>
                <ul id="note-list" class="list list-group">
                <?php foreach ($query as $row){ ?>
                    <div class="col-lg-4 memo">
                        <li class="hover alert alert-info" style="list-style: none;"> 
                            <div class="view" id=""> 
                                <!-- <button class="destroy close ">×</button> -->
                                <div class="btn-group pull-right hover-action"> 
                                    <button class="btn btn-white btn-icon btn-xs dropdown-toggle" data-toggle="dropdown"><span class="icon-cog"></span></button> 
                                    <ul class="dropdown-menu"> 
                                        <li><?=anchor('memo/detail/'.$row->id_memo.'', 'Lihat', array('class' => ''));?></li> 
                                        <li><?=anchor('memo/ubah/'.$row->id_memo.'', 'Edit', array('class' => ''));?></li> 
                                        <li><?=anchor('memo/hapus/'.$row->id_memo.'', 'Hapus', array('class' => '', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));?></li>
                                    </ul> 
                                </div>
                                <div class="note-name"> 
                                    <strong class="judul_memo"><?=$row->judul_memo?></strong> 
                                </div> 
                                <div class="note-desc isi_memo"><?=substr($row->isi_memo, 0, 200)?></div>
                                <!-- <a href='#' class='timeago' title=""></a> -->
                                <span class="text-xs text-muted"><?=$row->datecreated?></span> 
                            </div> 
                        </li>
                    </div>
                <?php } //end foreach ?>
                </ul>
            </div>
        </div>
    </section> 
</section> 
<script>
    var monkeyList = new List('list-memo', { 
        valueNames: ['isi_memo', 'judul_memo'], 
        plugins: [ ListFuzzySearch() ] 
    });
</script>