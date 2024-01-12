<?php

include('./config/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $newPermission = $_POST['permissions'];

    $stmt = $pdo->prepare('UPDATE user SET permissions = :newPermission WHERE id = :userId');
    $stmt->bindParam(':newPermission', $newPermission);
    $stmt->bindParam(':userId', $userId);

    if ($stmt->execute()) {
        header("Location: /permission");
        exit();
    } else {
        // Operasi gagal
        echo 'Gagal mengubah permission.';
    }
}
