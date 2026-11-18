<?php
// File: invoice.php
require_once 'config/database.php';

if (!isset($_GET['trx'])) {
    header("Location: cetak-kwitansi.php");
    exit;
}

$trx_id = $_GET['trx'];

// Tarik data transaksi berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM donasi WHERE transaction_id = :trx_id LIMIT 1");
$stmt->execute([':trx_id' => $trx_id]);
$donasi = $stmt->fetch();

if (!$donasi) {
    die("Transaksi tidak ditemukan.");
}

require_once 'includes/header.php';
?>


<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-emerald-100 text-lzEmerald rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Alhamdulillah, Permintaan Tercatat!</h2>
                <p class="text-gray-500 mt-2">Selesaikan pembayaran Anda agar donasi segera disalurkan.</p>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-500">Nomor Transaksi</span>
                    <span class="font-bold text-gray-800"><?php echo htmlspecialchars($donasi['transaction_id']); ?></span>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-500">Metode Pembayaran</span>
                    <span class="font-bold text-gray-800"><?php echo htmlspecialchars($donasi['metode_pembayaran']); ?></span>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-500">Status</span>
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Menunggu Pembayaran</span>
                </div>
                <hr class="border-gray-200 my-4">
                <div class="flex justify-between items-center text-lg">
                    <span class="font-bold text-gray-700">Total Tagihan</span>
                    <span class="font-bold text-lzGreen text-2xl">Rp <?php echo number_format($donasi['nominal'], 0, ',', '.'); ?></span>
                </div>
            </div>

            <div class="text-center space-y-4">
                <p class="text-sm text-gray-500">Silakan lakukan transfer ke rekening berikut:</p>
                <div class="border-2 border-dashed border-lzEmerald rounded-lg p-4 bg-emerald-50 text-lzGreen font-bold text-xl">
                    <?php 
                        if($donasi['metode_pembayaran'] == 'BCA') echo "BCA - 123456789 a/n LAINZAKKAINA";
                        elseif($donasi['metode_pembayaran'] == 'BSI') echo "BSI - 987654321 a/n LAINZAKKAINA";
                        else echo "Scan QRIS LAINZAKKAINA pada aplikasi Anda.";
                    ?>
                </div>
                
                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                    <!-- Tombol Konfirmasi Mandiri ke Website (Membawa parameter TRX otomatis) -->
                    <a href="konfirmasi.php?trx=<?php echo urlencode($trx_id); ?>" class="bg-lzGreen hover:bg-emerald-800 text-white font-bold px-6 py-3 rounded-xl transition shadow text-center">
                        Konfirmasi pembayaran Mandiri (Upload Bukti)
                    </a>

                    <!-- Tombol Konfirmasi via WhatsApp (Memperbaiki variabel $trx_id) -->
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20LAINZAKKAINA,%20saya%20ingin%20mengkonfirmasi%20donasi%20dengan%20ID%20Transaksi:%20<?php echo urlencode($trx_id); ?>" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-3 rounded-xl transition shadow text-center flex items-center justify-center gap-2">
                        Konfirmasi pembayaran via WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>