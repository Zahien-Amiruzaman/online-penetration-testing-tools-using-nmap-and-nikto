<?php
 /**
  * * include config
  */
 include '../../config/config.php';

/**
 * * include controllers
 */
include '../controllers/alert.inc.php';
include '../controllers/user_manage/user_add.inc.php';
include '../controllers/user_manage/user_delete.inc.php';
include '../controllers/user_manage/user_error_handler.inc.php';
include '../controllers/user_manage/user_get_data.inc.php';
include '../controllers/user_manage/user_table.inc.php';
include '../controllers/user_manage/user_update.inc.php';


/**
 * if the user click the add button and save
 */
if (isset($_POST['add_new_user_btn'])) {

    $fullname = $_POST['user_fullname'];
    $email = $_POST['user_email'];
    $username = $_POST['username'];
    $password = $_POST['user_password'];
    $user_type = $_POST['user_type'];

    $user_exists = user_exists($conn, $username, $email);

    if (is_input_empty()) {
        header("location: ../views/user_manage.php?error=empty_input");
        exit();
    }

    if (!is_password_match()) {
        header("location: ../views/user_manage.php?error=password_not_match");
        exit();
    }

    if ($user_exists) {
        header("location: ../views/user_managet.php?error=user_exists");
        exit();
    }

    add_new_user($conn, $fullname, $username, $email, $password, $user_type);
    header("location: ../views/user_manage.php?success=register_success");
}

/**
 * if user want to edit and update the data
 */
if (isset($_POST['edit_user_btn'])) {

    $user_id = $_POST['user_id'];
    $fullname = $_POST['user_fullname'];
    $email = $_POST['user_email'];
    $username = $_POST['username'];
    $user_type = $_POST['user_type'];

    update_user($conn, $fullname, $username, $email, $user_type, $user_id);
    header("location: ../views/user_manage.php?success=update_success");
}

/**
 * if the user click the delete button
 */
if (isset($_POST['delete_user_btn'])) {
    $user_id = $_POST['user_id'];

    delete_user($conn, $user_id);
    header("location: ../views/user_manage.php?success=delete_success");
}

