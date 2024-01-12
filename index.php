<?php
include('./config/connection.php');
include('./config/utils.php');
include('./routes/route.php');
include('./routes/web.php');

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $_SERVER['REQUEST_URI'] ?></title>
    <?php include('./public/bootstrap/style.php') ?>
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>


    <?php echo stack('css') ?>

    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 300px;
        }

        .swiper {
            width: 240px;
            height: 320px;
        }

        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            font-size: 22px;
            font-weight: bold;
            color: #fff;
            transition-duration: 0ms;
            transform: translate3d(-3393px, 0px, 0px);
            transition-delay: 2ms;
            position: relative;
        }

        .swiper-slide:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .swiper-slide .card {
            width: 18rem;
            transition: transform 0.3s ease-in-out;
        }

        .swiper-slide:hover .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
    </style>
</head>


<body>
    <?php
    $yieldSection = 'content';

    if (isset($section)) {
        $yieldSection = $section;
    }

    if (isset($sections[$yieldSection])) {
        echo $sections[$yieldSection];
    }
    ?>


    <?php echo stack('js') ?>
    <?php include('./public/bootstrap/script.php') ?>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#datatables');
    </script>
    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var oldImage = document.getElementById('oldImage');

            // Hide the old image
            if (oldImage) {
                oldImage.style.display = 'none';
            }

            preview.style.display = 'block';

            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "cards",
            loop: true,
            grabCursor: true,
        });

        const swiperBlog = new Swiper('.swiperBlog', {
            loop: true,
            slidesPerView: 5,
            spaceBetween: 50,
            autoplay: {
                delay: 5000,
                disableOnInteraction: true
            },

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },

            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 50
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 50
                },
                960: {
                    slidesPerView: 3,
                    spaceBetween: 50
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 50
                },
                1600: {
                    slidesPerView: 5,
                    spaceBetween: 50
                }
            }
        });
    </script>
</body>

</html>

</html>