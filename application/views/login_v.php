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
		    </div>
	    </div>
	</div>
	<section id="home" name="home"></section>
	<div id="intro" style="min-height:460px;">
		<div class="container">
			<div class="row ">
				<div class="col-md-4 col-md-offset-4 centered">
					<a class="" href="#" style="color:#777777;">inDosma | Interaksi Dosen dan Mahasiswa</a>
					<br>
					<br>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<div class="panel">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Form Log in</h3>
					 	</div>
					  	<div class="panel-body">
					  		<form class="form form-validate" role="form" method="post" action="<?=$form_login?>" enctype="multipart/form-data" accept-charset="UTF-8" id="bb">
                                <div class="controls form-group">
                                   <label class="sr-only" for="username">Username</label>
                                   <input type="text" class="form-control" id="username" name="username" placeholder="Username" data-rule-required="true" autofocus="">
                                </div>
                                <div class="controls form-group">
                                   <label class="sr-only" for="password">Password</label>
                                   <input type="password" class="form-control" id="password" name="password" placeholder="Password" data-rule-required="true">
                                </div>
                                <div class="controls form-group">
                                   <button type="submit" class="btn btn-success btn-block">Log in</button>
                                </div>
                                <div class="form-group">
	                                <div class="col-md-12 control">
	                                    <div style="padding-top:15px; font-size:85%" >
	                                        Belum mempunyai akun inDosma
	                                    <a href="#" data-toggle="modal" data-target=".daftar-form">
	                                        Daftar disini.
	                                    </a>
	                                    </div>
	                                </div>
	                            </div>    
                         	</form>
					    </div>
					</div>
				</div>
				<?php if(validation_errors() || $this->session->flashdata('result_login')){ ?>
                    <div class="col-md-4 col-md-offset-4" style="padding-bottom: 10px;">
                    	<div class="alert alert-danger catatan-form" style="margin-bottom: 0;">
                    		Peringatan :
                    		<ul>
                    		<?php echo validation_errors(); ?>
                    		<?php echo "<li>".$this->session->flashdata('result_login')."</li>"; ?>
                    		</ul>
                    	</div>
                    </div>
                <?php } ?>
			</div>
	    </div> <!--/ .container -->
	</div><!--/ #introwrap -->
	<!-- footer -->
	<div id="footer">
		<div class="container">
			<span class="pull-right copyfoot">&copy;2014 <a href="">indosma</a> <img src="<?=base_url()?>assets/home/img/madein.png" class="madein" alt=""></span>
		
		</div>
	</div>
	<!-- form daftar -->
	<?php $this->load->view('modal_daftar_v'); ?>

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
