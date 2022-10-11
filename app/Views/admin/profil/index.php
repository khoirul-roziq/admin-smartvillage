<main class="h-full pb-16 overflow-y-auto">
  <div class="container grid px-6 mx-auto">


    <!-- With actions -->
    <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300">
      Profil Instansi
    </h4>
    <div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4 ">
      <button onclick="window.location.href=`<?= base_url('/profil/edit') ?>`" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
          <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
        </svg>
        <span>Edit Profil</span>
      </button>
    </div>
    <div class="min-w-full mb-8 p-4 text-white bg-purple-600 rounded-lg shadow-xs dark:text-white">
      <?php
      $nama = $profil["nama_instansi"];
      $alamat = $profil["alamat"];
      $telp = $profil["no_hp"];
      $email = $profil["email"];
      $kode_nota = $profil["kode_nota"];
      $logo = $profil["logo"];
      ?>
      <div class="flex items-center  text-sm">
        <!-- Avatar with inset shadow -->

        <?php if ($logo == NULL) { ?>
          <div class="relative hidden mr-3 md:block">
            <img class="object-cover" style="height:200px;" src="<?= base_url('/assets/img/avatar.png') ?>" alt="" loading="lazy" />
            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
          </div>
        <?php } else { ?>
          <div class="relative hidden mr-3 md:block">
            <img class="object-cover" style="height:200px;" src="<?= base_url('uploads/logo/' . $logo) ?>" alt="" loading="lazy" />
            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
          </div>
        <?php } ?>

        <div style="margin-left: 30px;">
          <p class="text-lg font-semibold te">Nama Instansi </p>
          <p class="text-base text-white-600  mb-4"><?= $nama ?></p>
          <p class="text-lg font-semibold te">Alamat </p>
          <p class="text-base text-white-600  mb-4"><?= $alamat ?></p>
          <p class="text-lg font-semibold te">Kontak </p>
          <p class="text-base text-white-600 mb-4"><?= $telp ?></p>
          <p class="text-lg font-semibold te">Email </p>
          <p class="text-base text-white-600 mb-4"><?= $email ?></p>
          <p class="text-lg font-semibold te">Kode Nota </p>
          <p class="text-base text-white-600 "><?= $kode_nota ?></p>
        </div>
      </div>
    </div>
  </div>
</main>
</div>
</div>
</body>

</html>