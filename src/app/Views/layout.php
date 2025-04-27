<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title><?= $this->renderSection('title'); ?></title>

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />

  <!-- Flatpickr Core CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
  />
  <!-- Thème Airbnb -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css"
  />

  <!-- Surcharges CSS pour différencier aujourd’hui / sélection -->
  <style>
    .flatpickr-calendar {
      border: none;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      border-radius: 12px!important;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    /* Cercle vert clair autour de la date du jour */
    .flatpickr-day.today {
      background: #90EE90 !important;  /* lightgreen */
      color: #000 !important;
      border-radius: 50% !important;
    }

    /* Cercle bleu vif autour de la date sélectionnée */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
      background: #007aff !important;  /* blue */
      color: #fff !important;
      border-radius: 50% !important;
    }

    .flatpickr-weekday {
      color: #666;
    }
    .flatpickr-months {
      background: none;
    }
    .flatpickr-month {
      font-weight: 500;
    }
  </style>

  <!-- Bootstrap Icons & favicon -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  />
  <link rel="icon" href="<?= base_url('favicon.ico'); ?>" type="image/x-icon">
</head>
<body class="d-flex flex-column min-vh-100">

  <?= $this->include('templates/header'); ?>
  <?= $this->renderSection('main'); ?>
  <?= $this->include('templates/footer'); ?>

  <!-- Bootstrap JS Bundle -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
    defer
  ></script>

  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      flatpickr(".datepicker", {
        theme: "airbnb",
        altInput: true,
        altFormat: "d/m/Y",
        dateFormat: "Y-m-d",
        locale: "fr",
        allowInput: true,
        minDate: "today"
      });
    });
  </script>
</body>
</html>
