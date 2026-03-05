<?php
session_start();
include '../includes/koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'guru') {
    header("Location: index.php");
    exit;
}

// Proses Simpan Absen
if (isset($_POST['simpan_absen'])) {
    $tanggal = date('Y-m-d');
    // Loop setiap siswa yang diabsen
    foreach ($_POST['status'] as $siswa_id => $status_absen) {
        // Cek agar tidak double input di hari yang sama
        $cek = mysqli_query($conn, "SELECT * FROM absensi WHERE tanggal='$tanggal' AND siswa_id='$siswa_id'");
        if (mysqli_num_rows($cek) == 0) {
            mysqli_query($conn, "INSERT INTO absensi (tanggal, siswa_id, status) VALUES ('$tanggal', '$siswa_id', '$status_absen')");
        }
    }
    $_SESSION['sukses'] = "Absensi berhasil disimpan!";
    header("Location: absensi.php");
}

// Query Data Siswa
 $query = mysqli_query($conn, "SELECT * FROM users WHERE role='siswa'");

// Sertakan Layout (Asumsi layout.php ada di root)
// Jika layout.php kamu ada di folder includes, ganti jadi include 'includes/layout.php';
include '../includes/guru_layout.php'; 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">Absensi Siswa</h2>
    <a href="dashboard.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 shadow-sm border-0">
    <form method="post">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Hadir</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Alpa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $row['nama_lengkap']; ?></td>
                        <!-- Radio Button Group -->
                        <td class="text-center"><input type="radio" name="status[<?= $row['id']; ?>]" value="Hadir" checked></td>
                        <td class="text-center"><input type="radio" name="status[<?= $row['id']; ?>]" value="Sakit"></td>
                        <td class="text-center"><input type="radio" name="status[<?= $row['id']; ?>]" value="Izin"></td>
                        <td class="text-center"><input type="radio" name="status[<?= $row['id']; ?>]" value="Alpa"></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <button type="submit" name="simpan_absen" class="btn btn-primary mt-3">Simpan Absensi</button>
    </form>
</div>

<?php include '../includes/layout_footer.php'; ?>