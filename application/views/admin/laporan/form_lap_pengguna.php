<section class="panel">
	<header class="panel-heading font-bold"><?=$title_inbox?></header>
	<div class="panel-body">
		<form action="<?=$form_action?>" method="post" target="_blank" role="form">
			<div class="form-group"> 
				<label>Status Pengguna</label> 
				<select class="form-control" name="status_pengguna" id="status_pengguna">
					<option value="">Pilih semua status pengguna</option>
					<option value="dosen">Dosen</option>	
					<option value="mahasiswa">Mahasiswa</option>	
				</select>
			</div> 
			<div class="form-group"> 
				<label>Tanggal Registrasi Awal</label> 
				<input id="tgl_awal" name="tgl_awal" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Registrasi Awal" value="">
			</div>
			<div class="form-group"> 
				<label>Tanggal Registrasi Akhir</label> 
				<input id="tgl_akhir" name="tgl_akhir" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Registrasi Akhir" value="">
			</div> 
			<button type="submit" class="btn btn-sm btn-success">Cetak</button> 
			<button type="reset" class="btn btn-sm btn-warning">Batal</button> 
		</form>
	</div>
</section>