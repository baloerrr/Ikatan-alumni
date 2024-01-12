<?php

include('./views/partials/navbar.php');

$berita_id = $params['id'];

$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$berita_id]);
$berita = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<section class="bg-light min-vh-100 py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <img src=".<?= $berita['cover'] ?>" class="w-100 mb-4" alt="">
                <h3 id="h1" class="fw-bold mb-4"><?= $berita['title'] ?></h3>
                <p class="text-muted mb-4"><?= formatWaktu(strtotime($berita['tanggal'])) ?></p>
                <?= $berita['content'] ?>
            </div>
        </div>
    </div>
</section>



<?php include('./views/partials/footer.php') ?>