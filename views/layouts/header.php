<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý lịch phòng máy</title>
    <link rel="stylesheet" href="/CNW23N10/room_booking/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php?controller=room&action=index" class="logo">📅 Quản lý phòng máy</a>
            <?php if(isset($_SESSION['user_id'])): ?>
            <ul class="nav-menu">
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <!-- Menu cho Admin -->
                    <li><a href="index.php?controller=room&action=index">Quản lý phòng</a></li>
                    <li><a href="index.php?controller=booking&action=index">Duyệt lịch đặt</a></li>
                <?php else: ?>
                    <!-- Menu cho User -->
                    <li><a href="index.php?controller=room&action=index">Danh sách phòng</a></li>
                    <li><a href="index.php?controller=booking&action=create">Đặt lịch</a></li>
                    <li><a href="index.php?controller=booking&action=index">Lịch của tôi</a></li>
                <?php endif; ?>
                
                <li class="user-info">
                    <span>👤 <?php echo $_SESSION['fullname']; ?></span>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <span class="badge">Admin</span>
                    <?php endif; ?>
                </li>
                <li><a href="index.php?controller=auth&action=logout" class="btn-logout">Đăng xuất</a></li>
            </ul>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container main-content">