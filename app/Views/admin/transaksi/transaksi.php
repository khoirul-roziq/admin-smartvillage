        <main class="h-full pb-16 overflow-y-auto">
          <div class="container grid px-6 mx-auto">

            <!-- With actions -->
            <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300">
              Data Transaksi
            </h4>
            <div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4 ">
              <button onclick="window.location.href=`<?= base_url('/transaksi/create') ?>`" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
                </svg>
                <span>Tambah Transaksi</span>
              </button>
            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap" id="dataTable">
                  <thead>
                    <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Client</th>
                      <th class="px-4 py-3">Amount</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Tanggal</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php
                    foreach ($transaksi as $index => $data) {
                      // $data2 = $total[$index];
                    ?>
                      <tr class="text-gray-700 dark:text-black-400">
                        <td class="px-4 py-3">
                          <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                              <img class="object-cover w-full h-full rounded-full" src="<?= base_url('/assets/img/avatar-default-icon.png') ?>" alt="" loading="lazy" />
                              <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                            </div>
                            <div>
                              <p class="font-semibold"><?= esc($data["nama_pelanggan"]) ?></p>
                              <p class="text-xs text-gray-600 dark:text-black-400">
                                <?= esc($data["nama_desa"]) ?>
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                          <?= "Rp" . esc(number_format($data["total"], 2, ',', '.')); ?>
                        </td>
                        <?php if ($data["status"] == 1) { ?>
                          <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-white">
                              Approved
                            </span>
                          </td>
                        <?php } else if ($data["status"] == 2) { ?>
                          <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                              Pending
                            </span>
                          </td>
                        <?php } else { ?>
                          <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-white dark:bg-red-700">
                              Denied
                            </span>
                          </td>
                        <?php } ?>
                        <td class="px-4 py-3 text-sm">
                          <?= date('d F Y', strtotime(esc($data["tanggal"]))) ?>
                        </td>
                        <td class="px-4 py-3">
                          <div class="flex items-center space-x-4 text-sm">

                            <button onclick="
                            if(confirm('Jadikan status transaksi Approve!')){
                            window.location.href=`<?= base_url('/transaksi/approved/' . $data['id_pelanggan'] . '/' . $data['tanggal']) ?>`
                            }" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-black-400 focus:outline-none focus:shadow-outline-gray" aria-label="Approve">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                              </svg>
                            </button>
                            <button onclick="
                            if(confirm('Jadikan status transaksi Pending!')){
                            window.location.href=`<?= base_url('/transaksi/pending/' . $data['id_pelanggan'] . '/' . $data['tanggal']) ?>`
                            }" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-orange-700 rounded-lg dark:text-black-400 focus:outline-none focus:shadow-outline-gray" aria-label="Pending">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                              </svg>
                            </button>
                            <button onclick="
                            if(confirm('Jadikan status transaksi Cencel!')){
                            window.location.href=`<?= base_url('/transaksi/cancel/' . $data['id_pelanggan'] . '/' . $data['tanggal']) ?>`
                            }" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-black-400 focus:outline-none focus:shadow-outline-gray" aria-label="Cancel">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
                              </svg>
                            </button>
                            <button onclick="window.location.href=`<?= base_url('/transaksi/detail/' . $data['id_pelanggan'] . '/' . $data['tanggal']) ?>`" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-black-400 focus:outline-none focus:shadow-outline-gray" aria-label="Detail">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                              </svg>
                            </button>
                            <?php $session = \Config\Services::session();
                            if ($session->get('role_id') == 321) : ?>
                              <button onclick="
                              if(confirm('Apakah anda yakin ingin menghapus transaksi ini?')){
                              window.location.href=`<?= base_url('/transaksi/delete/')  . '/' . $data['id_pelanggan'] . '/' . $data['tanggal'] ?>`
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