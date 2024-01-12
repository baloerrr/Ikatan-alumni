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
                $user_id = $params['id'];

                $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
                $stmt->execute([$user_id]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <form style="background-color: transparent;" action="/edit-user/<?= $user_id ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-floating">
                                <input type="text" id="nama" name="nama" class="form-control" value="<?= $user['nama'] ?>" />
                                <label class="form-label" for="nama">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-floating">
                                <input type="text" id="username" name="username" class="form-control" value="<?= $user['username'] ?>" />
                                <label class="form-label" for="username">Username</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="number" id="nisn" name="nisn" class="form-control" value="<?= $user['nisn'] ?>" />
                        <label class="form-label" for="nisn">NISN</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" id="password" name="password" class="form-control" value="" />
                        <label class="form-label" for="fpassword">Password</label>
                    </div>

                    <?php

                    $kueri = "SHOW COLUMNS FROM user LIKE 'level'";
                    $result = $pdo->query($kueri);

                    if ($result) {
                        $row = $result->fetch(PDO::FETCH_ASSOC);
                        $enum_values = explode("','", substr($row['Type'], 6, -2));
                    } else {
                        die("Kueri gagal: " . $koneksi->errorInfo()[2]);
                    }


                    ?>

                    <div class="form-floating mb-4">
                        <select class="form-select" id="floatingSelect" name="level" aria-label="Floating label select example">
                            <?php
                            foreach ($enum_values as $value) {
                                $selected = ($value == $user['level']) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$value</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Pilih Level</label>
                    </div>

                    <?php

                    $kueri = "SHOW COLUMNS FROM user LIKE 'jabatan'";
                    $result = $pdo->query($kueri);

                    if ($result) {
                        $row = $result->fetch(PDO::FETCH_ASSOC);
                        $enum_values = explode("','", substr($row['Type'], 6, -2));
                    } else {
                        die("Kueri gagal: " . $koneksi->errorInfo()[2]);
                    }
                    ?>

                    <div class="form-floating mb-4">
                        <select class="form-select" id="floatingSelect" name="jabatan" aria-label="Floating label select example">
                            <?php
                            foreach ($enum_values as $value) {
                                $selected = ($value == $user['jabatan']) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$value</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Pilih Jabatan</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="number" id="masa_jabatan" name="masa_jabatan" class="form-control" value="<?= $user['masa_jabatan'] ?>" />
                        <label class="form-label" for="masa_jabatan">Masa Jabatan</label>
                    </div>

                    <div class="mb-4">
                        <label for="formFile" class="form-label">Foto</label>
                        <input class="form-control" type="file" name="foto" id="formFile" onchange=" previewImage(this)">
                        <img height="200" width="200" id="imagePreview" src="#" alt="Preview" style="display:none; height: auto; margin-top: 5px;">
                        <?php if (!empty($user['foto'])) : ?>
                            <img src=".<?= $user['foto'] ?>" id="oldImage" height="200" width="200" alt="Preview" style="margin-top: 5px;">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Edit
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