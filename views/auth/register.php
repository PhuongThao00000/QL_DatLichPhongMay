<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="/CNW23N10/room_booking/assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>📝 Đăng ký tài khoản</h2>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?controller=auth&action=register">
                <div class="form-group">
                    <label>Tên đăng nhập:</label>
                    <input type="text" name="username" required class="form-control">
                </div>

                <div class="form-group">
                    <label>Họ tên:</label>
                    <input type="text" name="fullname" required class="form-control">
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required class="form-control">
                </div>

                <div class="form-group">
                    <label>Mật khẩu:</label>
                    <input type="password" name="password" required class="form-control">
                </div>

                <div class="form-group">
                    <label>Xác nhận mật khẩu:</label>
                    <input type="password" name="confirm_password" required class="form-control">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
            </form>

            <p class="auth-link">
                Đã có tài khoản? <a href="index.php?controller=auth&action=login">Đăng nhập</a>
            </p>
        </div>
    </div>
</body>
</html>