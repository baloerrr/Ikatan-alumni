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
                <div class="card border-0">
                    <div class="card-header">
                        <h5 class="card-title">
                            User Table
                        </h5>
                        <h6 class="card-subtitle text-muted">
                        </h6>
                        <div class="flex text-end justify-content-end">
                            <a href="/tambah-user" class="btn btn-primary">
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatables" class="table display">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query('SELECT * FROM user');
                                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $no = 1;

                                foreach ($users as $user) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $user['nama'] ?></td>
                                    <td><?= $user['nisn'] ?></td>
                                    <td><?= $user['jabatan'] ?></td>
                                    <td><?= $user['level'] ?></td>
                                    <td>
                                        <img src="<?= $user['foto'] ?>" width="150" height="150" alt="">
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="/edit-user/<?= $user['id'] ?>">Edit</a>
                                        <a class="btn btn-danger" href="/hapus-user/<?= $user['id'] ?>"
                                            onclick="return confirm('Kamu yakin menghapus user ini??')">Hapus</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
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