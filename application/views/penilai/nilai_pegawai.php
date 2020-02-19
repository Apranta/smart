<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3><?= $data->nama ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="<?= base_url('assets/img/pegawai/' . $data->username . '.jpg') ?>" width="250px" class="img img-thumbnail" onerror='this.src="http://placehold.it/250"'>
                                </div>
                                <div class="col-md-9">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tempat , Tanggal Lahir</th>
                                                <th><?= $data->tempat_lahir . ' , ' . $data->tanggal_lahir ?></th>
                                            </tr>
                                            <tr>
                                                <th>Telepon</th>
                                                <th><?= $data->telepon ?></th>
                                            </tr>
                                            <tr>
                                                <th>Tahun Penerimaan</th>
                                                <th><?= $data->tahun_penerimaan ?></th>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <th><?= $data->alamat ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Pendidikan</th>
                                            </tr>
                                            <tr>
                                                <th>Nama Institusi</th>
                                                <th>Jenjang Pendidikan</th>
                                                <th>Tahun Lulus</th>
                                            </tr>
                                            <?php $pendidikan = json_decode($data->pendidikan);
                                            foreach ($pendidikan as $pend) : ?>
                                                <tr>
                                                    <th><?= $pend->nama ?></th>
                                                    <th><?= $pend->pendidikan ?></th>
                                                    <th><?= $pend->lulus ?></th>
                                                </tr>
                                            <?php endforeach; ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <h3 class="text-center">Penilaian Wawancara</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Pengalaman Kerja</th>
                                            </tr>
                                            <tr>
                                                <th>Nama Instansi</th>
                                                <th>Posisi</th>
                                                <th>Masa Kerja</th>
                                            </tr>
                                            <?php $pengalaman = json_decode($data->pengalaman_kerja);
                                            foreach ($pengalaman as $peng) : ?>
                                                <tr>
                                                    <th><?= $peng->nama ?></th>
                                                    <th><?= $peng->posisi ?></th>
                                                    <th><?= $peng->masa_kerja ?></th>
                                                </tr>
                                            <?php endforeach; ?>
                                        </thead>
                                    </table>
                                    <h4>Genre Musik</h4>
                                    <ul class="list-group">
                                        <?php $genre = explode("," , $data->genre_musik);
                                        foreach ($genre as $g) : ?>
                                            <li class="list-group-item"><?= $g ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <h4>Bahasa yang di kuasai</h4>
                                    <ul class="list-group">
                                        <?php $bahasa = explode("," , $data->bahasa);
                                        foreach ($bahasa as $g) : ?>
                                            <li class="list-group-item"><?= $g ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <h4>Alamat</h4>
                                    <p><?= $data->alamat ?></p>
                                </div>
                                <div class="col-md-6">
                                    <?= form_open('penilai/pnilai_pegawai/' . $data->id_pegawai); ?>
                                    <h4>Input Nilai</h4>
                                    <?php foreach ($this->Kriteria_m->get() as $kriteria) : ?>
                                        <div class="form-group label-floating">
                                            <label class="control-label"><?= $kriteria->nama ?></label>
                                            <!-- <input type="number" name="<?= $kriteria->id ?>" value="0" class="form-control" max="100" min="0"> -->
                                            <select name="<?= $kriteria->id ?>" class="form-control chosen-select" id="select">
                                                <option value="">Silahkan Pilih</option>
                                                <?php foreach ($this->Nilai_kriteria_m->get(['kriteria' => $kriteria->id]) as $value) : ?>
                                                    <option value="<?= $value->id ?>"> <?= $value->parameter ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endforeach; ?>

                                    <input name="simpan" value="Simpan" type="submit" class="btn btn-info">
                                    </form>
                                    <hr>
                                    <?= form_open('penilai/pnilai_pegawai/' . $data->id_pegawai); ?>
                                        <div class="form-group">
                                            <label>Jarak</label>
                                            <select name="nilai" class="form-control">
                                                <option value="100">1 KM - 5 KM</option>
                                                <option value="80">6 KM - 10 KM</option>
                                                <option value="60">11 KM - 15 KM</option>
                                                <option value="40">16 KM - 20 KM</option>
                                                <option value="20">21 KM - 25 KM</option>
                                                <option value="0"> >25 KM</option>
                                            </select>
                                        </div>
                                    <input name="domisili" value="Simpan" type="submit" class="btn btn-info">

                                    <?= form_close() ?>

                                </div>
                            </div>
                            <hr>
                            <h3 class="text-center">Data Berkas Administrasi</h3>
                            <table class="table table-striped">
                                <tbody>
                                    <?php foreach ($this->Berkas_m->get() as $key) : ?>
                                        <tr>
                                            <td><?= $key->nama ?></td>
                                            <td>
                                                <?php
                                                $b = $this->Data_berkas_m->get_row(['id_pegawai' => $data->username, 'id_data_berkas' => $key->id_berkas]);
                                                if (isset($b)) : ?>
                                                    <a href="<?= base_url('assets/berkas/' . $b->id . '.jpg') ?>" download class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success" onclick="lulus('<?= $data->id_pegawai ?>')">Lengkap</button>
                                <button type="button" class="btn btn-danger" onclick="batal('<?= $data->id_pegawai ?>')">Tidak Lengkap</button>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function lulus(username) {
    	// alert('aa');
    	$.ajax({
                url: "<?= base_url('penilai/pnilai_pegawai') ?>",
                type: 'POST',
                data: {
                    id_pegawai: username,
                    konfirm: true
                },
                success: function() {
                    window.location = "<?= base_url('penilai/pnilai_pegawai') ?>";
                }
            });
    }

    function batal(username) {
        // alert('aa');
        $.ajax({
                url: "<?= base_url('penilai/pnilai_pegawai') ?>",
                type: 'POST',
                data: {
                    id_pegawai: username,
                    notkonfirm: true
                },
                success: function() {
                    window.location = "<?= base_url('penilai/pnilai_pegawai') ?>";
                }
            });
    }
</script>