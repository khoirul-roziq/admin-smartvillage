<?= $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>
<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- START CONTENT -->
<section id="content">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper">
        <!-- Search for small screen -->
        <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
            <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
        </div>
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title">Data Layanan</h5>
                    <ol class="breadcrumbs">
                        <li><a href="index.html">Dashboard</a></li>
                        <li><a href="index.html">Data Layanan</a></li>
                        <li class="active">Tambah Data</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!--breadcrumbs end-->



    <main class="container mt-3 mb-3">
        <?php if (session()->getFlashdata('massage')) : ?>
            <div class="card-panel gradient-45deg-red-pink gradient-shadow" style="color: white;">
                <span>Data yang anda masukan tidak valid!</span>
            </div>
        <?php endif; ?>
        <div id="basic-form" class="section">
            <div class="row">
                <div class="col s12 m12 l9">
                    <div class="card-panel">
                        <h4 class="header2">Tambah Data Layanan</h4>
                        <div class="row">
                            <form class="col s12" method="post" action="<?= base_url('layanan/store') ?>">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="kodeLayanan" name="kodeLayanan" type="text" value="<?= old('kodeLayanan'); ?>">
                                        <label for="kodeLayanan">Kode Layanan</label>
                                        <small style="color: red;"><?= $validation->getError('kodeLayanan'); ?></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="namaLayanan" name="namaLayanan" type="text" value="<?= old('namaLayanan'); ?>">
                                        <label for="namaLayanan">Nama Layanan</label>
                                        <small style="color: red;"><?= $validation->getError('namaLayanan'); ?></small>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="hargaLayanan" name="hargaLayanan" type="text" value="<?= old('hargaLayanan'); ?>">
                                        <label for="hargaLayanan">Harga Layanan</label>
                                        <small style="color: red;"><?= $validation->getError('hargaLayanan'); ?></small>
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light right" type="submit" name="action">Kirim
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <?= $this->endSection() ?>