<body>
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">

            <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Tambah Perjanjian Kerjasama
            </h4>

            <?php if (session()->getFlashdata('massage')) : ?>
                <div class="card-panel gradient-45deg-red-pink gradient-shadow" style="color: white;">
                    <span>Data yang anda masukan tidak valid!</span>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('pks/store') ?>" id="add_layanan" method="POST">
                <?= csrf_field() ?>
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama Desa</span>
                        <input id="namaDesa" name="namaDesa" type="text" value="<?= old('namaDesa'); ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Masukkan Nama Desa" />
                        <small style="color: red;"><?= $validation->getError('namaDesa'); ?></small>
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama Kades</span>
                        <input id="namaKades" name="namaKades" type="text" value="<?= old('namaKades'); ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Masukkan Nama Kades" />
                        <small style="color: red;"><?= $validation->getError('namaKades'); ?></small>
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Tanggal</span>
                        <input id="tanggalPks" name="tanggalPks" type="date" value="<?= old('tanggalPks'); ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                        <small style="color: red;"><?= $validation->getError('tanggalPks'); ?></small>
                    </label>

                    <div class="flex mt-4 flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
                        <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
                                <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293V1.5z" />
                            </svg>
                            <span>Simpan</span>
                        </button>
                        <a href="<?= base_url('/pks') ?>" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
                            </svg>
                            <span>Batal</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>