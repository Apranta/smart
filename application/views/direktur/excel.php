<?php
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Laporan-Penilaian.xls");

?>
<center>
	Laporan Hasil Penilaian Calon Pegawai
</center>
<style type="text/css">
	tr th,
	tr td {
		text-align: center;
		padding: 1%;
	}

	table {
		width: 100%;
		border: 1;
	}
</style>
<table class="table table-bordered" border="1">
	<thead>
		<tr>
			<th rowspan="3" valign="center" style="vertical-align: center !important;">#</th>
			<th rowspan="3" valign="center" style="vertical-align: center !important;">Nama</th>
			<th colspan="<?= count($this->Kriteria_m->get()) + 2 ?>">Kriteria</th>
			<th rowspan="3">Total</th>
		</tr>
		<tr>
			<th rowspan="2">Domisili</th>
			<th rowspan="2">Nilai tes</th>
			<th colspan="<?= count($this->Kriteria_m->get()) ?>">Wawancara</th>
		</tr>
		<tr>

			<?php foreach ($this->Kriteria_m->get() as $kri) : ?>
				<th><?= $kri->nama ?></th>
			<?php endforeach ?>
		</tr>
	</thead>
	<tbody>
		<?php $i = 0;
		foreach ($data as $pegawai) :
			$total_all[$pegawai->id_pegawai] = 0;
		?>
			<tr>
				<td><?= ++$i; ?></td>
				<td><?= $pegawai->nama ?></td>
				<td><?php
					$t = $this->Domisili_m->get_row(['id_pegawai' => $pegawai->id_pegawai])->nilai;
					$total_all[$pegawai->id_pegawai] += $t;
					echo $t; ?> KM</td>
				<td><?php
					$s = $this->Tes_tertulis_m->get_row(['id_pegawai' => $pegawai->id_pegawai])->nilai;
					$total_all[$pegawai->id_pegawai] += $s;
					echo $s;
					?></td>
				<?php
				$total[$pegawai->id_pegawai] = 0;
				foreach ($this->Kriteria_m->get() as $kri) : ?>
					<td><?php
						$nilai = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->id_pegawai, 'id_kriteria' => $kri->id]);
						if (!isset($nilai)) {
							$total[$pegawai->id_pegawai] += 0;
							echo "0";
						} else {
							$val = ($this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])->nilai : 0;
							$total[$pegawai->id_pegawai] += $val;
							echo $val;
						}
						?></td>
				<?php endforeach ?>
				<td><?= $total[$pegawai->id_pegawai] + $total_all[$pegawai->id_pegawai] ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>