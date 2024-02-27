<?php
$conn = mysqli_connect('localhost', 'root', '', 'projectpwdpb');
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk menyimpan data ke tabel personal_computer
function simpanPerbaikan($no, $tanggal, $service, $penggantian_sparepart, $paraf, $nama) {
    global $conn;

    $sql = "INSERT INTO personal_computerr (No, Tanggal, Servis, Penggantian_Sparepart, Paraf, nama) VALUES ('$no', '$tanggal', '$service', '$penggantian_sparepart', '$paraf', '$nama')";

    if (mysqli_query($conn, $sql)) {
        echo "DATA BERHASIL DISIMPAN KE PESANAN.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Proses form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $no = $_POST["no"];
    $tanggal = $_POST["tanggal"];
    $service = $_POST["service"];
    $penggantian_sparepart = $_POST["penggantian_Alat"];
    $paraf = $_POST["paraf"];
    $nama = $_POST["nama"];

    // Panggil fungsi untuk menyimpan data
    simpanPerbaikan($no, $tanggal, $service, $penggantian_sparepart, $paraf, $nama);
}

function ambilDataPersonalComputer() {
    global $conn;

    $sql = "SELECT * FROM personal_computerr";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return [];
    }
}

// Ambil data dari tabel personal_computer
$dataPersonalComputer = ambilDataPersonalComputer();

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:  rgba(223, 204, 251, .3);
            margin: 0;
            padding: 0;
        }

        h2 {
            color:#161A30;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background: #DCF2F1;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 8px;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background: #161A30;
            color: #fff;
            cursor: pointer;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            background: #DCF2F1;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #DCF2F1;
            color: black;
        }
    </style>

</head>
<body>

<h2>Form Perbaikan Alat Tenis Meja</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="no">No:</label>
    <input type="text" name="no" required>

    <label for="Nama">Nama:</label>
    <input type="text" name="nama" required>

    <label for="tanggal">Tanggal:</label>
    <input type="date" name="tanggal" required>

    <label for="service">Service:</label>
    <textarea name="service" required></textarea>

    <label for="penggantian_Alat">Penggantian Alat:</label>
    <textarea name="penggantian_Alat" required></textarea>

    <label for="paraf">Paraf:</label>
    <input type="text" name="paraf" required>

    <input type="submit" value="Submit">
</form>

<h2>Data Pesanan</h2>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Service</th>
            <th>Penggantian Alat</th>
            <th>Paraf</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($dataPersonalComputer as $data) {
            echo "<tr>";
            echo "<td>" . $data['No'] . "</td>";
            echo "<td>" . $data['nama'] . "</td>";
            echo "<td>" . $data['Tanggal'] . "</td>";
            echo "<td>" . $data['Servis'] . "</td>";
            echo "<td>" . $data['Penggantian_Sparepart'] . "</td>";
            echo "<td>" . $data['Paraf'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>