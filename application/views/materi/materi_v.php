<?php 
$status_pengguna = $this->session->userdata('status_pengguna');
$kode_kelas = $this->uri->segment(3);
if($status_pengguna == "dosen")
    { 
?>
    	<p>
            <?php echo anchor('materi/tambah/'.$kode_kelas.'', '<i class="icon-plus pull-right"></i> Tambah Materi', array('class' => 'btn btn-success btn-block')); ?>
    	</p>
<?php } //end if dosen

    $this->db->where('kode_kelas', $kode_kelas);
    $this->db->from('materi');
    $jml = $this->db->count_all_results();

    if ($jml == 0) {
        echo '
            <div class="alert alert-warning alert-block"> 
                <h5><i class="icon-bell-alt"></i>Pemberitahuan!</h5> 
                <p class="h5">Data materi belum ada</p> 
            </div>
        ';
    }
?>
<div class="row">
<?php
foreach ($query_materi as $row_materi){
    $file_materi = $row_materi->file_materi;
?>
<div class="col-lg-6">
    <section class="panel">
        <header class="panel-heading"><?=$row_materi->nama_materi?></header> 
        <div class="clearfix m-t-lg m-b-lg padder text-ellipsis">
            <?=$row_materi->isi_materi?>
        </div> 
        <footer class="panel-footer bg-light lt">
            <div class="btn-group btn-group-justified">
                <!-- <span class="text-muted"><i class="icon-time"></i> <?=$row_materi->datecreated?></span> -->
                <?php
                    if(!empty($file_materi)){
                        echo anchor('materi/download/'.$row_materi->id_materi.'', '<i class="icon-cloud-download"></i>Download ', array('class' => 'btn btn-white btn-sm text-ellipsis')); 
                    }
                    if($status_pengguna == "dosen")
                    {
                        echo anchor('materi/ubah/'.$row_materi->id_materi.'', '<i class="icon-edit"></i>Edit ', array('class' => 'btn btn-white btn-sm')); 
                        echo anchor('materi/hapus/'.$row_materi->id_materi.'/'.$row_materi->kode_kelas.'', '<i class="icon-trash"></i>Hapus', array('class' => 'btn btn-white btn-sm', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')")); 
                    }
                    echo anchor('materi/detail/'.$row_materi->id_materi.'/'.$row_materi->kode_kelas.'', '<i class="icon-search"></i>Detail ', array('class' => 'btn btn-white btn-sm text-ellipsis')); 
                ?>
            </div>
        </footer> 
    </section>
</div>
<?php } //end foreach ?>
</div>