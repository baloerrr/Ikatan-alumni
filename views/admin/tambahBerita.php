<?php
include('./config/utils.php');
include('./config/connection.php');

push('css', '<link rel="stylesheet" href="./public/css/admin.css">');
push('js', '<script src="./public/js/admin.js"></script>');

?>


<div class="wrapper">
    <?php include('./views/admin/partials/sidebar.php') ?>

    <div class="main">
        <?php include('./views/admin/partials/header.php') ?>

        <main class="content px-3 py-2">
            <div class="container-fluid">
                <form style="background-color: transparent;" action="/tambah-berita" method="post"
                    enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" id="title" name="title" class="form-control" />
                        <label class="form-label" for="title">Judul</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="content" name="content" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label mb-3">Cover</label>
                        <input class="form-control" type="file" name="cover" id="cover" onchange=" previewImage(this)">
                        <img height="200" width="200" id="imagePreview" src="#" alt="Preview"
                            style="display:none; height: auto; margin-top: 5px;">
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