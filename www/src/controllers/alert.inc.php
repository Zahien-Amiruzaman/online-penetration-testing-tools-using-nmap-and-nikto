<?php

function errorAlertWarning($message)
{
    echo <<<HTML
        <div class="alert alert-danger text-center" role="alert">
            <strong>$message</strong>
        </div>
    HTML;
}

function successAlert($message)
{
    echo <<<HTML
        <div class="alert alert-success text-center" role="alert">
            <strong>$message</strong>
        </div>
    HTML;
}

function getError() {
    $errorMessages = [
        'username_password_not_match' => 'Username/Password not match!',
        'wrong_user_type' => 'Wrong user type!',
        'password_not_match' => 'Password does not match!',
        'empty_input' => 'Please fill all fields!',
        'user_exists' => 'Username or Email already taken!',
        'invalid_subnet' => 'Invalid subnet!'
    ];

    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        $errorMsg = $errorMessages[$error]?? 'Unknown error';

        echo <<<HTML
        <div class="alert alert-danger text-center" role="alert">
            <strong>$errorMsg</strong>
        </div>
        HTML;
    }
}

function getSuccess() {
    $successMessage = [
        'register_success' => 'Registration Successful!',
        'update_success' => 'Update Successful!',
        'delete_success' => 'Delete Successful!'
    ];

    if (isset($_GET['success'])) {
        $success = $_GET['success'];
        $successMsg = $successMessage[$success]?? 'Unknown success';

        echo <<<HTML
        <div class="alert alert-success text-center" role="alert">
            <strong>$successMsg</strong>
        </div>
        HTML;
    }
}
