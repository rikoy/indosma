<?php $idp = $this->session->userdata('id_admin'); ?>
<section class="panel">
    <div class="panel-body">
                        <?php 
                            if ($idp == $default['id']) {
                                echo "<a href='".base_url()."admin/profil/ubah/".$idp."' class='m-r btn btn-xs btn-success m-t-xs pull-right'>Edit Profil</a>";
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
                    </section>
                </div>
                <div class="clear"></div>
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
    </section>