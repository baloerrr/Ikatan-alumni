<?php

function loginController()
{
    section_start('content');
    ob_start();
    include('./views/login.php');
    echo ob_get_clean();
    section_end();
}

function registerController()
{
    section_start('content');
    ob_start();
    include('./views/register.php');
    echo ob_get_clean();
    section_end();
}

function loginProses()
{
    include('./config/connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
            $stmt->execute([$username]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['level'] = $user['level'];
                $_SESSION['is_logged_in'] = true;

                if ($user['level'] === 'admin') {
                    header('Location: /dashboard');
                    exit;
                } elseif ($user['level'] === 'user') {
                    if ($user['permissions'] === 'disetujui') {
                        header('Location: /');
                        exit;
                    } else {
                        header('Location: /wait_permission');
                        exit;
                    }
                } else {
                    header('Location: /login');
                    exit;
                }
            } else {
                echo "Login failed. Invalid username or password.";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        echo "Request Method was not POST";
    }
}




function registerProses()
{
    include('./config/connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['nama'];
        $username = $_POST['username'];
        $nisn = $_POST['nisn'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $level = "user";

        $targetDir = "./public/images/"; // Adjust the target directory as needed
        $targetFile = $targetDir . basename($_FILES["foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if (file_exists($targetFile)) {
            $uploadOk = 0;
        }

        if ($_FILES["foto"]["size"] > 500000) {
            $uploadOk = 0;
        }

        if (
            $imageFileType != "jpg" && $imageFileType != "png" &&
            $imageFileType != "jpeg" && $imageFileType != "gif"
        ) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
                echo "Upload foto successful";
                try {
                    $stmt = $pdo->prepare("INSERT INTO user (nama, username, nisn, password, foto, level) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$name, $username, $nisn, $password, $targetFile, $level]);

                    header('Location: /login');
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "Upload foto not successful";
            }
        }
    } else {
        echo "Request Method wasn't not POST";
    }
}


function waitPermissionController()
{
    include('./config/connection.php');
    section_start('content');
    ob_start();
    include('./views/wait_permission.php');
    echo ob_get_clean();
    section_end();
}
