<div class="modal fade daftar-form" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="panel">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="panel-title" id="contactLabel">Form Pendaftaran Interaksi Dosen dan Mahasiswa</h4>
            </div>
            <form action="<?=$form_daftar?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="form-validate" id="aaa">
                <div class="modal-body" style="padding: 5px;">
                	<div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <div class="controls">
                            	<?php 
		                            $options = array(
		                                ''  => 'Pilih Status Pendaftaran',
		                                'dosen' => 'Dosen',
		                                'mahasiswa' => 'Mahasiswa'
		                                );
		                            echo form_dropdown('status_pengguna', $options, set_value('status_pengguna', (isset($default['status_pengguna'])) ? $default['status_pengguna'] : ''), 'class="form-control" data-rule-required="true"') ;
		                        ?>
	                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <div class="controls">
                            	<input class="form-control" value="<?php echo set_value('id_pengguna', isset($default['id_pengguna']) ? $default['id_pengguna'] : ''); ?>" name="id_pengguna" id="id_pengguna" placeholder="Nomor Identitas" type="text" data-rule-required="true" data-rule-minlength="2" data-rule-number="true" autofocus=""  />
                        	</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <div class="controls">
                            	<input class="form-control" value="<?php echo set_value('nama_lengkap', isset($default['nama_lengkap']) ? $default['nama_lengkap'] : ''); ?>" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" type="text" data-rule-required="true" />
                        	</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <div class="controls">
                            	<input class="form-control" value="<?php echo set_value('username', isset($default['username']) ? $default['username'] : ''); ?>" name="username" id="username" placeholder="Username" type="text" data-rule-required="true" />
                        	</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                        	<div class="controls">
                            	<input class="form-control" value="" name="password" id="passwd" placeholder="Password" type="password" data-rule-required="true" data-rule-minlength="5" />
                        	</div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                            <div class="controls">
                            	<input class="form-control" value="" name="confirm-password" placeholder="Konfirmasi Password" type="password" data-rule-equalTo="#passwd" data-rule-required="true" />
                        	</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <div class="controls">
                            	<input class="form-control" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" name="email" placeholder="E-mail" type="text" data-rule-email="true" data-rule-required="true" />
                        	</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                            <div class="controls">
                            	<input type="checkbox" name="setuju" value="1" data-rule-required="true">
                            	Dengan mendaftar di inDosma, Anda sudah membaca dan memahami Kebijakan Privasi inDosma. 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        	<div class="alert alert-warning catatan-form" style="margin-bottom: 0;">
	                        	Catatan :
	                        	<ul class="">
	                        		<li>Nomor Identitas untuk pengguna Mahasiswa bisa mengisi dengan Nomor Induk Mahasiswa (NIM) atau Nomor Pendaftaran Mahasiswa (NPM).</li>
                        			<li>Nomor Identitas untuk pengguna Dosen bisa mengidi dengan Nomor Induk Pegawai (NIP) atau Nomor Induk Karyawan (NIK).</li>
	                        	</ul>
	                        </div>
                        </div>
                    </div>
                </div>  
                <div class="panel-footer" style="margin-bottom:-14px;">
                    <input type="submit" class="btn btn-success" value="Daftar"/>
                        <!--<span class="glyphicon glyphicon-ok"></span>-->
                    <input type="reset" class="btn btn-danger" value="Batal" />
                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                    <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Keluar</button>
                </div>
            </form>
    	</div>
    </div>
</div>