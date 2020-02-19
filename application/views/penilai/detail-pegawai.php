<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Detail Pegawai
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="<?= base_url('assets/img/pegawai/' . $data->username .'.jpg') ?>" width="250px" class="img img-thumbnail" onerror = 'this.src="http://placehold.it/250"'>
                                            <hr>
                                            <h4 class="text-center"><?= $data->nama ?></h4>
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
                                                        <th>Pendidikan</th>
                                                        <th><?= $data->pendidikan ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Tahun Penerimaan</th>
                                                        <th><?= $data->tahun_penerimaan ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat</th>
                                                        <th><?= $data->alamat ?></th>
                                                    </tr>
                                                    <tr><th colspan="2">Seleksi</th></tr>
                                                    <tr>
                                                        <th>Administrasi</th>
                                                        <th><?= ($data->berkas == 1 )? 'Lulus' : 'Tidak Lulus' ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Tes Tertulis</th>
                                                        <th><?= ($data->tes == 1 ) ? 'Lulus' : 'Tidak Lulus' ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Wawancara</th>
                                                        <th><?= ($data->wawancara == 1 ) ? 'Lulus' : 'Tidak Lulus' ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>  
                                    <hr>
                                    <h3 class="text-center">Data Berkas Administrasi</h3>
                                    <table class="table table-striped">
                                        <tbody>
                                            <?php foreach ($this->Berkas_m->get() as $key): ?>
                                            <tr>
                                                <td><?= $key->nama ?></td>
                                                <td>
                                                    <?php
                                                        $b = $this->Data_berkas_m->get_row(['id_pegawai' => $data->username , 'id_data_berkas' => $key->id_berkas]);          
                                                     if (isset($b)): ?>
                                                        <a href="<?= base_url('assets/berkas/' . $b->id .'.jpg') ?>" download class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h3 class="text-center">Nilai Tes Tertulis</h3>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <?php foreach ($this->Nilai_tes_m->get() as $value): ?>
                                                    
                                                <th><?= $value->nama ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach ($this->Nilai_tes_m->get() as $value): ?>
                                                    <td><?= ($this->Tes_tertulis_m->get_row(['id_pendaftar' => $data->username , 'id_nilai' => $value->id_nilai])) ? $this->Tes_tertulis_m->get_row(['id_pendaftar' => $data->username , 'id_nilai' => $value->id_nilai])->nilai : 0 ?> </td>
                                                <?php endforeach ?>
                                            </tr>
                                        </tbody>
                                    </table>                
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>