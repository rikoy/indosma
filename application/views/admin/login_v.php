<!DOCTYPE html>
<html lang="en">
	<head> 
		<meta charset="utf-8" /> 
		<title>Sistem Interaksi Dosen dan Mahasiswa</title> 
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
		<link rel="stylesheet" href="<?=base_url()?>assets/app/css/app.v1.css"> 
		<link rel="stylesheet" href="<?=base_url()?>assets/app/css/font.css" cache="false">
		<!--[if lt IE 9]> 
		<script src="<?=base_url()?>assets/app/js/ie/respond.min.js" cache="false"></script> 
		<script src="<?=base_url()?>assets/app/js/ie/html5.js" cache="false"></script> 
		<script src="<?=base_url()?>assets/app/js/ie/fix.js" cache="false"></script> 
		<![endif]-->
		<script src="<?=base_url()?>assets/app/js/app.v1.js"></script>
		<script src="<?=base_url()?>assets/app/js/jquery.ui.shake.js"></script>

		<script>
			$(document).ready(function() {
			
				$('#login').click(function()
				{
					var username=$("#username").val();
					var password=$("#password").val();
				    var dataString = 'username='+username+'&password='+password;
					if($.trim(username).length>0 && $.trim(password).length>0)
					{
					
						$.ajax({
				            type: "POST",
				            url: "<?=base_url()?>admin/login/proses_login",
				            data: dataString,
				            cache: false,
				            beforeSend: function(){ $("#login").val('Connecting...');},
				            success: function(data){
					            if(data)
					            {
					            	// $("body").load("home.php").hide().fadeIn(1500).delay(6000);
					            	window.location.replace("<?=base_url()?>admin/dashboard");
					            }
					            else
					            {
					             	$('#box').shake();
								 	$("#login").val('Login')
								 	$("#error").html("<span style='color:#cc0000'>Error:</span> Username dan password tidak terdaftar. ");
					            }
				            }
			            });
					
					}
					else
					{
		                $("#notifikasi").html('Isi Username dan Password pada form login');
		                $("#notifikasi").fadeIn(1500);
		                $("#notifikasi").fadeOut(1500); 
		            }
            
					return false;
				});
			
				
			});
		</script>
		<!-- Bootstrap --> 
		<!-- app --> 
	</head>
	<body> 
		<section id="content" class="m-t-lg wrapper-md animated fadeInUp"> 
			<a class="nav-brand" href="index.html">inDosma</a> 
			<div class="row m-n"> 
				<div class="col-md-4 col-md-offset-4 m-t-lg">
					<div id="box">
						<div id="notifikasi" style="display:none" class="alert alert-danger"></div>
						<section class="panel"> 
							<header class="panel-heading text-center"> <?=$title_box?> </header> 
							<!-- <form action="<?=$form_login?>" method="post" class="panel-body" data-validate="parsley" id="bbb">  -->
							<form action="" method="post" class="panel-body" data-validate="parsley" id="bbb">	
								<div class="form-group">
									<label class="control-label">Username</label>
									<input type="text" name="username" id="username" placeholder="Username" data-required="true" class="form-control" autofocus=""> 
								</div>
								<div class="form-group">
									<label class="control-label">Password</label>
									<input type="password" id="password" name="password" placeholder="Password" data-required="true" class="form-control"> 
								</div> 
								
								<input type="submit" class="btn btn-info" value="Log In" id="login"/>  
								
							</form>
							<div id="error" class="m-l m-b">
						</section> 
					</div>
				</div> 
			</div> 
		</section> 
		<!-- footer --> 
		<footer id="footer"> 
			<div class="text-center padder clearfix"> 
				<p> <small>Sistem Informasi Interaksi Dosen dan Mahasiswa<br>&copy; 2014</small> </p> 
			</div> 
		</footer> 
		<!-- / footer -->
	</body>
</html>