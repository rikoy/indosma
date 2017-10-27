<!DOCTYPE html>
<html lang="en">
  	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="shortcut icon" href="assets/ico/favicon.png">

	    <title>Sistem Informasi Interaksi Dosen dan Mahasiswa</title>

	    <!-- Bootstrap core CSS -->
	    <link href="<?=base_url()?>assets/home/css/bootstrap.css" rel="stylesheet">

	    <!-- Custom styles for this template -->
	    <link href="<?=base_url()?>assets/home/css/main.css" rel="stylesheet">
	    
	    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'> -->
	    <!-- <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'> -->
	    
	    <script src="<?=base_url()?>assets/home/js/jquery.min.js"></script>
	    <script src="<?=base_url()?>assets/home/js/smoothscroll.js"></script>
  	</head>
	<body data-spy="scroll" data-offset="0" data-target="#navigation">
    <!-- Fixed navbar -->
	    <div id="navigation" class="navbar navbar-default navbar-fixed-top">
	      	<div class="container">
		        <div class="navbar-header">
		          	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
		          	</button>
		          <a class="navbar-brand" href="<?=base_url()?>">inDosma</a>
		        </div>
		        <div class="navbar-collapse collapse">
		          	<ul class="nav navbar-nav navbar-right">
			            <li class="dropdown">
		                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Log in <b class="caret"></b></a>
		                    <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
		                        <li>
		                           	<div class="row">
		                              	<div class="col-md-12">
		                                 	<form class="form form-validate" role="form" method="post" action="<?=$form_login?>" enctype="multipart/form-data" accept-charset="UTF-8" id="bb">
			                                    <div class="controls form-group">
			                                       <label class="sr-only" for="username">Username</label>
			                                       <input type="text" class="form-control" id="username" name="username" placeholder="Username" data-rule-required="true">
			                                    </div>
		                                        <div class="controls form-group">
			                                       <label class="sr-only" for="password">Password</label>
			                                       <input type="password" class="form-control" id="password" name="password" placeholder="Password" data-rule-required="true">
			                                    </div>
			                                    <div class="controls form-group">
			                                       <button type="submit" class="btn btn-success btn-block">Log in</button>
			                                    </div>
		                                 	</form>
		                              	</div>
		                           	</div>
		                        </li>
		                    </ul>
		                </li>
		          	</ul>
		        </div><!--/.nav-collapse -->
	    	</div>
		</div>
		<section id="home" name="home"></section>
		<div id="intro">
			<div class="container">
				<div class="row ">
					<div class="col-md-12 centered">
						<a class="" href="#" style="color:#777777;">inDosma | Interaksi Dosen dan Mahasiswa</a>
					</div>
					<div class="modal-dialog">
			            <div class="panel">
			                <div class="panel-heading">
			                    <h4 class="panel-title" id="contactLabel">Form Pendaftaran Interaksi Dosen dan Mahasiswa</h4>
			                </div>
			                <form action="<?=$form_daftar?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="form-validate" id="aaa">
				                <div class="modal-body" style="padding: 5px;">
				                	<?php if(validation_errors()){ ?>
					                	<div class="row">
					                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
					                        	<div class="alert alert-danger catatan-form" style="margin-bottom: 0;">
					                        		Peringatan :
					                        		<ul>
					                        		<?php echo validation_errors(); ?>
					                        		</ul>
					                        	</div>
					                        </div>
					                    </div>
					                <?php } ?>
				                	<div class="row">
				                		<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
				                            <div class="controls">
				                            	<?php 
						                            $options = array(
						                                ''  => 'Pilih Status Pendaftaran',
						                                'dosen' => 'Dosen',
						                                'mahasiswa' => 'Mahasiswa'
						                                );
						                            echo form_dropdown('status_pengguna', $options, set_value('status_pengguna', (isset($default['status_pengguna'])) ? $default['status_pengguna'] : ''), 'class="form-control"') ;
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
				                            	<input class="form-control" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" name="email" placeholder="E-mail" type="text" data-rule-required="true" data-rule-email="true" />
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
				                </div>
				            </form>
			        	</div>
			        </div>
				</div>
		    </div> <!--/ .container -->
		</div><!--/ #introwrap -->
		<!-- footer -->
		<div id="footer">
			<div class="container">
				<span class="pull-right copyfoot">&copy;2014 <a href="">indosma</a> <img src="<?=base_url()?>assets/home/img/madein.png" class="madein" alt=""></span>
			
			</div>
		</div>
	
	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="<?=base_url()?>assets/home/js/bootstrap.js"></script>
	    
	    <!-- validasi -->
	    <script src="<?=base_url()?>assets/home/js/plugins/validation/jquery.validate.min.js"></script>
	    <script src="<?=base_url()?>assets/home/js/plugins/validation/additional-methods.min.js"></script>

	    <script src="<?=base_url()?>assets/home/js/eakroko.js"></script>

		<script>
		$('.carousel').carousel({
		  interval: 3500
		});
		$(document).ready(function(){
		    //Handles menu drop down
		    $('.dropdown-menu').find('form').click(function (e) {
		        e.stopPropagation();
		    });
		});
		$('.modal').on('hidden.bs.modal', function(){
		    $(this).find('form')[0].reset();
		    $("span.help-block").remove();
			$(".help-block").removeClass("help-block");
		});
		</script>
  	</body>
</html>
