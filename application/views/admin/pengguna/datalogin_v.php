<section class="panel">
	<header class="panel-heading font-bold"><?=$title_inbox?></header>
	<div class="panel-body">
		<div class="table-responsive"> 
			<table class="table m-b-none dataTable">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Lengkap</th>
						<th>NPM</th>
						<th>IP Address</th>
						<th>Tanggal</th>
						<th>Jam</th>
						<th>Deskripsi</th>
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
								echo '<td>'.$row->id_pengguna.'</td>';
								echo '<td>'.$row->ip_login.'</td>';
								echo '<td>'.date('d-m-Y', strtotime ($row->date)).'</td>';
								echo '<td>'.$row->time.'</td>';
								echo '<td>'.$row->user_agent.'</td>';
							echo '</tr>';
						} //end foreach
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>