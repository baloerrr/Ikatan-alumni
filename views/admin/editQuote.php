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
                <?php
                $quote_id = $params['id'];
                $stmt = $pdo->prepare("SELECT * FROM quotes WHERE id = ?");
                $stmt->execute([$quote_id]);
                $quote = $stmt->fetch(PDO::FETCH_ASSOC);

                // Retrieve user names from the 'user' table
                $userStmt = $pdo->query('SELECT nama FROM user');
                $users = $userStmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <form style="background-color: transparent;" action="/edit-quote/<?= $quote_id ?>" method="post"
                    enctype="multipart/form-data">

                    <div class="form-floating mb-4">
                        <select class="form-select" id="floatingSelect" name="nama"
                            aria-label="Floating label select example">
                            <?php
                            foreach ($users as $userOption) {
                                $selected = ($userOption['nama'] == $quote['nama']) ? 'selected' : '';
                                echo "<option value=\"{$userOption['nama']}\" $selected>{$userOption['nama']}</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Nama Lengkap</label>
                    </div>

                    <div class="form-floating mb-4">
                        <div class="form-floating">
                            <textarea id="teks" name="teks" class="form-control"><?= $quote['teks'] ?></textarea>
                            <label class="form-label" for="teks">Teks</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        edit
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