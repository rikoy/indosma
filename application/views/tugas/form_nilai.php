<style>

    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        overflow-y: auto;
    }
</style>
<section class="vbox">
    <header class="bg-light lter b-b header clearfix">       
        <p class="h4"><?=$title_box?></p>
    </header> 
    <section class="scrollable">
        <div class="wrapper">
            <div class="row">
                <!-- content -->
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="wizard clearfix" id="form-wizard">
                            <ul class="steps"> <li data-target="" class="active" style="color: #404040;">Form <?=$title_box?></li></ul>
                        </div>
                        <div class="step-content">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" class="" data-validate="parsley" id="bbb">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive"> 
                                            <table class="table m-b-none dataTable" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>NPM</th>
                                                        <th>File Tugas</th>
                                                        <th>Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $i=0;
                                                        foreach ($query as $row){
                                                            $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?=$i?></td>
                                                        <td><?=$row->nama_lengkap?></td>
                                                        <td><?=$row->id_pengguna?></td>
                                                        <td>
                                                            <?php 
                                                                echo anchor('tugas/download_file_tugas/'.$row->id_nilai_tugas.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'', $row->file_tugas , array()); 
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="id_pengguna[]" id="" value="<?=$row->id_pengguna?>">
                                                            <input type="hidden" name="id_tugas" id="" value="<?=$row->id_tugas?>">
                                                            <input type="hidden" name="kode_kelas" id="" value="<?=$this->uri->segment(4)?>">
                                                            <input type="text" name="nilai_tugas[]" id="nilai_tugas" class="" value="<?=$row->nilai_tugas?>" data-type="number" style="width:50px; ">
                                                        </td>
                                                    </tr>
                                                    <?php } //end foreach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <footer class="panel-footer">
                                    <input type="submit" class="btn btn-success btn-sm" value="Simpan">
                                    <?=anchor('tugas/cetak_nilai/'.$this->uri->segment(4).'/'.$this->uri->segment(3).'', 'Cetak', array('class' => 'btn btn-info btn-sm', 'target' => '_blank'));?>
                                    <input type="reset" class="btn btn-warning btn-sm" value="Batal">
                                    <?=anchor('kelas/masuk/'.$this->uri->segment(4).'', 'Kembali', array('class' => 'btn btn-default btn-sm"'));?>
                                </footer>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section> 
</section>