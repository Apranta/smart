<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Penilaian Pegawai</h4>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="grafik" style="width: 100%;">
                                        
                                    </div>
                                    <hr>
                                    <style type="text/css">
                                        tr th, tr td {text-align: center; padding: 1%;}
                                    </style>
                                    <table width="100%" class="table table-striped table-bordered table-hover dataTables-example" id="">
                                        <thead>
                                            <tr>
                                                <th>Rangking</th>
                                                <th>Nama</th>
                                                <th>Seleksi Berkas</th>
                                                <th>Tes Tertulis</th>
                                                <th>Wawancara</th>
                                                <th>Nilai Akhir</th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i= 0; foreach ($data as $pegawai): ?>
                                            <tr>
                                                <td><?= ++$i ?></td>
                                                <td><?= $pegawai->nama ?></td>
                                                <td><?= ($pegawai->berkas == 1)? 'LULUS' : 'Tidak Lulus' ?></td>
                                                <td><?= ($pegawai->tes == 1)? 'LULUS' : 'Tidak Lulus' ?></td>
                                                <td><?= ($pegawai->wawancara == 1)? 'LULUS' : 'Tidak Lulus' ?></td>
                                                <td><?= $total[$pegawai->username] ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody> 
                                    </table>
                                    <hr>
                                    <?php if ($this->session->userdata('role') == 2): ?>
                                        <div class="row">
                                        <div class="col-md-6">

                                            <h4 class="text-center">
                                                Data Calon Pegawai yang LULUS
                                            </h4>
                                            <table class="table ">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($this->Pegawai_m->get(['wawancara' => 1]) as $pegawai): ?>
                                                    <tr>
                                                        <td><?= $pegawai->nama ?></td>
                                                        <td>LULUS</td>
                                                        <td>
                                                            <?php if ($this->session->userdata('role') == 2): ?>
                                                                
                                                            <button class="btn btn-danger" onclick="_batal('<?= $pegawai->username ?>')">BATALKAN</button>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">

                                            <h4 class="text-center">
                                                Data Calon Pegawai yang TIDAK LULUS
                                            </h4>
                                            <table class="table ">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($this->Pegawai_m->get(['wawancara' => 9]) as $pegawai): ?>
                                                    <tr>
                                                        <td><?= $pegawai->nama ?></td>
                                                        <td>TIDAK LULUS</td>
                                                        <td>
                                                            <?php if ($this->session->userdata('role') == 2): ?>
                                                                
                                                            <button class="btn btn-success" onclick="_lulus('<?= $pegawai->username ?>')">LULUSKAN</button>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/scripts/highcharts.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/scripts/exporting.js') ?>" type="text/javascript"></script>
            <script>
                $(document).ready(function() {
                    $('.input-group.date').datepicker({format: "yyyy-mm-dd"});
                    
                    $('.dataTables-example').DataTable({
                        pageLength: 25,
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                            {
                                extend: 'excel', 
                                title: 'Data Pegawai Lulus',
                            },
                            {
                                extend: 'pdf', 
                                title: 'Data Pegawai Lulus',
                            },
                        ]

                    });

            

                });

                Highcharts.chart('grafik', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Data Penilaian Calon Pegawai'
                    },
                    xAxis: {
                        categories: [
                            'Nilai Akhir'
                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Nilai'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.3f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [
                    <?php foreach ($total as $key => $value): ?>
                    {
                        name: '<?= $this->Pegawai_m->get_row(['username' => $key])->nama ?>',
                        data: [<?= $value ?>]
                    },
                    <?php endforeach ?>
                    ]
                });

    function _lulus(id) {
        // body...
        $.ajax({
            url: "<?= base_url('manager/nilai_pegawai') ?>",
            type: 'POST',
            data: {
                id : id,
                lulus: true
            },
            success: function() {

                    window.location = "<?= base_url('manager/nilai_pegawai') ?>";
            }
        });
    }

    function _batal(id) {
        // body...
        $.ajax({
            url: "<?= base_url('manager/nilai_pegawai') ?>",
            type: 'POST',
            data: {
                id : id,
                batal: true
            },
            success: function() {
                
                    window.location = "<?= base_url('manager/nilai_pegawai') ?>";
            }
        });
    }
            </script>