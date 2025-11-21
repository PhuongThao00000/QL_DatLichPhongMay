<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/CNW23N10/room_booking/assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>🔐 Đăng nhập</h2>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if(isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?controller=auth&action=login">
                <div class="form-group">
                    <label>Tên đăng nhập:</label>
                    <input type="text" name="username" required class="form-control">
                </div>

                <div class="form-group">
                    <label>Mật khẩu:</label>
                    <input type="password" name="password" required class="form-control">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            </form>

            <p class="auth-link">
                Chưa có tài khoản? <a href="index.php?controller=auth&action=register">Đăng ký ngay</a>
            </p>

            <div class="demo-account">
                <p><strong>Tài khoản demo:</strong></p>
                <p>Admin: admin / admin123</p>
                <p>User: user1 / user123</p>
            </div>
        </div>
    </div>
</body>
</html>