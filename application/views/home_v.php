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
		          <a class="navbar-brand" href="#">inDosma</a>
		        </div>
	        <div class="navbar-collapse collapse">
	          	<ul class="nav navbar-nav navbar-right">
		            <li><a href="#desc" class="smothscroll" data-toggle="modal" data-target=".daftar-form">Daftar</a></li>
		            <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Log in <b class="caret"></b></a>
	                    <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
	                        <li>
	                           	<div class="row">
	                              	<div class="col-md-12">
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
	<div id="headerwrap">
	    <div class="container">
	    	<div class="row centered">
	    		<div class="col-lg-12">
					<h1>Selamat datang di <span class="font-tebal">inDosma</span></h1>
					<div class="ticker hidden-xs hidden-sm hidden-md">
						<h3>Interaksi dengan dosen dan teman kampus mu, disini.</h3>
						<h3>Diskusi, sharing, update informasi seputar kampus mu.</h3>
						<h3>Ajak teman mu bergabung bersama kami!</h3>
					</div>
					<br>
	    		</div>
	    		<div class="col-lg-2">
	    			<h5>Desain simple</h5>
	    			<p>Tak perlu waktu lama untuk bisa menggunakan nya</p>
	    			<img class="hidden-xs hidden-sm hidden-md" src="<?=base_url()?>assets/home/img/arrow1.png">
	    		</div>
	    		<div class="col-lg-8">
	    			<img class="img-responsive" src="<?=base_url()?>assets/home/img/app-bg.png" alt="">
	    		</div>
	    		<div class="col-lg-2">
	    			<br>
	    			<img class="hidden-xs hidden-sm hidden-md" src="<?=base_url()?>assets/home/img/arrow2.png">
	    			<h5>Gratis</h5>
	    			<p>Dapat diakses tanpa biaya sepeser pun.</p>
	    		</div>
	    	</div>
	    </div> <!--/ .container -->
	</div><!--/ #headerwrap -->
	<div id="intro">
		<div class="container">
			<div class="row centered">
				<h1>Cara Kerja dan Fitur</h1>
				<br>
				<br>
				<div class="list_pengguna">
					<div class="col-lg-2"></div>
					<div class="col-lg-2 ico_dosen">
						<img src="<?php echo base_url(); ?>assets/home/img/dosen.png" alt="">
						<h3>Dosen</h3>
					</div>
					<div class="col-lg-2 ico_mhs">
						<img src="<?php echo base_url(); ?>assets/home/img/mhs.png" alt="">
						<h3>Mahasiswa</h3>
					</div>
					<div class="col-lg-6 align-left">
						<!-- ACCORDION -->
			            <div class="accordion ac" id="accordion2">
			                <div class="accordion-group">
			                    <div class="accordion-heading">
			                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
			                        <span class="label label-warning">1</span> Perguruan Tinggi
			                        </a>
			                    </div><!-- /accordion-heading -->
			                    <div id="collapseOne" class="accordion-body collapse in">
			                        <div class="accordion-inner">
										<p>Setelah dosen melakukan registrasi, langkah selanjutanya dosen menambahkan data perguruan tinggi sehingga mahasiswa atau dosen lain dapat bergabung. Sistem akan men-generate kode perguruan tinggi secara otomatis, untuk acuan dosen atau mahasiswa yang akan bergabung. Sedangkan untuk mahasiswa hanya bisa bergabung dengan perguruan tinggi yang sudah di buat oleh dosen.</p>
									</div><!-- /accordion-inner -->
			                    </div><!-- /collapse -->
			                </div><!-- /accordion-group -->
			                <br>
			
			                <div class="accordion-group">
			                    <div class="accordion-heading">
			                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
			                        <span class="label label-warning">2</span> Kelas
			                        </a>
			                    </div>
			                    <div id="collapseTwo" class="accordion-body collapse">
			                        <div class="accordion-inner">
									<p>Setelah dosen membuat atau bergabung dengan perguruan tinggi. Dosen membuat kelas sehingga mahasiswa yang dididiknya dapat bergabung dan dapat memanfaatkan fasilitas yang ada di dalam kelas tersebut. Sedangkan untuk mahasiswa hanya bisa bergabung dengan kelas yang sudah di buat oleh dosen.</p>
									</div><!-- /accordion-inner -->
			                    </div><!-- /collapse -->
			                </div><!-- /accordion-group -->
			                <br>
			
			                 <div class="accordion-group">
			                    <div class="accordion-heading">
			                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
			                        <span class="label label-warning">3</span> Diskusi
			                        </a>
			                    </div>
			                    <div id="collapseThree" class="accordion-body collapse">
			                        <div class="accordion-inner">
									<p>Dikusi adalah salah satu fitur di dalam kelas, diskusi dapat dilakukan oleh dosen dan mahasiswa dalam kelas yang sama. Diskusi dapat dilihat/dibalas secara realtime.</p>
									</div><!-- /accordion-inner -->
			                    </div><!-- /collapse -->
			                </div><!-- /accordion-group -->
			                <br>
			                
			                 <div class="accordion-group">
			                    <div class="accordion-heading">
			                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
			                        <span class="label label-warning">4</span> Materi
			                        </a>
			                    </div>
			                    <div id="collapseFour" class="accordion-body collapse">
			                        <div class="accordion-inner">
									<p>Dosen di dalam kelas dapat memberikan materi baik berupa tulisan atau berupa file lampiran. Yang nantinya materi tersebut dapat dilihat atau di download oleh mahasiswa yang bersangkutan.</p>
									</div><!-- /accordion-inner -->
			                    </div><!-- /collapse -->
			                </div><!-- /accordion-group -->
			                <br>

			                <div class="accordion-group">
			                    <div class="accordion-heading">
			                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
			                        <span class="label label-warning">5</span> Tugas
			                        </a>
			                    </div>
			                    <div id="collapseFive" class="accordion-body collapse">
			                        <div class="accordion-inner">
									<p>Fitur ke tiga di dalam kelas, dosen dapat menyajikan tugas untuk mahasiswa nya yang berada dalam kelas tersebut. Kemudian mahasiswa dapat mengirim balik jawaban tugas nya dalam format file fpd. Yang nantinya dosen akan menilai jawaban tugas yang telah dikirimkan oleh mahasiswa tersebut.</p>
									</div><!-- /accordion-inner -->
			                    </div><!-- /collapse -->
			                </div><!-- /accordion-group -->
			                <br>

			                <div class="accordion-group">
			                    <div class="accordion-heading">
			                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">
			                        <span class="label label-warning">6</span> Update Status
			                        </a>
			                    </div>
			                    <div id="collapseSix" class="accordion-body collapse">
			                        <div class="accordion-inner">
									<p>Baik dosen maupun mahasiswa dapat melakukan update status. Setiap mahasiswa dan dosen dalam perguruan tinggi yang sama dapat melihat dan mengomentari status dari setiap pengguna.</p>
									</div><!-- /accordion-inner -->
			                    </div><!-- /collapse -->
			                </div><!-- /accordion-group -->
			                <br>

			                <div class="accordion-group">
			                    <div class="accordion-heading">
			                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSeven">
			                        <span class="label label-warning">7</span> Pesan
			                        </a>
			                    </div>
			                    <div id="collapseSeven" class="accordion-body collapse">
			                        <div class="accordion-inner">
									<p>Dosen dan mahasiswa dapat salaing mengirim pesan pribadi, selama dosen dan mahasiswa itu berada dalam perguruan tinggi yang sama.</p>
									</div><!-- /accordion-inner -->
			                    </div><!-- /collapse -->
			                </div><!-- /accordion-group -->
			                <br>	
						</div>
						<!-- Accordion -->
						<!-- <img src="<?php echo base_url(); ?>assets/home/img/pt.png" alt="">
						<img src="<?php echo base_url(); ?>assets/home/img/kelas.png" alt="">
						<img src="<?php echo base_url(); ?>assets/home/img/diskusi.png" alt="">
						<img src="<?php echo base_url(); ?>assets/home/img/materi.png" alt="">
						<img src="<?php echo base_url(); ?>assets/home/img/tugas.png" alt=""> -->
					</div>
				</div>
			</div>
			<br>
	    </div> <!--/ .container -->
	</div>
	<div id="footerwrap">
		<div class="container">
			<div class="row">
				<div class="container">
					<div class="col-lg-5">
						<h3 class="">Office</h3>
						<p>
						Jalan Terusan Ciliwung<br>
						Bandung<br>
						40132<br>
						Indonesia
						</p>
					</div>
				</div>
			</div>
		</div><!-- /container -->
	</div>
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
	//HERO TICKER
    var current = 1; 
    var height = jQuery('.ticker').height(); 
    var numberDivs = jQuery('.ticker').children().length; 
    var first = jQuery('.ticker h3:nth-child(1)'); 
    setInterval(function() {
        var number = current * -height;
        first.css('margin-top', number + 'px');
        if (current === numberDivs) {
            first.css('margin-top', '0px');
            current = 1;
        } else current++;
    }, 2500);
	</script>
  </body>
</html>
