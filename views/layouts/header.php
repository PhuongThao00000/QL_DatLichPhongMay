<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ PHÒNG MÁY</title>

    <!-- CSS tách riêng -->
    <link rel="stylesheet" href="/QL_DatLichPhongMay/assets/css/style.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container">
            <a href="index.php?controller=room&action=index" class="logo">📅 QUẢN LÝ PHÒNG MÁY</a>

            <?php if(isset($_SESSION['user_id'])): ?>
            <ul class="nav-menu">

                <?php if($_SESSION['role'] == 'admin'): ?>
                    <li><a href="index.php?controller=room&action=index">Quản lý phòng</a></li>
                    <li><a href="index.php?controller=booking&action=index">Duyệt lịch đặt</a></li>
                <?php else: ?>
                    <li><a href="index.php?controller=room&action=index">Danh sách phòng</a></li>
                    <li><a href="index.php?controller=booking&action=create">Đặt lịch</a></li>
                    <li><a href="index.php?controller=booking&action=index">Lịch của tôi</a></li>
                <?php endif; ?>

                <li class="user-info">
                    <span>👤 <?php echo $_SESSION['fullname']; ?></span>

                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <span class="badge badge-danger">Admin</span>
                    <?php endif; ?>
                </li>

                <li><a class="btn-logout" href="index.php?controller=auth&action=logout">ĐĂNG XUẤT</a></li>

            </ul>
            <?php endif; ?>
        </div>
    </nav>

</body>
</html>
