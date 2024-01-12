<nav class="navbar navbar-expand px-3 border-bottom">
    <button class="btn" id="sidebar-toggle" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse navbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <?php
                session_start();
                $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
                $stmt->execute([$_SESSION['user_id']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="/dashboard" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                    <img src="<?php echo $user['foto'] ?>" style="border-radius: 20px; object-fit: cover;"
                        class="avatar img-fluid" alt="">
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a href="/edit-user/<?= $user['id'] ?>" class="dropdown-item">Profile</a>
                    <a href="logout.php" class="dropdown-item" onclick="return confirm('Anda yakin logout?')">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>