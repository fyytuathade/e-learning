<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') header("Location: dashboard.php");
include '../includes/koneksi.php';;

// Hapus User
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    header("Location: manajemen_user.php");
}

// Tambah User
if (isset($_POST['tambah'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $n = $_POST['nama'];
    $r = $_POST['role'];
    mysqli_query($conn, "INSERT INTO users (username, password, nama_lengkap, role) VALUES ('$u', '$p', '$n', '$r')");
}

// --- TENTUKAN DASHBOARD LINK ---
 = "../admin/dashboard.php"; 
// ------------------------------

// --- TENTUKAN DASHBOARD LINK ---
 = "../admin/dashboard.php"; 
// ------------------------------

// --- TENTUKAN DASHBOARD LINK ---
 = "../admin/dashboard.php"; 
// ------------------------------

// --- TENTUKAN DASHBOARD LINK ---
 = "../admin/dashboard.php"; 
// ------------------------------

include '../includes/layout.php';;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Pengguna</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUserModal"><i class="bi bi-plus-lg"></i> Tambah User</button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no=1;
                $query = mysqli_query($conn, "SELECT * FROM users");
                while($row = mysqli_fetch_assoc($query)):
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_lengkap']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><span class="badge bg-secondary"><?= $row['role']; ?></span></td>
                    <td>
                        <a href="?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus user ini?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama" class="form-control" required></div>
                    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" required></div>
                    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                    <div class="mb-3"><label>Role</label>
                        <select name="role" class="form-select">
                            <option value="admin">Admin</option>
                            <option value="guru">Guru</option>
                            <option value="siswa">Siswa</option>
                        </select>
                    </div>
                    <button type="submit" name="tambah" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'layout_footer.php'; ?>