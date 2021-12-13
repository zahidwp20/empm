<?php
/**
 * Database Connection
 */

session_start();

date_default_timezone_set('Asia/Dhaka');

const EMPM_DB_NAME = 'empm_db';
const EMPM_TBL_USERS = 'empm_users';
const EMPM_TBL_OPTIONS = 'empm_options';
const EMPM_ADMIN_EMAIL = 'admin@empm.local';
const EMPM_ADMIN_USERNAME = 'admin';
const EMPM_ADMIN_PASSWORD = '123456';


// Create connection
$conn = new mysqli('localhost', 'root', '');

$_SESSION['conn'] = $conn;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
if (!mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS " . EMPM_DB_NAME)) {
    die("Error creating database: " . mysqli_error($conn));
}

// Select Database
if (!mysqli_select_db($conn, EMPM_DB_NAME)) {
    die("Error selecting database");
}

//Create users table
$sql_create_tbl_users = "CREATE TABLE IF NOT EXISTS " . EMPM_TBL_USERS . " (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255),
        last_name VARCHAR(255),
        user_name VARCHAR(255) UNIQUE NOT NULL,
        email_address VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        phone_number VARCHAR(255),
        designation VARCHAR(255),
        street_address VARCHAR(255),
        city VARCHAR(255),
        zipcode VARCHAR(255),
        country VARCHAR(255),
        gender VARCHAR(255),
        salary VARCHAR(255),
        religion VARCHAR(255),
        status VARCHAR(255) DEFAULT 'pending',
        user_role VARCHAR(255) DEFAULT 'employee',
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if (!$conn->query($sql_create_tbl_users)) {
    die("Error creating table: " . $conn->error);
}

//Create options table
$sql_create_tbl_options = "CREATE TABLE IF NOT EXISTS " . EMPM_TBL_OPTIONS . " (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        option_key VARCHAR(255) UNIQUE NOT NULL,
        option_value VARCHAR(255),
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if (!$conn->query($sql_create_tbl_options)) {
    die("Error creating table: " . $conn->error);
}

// Create a default admin user if no admin user is created
if (!empm_get_user(EMPM_ADMIN_USERNAME)) {
    $user_id = empm_user_registration(EMPM_ADMIN_USERNAME, EMPM_ADMIN_EMAIL, EMPM_ADMIN_PASSWORD);

    if ($user_id) {
        $sql = "UPDATE " . EMPM_TBL_USERS . " SET user_role = 'administrator', status = 'active' WHERE id = $user_id";
        $conn->query($sql);
    }
}

