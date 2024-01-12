<?php
include('./config/utils.php');
include('./config/connection.php');

push('css', '<link rel="stylesheet" href="../public/css/admin.css">');
push('js', '<script src="../public/js/admin.js"></script>');

?>


<div class="wrapper">
    <?php include('./views/admin/partials/sidebar.php') ?>

    <div class="main">
        <?php include('./views/admin/partials/header.php') ?>

        <main class="content px-3 py-2">
            <div class="container-fluid">
                <!-- Table Element -->
                <form style="background-color: transparent;" action="/tambah-quote" method="post" enctype="multipart/form-data">

                    <?php
                    $stmt = $pdo->query('SELECT nama FROM user');
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <div class="form-floating mb-4">
                        <select class="form-select" id="floatingSelect" name="nama" aria-label="Floating label select example">
                            <?php
                            foreach ($users as $user) {
                                echo "<option value=\"{$user['nama']}\">{$user['nama']}</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Nama Lengkap</label>
                    </div>

                    <div class="form-floating mb-4">
                        <div class="form-floating">
                            <textarea id="teks" name="teks" class="form-control" required></textarea>
                            <label class="form-label" for="teks">Teks</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Tambah
                    </button>

                </form>
            </div>
        </main>
        <a href="#" class="theme-toggle">
            <i class="fa-regular fa-moon"></i>
            <i class="fa-regular fa-sun"></i>
        </a>

        <?php include('./views/admin/partials/footer.php') ?>

    </div>
</div>