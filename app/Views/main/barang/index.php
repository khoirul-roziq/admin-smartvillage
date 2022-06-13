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
                    <h5 class="breadcrumbs-title">Data Barang</h5>
                    <ol class="breadcrumbs">
                        <li><a href="index.html">Dashboard</a></li>
                        <li class="active">Data Barang</li>
                    </ol>
                </div>
                <div class="col s2 m6 l6">
                    <!-- <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-activates="dropdown1"> -->
                    <a class="btn-floating btn-large waves-effect waves-light breadcrumbs-btn right dropdown-settings mr-3" data-activates="dropdown1" href="<?= base_url('barang/create'); ?>">
                        <i class="material-icons">add</i>
                    </a>
                    <!-- </a> -->
                    <ul id="dropdown1" class="dropdown-content">
                        <li><span class="grey-text text-darken-2">Tambah Data</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->

    <!-- Start Main -->

    <main class="container mt-3 mb-3">
        <?php if (session()->getFlashdata('massage')) : ?>
            <div class="card-panel gradient-45deg-light-blue-teal gradient-shadow" style="color:darkgreen;">
                <span><?= session()->getFlashdata('massage'); ?></span>
            </div>
        <?php endif; ?>

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barang as $index) : ?>
                    <tr>
                        <td><?= $index['kode_barang']; ?></td>
                        <td><?= $index['nama_barang']; ?></td>
                        <td><?="Rp. ". number_format($index['harga_barang'],2,".",",") ?></td>
                        <td><a href="<?= base_url('barang/'.$index['kode_barang'].'/edit') ?>" ><i class="material-icons">mode_edit</i></a>
                        <a href="<?= base_url('barang/'.$index['kode_barang'].'/delete') ?>" ><i class="material-icons">delete</i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </main>

    <!-- end Main -->
</section>
<!-- END CONTENT -->
<?= $this->endSection() ?>