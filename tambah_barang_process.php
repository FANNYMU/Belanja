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

    // Ambil data dari form tambah barang
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];

    // Query untuk menambahkan data barang ke database
    $sql = "INSERT INTO barang (nama_barang, harga) VALUES ('$nama_barang', '$harga')";

    if ($conn->query($sql) === TRUE) {
        // Jika penambahan berhasil, redirect ke halaman beranda
        header("Location: home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
