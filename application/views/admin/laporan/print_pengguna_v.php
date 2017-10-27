<?php
	tcpdf();
	$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
		$head = '<h3 style="text-align: center">Laporan Pengguna Sistem Informasi Interaksi Dosen dan Mahasiswa</h3>';
		
		$status_pengguna= $this->input->post('status_pengguna');
	    $tgl_awal		= $this->input->post('tgl_awal');
	    $tgl_akhir		= $this->input->post('tgl_akhir');

		$ttgl_awal 		= date("d/m/Y", strtotime($tgl_awal));
		$ttgl_akhir		= date("d/m/Y", strtotime($tgl_akhir));
		$tgl_sekarng	= date("d/m/Y");

		if(($status_pengguna != "") AND ($tgl_awal != "") AND ($tgl_akhir != "")){
			$top = '<p style="text-align: center">Status Pengguna : '.$status_pengguna.' <br>Dari Tanggal Awal Registrasi : '.$ttgl_awal.' - Dari Tanggal Akhir Registrasi :'.$ttgl_akhir.'</p><br/>';
		}elseif(($status_pengguna != "") AND ($tgl_awal != "") AND ($tgl_akhir == "")){
			$top = '<p style="text-align: center">Status Pengguna : '.$status_pengguna.' <br>Dari Tanggal Awal Registrasi : '.$ttgl_awal.'</p><br/>';
		}elseif(($status_pengguna != "") AND ($tgl_awal == "") AND ($tgl_akhir == "")){
			$top = '<p style="text-align: center">Status Pengguna : '.$status_pengguna.'</p><br/>';
		}elseif(($status_pengguna != "") AND ($tgl_awal == "") AND ($tgl_akhir != "")){
			$top = '<p style="text-align: center">Status Pengguna : '.$status_pengguna.'<br>Dari Tanggal Awal Registrasi : '.$tgl_sekarng.' - Dari Tanggal Akhir Registrasi :'.$ttgl_akhir.'</p><br/>';
		}elseif(($status_pengguna == "") AND ($tgl_awal == "") AND ($tgl_akhir != "")){
			$top = '<p style="text-align: center">Dari Tanggal Akhir Registrasi : '.$ttgl_akhir.'</p><br/>';
		}elseif(($status_pengguna == "") AND ($tgl_awal != "") AND ($tgl_akhir == "")){
			$top = '<p style="text-align: center">Dari Tanggal Awal Registrasi : '.$ttgl_awal.'</p><br/>';
		}elseif(($status_pengguna == "") AND ($tgl_awal != "") AND ($tgl_akhir != "")){
			$top = '<p style="text-align: center">Dari Tanggal Registrasi : '.$ttgl_awal.' - '.$ttgl_akhir.'</p><br/>';
		}else{
			$top = '<br/>';
		}

	    // $content = ob_get_contents();
	    $content = '<table width="100%" cellpadding="5" border="0.6">
						<thead>
							<tr>
								<th width="5%" align="center" valign="middle">No.</th>
								<th width="17%" align="center" valign="middle">Nama Lengkap</th>
								<th width="15%" align="center" valign="middle">Email</th>
								<th width="10%" align="center" valign="middle">No. telepon</th>
								<th width="10%" align="center" valign="middle">Tanggal Lahir</th>
								<th width="8%" align="center" valign="middle">Status Pengguna</th>
								<th width="17%" align="center" valign="middle">Perguruan Tinggi</th>
								<th width="18%" align="center" valign="middle">Kelas</th>
							</tr>
						</thead>
						<tbody>';
					$n = 0;
					foreach ($query as $row) {
						$n++;
						if($row->tgl_lahir != ""){
							$tgl_lahir = date("d/m/Y", strtotime($row->tgl_lahir));
						}else{
							$tgl_lahir = "";
						}
						$content .= '<tr>';
							$content .= '<td width="5%">'.$n.'</td>';
							$content .= '<td width="17%">'.$row->nama_lengkap.'</td>';
							$content .= '<td width="15%">'.$row->email.'</td>';
							$content .= '<td width="10%">'.$row->no_telp.'</td>';
							$content .= '<td width="10%">'.$tgl_lahir.'</td>';
							$content .= '<td width="8%">'.$row->status_pengguna.'</td>';
							$content .= '<td width="17%">';

								$q_pt = $this->db->query("SELECT a.nama_pt FROM perguruan_tinggi AS a LEFT JOIN pt_pengguna AS b ON b.kode_pt = a.kode_pt WHERE b.id_pengguna = '$row->id_pengguna'");
		                    	$c_pt = $q_pt->num_rows();

		                    	$p=0;
		                    	foreach ($q_pt->result() as $r_pt)
								{
									$p++;
								    $content .= "$r_pt->nama_pt";

								    if ($c_pt != $p) {
								    	$content .= ", ";
								    }
								}

							$content .= '</td>';
							$content .= '<td width="18%">';

								$q_kelas = $this->db->query("SELECT a.nama_kelas FROM kelas AS a LEFT JOIN kelas_pengguna AS b ON b.kode_kelas = a.kode_kelas WHERE b.id_pengguna = '$row->id_pengguna'");
		                    	$c_kelas = $q_kelas->num_rows();

		                    	$k=0;
		                    	foreach ($q_kelas->result() as $r_kelas)
								{
									$k++;
								    $content .= "$r_kelas->nama_kelas";

								    if ($c_kelas != $k) {
								    	$content .= ", ";
								    }
								}

							$content .= '</td>';
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