<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database (Anda harus mengganti nilai ini sesuai dengan pengaturan Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "buku_tamu";

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan query untuk memeriksa apakah data yang dimasukkan cocok dengan yang ada di database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Jika data cocok, redirect ke halaman beranda atau halaman selanjutnya
        $_SESSION['username'] = $username;
        header("Location: home.php");
    } else {
        // Jika data tidak cocok, tampilkan pesan error
        echo "Username atau password salah.";
    }

    $conn->close();
}
?>
