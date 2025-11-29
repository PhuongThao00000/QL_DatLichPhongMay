<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/QL_DatLichPhongMay/assets/css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>🔐 Đăng nhập</h2>

            <?php if(isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?controller=auth&action=login">

                <!-- Username -->
                <div class="form-group">
                    <input type="text" name="username" required class="form-control" placeholder="Tên đăng nhập">
                    <i class="fa fa-user icon"></i>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input type="password" name="password" required class="form-control" placeholder="Mật khẩu" id="password">
                    <i class="fa fa-lock icon"></i>
                    <i class="fa fa-eye toggle-password" onclick="togglePassword()"></i>
                </div>

                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>

            <p class="auth-link">
                Chưa có tài khoản? <a href="index.php?controller=auth&action=register">Đăng ký ngay</a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pw = document.getElementById('password');
            const icon = document.querySelector('.toggle-password');
            if(pw.type === 'password'){
                pw.type = 'text';
                icon.classList.replace('fa-eye','fa-eye-slash');
            } else {
                pw.type = 'password';
                icon.classList.replace('fa-eye-slash','fa-eye');
            }
        }
    </script>
</body>
</html>
