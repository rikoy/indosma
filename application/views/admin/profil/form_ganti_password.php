<section class="panel">
	<header class="panel-heading font-bold"><?=$title_inbox?></header>
	<div class="panel-body">
		<form action="<?=$form_action?>" method="post" role="form" enctype="multipart/form-data" data-validate="parsley" id="bbb">
			<input type="hidden" name="id_pengguna" value="<?=$this->session->userdata('id_admin')?>">
			<div class="form-group"> 
				<label>Password Baru</label> 
				<input class="form-control parsley-validated" value="" name="password" id="passwd" placeholder="Password Baru" type="password" data-required="true" data-rule-minlength="5" />
			</div>
			<div class="form-group"> 
				<label>Konfirmasi Password Baru</label> 
				<input class="form-control parsley-validated" value="" name="confirm-password" placeholder="Konfirmasi Password Baru" type="password" data-equalto="#passwd" data-required="true" />
			</div>
			<button type="submit" class="btn btn-sm btn-success">Simpan</button> 
			<button type="reset" class="btn btn-sm btn-warning">Batal</button>
		</form>
	</div>
</section>