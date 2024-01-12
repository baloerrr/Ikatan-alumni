<?php


function dashboardController()
{
    include('./config/connection.php');

    section_start('content');
    ob_start();
    include('./views/admin/dashboard.php');
    echo ob_get_clean();
    section_end();
}

function quotesController()
{

    section_start('content');
    ob_start();
    include('./views/admin/quotes.php');
    echo ob_get_clean();
    section_end();
}

function userController()
{
    section_start('content');
    ob_start();
    include('./views/admin/users.php');
    echo ob_get_clean();
    section_end();
}

function beritaController()
{
    section_start('content');
    ob_start();
    include('./views/admin/berita.php');
    echo ob_get_clean();
    section_end();
}

function tambahUserController()
{
    section_start('content');
    ob_start();
    include('./views/admin/tambahUser.php');
    echo ob_get_clean();
    section_end();
}

function editUserController($params)
{
    section_start('content');
    ob_start();
    include('./views/admin/editUser.php');
    echo ob_get_clean();
    section_end();
}

function tambahQuoteController()
{
    section_start('content');
    ob_start();
    include('./views/admin/tambahQuote.php');
    echo ob_get_clean();
    section_end();
}

function editQuoteController($params)
{
    section_start('content');
    ob_start();
    include('./views/admin/editQuote.php');
    echo ob_get_clean();
    section_end();
}

function tambahBeritaController()
{
    section_start('content');
    ob_start();
    include('./views/admin/tambahBerita.php');
    echo ob_get_clean();
    section_end();
}

function editBeritaController($params)
{
    section_start('content');
    ob_start();
    include('./views/admin/editBerita.php');
    echo ob_get_clean();
    section_end();
}

function permissionController()
{
    include('./config/connection.php');

    section_start('content');
    ob_start();
    include('./views/admin/permission.php');
    echo ob_get_clean();
    section_end();
}

function tambahUserProses()
{
    include('./config/connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari formulir
        $nama = htmlspecialchars(strip_tags(trim($_POST['nama'])));
        $username = htmlspecialchars(strip_tags(trim($_POST['username'])));
        $nisn = htmlspecialchars(strip_tags(trim($_POST['nisn'])));
        $password = htmlspecialchars(strip_tags(trim($_POST['password'])));
        $level = htmlspecialchars(strip_tags(trim($_POST['level'])));
        $jabatan = htmlspecialchars(strip_tags(trim($_POST['jabatan'])));
        $masa_jabatan = htmlspecialchars(strip_tags(trim($_POST['masa_jabatan'])));

        // Proses upload foto
        $fotoPath = ''; // Tentukan path penyimpanan foto
        if ($_FILES['foto']['error'] == 0) {
            $fotoName = uniqid() . '_' . $_FILES['foto']['name'];
            $fotoPath = './public/images/' . $fotoName;
            move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath);
        }

        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Kueri SQL untuk menambahkan data pengguna ke tabel 'user'
            $sql = "INSERT INTO user (nama, username, nisn, password, level, jabatan, masa_jabatan, foto) 
                VALUES (:nama, :username, :nisn, :password, :level, :jabatan, :masa_jabatan, :foto)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':nisn', $nisn);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':level', $level);
            $stmt->bindParam(':jabatan', $jabatan);
            $stmt->bindParam(':masa_jabatan', $masa_jabatan);
            $stmt->bindParam(':foto', $fotoPath);

            $stmt->execute();

            header("Location: /users");
            exit();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    // Tutup koneksi
    $pdo = null;
}

function tambahQuoteProses()
{
    include('./config/connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $teks = $_POST['teks'];

        try {
            // Get the user_id based on the selected name
            $stmt = $pdo->prepare("SELECT id FROM user WHERE nama = ?");
            $stmt->execute([$nama]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Insert the quote into the database
            $stmt = $pdo->prepare("INSERT INTO quotes (user_id, teks) VALUES (?, ?)");
            $stmt->execute([$user['id'], $teks]);

            // Redirect or display success message
            header("Location: /quotes");
            exit();
        } catch (PDOException $e) {
            // Handle database errors
            die("Database error: " . $e->getMessage());
        }
    }
}

function tambahBeritaProses()
{
    include('./config/connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = htmlspecialchars(strip_tags(trim($_POST['title'])));
        $content = htmlspecialchars(strip_tags(trim($_POST['content'])));

        $coverPath = ''; // Tentukan path penyimpanan foto
        if ($_FILES['cover']['error'] == 0) {
            $fotoName = uniqid() . '_' . $_FILES['cover']['name'];
            $coverPath = './public/images/' . $fotoName;
            move_uploaded_file($_FILES['cover']['tmp_name'], $coverPath);
        }

        $currentDateTime = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS

        try {
            $sql = "INSERT INTO news (title, tanggal, cover, content) 
                VALUES (:title, :tanggal, :cover, :content)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':tanggal', $currentDateTime);
            $stmt->bindParam(':cover', $coverPath);
            $stmt->bindParam(':content', $content);

            $stmt->execute();

            header("Location: /berita");
            exit();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    // Tutup koneksi
    $pdo = null;
}


function editBeritaProses($params)
{
    include('./config/connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $berita_id = $params['id'];
        $title = isset($_POST['title']) ? htmlspecialchars(strip_tags(trim($_POST['title']))) : '';
        $content = isset($_POST['content']) ? htmlspecialchars(strip_tags(trim($_POST['content']))) : '';

        // Proses upload foto baru jika ada
        $coverPath = ''; // Tentukan path penyimpanan foto baru
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === 0) {
            $fotoName = uniqid() . '_' . $_FILES['cover']['name'];
            $coverPath = './public/images/' . $fotoName;
            move_uploaded_file($_FILES['cover']['tmp_name'], $coverPath);
        }

        try {
            // Update data berita
            $sql = "UPDATE news SET title = ?, cover = ?, content = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $coverPath, $content, $berita_id]);

            header("Location: /berita");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid Request Method";
    }
}




function editUserProses($params)
{
    include('./config/connection.php');

    $user_id = $params['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['nama'];
        $username = $_POST['username'];
        $nisn = $_POST['nisn'];
        $password = (!empty($_POST['password'])) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
        $level = $_POST['level'];
        $jabatan = $_POST['jabatan'];
        $masa_jabatan = $_POST['masa_jabatan'];

        $newPhoto = $_FILES['foto'];
        $photoPath = uploadNewPhoto($newPhoto, $user_id);


        try {
            if (!empty($_POST['password'])) {
                $stmt = $pdo->prepare("UPDATE user SET nama=?, username=?, nisn=?, password=?, level=?, jabatan=?, masa_jabatan=?,
foto=? WHERE id=?");
                $stmt->execute([$name, $username, $nisn, $password, $level, $jabatan, $masa_jabatan, $photoPath, $user_id]);
            } else {
                $stmt = $pdo->prepare("UPDATE user SET nama=?, username=?, nisn=?, level=?, jabatan=?, masa_jabatan=?, foto=? WHERE
id=?");
                $stmt->execute([$name, $username, $nisn, $level, $jabatan, $masa_jabatan, $photoPath, $user_id]);
            }

            header("Location: /users");
            exit;
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }
}


function editQuoteProses($params)
{
    include('./config/connection.php');

    $quote_id = $params['id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $teks = $_POST['teks'];

        // Perform validation if needed

        // Update the quote in the database
        try {
            $stmt = $pdo->prepare("
UPDATE quotes AS q
JOIN user AS u ON q.user_id = u.id
SET q.teks = ?
WHERE q.id = ?
");
            $stmt->execute([$teks, $quote_id]);

            header("Location: /quotes");
            exit;
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    } else {
        // Handle non-POST requests if needed
    }
}


function hapusUserProses($params)
{
    include('./config/connection.php');

    $user_id = $params['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
        $stmt->execute([$user_id]);

        header("Location: /users");
        exit;
    } catch (PDOException $e) {
        echo "Error " . $e->getMessage();
    }
}

function hapusQuoteProses($params)
{
    include('./config/connection.php');

    $quote_id = $params['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM quotes WHERE id = ?");
        $stmt->execute([$quote_id]);

        header("Location: /quotes");
        exit;
    } catch (PDOException $e) {
        echo "Error " . $e->getMessage();
    }
}

function hapusBeritaProses($params)
{
    include('./config/connection.php');

    $berita_id = $params['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
        $stmt->execute([$berita_id]);

        header("Location: /berita");
        exit;
    } catch (PDOException $e) {
        echo "Error " . $e->getMessage();
    }
}

function editPermissionProses($params)
{
    include('./config/connection.php');

    $user_id = $params['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPermission = $_POST['permissions'];
        $stmt = $pdo->prepare('UPDATE user SET permissions = :newPermission WHERE id = :userId');
        $stmt->bindParam(':newPermission', $newPermission);
        $stmt->bindParam(':userId', $user_id);

        if ($stmt->execute()) {
            header('Location: /permission');
            exit();
        } else {
            echo 'Gagal mengubah permission.';
        }
    }
}

function uploadNewPhoto($file, $user_id)
{
    $targetDir = "./public/images/";
    $targetFile = $targetDir . "user_" . $user_id . "_" . basename($file["name"]);
    move_uploaded_file($file["tmp_name"], $targetFile);

    return $targetFile;
}
