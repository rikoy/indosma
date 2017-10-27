<div class="col-md-7">
	<section class="panel">
		<header class="panel-heading">Login Terakhir</header>
		<div class="table-responsive"> 
			<table class="table table-striped m-b-none text-sm">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama</th>
						<th>NPM</th>
						<th>Tanggal</th>
						<th>Jam</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						//get data login
						$q_get_login = $this->db->query("SELECT a.*, b.nama_lengkap FROM session_login AS a LEFT JOIN pengguna AS b ON a.id_pengguna = b.id_pengguna ORDER BY id_session_login DESC LIMIT 5");
						$n = 0;
						foreach ($q_get_login->result() as $dl) {
							$n++;
					?>
					<tr>
						<td><?=$n?></td>
						<td><?=$dl->nama_lengkap?></td>
						<td><?=$dl->id_pengguna?></td>
						<td><?=date('d-m-Y', strtotime ($dl->date))?></td>
						<td><?=$dl->time?></td>
					</tr>
					<?php } //end foreach ?>
				</tbody>
			</table>
		</div>
		<footer class="panel-footer text-sm">
			<a href="<?php base_url(); ?>pengguna/data_login" class="btn btn-success btn-sm">Selengkapnya</a></footer>
	</section>
</div>

<div class="col-md-5">
	<section class="panel">
		<header class="panel-heading">Grafik Pengguna</header>
		<?php 
			//get jumlah dosen
			$q_get_jml_dosen = $this->db->query("SELECT COUNT(*) AS jml_dosen FROM pengguna WHERE status_pengguna = 'dosen'");
			$r_jml_dosen = $q_get_jml_dosen->row();

			//get jml mahasiswa

			$q_get_jml_mhs = $this->db->query("SELECT COUNT(*) AS jml_mhs FROM pengguna WHERE status_pengguna = 'mahasiswa'");
			$r_jml_mhs = $q_get_jml_mhs->row();
		?>
		<div class="text-center wrapper"> 
			<div class="sparkline inline" data-type="pie" data-height="150" data-slice-colors="['#acdb83','#fb6b5b']"><?php echo $r_jml_dosen->jml_dosen; ?>,<?php echo $r_jml_mhs->jml_mhs; ?></div> 
		</div> 
		<ul class="list-group no-radius"> 
			<li class="list-group-item"> 
				<span class="pull-right"><?php echo $r_jml_dosen->jml_dosen; ?></span> 
				<span class="label bg-success">&nbsp;</span> Dosen
			</li> 
			<li class="list-group-item"> 
				<span class="pull-right"><?php echo $r_jml_mhs->jml_mhs; ?></span> 
				<span class="label bg-danger">&nbsp;</span> Mahasiswa 
			</li> 
		</ul> 
	</section>
</div>
<div class="col-lg-4"> 
	<section class="panel bg-info lter no-borders">
		<?php 
			$q_get_jml_pengguna = $this->db->query("SELECT COUNT(*) AS jml_pengguna FROM pengguna WHERE status_pengguna != 'admin'");
			$r_get_jml_pengguna = $q_get_jml_pengguna->row();
		?>
		<div class="panel-body"> <a class="pull-right" href="#"><i class="icon-user"></i></a> 
			<span class="h4">Jumlah Pengguna</span> 
			<div class="text-center padder m-t"> 
				<span class="h1"><i class="icon-group text-muted"></i> <?php echo $r_get_jml_pengguna->jml_pengguna; ?></span> 
			</div> 
		</div>
	</section> 
</div>
<div class="col-lg-4"> 
	<section class="panel bg-primary lter no-borders">
		<?php 
			$q_get_jml_pt = $this->db->query("SELECT COUNT(*) AS jml_pt FROM perguruan_tinggi");
			$r_get_jml_pt = $q_get_jml_pt->row();
		?>
		<div class="panel-body"> <a class="pull-right" href="#"><i class="icon-home"></i></a> 
			<span class="h4">Jumlah Perguruan Tinggi</span> 
			<div class="text-center padder m-t"> 
				<span class="h1"><i class="icon-building text-muted"></i> <?php echo $r_get_jml_pt->jml_pt; ?></span> 
			</div> 
		</div>
	</section> 
</div>
<div class="col-lg-4"> 
	<section class="panel bg-warning lter no-borders">
		<?php 
			$q_get_jml_kelas = $this->db->query("SELECT COUNT(*) AS jml_kelas FROM kelas");
			$r_get_jml_kelas = $q_get_jml_kelas->row();
		?>
		<div class="panel-body"> <a class="pull-right" href="#"><i class="icon-rocket"></i></a> 
			<span class="h4">Jumlah Kelas</span> 
			<div class="text-center padder m-t"> 
				<span class="h1"><i class="icon-beaker text-muted"></i> <?php echo $r_get_jml_kelas->jml_kelas; ?></span> 
			</div> 
		</div>
	</section> 
</div>