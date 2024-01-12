<?php
include('./views/partials/navbar.php');
?>

<div class="carousel slide" data-bs-ride="carousel" id="carouselExampleIndicators">
    <div class="carousel-indicators">
        <button aria-label="Slide 1" class="active" data-bs-slide-to="0" data-bs-target="#carouselExampleIndicators"
            type="button"></button> <button aria-label="Slide 2" data-bs-slide-to="1"
            data-bs-target="#carouselExampleIndicators" type="button"></button> <button aria-label="Slide 3"
            data-bs-slide-to="2" data-bs-target="#carouselExampleIndicators" type="button"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 object-fit-cover"
                src="https://fkip.unsri.ac.id/ptm/wp-content/uploads/2023/10/image-1.png">
            <div class="carousel-caption">
                <h5>Ikatan Alumni SMK Negeri Sumsel</h5>
                <p>Melangkah Bersama, Merajut Kenangan: Menyatukan Ikatan Alumni untuk Masa Depan yang Lebih Baik</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 object-fit-cover"
                src="https://asset-2.tstatic.net/sumsel/foto/bank/images/siswa-siswa-smkn-sumsel-mobil-pemadam-kebakaran.jpg">
            <div class="carousel-caption">
                <h5>Ikatan Alumni SMK Negeri Sumsel</h5>
                <p>Bersama Alumni, Terhubung oleh Masa Lalu, Menginspirasi Masa Depan</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 object-fit-cover"
                src="https://fkip.unsri.ac.id/ptm/wp-content/uploads/2023/10/image-1.png">
            <div class="carousel-caption">
                <h5>Ikatan Alumni SMK Negeri Sumsel</h5>
                <p>Kumpul Bersama, Berbagi Cerita: Ikatan Alumni Sebagai Keluarga Abadi.</p>
            </div>
        </div><button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators"
            type="button"><span aria-hidden="true" class="carousel-control-prev-icon"></span> <span
                class="visually-hidden">Previous</span></button> <button class="carousel-control-next"
            data-bs-slide="next" data-bs-target="#carouselExampleIndicators" type="button"><span aria-hidden="true"
                class="carousel-control-next-icon"></span> <span class="visually-hidden">Next</span></button>
    </div>



    <section class="bg-light py-5" id="struktur">
        <div class="container">
            <div class="row">
                <h1 class="fw-bold text-center mb-5">Struktur Organisasi</h1>
                <div class="col-lg-6 h-auto">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php
                            $stmt = $pdo->query('SELECT * FROM user WHERE jabatan IN ("Ketua", "Wakil", "Sekretaris", "Bendahara") ORDER BY id DESC LIMIT 4');
                            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                            <?php foreach ($users as $user) { ?>
                            <div class="swiper-slide">
                                <div class="card border-0" style="width: 18rem;">
                                    <img height="230" width="100%" src="<?= $user['foto'] ?>" class=" object-fit-cover"
                                        alt="...">
                                    <div class="card-body">
                                        <h5 class="fs-6 text-muted mb-1"><?= $user['nama'] ?></h5>
                                        <p class="fs-6 text-muted mb-1"><?= $user['jabatan'] ?></p>
                                    </div>
                                </div>

                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 h-auto">
                    <p>Struktur organisasi di SMK Negeri Sumsel terdiri dari berbagai tingkatan dan departemen yang
                        bekerja
                        bersama untuk memberikan pengelolaan yang efektif dan memberdayakan siswa untuk meraih
                        kesuksesan.
                        Kepala Sekolah menjadi pemimpin utama yang bertanggung jawab atas pengelolaan dan pengembangan
                        sekolah. Di bawahnya, terdapat beberapa wakil kepala sekolah yang mengawasi bidang-bidang
                        spesifik
                        seperti akademik, kurikulum, dan kemahasiswaan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-5" id="kegiatan">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 h-auto mb-5">
                    <div class="card bg-transparent text-center rounded-0 border-0 h-100">
                        <h1 class="fw-bold">Kegiatan</h1>
                    </div>
                </div>
                <div class="col-lg-12 h-auto">
                    <div #swiperRef="" class="swiper swiperBlog w-100">
                        <div class="swiper-wrapper">
                            <?php
                            $stmt = $pdo->query('SELECT * FROM news');
                            $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                            <?php foreach ($news as $berita) {

                                $judulBerita = $berita['title'];

                                if (strlen($judulBerita) > 30) {
                                    $judulBerita = substr($judulBerita, 0, 30) . '...';
                                }
                            ?>
                            <a href="/kegiatan/<?= $berita['id'] ?>" class="swiper-slide rounded-5">
                                <div class="card border-0" style="width: 18rem; ">
                                    <img src="<?= $berita['cover'] ?>" class="card-img-top object-fit-cover" alt="..."
                                        height="200" width="200">
                                    <div class="card-body">
                                        <h5 class="card-title fs-6 fw-bold"><?= $judulBerita ?></h5>
                                        <p class="fs-6 text-muted mb-1"> |
                                            SMK Negeri Sumsel | <?= formatWaktu(strtotime($berita['tanggal'])) ?></p>
                                    </div>
                                </div>
                            </a>
                            <?php } ?>

                        </div>
                        <!-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- team starts -->
    <section class="bg-light py-5" id="quotes">
        <div class="container">
            <h1 class="fw-bold text-center mb-5">Apa Kata Mereka?</h1>
            <div class="row">
                <?php
                $stmt = $pdo->query('SELECT quotes.teks, user.nama, quotes.angkatan FROM quotes JOIN user ON quotes.user_id = user.id');
                $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php foreach ($quotes as $quote) { ?>
                <div class="col-md-4">
                    <div class="card border-0" style="width: 18rem;">
                        <div class="card-body">
                            <p class="card-text"><?= $quote['teks'] ?></p>
                            <h5 class="card-title fs-6"><?= $quote['nama'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Angakatan 2022</h6>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- team ends -->

    <!-- footer starts -->
    <?php include('./views/partials/footer.php') ?>
    <!-- footer ends -->