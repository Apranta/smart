<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <!-- OVERVIEW -->
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h3 class="panel-title">Dashboard Calon Pegawai</h3>
                            <!--<p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>-->
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-10">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Pengumuman Hasil Penerimaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Seleksi Berkas</td>
                                            <td>
                                                <?php 
                                                    switch ($user->berkas) {
                                                        case 1:
                                                            echo '<label class="label label-success"> Diterima </label>';
                                                            
                                                            break;
                                                        case 9:
                                                            echo '<label class="label label-danger"> Ditolak </label>';
                                                            
                                                            break;
                                                        
                                                        default:
                                                            echo '<label class="label label-warning"> Menunggu </label>';
                                                            break;
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Seleksi Tes Tertulis</td>
                                            <td>
                                                <?php 
                                                    switch ($user->tes) {
                                                        case 1:
                                                            echo '<label class="label label-success"> Diterima </label>';
                                                            
                                                            break;
                                                        case 9:
                                                            echo '<label class="label label-danger"> Ditolak </label>';
                                                            
                                                            break;
                                                        
                                                        default:
                                                            echo '<label class="label label-warning"> Menunggu </label>';
                                                            break;
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Seleksi Wawancara</td>
                                            <td>
                                                <?php 
                                                    switch ($user->wawancara) {
                                                        case 1:
                                                            echo '<label class="label label-success"> Diterima </label>';
                                                            
                                                            break;
                                                        case 9:
                                                            echo '<label class="label label-danger"> Ditolak </label>';
                                                            
                                                            break;
                                                        
                                                        default:
                                                            echo '<label class="label label-warning"> Menunggu </label>';
                                                            break;
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="<?= base_url('pegawai/detail_hasil') ?>" class="btn btn-info">Lihat Nilai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>