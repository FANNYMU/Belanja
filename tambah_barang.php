<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
</head>
<body>
    <h2>Tambah Barang Baru</h2>
    <form action="tambah_barang_process.php" method="post">
        <label for="nama_barang">Nama Barang:</label><br>
        <input type="text" id="nama_barang" name="nama_barang" required><br>
        <label for="harga">Harga:</label><br>
        <input type="text" id="harga" name="harga" required><br><br>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>
