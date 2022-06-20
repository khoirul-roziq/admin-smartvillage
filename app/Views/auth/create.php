<body>
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">

            <h4 class="mb-4 my-6 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Tambah Admin
            </h4>

            <?php if (session()->getFlashdata('massage')) : ?>
                <div class="block mb-4 w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center transition-colors duration-150 border border-transparent rounded-lg" style="color: teal; background-color:aquamarine">
                    <span><?= session()->getFlashdata('massage'); ?></span>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('registration/store') ?>" id="add_admin" method="POST">
                <?= csrf_field() ?>
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Username</span>
                        <input id="username" name="username" type="text" value="<?= old('username'); ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Masukkan Username" />
                        <small style="color: red;"><?= $validation->getError('username'); ?></small>
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama Lengkap</span>
                        <input id="nama" name="nama" type="text" value="<?= old('nama'); ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Masukkan Nama Lengkap" />
                        <small style="color: red;"><?= $validation->getError('nama'); ?></small>
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Email</span>
                        <input id="email" name="email" type="text" value="<?= old('email'); ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Masukkan Email" />
                        <small style="color: red;"><?= $validation->getError('email'); ?></small>
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password</span>
                        <input id="password1" name="password1" type="password" value="<?= old('password1'); ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Masukkan Password" />
                        <small style="color: red;"><?= $validation->getError('password1'); ?></small>
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
                        <input id="password2" name="password2" type="password" value="<?= old('password2'); ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Konfirmasi Password" />
                        <small style="color: red;"><?= $validation->getError('password2'); ?></small>
                    </label>

                    <div class="flex mt-4 flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
                        <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
                                <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293V1.5z" />
                            </svg>
                            <span>Simpan</span>
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>