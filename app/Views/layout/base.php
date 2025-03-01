<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.png">
    <title>
        <?php
        $app_name = service('setting')->getSetting('application_name');
        echo $app_name;
        ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="<?= base_url() ?>assets/css/font-opensans.css" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="<?= base_url() ?>assets/js/font-awesome.js" crossorigin="anonymous"></script>
    <!-- <script src="https://kit.fontawesome.com/8ac8e75fb4.js" crossorigin="anonymous"></script> -->
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- DATATABLE -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/datatables-bootstrap.css">

    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="<?= base_url() ?>" target="_blank">
                <img src="<?= base_url() ?>assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold"><?= $app_name ?></span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <?= $this->include('layout/_sidebar'); ?>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <!-- Navbar -->
        <?= $this->include('layout/_navbar'); ?>
        <div class="px-4 mt-2">
            <?= view('Myth\Auth\Views\_message_block') ?>
        </div>
        <!-- End Navbar -->

        <!-- <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button> -->

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <div class="me-2 rounded" id="toast-bg" style="height: 20px; width: 20px;"></div>
                    <strong class="me-auto">TOAST HEADER</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    TOAST BODY
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <?= $this->renderSection('content'); ?>
            <?= $this->include('layout/_footer.php'); ?>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/chartjs.min.js"></script>

    <!-- DATATABLE -->
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
    <script src="<?= base_url() ?>assets/js/datatables.js"></script>
    <script src="<?= base_url() ?>assets/js/datatables-bs5.js"></script>
    <script src="<?= base_url() ?>assets/js/datatables-button.js"></script>
    <script src="<?= base_url() ?>assets/js/button-datatables.js"></script>
    <script src="<?= base_url() ?>assets/js/jszip-datatables.js"></script>
    <script src="<?= base_url() ?>assets/js/pdfmake-datatables.js"></script>
    <script src="<?= base_url() ?>assets/js/button-html5-datatables.js"></script>
    <script src="<?= base_url() ?>assets/js/button-datatables.js"></script>
    <script src="<?= base_url() ?>assets/js/button-print-datatables.js"></script>

    <script src="<?= base_url() ?>assets/js/core/core.js"></script>

    <script>
        $(document).ready(function() {
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        })

        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')

        if (toastTrigger) {
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastTrigger.addEventListener('click', () => {
                toastBootstrap.show()
            })
        }

        $('.number-input').keyup(function() {
            // Mendapatkan nilai input
            let input = $(this).val();

            // Menghapus karakter selain angka
            let formattedInput = input.replace(/\D/g, '');

            // Menangani kasus di mana angka 0 di depan dihilangkan ketika angka lain dimasukkan
            if (formattedInput.length > 1 && formattedInput.charAt(0) === '0') {
                formattedInput = formattedInput.slice(1);
            }

            // Menambahkan titik sebagai pemisah ribuan
            formattedInput = formattedInput.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // Menetapkan nilai input yang diformat kembali ke input
            $(this).val(formattedInput);
        });
    </script>


    <?= $this->renderSection('script'); ?>


    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url() ?>assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>