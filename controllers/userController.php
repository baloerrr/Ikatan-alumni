<?php

function kegiatanController($params)
{
    include('./config/connection.php');

    section_start('content');
    ob_start();
    include('./views/user/kegiatanDetail.php');
    echo ob_get_clean();
    section_end();
}


function alumniController()
{
    include('./config/connection.php');
    section_start('content');
    ob_start();
    include('./views/user/alumni.php');
    echo ob_get_clean();
    section_end();
}

function cetakKartuController()
{
    include('./config/connection.php');
    section_start('content');
    ob_start();
    include('./views/user/cetak-kartu.php');
    echo ob_get_clean();
    section_end();
}

function cetakKartuProses($params)
{
    include('./config/connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari formulir
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';
        $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';

        // Ambil user ID dari parameter
        $user_id = $params['id'];

        // Periksa apakah ada file gambar yang diunggah
        if ($_FILES['foto']['error'] == 0) {
            // Jika ada, proses upload gambar
            $fotoName = uniqid() . '_' . $_FILES['foto']['name'];
            $fotoPath = './public/images/' . $fotoName;
            move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath);
        } else {
            // Jika tidak ada perubahan gambar, ambil path gambar yang sudah ada dari database
            $stmtFoto = $pdo->prepare("SELECT foto FROM user WHERE id = ?");
            $stmtFoto->execute([$user_id]);
            $existingFoto = $stmtFoto->fetchColumn();

            if ($existingFoto) {
                $fotoPath = $existingFoto;
            } else {
                // Default jika tidak ada gambar sebelumnya
                $fotoPath = '';
            }
        }

        // Proses update data
        try {
            $stmt = $pdo->prepare("UPDATE user SET nama = ?, jabatan = ?, alamat = ?, foto = ? WHERE id = ?");
            $stmt->execute([$nama, $jabatan, $alamat, $fotoPath, $user_id]);

            header("Location: /cetak-kartu/" . $user_id);
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error: Invalid request method.";
    }
}
