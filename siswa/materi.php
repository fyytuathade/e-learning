<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') header("Location: index.php");
include '../includes/koneksi.php';
include '../includes/siswa_layout.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark"><i class="bi bi-journal-text text-primary me-2"></i>Materi Belajar</h2>
    <a href="dashboard.php" class="btn btn-outline-secondary">Dashboard</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Judul Materi</th>
                        <th>Guru Pengajar</th>
                        <th>Deskripsi</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conn, "SELECT m.*, u.nama_lengkap FROM materi m JOIN users u ON m.guru_id = u.id ORDER BY m.id DESC");
                    if(mysqli_num_rows($query) == 0) echo "<tr><td colspan='4' class='text-center py-5'>Belum ada materi yang diunggah.</td></tr>";
                    while($row = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td><?= $row['judul']; ?></td>
                        <td><span class="badge bg-info text-dark"><?= $row['nama_lengkap']; ?></span></td>
                        <td><?= $row['deskripsi']; ?></td>
                        <td><a href="<?= $row['link']; ?>" target="_blank" class="btn btn-primary btn-sm rounded-pill">Buka Materi</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/layout_footer.php'; ?>