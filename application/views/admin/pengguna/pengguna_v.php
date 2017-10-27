<section class="panel">
	<header class="panel-heading font-bold"><?=$title_inbox?></header>
	<div class="panel-body">
		<div class="table-responsive"> 
			<table class="table m-b-none dataTable">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Lengkap</th>
						<th>Email</th>
						<th>No. telepon</th>
						<th>Tanggal Lahir</th>
						<th>Status Pengguna</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$n = 0;
						foreach ($query as $row) {
							$n++;
							
							echo '<tr>';
								echo '<td>'.$n.'</td>';
								echo '<td>'.$row->nama_lengkap.'</td>';
								echo '<td>'.$row->email.'</td>';
								echo '<td>'.$row->no_telp.'</td>';
								echo '<td>'.$row->tgl_lahir.'</td>';
								echo '<td>'.$row->status_pengguna.'</td>';
								echo '<td>';
										echo anchor('admin/pengguna/hapus/'.$row->id_pengguna.'', '<i class="icon-remove"></i>Hapus', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));
								echo '</td>';
							echo '</tr>';
						} //end foreach
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>