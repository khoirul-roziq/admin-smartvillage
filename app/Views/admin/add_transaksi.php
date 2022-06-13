<body>
  <main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">

      <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Tambah Transaksi
      </h4>

      <form action="<?= base_url('/add-transaksi') ?>" id="add_transaksi" method="POST">
        <?= csrf_field() ?>
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Pelanggan</span>
            <select name="pelanggan" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
              <?php foreach ($pelanggan as $index => $data) { ?>
                <option value="<?= $data['id_pelanggan'] ?>"><?= $data["nama_pelanggan"] ?></option>
              <?php } ?>
            </select>
          </label>

          <div class="mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
              Barang
            </span>
            <div class="flex barang0">
              <label class="block text-sm w-full">
                <select name="barang_order0" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                  <option value="" selected disabled>-- PILIH BARANG --</option>
                  <?php foreach ($barang as $index => $data) { ?>
                    <option value="<?= $data['kode_barang'] ?>"><?= $data["nama_barang"] ?></option>
                  <?php } ?>
                </select>
              </label>
              <div class="custom-number-input w-32">
                <div class="flex flex-row relative bg-transparent w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                  <button type="button" data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-400  w-20 rounded-l cursor-pointer outline-none">
                    <span class="m-auto font-thin">−</span>
                  </button>
                  <input name="qty0" type="number" class="outline-none dark:text-gray-300 dark:bg-gray-700 focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="0"></input>
                  <button type="button" data-action="increment" class="bg-gray-300 dark:text-gray-300 dark:bg-gray-700 text-gray-600 hover:text-gray-700 hover:bg-gray-400 w-20 rounded-r cursor-pointer">
                    <span class="m-auto font-thin">+</span>
                  </button>
                </div>
              </div>
            </div>

            <div class="more_barang"></div>

            <button type="button" id="add_barang" class="flex w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input items-center justify-center px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 " fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
              </svg>
              <span class="ml-4">Tambah Barang</span>
            </button>
          </div>

          <div class=" mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
              Layanan
            </span>

            <label class="block text-sm layanan0 flex">
              <select name="layanan_order0" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="" selected disabled>-- PILIH LAYANAN --</option>
                <?php foreach ($layanan as $index => $data) { ?>
                  <option value="<?= $data['kode_layanan'] ?>"><?= $data["nama_layanan"] ?></option>
                <?php
                } ?>
              </select>
            </label>

            <div class="more_layanan"></div>

            <button type="button" id="add_layanan" class="flex w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input items-center justify-center px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 " fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
              </svg>
              <span class="ml-4">Tambah Layanan</span>
            </button>
          </div>
          <div class="flex mt-4 flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
            <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
                <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293V1.5z" />
              </svg>
              <span>Simpan</span>
            </button>
            <a href="<?= base_url('/transaksi') ?>" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
              </svg>
              <span>Batal</span>
            </a>
          </div>
        </div>
        <input type="hidden" value="1" name="jumlah_barang" id="jumlah_barang">
        <input type="hidden" value="1" name="jumlah_layanan" id="jumlah_layanan">
      </form>

    </div>
  </main>
  <style>
    input[type='number']::-webkit-inner-spin-button,
    input[type='number']::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .custom-number-input input:focus {
      outline: none !important;
    }

    .custom-number-input button:focus {
      outline: none !important;
    }
  </style>

  <script>
    $(document).ready(function() {
      let barang = 1;
      let layanan = 1;
      $("#add_barang").click(function() {
        $(".barang0").clone().removeClass("barang0").addClass("barang" + barang).append("<button type='button' id='hapus_barang" + barang + "' class='hapus_barang flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray'><svg class='w-6 h-6' aria-hidden='true' fill='currentColor' viewBox='0 0 20 20'><path fill-rule='evenodd' d='M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z' clip-rule='evenodd'></path></svg></button>").appendTo('.more_barang');
        $(".barang" + barang + " > label > select").attr("name", "barang_order" + barang);
        $(".barang" + barang + " > div > div > input").attr("name", "qty" + barang);
        barang += 1;
        $("#jumlah_barang").attr("value", barang);

        function increment(e) {
          const btn = e.target.parentNode.parentElement.querySelector(
            'button[data-action="decrement"]'
          );
          const target = btn.nextElementSibling;
          let value = Number(target.value);
          value++;
          target.value = value;
        }

        const decrementButtons = document.querySelectorAll(
          `button[data-action="decrement"]`
        );

        const incrementButtons = document.querySelectorAll(
          `button[data-action="increment"]`
        );

        decrementButtons.forEach(btn => {
          btn.addEventListener("click", decrement);
        });

        incrementButtons.forEach(btn => {
          btn.addEventListener("click", increment);
        });
      });

      $("#add_layanan").click(function() {
        $(".layanan0").clone().removeClass("layanan0").addClass("layanan" + layanan).append("<button type='button' id='hapus_layanan" + layanan + "' class='hapus_layanan flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray'><svg class='w-6 h-6' aria-hidden='true' fill='currentColor' viewBox='0 0 20 20'><path fill-rule='evenodd' d='M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z' clip-rule='evenodd'></path></svg></button>").appendTo('.more_layanan');
        $(".layanan" + layanan + " > select").attr("name", "layanan_order" + layanan);
        layanan += 1;
        $("#jumlah_layanan").attr("value", layanan);
      });

      $(".more_barang").on("click", ".hapus_barang", function() {
        $(this).parent().remove();
        barang -= 1;
        $("#jumlah_barang").attr("value", barang);
      });

      $(".more_layanan").on("click", ".hapus_layanan", function() {
        $(this).parent().remove();
        layanan -= 1;
        $("#jumlah_layanan").attr("value", layanan);
      });
      $("select").change(function() {
        $("select option").removeClass("hidden");
        $("select option:selected").addClass("hidden");
      })

      function decrement(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
          'button[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        value--;
        target.value = value;
      }

      function increment(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
          'button[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        value++;
        target.value = value;
      }

      const decrementButtons = document.querySelectorAll(
        `button[data-action="decrement"]`
      );

      const incrementButtons = document.querySelectorAll(
        `button[data-action="increment"]`
      );

      decrementButtons.forEach(btn => {
        btn.addEventListener("click", decrement);
      });

      incrementButtons.forEach(btn => {
        btn.addEventListener("click", increment);
      });
    });
  </script>
</body>

</html>