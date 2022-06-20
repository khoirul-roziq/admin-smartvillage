<main class="h-full pb-16 overflow-y-auto">
  <div class="container grid px-6 mx-auto">


    <!-- With actions -->
    <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300">
      Detail Pelanggan
    </h4>

    <div class="min-w-full mb-8 p-4 text-white bg-purple-600 rounded-lg shadow-xs dark:text-white">
      <?php
      $nama = $transaksi[0]["nama_pelanggan"];
      $alamat = $transaksi[0]["alamat"];
      $telp = $transaksi[0]["no_telp"];
      ?>
      <div class="flex items-center  text-sm">
        <!-- Avatar with inset shadow -->
        <div class="relative hidden mr-3 md:block">
          <img class="object-cover" style="height:200px;" src="<?= base_url('/assets/img/avatar.png') ?>" alt="" loading="lazy" />
          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
        </div>
        <div style="margin-left: 30px;">
          <p class="text-lg font-semibold te">Nama Pelanggan </p>
          <p class="text-base text-white-600  mb-4"><?= $nama ?></p>
          <p class="text-lg font-semibold te">Alamat </p>
          <p class="text-base text-white-600  mb-4"><?= $alamat ?></p>
          <p class="text-lg font-semibold te">Kontak </p>
          <p class="text-base text-white-600 "><?= $telp ?></p>
        </div>
      </div>
    </div>
    <div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4 ">
      <button onclick="window.location.href=`<?= base_url('/transaksi/nota-download') . '/' . $transaksi[0]['id_pelanggan'] . '/' . $transaksi[0]['tanggal'] ?>`" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
          <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
          <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
        </svg>
        <span>Print Nota Transaksi</span>
      </button>
    </div>

    <h5 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300">
      Detail Barang
    </h5>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap" id="dataTable">
          <thead>
            <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class="px-4 py-3">Barang</th>
              <th class="px-4 py-3">Harga Barang</th>
              <th class="px-4 py-3">Quantity</th>
              <th class="px-4 py-3">Total Harga</th>
              <th class="px-4 py-3">Tanggal</th>
              <th class="px-4 py-3">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <?php
            foreach ($transaksi as $index => $data) {
              if (esc($data["nama_barang"] != NULL)) {
            ?>
                <tr class="text-gray-700 dark:text-black-400">
                  <td class="px-4 py-3 text-sm">
                    <?php if (esc($data["nama_barang"] != NULL)) {
                      echo esc($data["nama_barang"]);
                    } ?>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?php if (esc($data["nama_barang"] != NULL)) {
                      echo "Rp" . esc(number_format($data["harga_barang"], 2, ',', '.'));
                    } ?>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?php if (esc($data["nama_barang"] != NULL)) {
                      echo esc($data["qty"]);
                    } ?>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?php if (esc($data["nama_barang"] != NULL)) {
                      echo "Rp" . esc(number_format(($data["harga_barang"] * $data["qty"]), 2, ',', '.'));
                    } ?>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?php if (esc($data["nama_barang"] != NULL)) {
                      echo date('d F Y', strtotime(esc($data["tanggal"])));
                    } ?>
                  </td>
                  <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                      <button onclick="window.location.href=`<?= base_url('/transaksi/edit/barang') . '/' . $data['id_transaksi'] ?>`" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                      </button>
                      <button onclick="window.location.href=`<?= base_url('/transaksi/delete/barang') . '/' . $data['id_barang'] . '/' . $data['id_pelanggan'] . '/' . $data['tanggal'] ?>`" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
    <h5 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300">
      Detail Layanan
    </h5>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap" id="dataTableLayanan">
          <thead>
            <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class="px-4 py-3">Layanan</th>
              <th class="px-4 py-3">Harga Layanan</th>
              <th class="px-4 py-3">Quantity</th>
              <th class="px-4 py-3">Total Harga</th>
              <th class="px-4 py-3">Tanggal</th>
              <th class="px-4 py-3">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <?php
            foreach ($transaksi as $index => $data) {
              if (esc($data["nama_layanan"] != NULL)) {

            ?>
                <tr class="text-gray-700 dark:text-black-400">
                  <td class="px-4 py-3 text-sm">
                    <?php if (esc($data["nama_layanan"] != NULL)) {
                      echo esc($data["nama_layanan"]);
                    } ?>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?php if (esc($data["nama_layanan"] != NULL)) {
                      echo  "Rp" . esc(number_format($data["harga_layanan"], 2, ',', '.'));
                    } ?>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <p>1</p>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?= "Rp" . esc(number_format(($data["harga_layanan"]), 2, ',', '.')); ?>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?= date('d F Y', strtotime(esc($data["tanggal"]))) ?>
                  </td>
                  <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                      <button onclick="window.location.href=`<?= base_url('/transaksi/edit/layanan') . '/' . $data['id_transaksi'] ?>`" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                      </button>
                      <button onclick="window.location.href=`<?= base_url('/transaksi/delete/layanan') . '/' . $data['id_layanan'] . '/' . $data['id_pelanggan'] . '/' . $data['tanggal'] ?>`" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
            <?php }
            }; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
</div>
</div>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "language": {
        "decimal": "",
        "emptyTable": "NO DATA FOUND",
        "info": "SHOWING _START_ - _END_ OF _TOTAL_",
        "infoEmpty": "EMPTY",
        "infoFiltered": "(filtered from _MAX_ total entries)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Show _MENU_ entries",
        "loadingRecords": "Loading...",
        "processing": "",
        "search": "Search:",
        "zeroRecords": "No matching records found",
        "paginate": {
          "first": "First",
          "last": "Last",
          "next": "Next",
          "previous": "Previous"
        },
        "aria": {
          "sortAscending": ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
        }
      }
    })

    $('#dataTableLayanan').DataTable({
      "language": {
        "decimal": "",
        "emptyTable": "NO DATA FOUND",
        "info": "SHOWING _START_ - _END_ OF _TOTAL_",
        "infoEmpty": "EMPTY",
        "infoFiltered": "(filtered from _MAX_ total entries)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Show _MENU_ entries",
        "loadingRecords": "Loading...",
        "processing": "",
        "search": "Search:",
        "zeroRecords": "No matching records found",
        "paginate": {
          "first": "First",
          "last": "Last",
          "next": "Next",
          "previous": "Previous"
        },
        "aria": {
          "sortAscending": ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
        }
      }
    })
  });
</script>
</body>

</html>