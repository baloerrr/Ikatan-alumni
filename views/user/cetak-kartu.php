<?php
include('./views/partials/navbar.php');
session_start();
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<section class="bg-light min-vh-100 py-5 ">
    <div class="container pt-5">
        <h1 class="fw-bold text-center mb-5">Cetak Kartu</h1>
        <div class="row d-flex justify-content-center h-100">
            <div class="col-12 col-md-12 col-lg-6 ">
                <div id="card1-id" class="card mb-3" style="max-width: 600px; height: 280px;">
                    <form id="form1-id" class="" action="/cetak-kartu/<?= $user_id ?>" method="post"
                        enctype="multipart/form-data"" onsubmit=" submitForm()">
                        <div class="w-full  d-flex bg-primary gap-5 p-2">
                            <img class="ms-3" src="/public/images/logo-smk-sumsel.png" width="70" height="70" alt="">
                            <div class="w-full d-flex flex-column justify-content-center align-items-center">
                                <h2 class="fw-bold fs-4 text-light">IKATAN KELUARGA ALUMNI</h2>
                                <h4 class="fw-medium fs-5 text-light">SMK NEGERI SUMSEL</h4>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <div>
                                    <input type="file" name="foto" id="inputFile" class="form-control"
                                        style="display: none;" onchange="previewImage(this)" />
                                </div>
                                <label for="inputFile">
                                    <img height="125" width="125" id="imagePreview" src="./public/images/add-photo.png"
                                        alt="Preview" style="display: none; margin-top: 5px; cursor: pointer;">
                                    <?php if (!empty($user['foto'])) : ?>
                                    <img src=".<?= $user['foto'] ?>" id="oldImage" height="125" width="125"
                                        alt="Preview" style="margin-top: 5px; cursor: pointer;">
                                    <?php endif; ?>
                                </label>
                            </div>

                            <div class="col-md-8">
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td style="font-size: 13px;">Nama :</td>
                                                <td style="font-size: 13px;">
                                                    <div class="form-floating">
                                                        <input type="text" name="nama" class="border-0 w-full"
                                                            placeholder="Nama Lengkap" value="<?= $user['nama'] ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 13px;">Jabatan :</td>
                                                <td style="font-size: 13px;">
                                                    <div class="form-floating">
                                                        <input type="text" name="jabatan" class="border-0"
                                                            placeholder="Jabatan" value="<?= $user['jabatan'] ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 13px;">Alamat :</td>
                                                <td style="font-size: 13px;">
                                                    <div class="form-floating">
                                                        <textarea class="border-0 w-full" name="alamat" id="" cols=""
                                                            rows=""><?= $user['alamat'] ?></textarea>

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="card2-id" class="card mb-3" style="max-width: 600px; height: 280px;">
                    <form id="form2-id" action="">
                        <div class="w-full d-flex bg-primary gap-5 p-2">
                            <img class="ms-3" src="/public/images/logo-smk-sumsel.png" width="70" height="70" alt="">
                            <div class="w-full d-flex flex-column justify-content-center align-items-center">
                                <h2 class="fw-bold fs-4 text-light">IKATAN KELUARGA ALUMNI</h2>
                                <h4 class="fw-medium fs-5 text-light">SMK NEGERI SUMSEL</h4>
                            </div>
                        </div>
                        <div class="row mt-4 d-flex justify-content-center align-items-center">
                            <div class="col-md-6 d-flex justify-content-center align-items-center">
                                <div class="d-flex flex-column gap-2">
                                    <p style="font-size: 13px;">Ketua Alumni</p>
                                    <img class="object-fit-contain" height="30" width="100%"
                                        src="/public/images/reza-signature.png" alt="">
                                    <p style="font-size: 13px;">Reza Ramdhani Alkamal</p>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center align-items-center">
                                <div class="d-flex flex-column">
                                    <p style="font-size: 13px;">Wakil</p>
                                    <p><img class="object-fit-contain" height="30" width="100%"
                                            src="/public/images/raihan-signature.png" alt=""></p>
                                    <p style="font-size: 13px;">Raihan Andika</p>
                                </div>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-12 position-absolute bottom-0 start-0">
                                <p class="ms-2" style="font-size: 10px;">Jl. Jend. Basuki Rachmat, Talang Aman, Kec.
                                    Kemuning, Kota
                                    Palembang, Sumatera
                                    Selatan 30128</p>
                            </div>
                        </div>
                    </form>
                </div>
                <button type="submit" form="form1-id" class="btn btn-primary">Submit</button>
                <button class="btn btn-success" onclick="downloadCard()">Kartu Depan</button>
                <button class="btn btn-success" onclick="downloadCard2()">Kartu Belakang</button>


            </div>
        </div>
    </div>
</section>


<?php include('./views/partials/footer.php') ?>