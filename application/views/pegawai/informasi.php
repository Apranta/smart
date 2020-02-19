<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <!-- OVERVIEW -->
                    <h3>Papan Informasi</h3>
                   <div class="row">
                       <?php foreach ($informasi as $value): ?>
                           <div class="col-md-4">
                                <div class="panel panel-headline">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?= $value->judul ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                            <?= $value->isi ?>
                                        </p>
                                    </div>
                                </div>
                           </div>
                       <?php endforeach ?>
                   </div>
                </div>
            </div>
        </div>