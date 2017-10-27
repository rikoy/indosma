<section class="panel">
	<header class="panel-heading font-bold"><?=$title_inbox?></header>
	<div class="panel-body">
		<form action="<?=$form_action?>" method="post" role="form" enctype="multipart/form-data">
			<input type="hidden" name="id_pengguna" value="<?=$this->session->userdata('id_admin')?>">
            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($default['id']) ? $default['id'] : ''); ?>">                        
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="control-group">
                            <p>Nama Lengkap</p>
                            <div class="controls">
                                <input id="" name="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap" data-required="true" value="<?php echo set_value('nama_lengkap', isset($default['nama_lengkap']) ? $default['nama_lengkap'] : ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-group">
                            <p>Email</p>
                            <div class="controls">
                                <input id="" name="email" type="text" class="form-control" placeholder="Email" data-required="true" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-group">
                            <p>Nomor Telepon</p>
                            <div class="controls">
                                <input id="" name="no_telp" type="text" class="form-control" placeholder="Nomor Telepon"  value="<?php echo set_value('no_telp', isset($default['no_telp']) ? $default['no_telp'] : ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-group">
                            <p>Tanggal Lahir</p>
                            <div class="controls">
                                <input id="" name="tgl_lahir" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Lahir"  value="<?php echo set_value('tgl_lahir', isset($default['tgl_lahir']) ? $default['tgl_lahir'] : ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-group">
                            <p>Alamat</p>
                            <div class="controls">
                                <textarea name="alamat" id="" class="form-control" cols="" rows="5" placeholder="Alamat" ><?php echo set_value('alamat', isset($default['alamat']) ? $default['alamat'] : ''); ?></textarea>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="control-group">
                            <p>Status Pernikahan</p>
                            <div class="controls">
                                <?php 
                                    $options = array(
                                        ''              => 'Pilih Status Pernikahan',
                                        'jomblo'         => 'Jomblo',
                                        'berpasangan'    => 'Sudah Punya Pasangan'
                                        );
                                    echo form_dropdown('status_pernikahan', $options, set_value('status_pernikahan', (isset($default['status_pernikahan'])) ? $default['status_pernikahan'] : ''), 'class="form-control"') ;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-group">
                            <p>Jenis Kelamin</p>
                            <div class="controls">
                                <label class='radio'>
                                    <input name="jenis_kelamin" type="radio" value="l" <?php echo set_radio('jenis_kelamin', 'l', isset($default['jenis_kelamin']) && $default['jenis_kelamin'] == 'l' ? TRUE : FALSE); ?> />
                                    Laki-laki
                                </label>
                                <label class='radio'>
                                    <input name="jenis_kelamin" type="radio" value="p" <?php echo set_radio('jenis_kelamin', 'p', isset($default['jenis_kelamin']) && $default['jenis_kelamin'] == 'p' ? TRUE : FALSE); ?> />
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-group">
                            <p>Tentang Pribadi</p>
                            <div class="controls">
                                <textarea name="tentang_pribadi" id="" class="form-control" cols="" rows="4" placeholder="Tentang Pribadi" ><?php echo set_value('tentang_pribadi', isset($default['tentang_pribadi']) ? $default['tentang_pribadi'] : ''); ?></textarea>   
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-group">
                            <p>Photo Profil</p>
                            <div class="controls">
                                <div class="media m-t-none"> 
                                    <img src="<?=base_url()?>avatar/<?php echo set_value('foto_profil', isset($default['foto_profil']) ? $default['foto_profil'] : ''); ?>" class="pull-left text-center media-lg thumb-lg"> 
                                    <div class="media-body"> 
                                        <input type="file" name="foto_profil" title="Cari Photo" class="btn btn-sm btn-info m-b-sm"><br> 
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<button type="submit" class="btn btn-sm btn-success">Simpan</button> 
			<button type="reset" class="btn btn-sm btn-warning">Batal</button> 
		</form>
	</div>
</section>