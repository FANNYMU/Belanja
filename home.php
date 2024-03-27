<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda - Jual Beli Barang</title>
    <link rel="stylesheet" href="assets/style.css">

    <script>
    // Function to toggle dark mode
    function toggleDarkMode() {
        var body = document.body;
        body.classList.toggle("dark-mode");

        // Save preference to localStorage
        var isDarkMode = body.classList.contains("dark-mode");
        localStorage.setItem("darkMode", isDarkMode);
    }

    // Function to apply saved preference on page load
    function applySavedPreference() {
        var body = document.body;
        var isDarkMode = localStorage.getItem("darkMode");

        if (isDarkMode === "true") {
            body.classList.add("dark-mode");
        }
    }

    // Apply saved preference when page loads
    document.addEventListener("DOMContentLoaded", function() {
        applySavedPreference();

        // Add event listener to dark mode button
        var darkModeButton = document.getElementById("dark-mode-button");
        darkModeButton.addEventListener("click", toggleDarkMode);
    });

    // Fungsi untuk menampilkan preview foto yang dipilih
function previewImage(event) {
    var previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = ''; // Hapus konten sebelumnya

    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function() {
        var img = document.createElement('img');
        img.src = reader.result;
        img.classList.add('preview-image');
        previewContainer.appendChild(img);
    }

    reader.readAsDataURL(file);
}

// Fungsi untuk mengunggah foto ke dalam elemen <li>
function uploadImage() {
    var previewContainer = document.getElementById('preview-container');
    var img = previewContainer.querySelector('.preview-image');

    if (img) {
        var ul = document.getElementById('barang-list');
        var li = document.createElement('li');
        li.appendChild(img.cloneNode(true)); // Salin elemen gambar ke dalam elemen <li>
        ul.appendChild(li);

        // Hapus preview gambar setelah diunggah
        previewContainer.innerHTML = '';
    } else {
        alert('Pilih foto terlebih dahulu!');
    }
}


</script>

</head>
<body>
<div class="container">
    <h1>Selamat Datang di Situs Jual Beli Barang</h1>

    <button id="dark-mode-button" class="cool-button">🌙 Dark Mode</button>

    <h2>Daftar Barang</h2>

    <form id="upload-form">
        <button type="button" class="upload-button" onclick="uploadImage()">Unggah Foto</button>
        <input type="file" id="file-input" accept="image/*" onchange="previewImage(event)">
</form>


    <ul id="barang-list">
        <?php
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


        // Query untuk mengambil data barang dari database
        $sql = "SELECT * FROM barang";
        $result = $conn->query($sql);


        // Tampilkan hasil query
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row["nama_barang"] . " - Rp " . number_format($row["harga"], 0, ',', '.') . "</li>";
            }
        } else {
            echo "Tidak ada barang yang tersedia.";
        }

        $conn->close();
        ?>
    </ul>
    <a href="tambah_barang.php">Tambah Barang</a>
    </div>

    <div id="preview-container"></div>
</body>
</html>
