      <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
          </h2>
          <!-- CTA -->

          <!-- Cards -->
          <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                </svg>
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Total clients
                </p>
                <?php $total_pelanggan = 0;
                $total_penghasilan = 0;
                $total_pending = 0;
                $total_denied = 0;
                foreach ($heading as $data) {
                  $total_pelanggan += 1;
                  if ($data["status"] == 1) {
                    $total_penghasilan += $data["total"];
                  } else if ($data["status"] == 2) {
                    $total_pending += 1;
                  } else {
                    $total_denied += 1;
                  }
                } ?>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  <?= $total_pelanggan ?>
                </p>
              </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Revenue
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  <?= "Rp" . esc(number_format($total_penghasilan, 2, ',', '.')); ?>
                </p>
              </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                </svg>
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Pending Order
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  <?= $total_pending ?>
                </p>
              </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
                </svg>
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Denied Order
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  <?= $total_denied ?>
                </p>
              </div>
            </div>
          </div>

          <!-- Charts -->
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Diagram
          </h2>
          <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Penjualan Barang
              </h4>
              <canvas id="barang"></canvas>
              <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                <!-- Chart legend -->
                <!-- <div class="flex items-center">
                  <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                  <span>Shirts</span>
                </div>
                <div class="flex items-center">
                  <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                  <span>Shoes</span>
                </div>
                <div class="flex items-center">
                  <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                  <span>Bags</span>
                </div> -->
              </div>
            </div>
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Pemesanan Layanan
              </h4>
              <canvas id="layanan"></canvas>
              <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">

              </div>
            </div>
            <!-- <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Traffic
              </h4>
              <canvas id="traffic_barang"></canvas>

            </div> -->
          </div>
        </div>
      </main>
      </div>
      </div>
      <script>
        $(document).ready(function() {

          /**
           * call the data.php file to fetch the result from db table.
           */

          var ctx1 = $("#barang");
          var ctx2 = $("#layanan");

          var data1 = {
            labels: [<?php foreach ($barang as $data) {
                        echo '"' . $data['nama_barang'] . '",';
                      }
                      ?>],
            datasets: [{
              label: "Penjualan Barang",
              data: [<?php $barang_order = [];
                      $total = 0;
                      foreach ($barang as $index => $data_barang) {
                        foreach ($transaksi as $data_transaksi) {
                          if ($data_barang["kode_barang"] == $data_transaksi["kode_barang"] && $data_transaksi["status"] == 1) {
                            $total += $data_transaksi["qty"];
                          }
                        }
                        array_push($barang_order, $total);
                        $total = 0;
                        echo '"' . $barang_order[$index] . '",';
                      }
                      ?>],
              backgroundColor: [
                "#7e3af2",
                "#047481",
                "#e02424",
                "#9f580a",
                "#1c64f2"
              ],
              borderWidth: [1, 1, 1, 1, 1]
            }]
          };

          var data2 = {
            labels: [<?php foreach ($layanan as $data) {
                        echo '"' . $data['nama_layanan'] . '",';
                      }
                      ?>],
            datasets: [{
              label: "Pemesanan Layanan",
              data: [<?php $layanan_order = [];
                      $total = 0;
                      foreach ($layanan as $index => $data_layanan) {
                        foreach ($transaksi as $data_transaksi) {
                          if ($data_layanan["kode_layanan"] == $data_transaksi["kode_layanan"] && $data_transaksi["status"] == 1) {
                            $total += 1;
                          }
                        }
                        array_push($layanan_order, $total);
                        $total = 0;
                        echo '"' . $layanan_order[$index] . '",';
                      }
                      ?>],
              backgroundColor: [
                "#1c64f2",
                "#e02424",
                "#047481",
                "#7e3af2",
                "#9f580a",
              ],
              borderWidth: [1, 1, 1, 1, 1]
            }]
          };

          var options = {
            title: {
              display: true,
              position: "top",
              fontSize: 18,
              fontColor: "#111"
            },
            legend: {
              display: true,
              position: "bottom"
            }
          };


          var chart1 = new Chart(ctx1, {
            type: "doughnut",
            data: data1,
            options: options
          });

          var chart2 = new Chart(ctx2, {
            type: "doughnut",
            data: data2,
            options: options
          });

        });
      </script>
      </body>

      </html>