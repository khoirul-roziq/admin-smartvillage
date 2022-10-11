<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= esc($title) ?></title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url('/assets/css/tailwind.output.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('/assets/css/validation.css') ?>" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/jquery.dataTables.css') ?>">
  <link rel="shortcut icon" href="<?= base_url('assets/nota/img/logo-djcorp.png') ?>">

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="<?= base_url('/assets/js/charts-lines.js') ?>" defer></script>
  <script src="<?= base_url('/assets/js/charts-pie.js') ?>" defer></script>
  <script src="<?= base_url('/assets/js/init-alpine.js') ?>"></script>
  <script src="<?= base_url('/assets/js/jquery-3.6.0.js') ?>"></script>
  <script src="<?= base_url('/assets/js/jquery-validate-1.19.3.min.js') ?>"></script>
  <script src="<?= base_url('/assets/js/menu.js') ?>"></script>
  <script type="text/javascript" charset="utf8" src="<?= base_url('/assets/js/jquery.dataTables.js') ?>"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> -->
</head>