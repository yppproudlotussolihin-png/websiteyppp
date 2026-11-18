<?php
// File: konfirmasi.php
require_once 'config/database.php';

$pesan = '';
$tipe_pesan = '';

// Menangkap nomor transaksi jika dikirim dari URL invoice
$default_trx = isset($_GET['trx']) ? htmlspecialchars($_GET['trx']) : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = trim($_POST['transaction_id']);
    $nama_pengirim = htmlspecialchars($_POST['nama_pengirim']);
    $bank_tujuan = htmlspecialchars($_POST['bank_tujuan']);
    $nominal = filter_var($_POST['nominal'], FILTER_SANITIZE_NUMBER_FLOAT);

    // Cek apakah nomor transaksi valid
    $stmt = $pdo->prepare("SELECT id, status_pembayaran FROM donasi WHERE transaction_id = :trx LIMIT 1");
    $stmt->execute([':trx' => $transaction_id]);
    $donasi = $stmt->fetch();

    if ($donasi) {
        if ($donasi['status_pembayaran'] == 'success') {
            $pesan = "Transaksi dengan ID tersebut sudah terverifikasi lunas sebelumnya.";
            $tipe_pesan = "warning";
        } else {
            // Handle Upload Bukti Transfer oleh Donatur
            $namaFileBukti = '';
            if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] === UPLOAD_ERR_OK) {
                $ekstensiValid = ['jpg', 'jpeg', 'png', 'webp'];
                $namaFileAsli = $_FILES['bukti_transfer']['name'];
                $ukuranFile = $_FILES['bukti_transfer']['size'];
                $tmpName = $_FILES['bukti_transfer']['tmp_name'];
                
                $ekstensi = strtolower(pathinfo($namaFileAsli, PATHINFO_EXTENSION));
                
                if (in_array($ekstensi, $ekstensiValid) && $ukuranFile <= 2000000) { // Max 2MB
                    $namaFileBukti = 'bukti_' . time() . '_' . rand(100,999) . '.' . $ekstensi;
                    if (!is_dir('assets/uploads/')) {
                        mkdir('assets/uploads/', 0777, true);
                    }
                    move_uploaded_file($tmpName, 'assets/uploads/' . $namaFileBukti);
                }
            }

            // Simpan nama file bukti transfer ke database (status tetap pending agar dicek amil)
            if (!empty($namaFileBukti)) {
                $updateBukti = $pdo->prepare("UPDATE donasi SET bukti_transfer = :bukti WHERE transaction_id = :trx");
                $updateBukti->execute([':bukti' => $namaFileBukti, ':trx' => $transaction_id]);
            }

            $pesan = "Alhamdulillah! Konfirmasi dan bukti transfer berhasil dikirim. Tim Amil kami akan segera melakukan verifikasi mutasi dalam 1x24 jam.";
            $tipe_pesan = "success";
        }
    } else {
        $pesan = "Nomor Transaksi tidak ditemukan. Periksa kembali format ID transaksi Anda.";
        $tipe_pesan = "error";
    }
}

require_once 'includes/header.php';
?>

<!-- Header Konfirmasi -->
<section class="bg-lzGreen py-16 text-center text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif font-bold mb-4">Konfirmasi Pembayaran Donasi</h1>
        <p class="text-emerald-100 text-lg">Kirimkan bukti transfer Anda agar amil dapat memvalidasi mutasi dengan cepat.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-10 border border-gray-100">
            
            <?php if($pesan): ?>
                <div class="mb-6 p-4 rounded-xl text-sm font-medium text-center <?php 
                    if($tipe_pesan == 'success') echo 'bg-emerald-100 text-lzGreen';
                    elseif($tipe_pesan == 'warning') echo 'bg-yellow-100 text-yellow-800';
                    else echo 'bg-red-100 text-red-700';
                ?>">
                    <?php echo $pesan; ?>
                    <div class="mt-4">
                        <a href="index.php" class="inline-block bg-lzGreen text-white px-6 py-2 rounded-lg font-bold text-xs uppercase">Kembali ke Beranda</a>
                    </div>
                </div>
            <?php endif; ?>

            <form action="konfirmasi.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nomor Transaksi *</label>
                    <input type="text" name="transaction_id" value="<?php echo $default_trx; ?>" required placeholder="Cth: LZK-20260901-1234" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                    <p class="text-xs text-gray-400 mt-1">Nomor transaksi terisi otomatis dari invoice Anda.</p>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nama Pemilik Rekening / Pengirim *</label>
                    <input type="text" name="nama_pengirim" required placeholder="Nama sesuai rekening bank Anda" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tujuan Transfer *</label>
                    <select name="bank_tujuan" required class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                        <option value="BCA">Bank BCA - LAINZAKKAINA</option>
                        <option value="BSI">Bank BSI - LAINZAKKAINA</option>
                        <option value="QRIS">QRIS Nasional</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nominal Transfer (Rp) *</label>
                    <input type="number" name="nominal" required placeholder="Cth: 100000" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Upload Foto Bukti Transfer (Max 2MB) *</label>
                    <input type="file" name="bukti_transfer" accept="image/*" required class="w-full border border-gray-300 rounded-xl px-3 py-2 bg-gray-50 text-sm">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG, atau WEBP.</p>
                </div>

                <button type="submit" class="w-full bg-lzGold hover:bg-yellow-500 text-lzGreen font-bold text-lg py-4 rounded-xl shadow-md transition">
                    Kirim Konfirmasi & Bukti
                </button>
            </form>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>