<?php
	tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica', '', 9);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, 12, PDF_MARGIN_RIGHT);
	$obj_pdf->setPrintFooter(false);
	$obj_pdf->setPrintHeader(false);
	$obj_pdf->AddPage();
	ob_start();
	    // we can have any view part here like HTML, PHP etc
		$head = '<h3 style="text-align: center;" >Interaksi Dosen Dan Mahasiswa (INDOSMA)</h3><br>';
		$top = '<h3>List Nilai Tugas : '.$nama_tugas.'<br>Kelas : '.$nama_kelas.'</h3><br>';
		
		$content = '<table width="100%" cellpadding="5" border="0.6">
						<thead>
							<tr>
								<th width="5%" align="center" valign="middle">No.</th>
								<th width="22%" align="center" valign="middle">NPM</th>
								<th width="53%" align="center" valign="middle">Nama Lengkap</th>
								<th width="20%" align="center" valign="middle">Nilai</th>
							</tr>
						</thead>
						<tbody>';
					$n = 0;
					foreach ($query as $row) {
						$n++;
						$content .= '<tr>';
							$content .= '<td width="5%">'.$n.'</td>';
							$content .= '<td width="22%">'.$row->id_pengguna.'</td>';
							$content .= '<td width="53%">'.$row->nama_lengkap.'</td>';

							//get nilai
							$q_get_nilai = $this->db->query("SELECT nilai_tugas FROM nilai_tugas WHERE id_tugas = '$id_tugas' AND id_pengguna = '$row->id_pengguna'");
							$row_nilai = $q_get_nilai->row();

							$content .= '<td width="20%">'.$row_nilai->nilai_tugas.'</td>';
						$content .= '</tr>';
					} //end foreach
		$content .= '</tbody>
					</table>';

		date_default_timezone_set('Asia/Jakarta');
		$datetime = date("Y-m-d");

		$foot = '<br>';
		$foot .= '<h3 style="text-align: right;">'.tgl_indo($datetime).'<br><br><br><br></h3><h3 style="text-align: right;"><u>'.$nama_dosen.'</u></h3>';

	ob_end_clean();
	$obj_pdf->writeHTML($head, true, 0, true, 0);
	$obj_pdf->writeHTML($top, true, 0, true, 0);
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	$obj_pdf->writeHTML($foot, true, 0, true, 0);
	$obj_pdf->Output('daftar_nilai_tugas.pdf', 'I');
?>