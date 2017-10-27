<?php
$idp = $this->session->userdata('idp');
$status_pengguna = $this->session->userdata('status_pengguna');
$kode_kelas = $this->uri->segment(3);
if($status_pengguna == "dosen")
    { 
?>
    	<p>
            <?php echo anchor('tugas/tambah/'.$kode_kelas.'', '<i class="icon-plus pull-right"></i> Tambah Tugas', array('class' => 'btn btn-success btn-block')); ?>
    	</p>
<?php } //end if dosen 
    $this->db->where('kode_kelas', $kode_kelas);
    $this->db->from('tugas');
    $jml = $this->db->count_all_results();

    if ($jml == 0) {
        echo '
            <div class="alert alert-warning alert-block"> 
                <h5><i class="icon-bell-alt"></i>Pemberitahuan!</h5> 
                <p class="h5">Data tugas belum ada</p> 
            </div>
        ';
    }
?>
<div class="row">
<?php
foreach ($query_tugas as $row_tugas){
    $file_tugas = $row_tugas->file_tugas;
?>
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?=$row_tugas->nama_tugas?>
            <?php
                //
                $tgl_sekarng = date("Y-m-d");
                $batas_pengumpulan = $row_tugas->batas_pengumpulan;

                $query_cek_tugas = $this->db->query("SELECT id_nilai_tugas FROM nilai_tugas WHERE id_pengguna = '$idp' AND id_tugas = '$row_tugas->id_tugas'");

                //cek sudah dibaca atau belum
                $q_cek_tugas_baca = $this->db->query("SELECT id_notifikasi FROM notifikasi WHERE id_pemeberitahuan = '$row_tugas->nama_tugas' AND id_pengguna = '$idp' AND status_dilihat = '0'");
                
                if(($q_cek_tugas_baca->num_rows() > 0) AND ($tgl_sekarng <= $batas_pengumpulan) AND ($query_cek_tugas->num_rows() == 0)){
                    echo '<span style="cursor:pointer;" class="label bg-warning">Baru</span>';
                }
            ?>
        </header> 
        <div class="clearfix m-t-lg m-b-lg padder">
            <p>Deskripsi :</p>
            <p><?=$row_tugas->isi_tugas?></p>
            <p><strong>Batas Pengumpulan : <?=tgl_indo($row_tugas->batas_pengumpulan)?></strong></p>
            <?php if($status_pengguna == "mahasiswa"){ 
                    $query_nilai = $this->db->query("SELECT nilai_tugas FROM nilai_tugas WHERE id_pengguna = '$idp' AND id_tugas = '$row_tugas->id_tugas'");
                    $row_nilai = $query_nilai->row();
                    if($query_nilai->num_rows() > 0){
                        echo "<strong>Nilai : ".$row_nilai->nilai_tugas."</strong>";
                    }else{
                        echo "<strong>Nilai : -</strong>";
                    }
                }

                if(($tgl_sekarng > $batas_pengumpulan) AND ($query_cek_tugas->num_rows() == 0)){
                    // echo "<span class='text-danger'>Anda Melewati Batas Pengumpulan</span>";
                    //echo anchor('#', 'Anda Melewati Batas Pengumpulan', array('class' => 'btn btn-danger btn-sm text-ellipsis'));
                    if ($status_pengguna == "mahasiswa") {
                        echo "<br>";
                        echo '<span style="cursor:pointer;" class="label bg-danger">Anda Melewati Batas Pengumpulan</span>';
                    }
                }
            ?>
        </div> 
        <footer class="panel-footer bg-light lt">
            <div class="btn-group btn-group-justified">
                <!-- <span class="text-muted"><i class="icon-time"></i> <?=$row_tugas->datecreated?></span> -->
                <?php
                    if(!empty($file_tugas)){
                        echo anchor('tugas/download/'.$row_tugas->id_tugas.'', '<i class="icon-cloud-download"></i>Download Tugas', array('class' => 'btn btn-white btn-sm text-ellipsis')); 
                    }

                    if($status_pengguna == "dosen")
                    {
                        echo anchor('tugas/ubah/'.$row_tugas->id_tugas.'', '<i class="icon-edit"></i>Edit ', array('class' => 'btn btn-white btn-sm')); 
                        echo anchor('tugas/hapus/'.$row_tugas->id_tugas.'/'.$row_tugas->kode_kelas.'', '<i class="icon-trash"></i>Hapus', array('class' => 'btn btn-white btn-sm', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')")); 
                        echo anchor('tugas/nilai/'.$row_tugas->id_tugas.'/'.$row_tugas->kode_kelas.'', '<i class="icon-gear"></i>Nilai ', array('class' => 'btn btn-white btn-sm')); 
                    }else{
                        
                        if($tgl_sekarng <= $batas_pengumpulan && $query_nilai->num_rows() == 0){
                            echo anchor('tugas/kumpul/'.$row_tugas->id_tugas.'/'.$row_tugas->kode_kelas.'', '<i class="icon-cloud-upload"></i>Kumpulkan Tugas ', array('class' => 'btn btn-white btn-sm text-ellipsis')); 
                        }
                    }
                ?>
            </div>
        </footer> 
    </section>
</div>
<?php } //end foreach ?>
</div>
