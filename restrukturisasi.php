<?php
// KONFIGURASI
 $base_dir = __DIR__; // Folder elearning

echo "<h1>🤖 Memulai Restrukturisasi Otomatis...</h1>";
echo "<pre>";

// 1. Buat Folder
 $folders = ['includes', 'guru', 'siswa', 'admin'];
foreach ($folders as $f) {
    $path = "$base_dir/$f";
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
        echo "✅ Folder '$f' dibuat.<br>";
    } else {
        echo "ℹ️ Folder '$f' sudah ada.<br>";
    }
}

// 2. Pindahkan File & Rename
// Format: [File Lama] => [Folder Tujuan]/[File Baru]
 $files_to_move = [
    // Core
    'koneksi.php'        => 'includes/koneksi.php',
    'layout.php'         => 'includes/layout.php',
    'layout_footer.php'  => 'includes/layout_footer.php',
    
    // Guru
    'guru_absensi.php'      => 'guru/absensi.php',
    'guru_tambah_materi.php'=> 'guru/tambah_materi.php',
    'guru_tambah_kuis.php'  => 'guru/tambah_kuis.php',
    'guru_lihat_nilai.php'  => 'guru/lihat_nilai.php',
    
    // Siswa
    'siswa_materi.php'      => 'siswa/materi.php',
    'siswa_kuis.php'        => 'siswa/kuis.php',
    'rekap_nilai.php'       => 'siswa/rekap_nilai.php',
    'riwayat_absensi.php'   => 'siswa/riwayat_absensi.php',
    'forum_diskusi.php'     => 'siswa/forum_diskusi.php',
    
    // Admin
    'manajemen_user.php'    => 'admin/manajemen_user.php',
];

foreach ($files_to_move as $old => $new) {
    $src = "$base_dir/$old";
    $dst = "$base_dir/$new";
    
    if (file_exists($src)) {
        if (rename($src, $dst)) {
            echo "✅ Pindah: $old -> $new<br>";
        } else {
            echo "❌ Gagal pindah: $old<br>";
        }
    } else {
        echo "⚠️ File tidak ditemukan (mungkin sudah dipindah): $old<br>";
    }
}

echo "<hr>";
echo "✨ SELESAI MEMINDAHKAN FILE!<br>";
echo "🛠️  SEKARANG MEMPERBAIKI KODE (LINK & INCLUDE)...<br>";

// 3. Perbaiki Kode (Include Path & Links)
 $fixes = [
    // File Root
    'index.php'  => [
        "include 'koneksi.php'" => "include 'includes/koneksi.php';",
        "include 'layout.php'"  => "include 'includes/layout.php';",
        "href='guru_absensi.php'"      => "href='guru/absensi.php'",
        "href='guru_tambah_materi.php'"=> "href='guru/tambah_materi.php'",
        "href='guru_tambah_kuis.php'"  => "href='guru/tambah_kuis.php'",
        "href='guru_lihat_nilai.php'"  => "href='guru/lihat_nilai.php'",
        "href='siswa_materi.php'"      => "href='siswa/materi.php'",
        "href='siswa_kuis.php'"        => "href='siswa/kuis.php'",
        "href='rekap_nilai.php'"       => "href='siswa/rekap_nilai.php'",
        "href='riwayat_absensi.php'"   => "href='siswa/riwayat_absensi.php'",
        "href='forum_diskusi.php'"     => "href='siswa/forum_diskusi.php'",
        "href='manajemen_user.php'"    => "href='admin/manajemen_user.php'",
    ],
    'profil.php' => [
        "include 'koneksi.php'" => "include 'includes/koneksi.php';",
        "include 'layout.php'"  => "include 'includes/layout.php';",
        "src='uploads/" => "src='../uploads/", // Perbaiki path foto karena layout dipindah
        "<img src=\"uploads/" => "<img src=\"../uploads/",
    ],
    
    // File Guru
    'guru/absensi.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],
    'guru/tambah_materi.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],
    'guru/tambah_kuis.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],
    'guru/lihat_nilai.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],

    // File Siswa
    'siswa/materi.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],
    'siswa/kuis.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],
    'siswa/rekap_nilai.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],
    'siswa/riwayat_absensi.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],
    'siswa/forum_diskusi.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],

    // File Admin
    'admin/manajemen_user.php' => [
        "include 'koneksi.php'" => "include '../includes/koneksi.php';",
        "include 'layout.php'"  => "include '../includes/layout.php';",
        "src='uploads/" => "src='../uploads/",
    ],
];

// Eksekusi Perbaikan Kode
foreach ($fixes as $file => $replacements) {
    $filepath = "$base_dir/$file";
    
    if (file_exists($filepath)) {
        $content = file_get_contents($filepath);
        $original = $content;
        
        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }
        
        // Tambahkan ../ ke path foto di layout.php jika belum ada (Khusus layout)
        if($file == 'includes/layout.php'){
             // Kode script khusus untuk layout sudah diperbaiki di langkah manual sebelumnya
             // Script ini fokus ke file konten
        }

        if ($content !== $original) {
            file_put_contents($filepath, $content);
            echo "🔧 Perbaiki Kode: $file<br>";
        }
    } else {
        echo "⚠️ File kode tidak ditemukan: $file (mungkin belum dipindah script ini)<br>";
    }
}

// 4. Khusus Perbaikan layout.php (Path Foto)
 $layout_path = "$base_dir/includes/layout.php";
if (file_exists($layout_path)) {
    $l_content = file_get_contents($layout_path);
    
    // Ganti src uploads menjadi ../uploads
    $l_content = str_replace("src='uploads/", "src='../uploads/", $l_content);
    $l_content = str_replace("src=\"uploads/", "src=\"../uploads/", $l_content);
    
    // Perbaiki link logout/profil di layout
    $l_content = str_replace("href='profil.php'", "href='../profil.php'", $l_content);
    $l_content = str_replace("href='logout.php'", "href='../logout.php'", $l_content);
    $l_content = str_replace("href='dashboard.php'", "href='../dashboard.php'", $l_content); // Asumsi dashboard ada di root atau redirect
    
    file_put_contents($layout_path, $l_content);
    echo "🔧 Perbaiki Kode: includes/layout.php (Path Foto & Link)<br>";
}

echo "</pre>";
echo "<h2>🎉 SEMUA SELESAI! Coba buka website kamu.</h2>";
?>