<?php
include('./views/partials/navbar.php');

$perPage = 9; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
$start = ($page - 1) * $perPage; // Hitung offset

$stmt = $pdo->query("SELECT COUNT(*) FROM user WHERE jabatan = 'anggota'");
$totalRows = $stmt->fetchColumn(); // Total jumlah data
$totalPages = ceil($totalRows / $perPage); // Total halaman

$stmt = $pdo->prepare('SELECT * FROM user WHERE jabatan = "anggota" LIMIT :start, :perPage');
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
$query = 'SELECT * FROM user WHERE jabatan = "anggota"';

if (!empty($searchKeyword)) {
    $query .= " AND (nama LIKE '%$searchKeyword%' OR nisn LIKE '%$searchKeyword%')";
}

$stmt = $pdo->prepare($query . " LIMIT :start, :perPage");
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="bg-light min-vh-100 py-5">
    <div class="container pt-5">
        <h1 class="fw-bold text-center mb-5">Data Alumni</h1>
        <form class="input-group mb-3 w-50 text-end" method="GET">
            <input type="text" class="form-control" placeholder="Cari berdasarkan nama atau NISN" name="search" value="<?= htmlspecialchars($searchKeyword) ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
        </form>
        <div class="row">
            <?php foreach ($users as $user) { ?>
                <div class="col-md-4 mb-4 mb-lg-0">
                    <div class="card" style="width: 18rem;">
                        <img height="250" width="100%" src="<?= $user['foto'] ?>" class="card-img-top object-fit-cover" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fs-6"><?= $user['nama'] ?></h5>
                            <p class="card-text"><?= $user['nisn'] ?></p>
                            <p class="card-text"><?= $user['jabatan'] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Paginasi -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= htmlspecialchars($searchKeyword) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</section>

<?php include('./views/partials/footer.php') ?>