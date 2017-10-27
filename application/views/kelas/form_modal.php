<?php
    //cari kode pt
    $statusp = $this->session->userdata('status_pengguna');
    $idp = $this->session->userdata('idp');
    $query = $this->db->query("SELECT kode_pt FROM pt_pengguna WHERE id_pengguna = '$idp'");
    $row = $query->row();

    $q_pt = $this->db->query("SELECT a.* FROM perguruan_tinggi AS a LEFT JOIN pt_pengguna AS b ON a.kode_pt = b.kode_pt WHERE b.id_pengguna = '$idp'");
    $jml_pt = $q_pt->num_rows();

    if($query->num_rows() > 0){
        $q_kelas = $this->db->query("SELECT a.*, b.nama_lengkap FROM kelas AS a LEFT JOIN pengguna AS b ON a.id_pengguna = b.id_pengguna WHERE a.kode_pt = '$row->kode_pt' AND a.kode_kelas NOT IN (SELECT kode_kelas FROM kelas_pengguna WHERE id_pengguna = '$idp')");
    }
?>
<div class="modal fade kelas-form" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="bs-example bs-example-tabs">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#form-tambah-pt" data-toggle="tab">Form Tambah Kelas</a></li>
                </ul>
            </div>
            <div class="modal-body">
                <div id="myTabContent" class="tab-content">
                    <!-- form tambah -->
                    <div class="tab-pane fade active in" id="form-tambah-pt">
                        <?php //jika sudah ada pt 
                            if($jml_pt > 0){ //jika sudah ada pt
                                if($statusp == "dosen"){//jika dosen
                        ?>
                        <form action="<?=$form_kelas?>" method="post" enctype="multipart/form-data" class="form-horizontal" data-validate="parsley" id="bbb">
                            <input type="hidden" name="id_pengguna" value="<?=$this->session->userdata('idp')?>">
                            <input type="hidden" name="kode_pt" value="<?=$row->kode_pt?>" >
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="userid">Nama Kelas</label>
                                    <div class="controls">
                                        <input id="" name="nama_kelas" type="text" class="form-control" placeholder="" class="input-medium" data-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="userid">Jurusan</label>
                                    <div class="controls">
                                        <input id="" name="jurusan" type="text" class="form-control" placeholder="" class="input-medium" data-required="true">
                                    </div>
                                </div>
                                <br>
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="submit" class="btn btn-success btn-sm" name="" value="Simpan" id="">
                                        <input type="reset" class="btn btn-warning btn-sm" name="" value="Batal" id="">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <?php } else { //jika mahasiswa ?>
                        <style>
                            .dataTables_length, .dataTables_info{
                                display: none;
                            }
                            .dataTables_filter, .dataTables_paginate{
                                float: none;
                            }
                        </style>
                        <form action="<?=$form_cari_kelas?>" method="post" enctype="multipart/form-data" class="form-horizontal" data-validate="parsley" id="bbb">
                            <input type="hidden" name="id_pengguna" value="<?=$this->session->userdata('idp')?>">
                            <input type="hidden" name="kode_pt" value="<?=$row->kode_pt?>" >
                            <div class="">
                                <div class=""> 
                                    <section class="panel"> 
                                        <header class="panel-heading"> 
                                            Data Kelas 
                                        </header>
                                        <div class="table-responsive">
                                            <table class="table table-striped text-sm dataTable"> 
                                                <thead> 
                                                    <tr> 
                                                        <th width="50">No</th> 
                                                        <th>Nama Kelas</th> 
                                                        <th>Nama Dosen</th> 
                                                        <th>Kode Kelas</th> 
                                                        <th width="70">Pilih</th> 
                                                    </tr> 
                                                </thead> 
                                                <tbody>
                                                    <?php
                                                        $no = 0; 
                                                        if ($q_kelas->num_rows() > 0)
                                                        {
                                                            foreach ($q_kelas->result() as $r_kelas)
                                                            {
                                                                $no++;
                                                                echo "<tr>";
                                                                    echo "<td>$no</td>";
                                                                    echo "<td>$r_kelas->nama_kelas</td>";
                                                                    echo "<td>$r_kelas->nama_lengkap</td>";
                                                                    echo "<td>$r_kelas->kode_kelas</td>";
                                                                    echo '<td>
                                                                            <div class="checkbox">
                                                                                <label class="checkbox-custom">
                                                                                    <input type="checkbox" name="kode_kelas[]" value='.$r_kelas->kode_kelas.'><i class="icon-unchecked"></i>
                                                                                </label>
                                                                            </div>
                                                                            </td>';
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    ?>
                                                </tbody> 
                                            </table>
                                        </div>
                                        <footer class="panel-footer clear" style="width: 100%;">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="submit" class="btn btn-success btn-sm" name="" value="Simpan" id="">
                                                    <input type="reset" class="btn btn-warning btn-sm" name="" value="Batal" id="">
                                                </div>
                                            </div>
                                        </footer>
                                    </section> 
                                </div>
                            </div>
                        </form>
                        <?php } } /*jika belum ada pt*/ else { echo "Pilih atau tambah Perguruan Tinggi terlebih dahulu."; } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Keluar</button>
                </center>
            </div>
        </div>
    </div>
</div>