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
                <form style="background-color: transparent;" action="/tambah-user" method="post"
                    enctype="multipart/form-data">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-floating">
                                <input type="text" id="nama" name="nama" class="form-control" />
                                <label class="form-label" for="nama">Nama Lengkap</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-floating">
                                <input type="text" id="username" name="username" class="form-control" />
                                <label class="form-label" for="username">Username</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="number" id="nisn" name="nisn" class="form-control" />
                        <label class="form-label" for="nisn">NISN</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" id="password" name="password" class="form-control" />
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
                        <select class="form-select" id="floatingSelect" name="level"
                            aria-label="Floating label select example">
                            <?php
                            foreach ($enum_values as $value) {
                                echo "<option value=\"$value\">$value</option>";
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
                        <select class="form-select" id="floatingSelect" name="jabatan"
                            aria-label="Floating label select example">
                            <?php
                            foreach ($enum_values as $value) {
                                echo "<option value=\"$value\">$value</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Pilih Jabatan</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="number" id="masa_jabatan" name="masa_jabatan" class="form-control" />
                        <label class="form-label" for="masa_jabatan">Masa Jabatan</label>
                    </div>

                    <div class="mb-4">
                        <label for="formFile" class="form-label">Foto</label>
                        <input class="form-control" type="file" name="foto" id="formFile">
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