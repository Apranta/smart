
<?php 
	header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Laporan-Penilaian.xls");
 
 ?>
<center>
Laporan Hasil Penilaian Calon Pegawai
</center>
<style type="text/css">
tr th, tr td {text-align: center; padding: 1%;}
table {
	width: 100%;
}
</style>
<table class="table table-bordered">
	<thead>
		<tr>
			<th rowspan="2" valign="center" style="vertical-align: center !important;">#</th>
			<th rowspan="2" valign="center" style="vertical-align: center !important;">Nama</th>
			<th colspan="<?= count($this->Kriteria_m->get()) ?>">Kriteria</th>
			<th rowspan="2">Total</th>
		</tr>
		<tr>
			<?php foreach ($this->Kriteria_m->get() as $kri): ?>
			<th><?= $kri->nama ?></th>
			<?php endforeach ?>
		</tr>
	</thead>
	<tbody>
		<?php $i=0; foreach ($data as $pegawai): ?>
		<tr>
			<td><?= ++$i; ?></td>
			<td><?= $pegawai->nama ?></td>
			<?php
			$total[$pegawai->username] = 0;
			foreach ($this->Kriteria_m->get() as $kri): ?>
			<th><?php
				$nilai = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->username , 'id_kriteria' => $kri->id]);
				if (!isset($nilai)) {
				$total[$pegawai->username]+=0;
				echo "0";
				}
				else{
				$val = ($this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])->bobot : 0;
				$total[$pegawai->username]+=$val;
				echo $val;
				}
			?></th>
			<?php endforeach ?>
			<td><?= $total[$pegawai->username] ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>