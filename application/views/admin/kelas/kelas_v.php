<section class="panel">
	<header class="panel-heading font-bold"><?=$title_inbox?></header>
	<div class="panel-body">
		<div class="table-responsive"> 
			<table class="table m-b-none dataTable">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Perguruan Tinggi</th>
						<th>Nama Kelas</th>
						<th>Pembuat</th>
						<th>Tanggal Di Buat</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$n = 0;
						foreach ($query as $row) {
							$n++;
							$datecreated = date("Y-m-d", strtotime($row->datecreated));
							echo '<tr>';
								echo '<td>'.$n.'</td>';
								echo '<td>'.$row->nama_pt.'</td>';
								echo '<td>'.$row->nama_kelas.'</td>';
								echo '<td>'.$row->nama_lengkap.' ['.$row->id_pengguna.']</td>';
								echo '<td>'.tgl_indo($datecreated).'</td>';
								echo '<td>';
										echo anchor('admin/kelas/hapus/'.$row->kode_kelas.'', '<i class="icon-remove"></i>Hapus', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));
								echo '</td>';
							echo '</tr>';
						} //end foreach
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>