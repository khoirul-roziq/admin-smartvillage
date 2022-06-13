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
                    <h5 class="breadcrumbs-title">Data Pelanggan</h5>
                    <ol class="breadcrumbs">
                        <li><a href="index.html">Dashboard</a></li>
                        <li class="active">Data Pelanggan</li>
                    </ol>
                </div>
                <div class="col s2 m6 l6">
                    <!-- <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-activates="dropdown1"> -->
                    <a class="btn-floating btn-large waves-effect waves-light breadcrumbs-btn right dropdown-settings mr-3" data-activates="dropdown1" href="<?= base_url('pelanggan/create'); ?>">
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
                    <th>Nama Pelanggan</th>
                    <th>Nama Desa</th>
                    <th>Telpon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pelanggan as $index) : ?>
                    <tr>
                        <td><?= $index['nama_pelanggan']; ?></td>
                        <td><?= $index['nama_desa']; ?></td>
                        <td><?= $index['no_telp']; ?></td>
                        <td><?= $index['email']; ?></td>
                        <td><?= $index['alamat']; ?></td>
                        <td><a href="<?= base_url('pelanggan/'.$index['id_pelanggan'].'/edit') ?>" ><i class="material-icons">mode_edit</i></a>
                        <a href="<?= base_url('pelanggan/'.$index['id_pelanggan'].'/delete') ?>" ><i class="material-icons">delete</i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>Nama Desa</th>
                    <th>Telpon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </main>

    <!-- end Main -->
</section>
<!-- END CONTENT -->
<?= $this->endSection() ?>