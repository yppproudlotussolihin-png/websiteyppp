<?php
// File: donasi.php
require_once 'config/database.php';

// Ambil ID program dari URL jika ada (cth: donasi.php?program=1)
$selected_program_id = isset($_GET['program']) ? $_GET['program'] : '';

// Ambil daftar program aktif untuk dropdown
$stmt = $pdo->query("SELECT id, judul FROM program WHERE status = 'aktif' ORDER BY id DESC");
$programs = $stmt->fetchAll();

require_once 'includes/header.php';
?>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-lzGreen px-8 py-6 text-white text-center">
                <h2 class="text-2xl font-serif font-bold">Formulir Donasi Online</h2>
                <p class="text-emerald-100 mt-1">Lengkapi data di bawah ini untuk menunaikan kebaikan Anda.</p>
            </div>

            <form action="proses-donasi.php" method="POST" class="p-8 space-y-6">
                <!-- Pilihan Program & Nominal -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Jenis Dana *</label>
                        <select name="jenis_dana" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                            <option value="infak">Infak</option>
                            <option value="sedekah">Sedekah</option>
                            <option value="zakat">Zakat</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Pilih Program (Opsional)</label>
                        <select name="program_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                            <option value="">-- Donasi Umum / Tidak Pilih Program --</option>
                            <?php foreach($programs as $p): ?>
                                <option value="<?php echo $p['id']; ?>" <?php echo ($selected_program_id == $p['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($p['judul']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nominal Donasi (Rp) *</label>
                        <input type="number" name="nominal" required min="10000" placeholder="Minimal Rp 10.000" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                    </div>
                </div>

                <hr class="border-gray-200">

                <!-- Data Donatur -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-800">Data Donatur</h3>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap *</label>
                        <input type="text" name="nama_donatur" required placeholder="Nama Anda" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nomor WhatsApp *</label>
                            <input type="text" name="whatsapp" required placeholder="0812xxx" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Email (Opsional)</label>
                            <input type="email" name="email" placeholder="email@anda.com" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                        </div>
                    </div>

                    <div class="flex items-center mt-2">
                        <input type="checkbox" name="is_anonim" id="anonim" value="1" class="w-5 h-5 text-lzEmerald border-gray-300 rounded focus:ring-lzEmerald">
                        <label for="anonim" class="ml-2 text-gray-600">Sembunyikan nama saya (Hamba Allah)</label>
                    </div>
                </div>

                <hr class="border-gray-200">

                <!-- Metode Pembayaran -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Metode Pembayaran *</label>
                    <select name="metode_pembayaran" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald">
                        <option value="BCA">Transfer Bank BCA - 123456789</option>
                        <option value="BSI">Transfer Bank BSI - 987654321</option>
                        <option value="QRIS">QRIS (GoPay, OVO, Dana, ShopeePay)</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-lzGold hover:bg-yellow-500 text-lzGreen font-bold text-lg py-4 rounded-lg shadow-md transition">
                    Lanjutkan Pembayaran
                </button>
            </form>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>