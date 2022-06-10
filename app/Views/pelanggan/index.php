<?= $this->extend('templates/layout_admin') ?>

<?= $this->section('toolsHeader') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataId').DataTable();
    });
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tables
        </h2>
        <!-- CTA -->
        <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple" href="https://github.com/estevanmaito/windmill-dashboard">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span>Star this project on GitHub</span>
            </div>
            <span>View more &RightArrow;</span>
        </a>

        <!-- With actions -->
        <?php if (session()->getFlashdata('massage')) : ?>
            <div class="block w-full px-4 py-2 mt-4 mb-6 text-sm font-medium leading-5 text-center transition-colors duration-150 border border-transparent rounded-lg" style="color: teal; background-color:aquamarine">
                <span><?= session()->getFlashdata('massage'); ?></span>
            </div>
        <?php endif; ?>

        <table id="dataId" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>Nama Desa</th>
                    <th>Telpon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pelanggan as $index ) :?>
                <tr>
                    <td><?= $index['nama_pelanggan']; ?></td>
                    <td><?= $index['nama_desa']; ?></td>
                    <td><?= $index['no_telp']; ?></td>
                    <td><?= $index['email']; ?></td>
                    <td><?= $index['alamat']; ?></td>
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
                </tr>
            </tfoot>
        </table>


    </div>
</main>


<?= $this->endSection() ?>

<?= $this->section('toolsFooter') ?>

<?= $this->endSection() ?>