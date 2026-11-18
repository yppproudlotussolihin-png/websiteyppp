<?php
// form.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config.php';
$isSuccess = false;
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fungsi untuk handle upload file
    function uploadFile($fileInputName) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == 0) {
            $allowedExts = ['jpg', 'jpeg', 'png', 'pdf'];$fileName = $_FILES[$fileInputName]['name'];
            $fileSize =$_FILES[$fileInputName]['size'];$fileTmp = $_FILES[$fileInputName]['tmp_name'];
            
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            if (in_array($fileExt, $allowedExts) &&$fileSize <= 5242880) { // 5MB limit
                $newName = time() . '_' . uniqid() . '.' . $fileExt;
                $dest = 'uploads/' .$newName;
                if (move_uploaded_file($fileTmp,$dest)) {
                    return $newName;
                }
            }
        }
        return null;
    }

    $nama =$_POST['nama'];
    $email =$_POST['email'];
    $wa =$_POST['wa'];
    $tahun =$_POST['tahun'];
    $lembaga =$_POST['lembaga'];
    $domisili =$_POST['domisili'];
    $pekerjaan =$_POST['pekerjaan'];
    $kesan =$_POST['kesan'];
    $perjalanan =$_POST['perjalanan'];
    $tantangan =$_POST['tantangan'];
    $prestasi =$_POST['prestasi'];
    $pelajaran =$_POST['pelajaran'];
    $pesan =$_POST['pesan'];
    $punya_karya =$_POST['punya_karya'];
    $judul_karya =$_POST['judul_karya'] ?? '';
    $jenis_karya =$_POST['jenis_karya'] ?? '';
    $deskripsi_karya =$_POST['deskripsi_karya'] ?? '';
    $link_karya =$_POST['link_karya'] ?? '';
    $sosmed =$_POST['sosmed'] ?? '';

    // Proses Upload
    $foto_diri = uploadFile('foto_diri');
    $foto_aktivitas = uploadFile('foto_aktivitas');$file_karya = uploadFile('file_karya');

    // Insert ke Database menggunakan Prepared Statement
    $stmt =$conn->prepare("INSERT INTO `iktsaro-alumni-tb` (nama_lengkap, email, no_wa, tahun_lulus, lembaga, domisili, pekerjaan, kesan, perjalanan, tantangan, prestasi, pelajaran, pesan, punya_karya, judul_karya, jenis_karya, deskripsi_karya, link_karya, file_karya, foto_diri, foto_aktivitas, sosmed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssssssssssssssssss", $nama,$email, $wa,$tahun, $lembaga,$domisili, $pekerjaan,$kesan, $perjalanan,$tantangan, $prestasi,$pelajaran, $pesan,$punya_karya, $judul_karya,$jenis_karya, $deskripsi_karya,$link_karya, $file_karya,$foto_diri, $foto_aktivitas,$sosmed);
    
    if ($stmt->execute()) {$isSuccess = true;
    } else {
        $errorMessage = "Terjadi kesalahan sistem: " . $conn->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Kisah Inspiratif & Karya Alumni YPPP Roudlotussolihin</title>
    <link rel="icon"
          type="image/png"
          href="../../../assets/images/ypp.png">
    <!-- Menggunakan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pesantren: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                        }
                    },
                    animation: {
                        'pop-in': 'popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards',
                        'draw-check': 'drawCheck 0.6s ease-out forwards 0.3s',
                    },
                    keyframes: {
                        popIn: {
                            '0%': { opacity: '0', transform: 'scale(0.8)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                        drawCheck: {
                            '0%': { strokeDasharray: '50', strokeDashoffset: '50' },
                            '100%': { strokeDasharray: '50', strokeDashoffset: '0' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <!-- Modal Popup Success -->
    <?php if ($isSuccess): ?>
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full overflow-hidden animate-pop-in relative">
            
            <!-- Icon Checkmark Beranimasi -->
            <div class="bg-pesantren-50 pt-8 pb-6 flex justify-center">
                <div class="h-20 w-20 bg-pesantren-500 rounded-full flex items-center justify-center shadow-lg shadow-pesantren-200">
                    <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" class="animate-draw-check" style="stroke-dasharray: 50; stroke-dashoffset: 50;" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <div class="px-8 pb-8 pt-4">
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">Alhamdulillah, Berhasil!</h3>
                <p class="text-gray-600 text-center text-sm leading-relaxed mb-6">
                    Terima kasih atas partisipasinya. Data Anda telah kami terima dan akan <strong>dicek validasinya</strong> oleh tim berwenang.
                </p>

                <!-- Box Ajakan WhatsApp -->
                <div class="bg-green-50 border border-green-100 rounded-2xl p-5 mb-6 shadow-inner">
                    <p class="text-sm text-green-800 text-center mb-4 leading-relaxed font-medium">
                        Kisah inspiratif yang telah di-<em>approve</em> akan dipublikasikan dan diposting di <strong>Saluran WhatsApp Resmi</strong> kami. <br><br>
                        Yuk, gabung sekarang agar tidak ketinggalan update dan cerita inspiratif dari alumni lainnya!
                    </p>
                    <a href="https://whatsapp.com/channel/0029VbB3JTW42Dclboyyfl2L" target="_blank" class="flex items-center justify-center w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                        </svg>
                        Ikuti Saluran WhatsApp
                    </a>
                </div>

                <!-- Tombol Tutup -->
                <button onclick="document.getElementById('successModal').style.display='none'" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 px-4 rounded-xl transition-colors">
                    Tutup & Kembali
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="bg-white rounded-t-xl border-t-8 border-pesantren-600 shadow-md p-8 mb-6">
            <h1 class="text-3xl font-bold text-pesantren-800 mb-4">Kisah Inspiratif & Karya Alumni YPPP Roudlotussolihin</h1>
            <p class="text-gray-700 leading-relaxed">
                Assalamu'alaikum warahmatullahi wabarakatuh.<br><br>
                Formulir ini digunakan untuk menghimpun data alumni, kesan, kisah inspiratif, prestasi, dan karya dari alumni <strong>Yayasan Pendidikan Pondok Pesantren Roudlotussolihin</strong>. Kisah yang terpilih akan dipublikasikan melalui website dan media sosial IKTSARO sebagai inspirasi bagi para santri dan alumni lainnya.
            </p>
            <p class="text-sm text-red-600 mt-4">* Wajib diisi</p>
        </div>

        <!-- Menampilkan Pesan Gagal (Hanya jika terjadi error sistem) -->
        <?php if ($errorMessage): ?>
            <div class='p-5 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-xl font-medium shadow-sm'>
                <?= $errorMessage ?>
            </div>
        <?php endif; ?>

        <!-- Form mulai di sini -->
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">

            <!-- Bagian 1: Identitas Alumni -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-xl font-bold text-pesantren-700 border-b pb-2 mb-6">Bagian 1 — Identitas Alumni</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Aktif <span class="text-red-500">*</span></label>
                        <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500" placeholder="contoh@gmail.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <input type="tel" name="wa" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500" placeholder="08xx-xxxx-xxxx">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus <span class="text-red-500">*</span></label>
                        <select name="tahun" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500">
                            <option value="">Pilih Tahun Lulus...</option>
                            <script>
                                const currentYear = new Date().getFullYear();
                                for (let i = currentYear; i >= 1990; i--) {
                                    document.write(`<option value="${i}">${i}</option>`);
                                }
                            </script>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lembaga Terakhir di Yayasan <span class="text-red-500">*</span></label>
                        <select name="lembaga" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500">
                            <option value="">Pilih Lembaga...</option>
                            <option value="RA">RA Al-Qu'an Roudlotussolihin</option>
                            <option value="MI">MI Ma'arif Bumirestu</option>
                            <option value="MTs">MTs Ma'arif Bumirestu</option>
                            <option value="SMA">SMA Ma'arif Bumirestu</option>
                            <option value="MUS">MUS Roudlotussolihin</option>
                            <option value="MUST">MUS Roudlotussolihin Tahfidz</option>
                            <option value="MUS RM">MUS Roudlotul Muttaqin</option>
                        </select>
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Domisili Saat Ini <span class="text-red-500">*</span></label>
                        <input type="text" name="domisili" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500" placeholder="Kota/Kabupaten, Provinsi">
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan / Profesi Saat Ini <span class="text-red-500">*</span></label>
                        <input type="text" name="pekerjaan" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500">
                    </div>
                </div>
            </div>

            <!-- Bagian 2: Kisah & Kesan Inspiratif -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-xl font-bold text-pesantren-700 border-b pb-2 mb-6">Bagian 2 — Kisah & Kesan Inspiratif</h2>
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kesan selama menimba ilmu di Roudlotussolihin <span class="text-red-500">*</span></label>
                        <textarea name="kesan" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ceritakan perjalanan Anda setelah lulus dari Roudlotussolihin <span class="text-red-500">*</span></label>
                        <textarea name="perjalanan" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tantangan terbesar yang pernah Anda hadapi dan cara mengatasinya <span class="text-red-500">*</span></label>
                        <textarea name="tantangan" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prestasi atau pencapaian yang paling Anda banggakan <span class="text-red-500">*</span></label>
                        <textarea name="prestasi" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nilai atau pelajaran dari pesantren yang paling berpengaruh dalam hidup Anda <span class="text-red-500">*</span></label>
                        <textarea name="pelajaran" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pesan dan motivasi untuk adik-adik santri <span class="text-red-500">*</span></label>
                        <textarea name="pesan" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500"></textarea>
                    </div>
                </div>
            </div>

            <!-- Bagian 3: Karya Alumni -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-xl font-bold text-pesantren-700 border-b pb-2 mb-6">Bagian 3 — Karya Alumni</h2>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Apakah Anda memiliki karya yang ingin ditampilkan? <span class="text-red-500">*</span></label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="punya_karya" value="ya" onchange="toggleKaryaForm(true)" required class="text-pesantren-600 focus:ring-pesantren-500">
                            <span class="ml-2">Ya</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="punya_karya" value="tidak" onchange="toggleKaryaForm(false)" class="text-pesantren-600 focus:ring-pesantren-500">
                            <span class="ml-2">Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- Formulir Karya (Tersembunyi secara default) -->
                <div id="karya-section" class="hidden space-y-5 bg-pesantren-50 p-6 rounded-lg border border-pesantren-100">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Karya <span class="text-red-500">*</span></label>
                        <input type="text" name="judul_karya" id="judul_karya" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Karya <span class="text-red-500">*</span></label>
                        <select name="jenis_karya" id="jenis_karya" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500">
                            <option value="">Pilih Jenis Karya...</option>
                            <option value="Buku">Buku</option>
                            <option value="Jurnal / Penelitian">Jurnal / Penelitian</option>
                            <option value="Artikel">Artikel</option>
                            <option value="Usaha / Produk UMKM">Usaha / Produk UMKM</option>
                            <option value="Aplikasi / Website">Aplikasi / Website</option>
                            <option value="Desain Grafis">Desain Grafis</option>
                            <option value="Fotografi / Videografi">Fotografi / Videografi</option>
                            <option value="Karya Seni">Karya Seni</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat Karya <span class="text-red-500">*</span></label>
                        <p class="text-xs text-gray-500 mb-2">Jelaskan tujuan, manfaat, atau cerita di balik karya tersebut.</p>
                        <textarea name="deskripsi_karya" id="deskripsi_karya" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Link Karya (Opsional)</label>
                        <p class="text-xs text-gray-500 mb-2">Google Drive, YouTube, Website, Instagram, atau Marketplace.</p>
                        <input type="url" name="link_karya" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500" placeholder="https://...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto atau Dokumen Karya (Max 5MB)</label>
                        <input type="file" name="file_karya" accept="image/*,.pdf" onchange="validateFileSize(this)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pesantren-50 file:text-pesantren-700 hover:file:bg-pesantren-100 cursor-pointer border border-gray-300 rounded-md">
                    </div>
                </div>
            </div>

            <!-- Bagian 4: Dokumentasi -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-xl font-bold text-pesantren-700 border-b pb-2 mb-6">Bagian 4 — Dokumentasi</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Diri Terbaik (Max 5MB) <span class="text-red-500">*</span></label>
                        <input type="file" name="foto_diri" required accept="image/*" onchange="validateFileSize(this)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pesantren-50 file:text-pesantren-700 hover:file:bg-pesantren-100 cursor-pointer border border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Aktivitas (kuliah, bekerja, usaha, mengajar, dll. - Max 5MB) <span class="text-red-500">*</span></label>
                        <input type="file" name="foto_aktivitas" required accept="image/*" onchange="validateFileSize(this)" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pesantren-50 file:text-pesantren-700 hover:file:bg-pesantren-100 cursor-pointer border border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Akun Instagram / LinkedIn (Opsional)</label>
                        <input type="text" name="sosmed" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pesantren-500 focus:border-pesantren-500" placeholder="@username / link linkedin">
                    </div>
                </div>
            </div>

            <!-- Bagian 5: Persetujuan -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-xl font-bold text-pesantren-700 border-b pb-2 mb-6">Bagian 5 — Persetujuan</h2>
                
                <label class="flex items-start space-x-3 cursor-pointer">
                    <input type="checkbox" required class="mt-1 h-5 w-5 text-pesantren-600 rounded focus:ring-pesantren-500">
                    <span class="text-sm text-gray-700 leading-relaxed">
                        Saya menyatakan bahwa data, cerita, foto, dan karya yang saya kirim adalah milik saya atau saya memiliki izin untuk membagikannya. Saya bersedia materi tersebut dipublikasikan oleh IKTSARO, Media Roudlotussolihin, dan Yayasan Pendidikan Pondok Pesantren Roudlotussolihin. <span class="text-red-500">*</span>
                    </span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-pesantren-600 hover:bg-pesantren-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                    Kirim Formulir
                </button>
            </div>

        </form>
    </div>

    <!-- JavaScript Validasi dan Logika -->
    <script>
        // Logika untuk menampilkan/menyembunyikan Bagian 3 (Karya)
        function toggleKaryaForm(show) {
            const karyaSection = document.getElementById('karya-section');
            const judul = document.getElementById('judul_karya');
            const jenis = document.getElementById('jenis_karya');
            const deskripsi = document.getElementById('deskripsi_karya');

            if (show) {
                karyaSection.classList.remove('hidden');
                judul.required = true;
                jenis.required = true;
                deskripsi.required = true;
            } else {
                karyaSection.classList.add('hidden');
                judul.required = false;
                jenis.required = false;
                deskripsi.required = false;
            }
        }

        // Validasi ukuran maksimal file (5MB)
        function validateFileSize(input) {
            const maxMB = 5;
            const maxBytes = maxMB * 1024 * 1024;
            
            if (input.files && input.files.length > 0) {
                const fileSize = input.files[0].size;
                
                if (fileSize > maxBytes) {
                    alert(`Maaf, ukuran file tidak boleh lebih dari ${maxMB}MB. File Anda berukuran ${(fileSize / (1024 * 1024)).toFixed(2)}MB.`);
                    input.value = ''; // Reset input agar pengguna tidak bisa submit file kebesaran
                }
            }
        }
    </script>
</body>
</html>