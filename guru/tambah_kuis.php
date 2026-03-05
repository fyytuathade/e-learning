<?php
session_start();
include '../includes/koneksi.php';

 $materi_list = mysqli_query($conn, "SELECT * FROM materi");

if (isset($_POST['simpan'])) {
    $materi_id = $_POST['materi_id'];
    $pertanyaan = $_POST['pertanyaan'];
    $a = $_POST['a']; $b = $_POST['b']; $c = $_POST['c']; $d = $_POST['d'];
    $benar = $_POST['benar'];

    mysqli_query($conn, "INSERT INTO kuis (materi_id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar) 
                        VALUES ('$materi_id', '$pertanyaan', '$a', '$b', '$c', '$d', '$benar')");
    $_SESSION['sukses'] = "Soal berhasil ditambahkan!";
    header("Location: dashboard.php");
}

include '../includes/guru_layout.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark"><i class="bi bi-question-square-fill text-success me-2"></i>Buat Soal Kuis</h2>
    <a href="dashboard.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form method="post">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Pilih Materi Terkait</label>
                    <select name="materi_id" class="form-select form-select-lg" required>
                        <option value="" selected disabled>-- Pilih Materi --</option>
                        <?php while($m = mysqli_fetch_assoc($materi_list)) { ?>
                            <option value="<?= $m['id']; ?>"><?= $m['judul']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Pertanyaan</label>
                    <textarea name="pertanyaan" class="form-control" rows="2" placeholder="Tulis soal di sini..." required></textarea>
                </div>
                <div class="col-12"><hr><h6 class="fw-bold">Opsi Jawaban</h6></div>
                <div class="col-md-6 mb-3">
                    <label class="text-primary fw-bold">Pilihan A</label><input type="text" name="a" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="text-primary fw-bold">Pilihan B</label><input type="text" name="b" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="text-primary fw-bold">Pilihan C</label><input type="text" name="c" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="text-primary fw-bold">Pilihan D</label><input type="text" name="d" class="form-control" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold text-danger">Kunci Jawaban Benar</label>
                    <select name="benar" class="form-select">
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="simpan" class="btn btn-success btn-lg"><i class="bi bi-check-circle me-2"></i>Simpan Soal</button>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/layout_footer.php'; ?>