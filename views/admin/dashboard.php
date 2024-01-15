<?php
include('./config/utils.php');

push('css', '<link rel="stylesheet" href="/public/css/admin.css">');
push('js', '<script src="/public/js/admin.js"></script>');

$sql = "SELECT COUNT(*) as jumlah_user FROM user";
$stmt = $pdo->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$jumlahUser = $result['jumlah_user'];

?>
<div class="wrapper">
    <?php include('./views/admin/partials/sidebar.php') ?>

    <div class="main">
        <?php include('./views/admin/partials/header.php') ?>

        <main class="content px-3 py-2">
            <div class="container-fluid">
                <div class="mb-3">
                    <h4>Admin Dashboard</h4>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill border-0 illustration">
                            <div class="card-body p-0 d-flex flex-fill">
                                <div class="p-3 m-1">
                                    <h4>Jumlah User</h4>
                                    <p class="mb-0 fw-medium fs-5"><?= $jumlahUser ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill border-0">
                            <div class="card-body py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-2">
                                            $ 78.00
                                        </h4>
                                        <p class="mb-2">
                                            Total Earnings
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </main>
        <a href="#" class="theme-toggle">
            <i class="fa-regular fa-moon"></i>
            <i class="fa-regular fa-sun"></i>
        </a>

        <?php include('./views/admin/partials/footer.php') ?>

    </div>
</div>