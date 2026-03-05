<?php
session_start();
include '../includes/koneksi.php';

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];
    $guru_id = $_SESSION['id'];

    mysqli_query($conn, "INSERT INTO materi (judul, deskripsi, link, guru_id) VALUES ('$judul', '$deskripsi', '$link', '$guru_id')");
    $_SESSION['sukses'] = "Materi berhasil ditambahkan!";
    header("Location: dashboard.php");
}

 $materi_list = mysqli_query($conn, "SELECT * FROM materi");
include '../includes/guru_layout.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark"><i class="bi bi-book-plus-fill text-primary me-2"></i>Tambah Materi Baru</h2>
    <a href="dashboard.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form method="post">
            <div class="mb-3">
                <label class="form-label fw-bold">Judul Materi</label>
                <input type="text" name="judul" class="form-control form-control-lg" placeholder="Contoh: Dasar Pemrograman PHP" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi Singkat</label>
                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan sedikit tentang materi ini..." required></textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Link Sumber Belajar (Video/PDF)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                    <input type="text" name="link" class="form-control" placeholder="https://youtube.com/..." required>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="simpan" class="btn btn-primary btn-lg"><i class="bi bi-save me-2"></i>Simpan Materi</button>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/layout_footer.php'; ?>