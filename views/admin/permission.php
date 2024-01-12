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
                            Permission Table
                        </h5>
                        <h6 class="card-subtitle text-muted">
                        </h6>
                    </div>
                    <div class="card-body">
                        <table id="datatables" class="table display">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Persetujuan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query('SELECT * FROM user WHERE permissions != "disetujui"');
                                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $no = 1;

                                foreach ($users as $user) {
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $user['nama'] ?></td>
                                        <td><?= $user['nisn'] ?></td>
                                        <td>
                                            <img src="<?= $user['foto'] ?>" width="150" height="150" alt="">
                                        </td>
                                        <td>
                                            <form action="/submit-permission.php" method="post">
                                                <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                                <select class="form-control" name="permissions" onchange="this.form.submit()">
                                                    <option value="disetujui" <?= ($user['permissions'] == 'disetujui') ? 'selected' : ''; ?>>
                                                        Disetujui
                                                    </option>
                                                    <option value="tidak_disetujui" <?= ($user['permissions'] == 'tidak disetujui') ? 'selected' : ''; ?>>
                                                        Tidak Disetujui
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href="/hapus-user/<?= $user['id'] ?>" onclick="return confirm('Kamu yakin menghapus user ini??')">Hapus</a>
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