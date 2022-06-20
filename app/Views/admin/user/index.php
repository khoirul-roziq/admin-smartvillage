        <main class="h-full pb-16 overflow-y-auto">
          <div class="container grid px-6 mx-auto">
            <!-- With actions -->
            <h4 class="my-6 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
              Data User Admin
            </h4>

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap" id="dataTable">
                  <thead>
                    <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Nama</th>
                      <th class="px-4 py-3">Email</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php
                    foreach ($user as $index) {
                      if ($index["role_id"] != 321) {


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
                                <p class="font-semibold"><?= esc($index["nama_lengkap"]) ?></p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                <p>username : <?= esc($index["username"]) ?></p>
                                </p>
                              </div>
                            </div>
                          </td>
                          <td class="px-4 py-3 text-sm">
                            <?= $index["email"] ?>
                          </td>

                          <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                              <button onclick="window.location.href=`<?= base_url('user/' . $index['id_user'] . '/edit') ?>`" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                              </button>
                              <?php $session = \Config\Services::session();
                              if ($session->get('role_id') == 321) : ?>
                                <button onclick="window.location.href=`<?= base_url('user/' . $index['id_user'] . '/delete') ?>`" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                  </svg>
                                </button>
                              <?php endif; ?>
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
          });
        </script>
        </body>

        </html>