        <main class="h-full pb-16 overflow-y-auto">
          <div class="container grid px-6 mx-auto">
            <!-- With actions -->
            <h4 class="my-6 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
              Data Pelanggan
            </h4>
            <div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
              <button onclick="window.location.href=`<?= base_url('/pelanggan/create') ?>`" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                  <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg>
                <span>Tambah Pelanggan</span>
              </button>
              <button onclick="window.location.href=`<?= base_url('/pelanggan/importFile') ?>`" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-teal-600 border border-transparent rounded-lg active:bg-teal-600 hover:bg-teal-900 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                  <path d="M6 12v-2h3v2H6z"/>
                  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z"/>
                </svg>
                <span>Import</span>
              </button>
              <button onclick="window.location.href=`<?= base_url('/pelanggan/export') ?>`" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-teal-600 border border-transparent rounded-lg active:bg-teal-600 hover:bg-teal-900 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>                </svg>
                </svg>
                <span>Export</span>
              </button>
            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap" id="dataTable">
                  <thead>
                    <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Nama</th>
                      <th class="px-4 py-3">Desa</th>
                      <th class="px-4 py-3">Kontak</th>
                      <th class="px-4 py-3">Email</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php
                    foreach ($pelanggan as $index) {
                      // $data2 = $total[$index];
                    ?>
                      <tr class="text-gray-700 dark:text-black">
                        <td class="px-4 py-3">
                          <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                              <img class="object-cover w-full h-full rounded-full" src="<?= base_url('/assets/img/avatar-default-icon.png') ?>" alt="" loading="lazy" />
                              <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                            </div>
                            <div>
                              <p class="font-semibold"><?= esc($index["nama_pelanggan"]) ?></p>
                              <p class="text-xs text-gray-600 dark:text-gray-400">
                                <?= esc($index["alamat"]) ?>
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                          <?= $index["nama_desa"] ?>
                        </td>
                        <td class="px-4 py-3 text-sm">
                          <?= $index["no_telp"] ?>
                        </td>
                        <td class="px-4 py-3 text-sm">
                          <?= $index["email"] ?>
                        </td>

                        <td class="px-4 py-3">
                          <div class="flex items-center space-x-4 text-sm">
                            <button onclick="window.location.href=`<?= base_url('pelanggan/' . $index['id_pelanggan'] . '/edit') ?>`" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                              </svg>
                            </button>
                            <?php $session = \Config\Services::session();
                            if ($session->get('role_id') == 321) : ?>
                              <button onclick="
                              if(confirm('Apakah anda yakin ingin menghapus data pelanggan ini?')){
                              window.location.href=`<?= base_url('pelanggan/' . $index['id_pelanggan'] . '/delete') ?>`
                              }" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                              </button>
                            <?php endif; ?>
                          </div>
                        </td>
                      </tr>
                    <?php }; ?>

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
          });
        </script>
        </body>

        </html>