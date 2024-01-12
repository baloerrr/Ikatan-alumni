<?php
session_start();
$currentRoute = $_SERVER['REQUEST_URI'];
$kegiatanId = isset($params['id']) ? $params['id'] : null;

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand text-uppercase d-flex align-items-center" href="https://sipil.polsri.ac.id">
            <img src="./public/images/logo-smk-sumsel.png" class="" width="50" height="50" alt="">
            <div class="d-flex flex-column ms-3">
                <span class="fs-5 fw-bold">Ikatan Alumni</span>
                <hr class="m-0">
                <span class="fs-6">SMK Negeri Sumsel</span>
            </div>
        </a>
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
            class="navbar-toggler" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse"
            type="button"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if ($currentRoute !== '/') : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/">Beranda</a>
                </li>
                <?php endif; ?>

                <?php if ($currentRoute !== '/kegiatan/' . $kegiatanId && strpos($currentRoute, '/alumni') !== 0) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="#struktur">Struktur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kegiatan">Kegiatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#quotes">Quotes</a>
                </li>
                <?php endif; ?>


                <?php if (isset($_SESSION['nama'])) : ?>
                <div class="dropdown">
                    <button class=" btn btn-light dropdown-toggle nav-item" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">INFORMASI
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-capitalize" href="/alumni">Alumni</a></li>
                        <!-- <li><a class="dropdown-item text-capitalize" href="#">Lowongan Pekerjaan</a></li> -->
                    </ul>
                </div>
                <div class="dropdown">
                    <button class=" btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?= $_SESSION['nama'] ?>
                    </button>
                    <ul class="dropdown-menu">
                        <!-- <li><a class="dropdown-item text-capitalize" href="#">Profile</a></li> -->
                        <form>
                            <li><a class="dropdown-item text-capitalize" href="logout.php"
                                    onclick="return confirm('Kamu yakin menghapus quote ini?')">Logout</a></li>
                        </form>
                    </ul>
                </div>


                <?php else : ?>


                <li class="nav-item">
                    <a class="nav-link" href="/login">Masuk</a>
                </li>
                <?php endif; ?>


            </ul>
        </div>
    </div>
</nav>