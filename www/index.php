<?php
session_start();
include 'src/controllers/alert.inc.php';

$login_inc_page = 'src/controllers/login.inc.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>SentinelScan Suite</title>

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/index.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-page">
        <div class="row">
            <div class="container container-logo">
                <div class="logo">
                    <img src="/public/images/sss-logo.png" alt="SentinalScan Suite Logo">
                </div>
            </div>
            <div class="title-container mt-4">
                <h2 class="login-title mb-5">
                    SentinelScan Suite
                </h2>
            </div>
            <div class="login-container col-md-10">
                <div class="form-container col-md-9">
                    <form action="<?= $login_inc_page ?>" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="input" class="form-control form-control-sm" name="username">
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-sm" name="password">
                        </div>
                        <div class="submit-btn">
                            <button type="submit" id="login-btn" name="login" class="btn btn-sm btn-primary col-md-12">Log
                                In</button>
                        </div>
                    </form>
                    <div class="error-container mt-3">
                        <?=getError()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
