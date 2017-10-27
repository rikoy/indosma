<?php $idp = $this->session->userdata('idp'); ?>
<section id="list-teman" class="vbox"> 
    <header class="bg-light lter b-b header clearfix"> 
        <p class="h4"><?=$title_box?></p>
    </header>
    <section class="scrollable"> 
        <div class="wrapper">
            <div class="row">
                <!-- content -->
                <div class="col-lg-12">
                    <section class="panel"> 
                        <?php 
                            if ($idp == $default['id']) {
                                echo "<a href='".base_url()."pengguna/ubah/".$idp."' class='m-r btn btn-xs btn-success m-t-xs pull-right'>Edit Profil</a>";
                            }
                        ?>
                        <div class="panel-body">
                            <div class="clearfix text-center m-t">
                                <div class="inline">
                                    <div class="thumb-lg"> 
                                        <img src="<?=base_url()?>avatar/thumb/<?php echo set_value('foto_profil', isset($default['foto_profil']) ? $default['foto_profil'] : ''); ?>" style="width: 90px; height: 90px;" class="img-circle"> 
                                    </div> 
                                    <div class="h4 m-t m-b-xs"><?php echo set_value('nama_lengkap', isset($default['nama_lengkap']) ? $default['nama_lengkap'] : ''); ?></div> 
                                    <small class="text-muted m-b" style="text-transform: capitalize;"><?php echo set_value('status_pengguna', isset($default['status_pengguna']) ? $default['status_pengguna'] : ''); ?></small> 
                                </div> 
                            </div> 
                        </div> 
                        <footer class="panel-footer bg-dark lter text-center"> 
                            <div class="row pull-out"> 
                                <div class="col-xs-4"> 
                                    <div class="padder-v"> 
                                        <span class="m-b-xs h4 block">
                                            <?php
                                                $query_jml_teman = $this->db->query("SELECT COUNT(*) AS jml FROM (SELECT id_pengguna AS a FROM kelas_pengguna WHERE id_pengguna != '$default[id]' AND kode_kelas IN (SELECT kode_kelas FROM kelas_pengguna WHERE id_pengguna = '$default[id]') GROUP BY id_pengguna) AS query");
                                                $row_jml_teman = $query_jml_teman->row();

                                                if($row_jml_teman->jml > 0){
                                                    echo $row_jml_teman->jml;
                                                }else{
                                                    echo "0";
                                                }
                                            ?>
                                        </span> 
                                        <small class="text-muted">Teman Kelas</small> 
                                    </div> 
                                </div> 
                                <div class="col-xs-4 bg-success"> 
                                    <div class="padder-v"> 
                                        <span class="m-b-xs h4 block">
                                            <?php
                                                $query_jml_kelas = $this->db->query("SELECT COUNT(kode_kelas) AS jml_kelas FROM kelas_pengguna WHERE id_pengguna = '$default[id]'");
                                                $row_jml_kelas = $query_jml_kelas->row();
                                                echo $row_jml_kelas->jml_kelas;
                                            ?>
                                        </span> 
                                        <small class="text-muted">Kelas</small> 
                                    </div> 
                                </div> 
                                <div class="col-xs-4"> 
                                    <div class="padder-v"> 
                                        <span class="m-b-xs h4 block">
                                            <?php
                                                $query_jml_status = $this->db->query("SELECT COUNT(id_status) AS jml_status FROM status WHERE id_pengguna = '$default[id]'");
                                                $row_jml_status = $query_jml_status->row();
                                                echo $row_jml_status->jml_status;
                                            ?>
                                        </span> 
                                        <small class="text-muted">Post</small> 
                                    </div> 
                                </div> 
                            </div> 
                        </footer> 
                    </section>
                </div>
                <div class="clear"></div>
                <div class="col-lg-6"> 
                    <section class="panel"> 
                            <header class="panel-heading"><h4>Teman Kelas</h4></header> 
                            <div class="panel-body">
                                <div class="media">
                                <?php 
                                    $query_teman = $this->db->query("SELECT b.nama_lengkap, b.id_pengguna, b.status_pengguna, b.foto_profil FROM kelas_pengguna AS a
                                                                LEFT JOIN pengguna AS b ON b.id_pengguna = a.id_pengguna 
                                                                WHERE b.id_pengguna != '$default[id]' AND kode_kelas IN
                                                                    (SELECT kode_kelas FROM kelas_pengguna WHERE id_pengguna = '$default[id]') GROUP BY a.id_pengguna");

                                    if ($query_teman->num_rows() > 0)
                                    {
                                       foreach ($query_teman->result() as $row_teman)
                                       {
                                          echo '<a href="'.base_url().'teman/profil/'.$row_teman->id_pengguna.'" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'.$row_teman->nama_lengkap.'" class="pull-left thumb-sm"><img src="'.base_url().'/avatar/'.$row_teman->foto_profil.'" alt="" style="width: 36px; height: 36px;"  class="img-circle"></a>';
                                       }
                                    }else{
                                        echo "-";
                                    }
                                ?>
                                </div>
                            </div>
                    </section> 
                </div>
                <div class="col-lg-6"> 
                    <section class="panel"> 
                            <header class="panel-heading"><h4>Pendidikan</h4></header> 
                            <div class="panel-body">
                                <?php 
                                    $query_pt = $this->db->query("SELECT a.nama_pt FROM perguruan_tinggi AS a LEFT JOIN pt_pengguna AS b ON a.kode_pt = b.kode_pt WHERE b.id_pengguna = '$default[id]'");
                                    $row_pt = $query_pt->row();
                                    echo "
                                            <span class='text-muted'>Perguruan Tinggi</span>
                                            <span class='h5 block m-b'>$row_pt->nama_pt</span>
                                            <span class='text-muted'>Kelas</span><br>
                                        ";

                                    $query_kelas = $this->db->query("SELECT a.nama_kelas FROM kelas_pengguna AS b LEFT JOIN kelas AS a ON a.kode_kelas = b.kode_kelas WHERE b.id_pengguna = '$default[id]' GROUP BY b.kode_kelas");
                                    $rowcount = $row_jml_kelas->jml_kelas;
                                    $n=0;
                                    if ($query_kelas->num_rows() > 0)
                                    {
                                       foreach ($query_kelas->result() as $row_kelas)
                                       {
                                            $n++;
                                            echo "<span class='h5'>$row_kelas->nama_kelas</span>";
                                            if ($rowcount != $n) {
                                                echo ", ";
                                            }
                                       }
                                    }
                                ?>
                            </div>
                    </section> 
                </div>
                <div class="col-lg-6"> 
                    <section class="panel"> 
                            <header class="panel-heading"><h4>Data Pribadi</h4></header> 
                            <div class="panel-body">
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <th width="40%">Jenis Kelamin</th>
                                        <td>
                                            <?php
                                                if($default['jenis_kelamin'] == 'l'){
                                                    $jenis_kelamin = "Laki-Laki";
                                                }elseif($default['jenis_kelamin'] == 'p'){
                                                    $jenis_kelamin = "Perempuan";
                                                }else{
                                                    $jenis_kelamin = "-";
                                                }
                                            ?>
                                            <?php echo set_value('jenis_kelamin', isset($default['jenis_kelamin']) ? $jenis_kelamin : '-'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status Pernikahan</th>
                                        <td>
                                            <?php
                                                if($default['status_pernikahan'] == 'jomblo'){
                                                    $status_pernikahan = "Jomblo";
                                                }elseif($default['status_pernikahan'] == 'berpasangan'){
                                                    $status_pernikahan = "Sudah Punya Pasangan";
                                                }else{
                                                    $status_pernikahan = "-";
                                                }
                                            ?>
                                            <?php echo set_value('status_pernikahan', isset($default['status_pernikahan']) ? $status_pernikahan : '-'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>
                                            <?php 
                                                if ($default['tgl_lahir'] == "1970-01-01") {
                                                    echo "-";
                                                }else{
                                                    echo set_value('tgl_lahir', isset($default['tgl_lahir']) ? date("d-m-Y", strtotime($default['tgl_lahir'])) : '-'); 
                                                }
                                            ?>
                                        </td>
                                                
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td><?php echo set_value('alamat', isset($default['alamat']) ? $default['alamat'] : '-'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo set_value('email', isset($default['email']) ? $default['email'] : '-'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Identitas</th>
                                        <td><?php echo set_value('id', isset($default['id']) ? $default['id'] : '-'); ?></td>
                                    </tr>
                                </table>
                            </div>
                    </section> 
                </div>
                <div class="col-lg-6"> 
                    <section class="panel"> 
                            <header class="panel-heading"><h4>Tentang Saya</h4></header> 
                            <div class="panel-body">
                                <?php echo set_value('tentang_pribadi', isset($default['tentang_pribadi']) ? $default['tentang_pribadi'] : '-'); ?>
                            </div>
                    </section> 
                </div>
            </div>
        </div>
    </section> 
</section>