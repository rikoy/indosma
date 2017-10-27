<section class="panel">
	<header class="panel-heading font-bold"><?=$title_inbox?></header>
	<div class="panel-body">
		<form action="<?=$form_action?>" method="post" target="_blank" role="form">
			<div class="form-group"> 
				<label>Tanggal Awal Dibuat</label> 
				<input id="tgl_awal" name="tgl_awal" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Awal Dibuat" value="">
			</div>
			<div class="form-group"> 
				<label>Tanggal Akhir Dibuat</label> 
				<input id="tgl_akhir" name="tgl_akhir" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Akhir Dibuat" value="">
			</div> 
			<button type="submit" class="btn btn-sm btn-success">Cetak</button> 
			<button type="reset" class="btn btn-sm btn-warning">Batal</button> 
		</form>
	</div>
</section>