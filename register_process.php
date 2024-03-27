<?php
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

    // Ambil data dari form registrasi
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan query untuk memasukkan data ke database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil. Silakan login <a href='index.php'><button>Disini</button></a>.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
