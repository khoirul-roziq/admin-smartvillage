<body>
  <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
      <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
          <img aria-hidden="true" class="hidden object-cover w-full h-full dark:hidden" src="../assets/img/login-office.jpeg" alt="Office" />
          <img aria-hidden="true" class="object-cover w-full h-full dark:block" src="../assets/img/login-office-dark.jpeg" alt="Office" />
        </div>
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
          <div class="w-full">
            <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
              Login
            </h1>
            <?php if (session()->getFlashdata('massage')) : ?>
              <div class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center transition-colors duration-150 border border-transparent rounded-lg" style="color: teal; background-color:aquamarine">
                <span><?= session()->getFlashdata('massage'); ?></span>
              </div>
            <?php endif; ?>
            <form action="<?= base_url('/login') ?>" method="POST" id="login">
              <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Username</span>
                <input type="text" name="username" id="username" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Username" />
              </label>

              <div class="flex-auto">
                <label class="block mt-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Password</span>
                  <div class="relative w-full">
                    <div class="absolute right-0 flex items-center px-2">
                      <i style="margin-top: 7px;" class="bi-eye-slash bi-aspect-ratio" id="togglePassword"></i>
                    </div>
                    <input name="password" id="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Password" type="password" />
                  </div>
              </div>
              </label>

              <!-- You should use a button here, as the anchor is only used for the example  -->
              <input id="login-button" type="submit" value="Login" class=" block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" />
            </form>

            <hr class="my-8" />

            <!-- <button class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
              <svg class="w-4 h-4 mr-2" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
              </svg>
              Github
            </button>
            <button class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
              <svg class="w-4 h-4 mr-2" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor">
                <path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z" />
              </svg>
              Twitter
            </button> -->

            <p class="mt-4">
              <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="<?= base_url('/forgot') ?>">
                Forgot your password?
              </a>
            </p>
            <!-- <p class="mt-1">
              <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="<?= base_url('/registration') ?>">
                Create account
              </a>
            </p> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function() {
      // toggle the type attribute
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);

      // toggle the icon
      this.classList.toggle("bi-eye");
    });


    $(document).ready(function() {
      let csrfName = $('.txt_csrfname').attr('name');
      let csrfHash = $('.txt_csrfname').val();

      $.validator.addMethod("checkUsername", function(value, element) {
        let res = false;
        $.ajax({
          url: "<?= base_url('/username') ?>",
          type: "post",
          async: false,
          data: {
            username: function() {
              return $("#username").val();
            },
            [csrfName]: csrfHash
          },
          dataType: 'json',
          success: function(data) {
            csrfHash = data.csrfHash;
            $('.txt_csrfname').val(data.csrfHash);

            if (data.user == "true") {
              res = true;
            } else {
              res = false;
            }
          }
        })
        return res;
      }, "");

      $.validator.addMethod("checkPassword", function(value, element) {
        let res = false;
        $.ajax({
          url: "<?= base_url('/password') ?>",
          type: "post",
          async: false,
          data: {
            username: function() {
              return $("#username").val();
            },
            password: function() {
              return $("#password").val();
            },
            [csrfName]: csrfHash
          },
          dataType: 'json',
          success: function(data) {
            csrfHash = data.csrfHash;
            $('.txt_csrfname').val(data.csrfHash);

            if (data.user == "true") {
              res = true;
            } else {
              res = false;
            }
          }
        })
        return res;
      }, "");

      $("#login").validate({
        rules: {
          username: {
            required: true,
            checkUsername: true
          },
          password: {
            required: true,
            checkPassword: true
          }
        },
        messages: {
          username: {
            required: "Please Enter Your Username",
            checkUsername: "Wrong Username"
          },
          password: {
            required: "Please Enter Your Password",
            checkPassword: "Wrong Password"
          }
        }
      });
    });
  </script>
</body>

</html>