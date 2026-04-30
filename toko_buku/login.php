<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Toko Buku</title>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Toko Buku Online</h4>
                    <small>Silakan login untuk melanjutkan</small>
                </div>
                <div class="card-body">

                    <!-- Pesan error/info dari redirect -->
                    <?php if (isset($_GET['message'])): ?>
                        <div class="alert alert-warning">
                            <?= htmlspecialchars($_GET['message']) ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="proses_login.php">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username"
                                   class="form-control" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"
                                   class="form-control" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Login</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>