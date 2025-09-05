<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/footer.css" rel="stylesheet">
    <link href="./css/login.css" rel="stylesheet">
    <!-- Dark Mode CSS -->
    <link href="./css/dark-mode.css" rel="stylesheet">
    <title>Airline Ticket Management System - FITDNU</title>
</head>

<body>
    <section class="vh-100 d-flex justify-content-center align-items-center login-container">
        <div class="container-fluid h-custom">
            <div class="d-flex flex-row align-items-center justify-content-center mb-4">
                <h2 class="text-primary" style="color: #f66600;">AIRLINE TICKET MANAGEMENT SYSTEM</h2>
                <!-- Theme toggle button for login page -->
                <button type="button" class="theme-toggle btn ms-3" id="login-theme-toggle" title="Chuyển đổi giao diện tối/sáng">
                    <span class="theme-icon">
                        <i class="fas fa-moon"></i>
                    </span>
                </button>
            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="./images/draw2.webp" style="width: 100%; height: 100%; object-fit: cover;" class="img-fluid"
                        alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="card login-card p-4 shadow">
                        <form action="./handle/login_process.php" method="POST">
                        <!-- Username input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" name="username" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Nhập username" required />
                            <label class="form-label" for="form3Example3">Username</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Nhập mật khẩu" required />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Ghi nhớ đăng nhập
                                </label>
                            </div>
                            <a href="#!" class="text-body">Quên mật khẩu?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng nhập</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Chưa có tài khoản? <a href="#!"
                                    class="link-danger">Đăng ký</a></p>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Success and error messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-danger text-white">
                        <strong class="me-auto">Lỗi</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success text-white">
                        <strong class="me-auto">Thành công</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= htmlspecialchars($_SESSION['success']) ?>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Dark Mode JS -->
    <script src="./js/dark-mode.js"></script>
    
    <!-- Auto-hide toasts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(function(toast) {
                setTimeout(function() {
                    toast.classList.remove('show');
                }, 5000);
            });
        });
    </script>
</body>

</html>
