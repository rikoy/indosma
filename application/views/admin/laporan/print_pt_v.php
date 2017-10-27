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
		$head = '<h3 style="text-align: center">Laporan Perguruan Tinggi Sistem Informasi Interaksi Dosen dan Mahasiswa</h3>';
		
		$status_pengguna= $this->input->post('status_pengguna');
	    $tgl_awal		= $this->input->post('tgl_awal');
	    $tgl_akhir		= $this->input->post('tgl_akhir');

		$ttgl_awal 		= date("d/m/Y", strtotime($tgl_awal));
		$ttgl_akhir		= date("d/m/Y", strtotime($tgl_akhir));
		$tgl_sekarng	= date("d/m/Y");

		if(($tgl_awal == "") AND ($tgl_akhir != "")){
			$top = '<p style="text-align: center">Dari Tanggal Awal Dibuat : '.$ttgl_awal.'</p><br/>';
		}elseif(($tgl_awal != "") AND ($tgl_akhir == "")){
 			$top = '<p style="text-align: center">Dari Tanggal Awal Dibuat : '.$ttgl_awal.'</p><br/>';
		}elseif(($tgl_awal != "") AND ($tgl_akhir != "")){
 			$top = '<p style="text-align: center">Dari Tanggal Dibuat : '.$ttgl_awal.' - '.$ttgl_akhir.'</p><br/>';
 		}else{
 			$top = '<br/>';
 		}

	    // $content = ob_get_contents();
	    $content = '<table width="100%" cellpadding="5" border="0.6">
						<thead>
							<tr>
								<th width="5%" align="center" valign="middle">No.</th>
								<th width="22%" align="center" valign="middle">Nama Lengkap</th>
								<th width="28%" align="center" valign="middle">Alamat</th>
								<th width="10%" align="center" valign="middle">Kode POS</th>
								<th width="15%" align="center" valign="middle">No Telepon</th>
								<th width="20%" align="center" valign="middle">Nama Pembuat</th>
							</tr>
						</thead>
						<tbody>';
					$n = 0;
					foreach ($query as $row) {
						$n++;
						$content .= '<tr>';
							$content .= '<td width="5%">'.$n.'</td>';
							$content .= '<td width="22%">'.$row->nama_pt.'</td>';
							$content .= '<td width="28%">'.$row->alamat_pt.'</td>';
							$content .= '<td width="10%">'.$row->kode_pos_pt.'</td>';
							$content .= '<td width="15%">'.$row->no_telp_pt.'</td>';
							$content .= '<td width="20%">'.$row->nama_lengkap.'</td>';
						$content .= '</tr>';
					} //end foreach
		$content .= '</tbody>
					</table>';

	ob_end_clean();
	$obj_pdf->writeHTML($head, true, 0, true, 0);
	$obj_pdf->writeHTML($top, true, 0, true, 0);
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	$obj_pdf->Output('laporan_pengguna.pdf', 'I');
?>