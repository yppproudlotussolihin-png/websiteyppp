const hamburger = document.querySelector(".hamburger");
const menu = document.querySelector(".menu");

/* =========================
   HAMBURGER MENU
========================= */

hamburger.addEventListener("click", () => {

    hamburger.classList.toggle("active");
    menu.classList.toggle("active");

});

/* =========================
   DROPDOWN MOBILE
========================= */

document.querySelectorAll(".dropdown > a").forEach(item => {

    item.addEventListener("click", function(e){

        if(window.innerWidth <= 992){

            e.preventDefault();

            this.parentElement.classList.toggle("active");

        }

    });

});

document.querySelectorAll(".dropdown-sub > a").forEach(item => {

    item.addEventListener("click", function(e){

        if(window.innerWidth <= 992){

            e.preventDefault();

            this.parentElement.classList.toggle("active");

        }

    });

});



// Menghilangkan loader saat halaman selesai dimuat
window.addEventListener("load", () => {
    const loader = document.getElementById("loader");
    
    // Memberikan jeda 1 detik sebelum loader menghilang
    setTimeout(() => {
        loader.style.opacity = "0";
        loader.style.visibility = "hidden";
    }, 1000);
});



/* ==========================
   AOS ANIMATION
========================== */

AOS.init({
    duration:1000,
    once:true
});







/* KETERANGAN PENTING: 
   'DOMContentLoaded' berfungsi agar sistem memastikan seluruh kode HTML 
   selesai dimuat (loading) terlebih dahulu sebelum script dijalankan. 
*/
document.addEventListener("DOMContentLoaded", function () {

    /* =====================================
       1. LOGIKA MUKIM / TIDAK MUKIM
       Fungsi: Mengunci atau membuka pilihan "Unit Pesantren". 
    ===================================== */
    const mukimSelect = document.getElementById("mukim");
    const unitSelect = document.getElementById("unit_pesantren");
    const unitRequired = document.getElementById("unit_required");

    function updateMukimLogic() {
        if (!mukimSelect || !unitSelect) return;

        if (mukimSelect.value === "Mukim") {
            unitSelect.disabled = false;
            unitSelect.setAttribute("required", "required");
            if (unitRequired) unitRequired.style.display = "inline";
        } else {
            unitSelect.disabled = true;
            unitSelect.value = "";
            unitSelect.removeAttribute("required");
            if (unitRequired) unitRequired.style.display = "none";
        }
    }

    if (mukimSelect) {
        mukimSelect.addEventListener("change", updateMukimLogic);
        updateMukimLogic();
    }

    /* =====================================
       2. LOGIKA STATUS AYAH & IBU 
       Fungsi: Menampilkan/menyembunyikan detail data orang tua
    ===================================== */
    function setupParentStatus(statusSelectId, fieldsContainerId) {
        const statusSelect = document.getElementById(statusSelectId);
        const fieldsContainer = document.getElementById(fieldsContainerId);

        if (!statusSelect || !fieldsContainer) return;

        const inputs = fieldsContainer.querySelectorAll("input, select");

        function updateParentLogic() {
            if (statusSelect.value === "Hidup") {
                fieldsContainer.style.display = "grid";
                inputs.forEach(input => {
                    input.disabled = false;
                    input.setAttribute("required", "required");
                });
            } else {
                fieldsContainer.style.display = "none";
                inputs.forEach(input => {
                    input.disabled = true;
                    input.removeAttribute("required");
                    input.value = "";
                });
            }
        }

        statusSelect.addEventListener("change", updateParentLogic);
        updateParentLogic();
    }

    setupParentStatus("status_ayah", "ayah_fields");
    setupParentStatus("status_ibu", "ibu_fields");

    /* =====================================
       3. FORMAT TANGGAL OTOMATIS (DD/MM/YYYY)
    ===================================== */
    function formatDateInput(id) {
        const input = document.getElementById(id);
        if (!input) return;

        input.addEventListener("input", function () {
            let value = this.value.replace(/\D/g, ""); 
            
            if (value.length > 2) value = value.slice(0, 2) + "/" + value.slice(2);
            if (value.length > 5) value = value.slice(0, 5) + "/" + value.slice(5);
            if (value.length > 10) value = value.slice(0, 10);
            
            this.value = value;
        });
    }

    formatDateInput("tanggal_lahir");
    formatDateInput("tanggal_lahir_ayah");
    formatDateInput("tanggal_lahir_ibu");

    /* =====================================
       4. VALIDASI HANYA ANGKA (Numeric Only)
       KETERANGAN: Kolom jumlah_saudara, anak_ke, tinggi_badan, dan berat_badan 
       dimasukkan ke sini agar user tidak bisa menginput huruf.
    ===================================== */
    function numericOnly(id) {
        const input = document.getElementById(id);
        if (!input) return;

        input.addEventListener("input", function () {
            this.value = this.value.replace(/\D/g, "");
        });
    }

    const numericFields = [
        "nik", "nisn", "nik_ayah", "nik_ibu", "nomor_kk", "kode_pos", "nomor_hp", "rt_rw",
        "jumlah_saudara", "anak_ke", "tinggi_badan", "berat_badan"
    ];
    numericFields.forEach(id => numericOnly(id));

    /* =====================================
       5. FUNGSI TOAST NOTIFICATION
    ===================================== */
    // Fungsi untuk memunculkan Modal Animasi
    // Fungsi memunculkan Modal Animasi
    function showModal(message, type) {
        const modal = document.getElementById('statusModal');
        const modalBox = document.getElementById('modalBox');
        const iconContainer = document.getElementById('modalIconContainer');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');

        iconContainer.innerHTML = '';

        if (type === 'success') {
        modalTitle.textContent = "Pendaftaran Berhasil!";
        modalTitle.className = "text-2xl font-bold mt-4 mb-2 text-emerald-600";
        // SVG Animasi Centang Hijau (Warna langsung ditanam di sini)
        iconContainer.innerHTML = `
            <svg class="animate-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="circle" cx="26" cy="26" r="25" fill="none" stroke="#10B981"/>
              <path class="check" fill="none" stroke="#10B981" d="M14 27l7 7 16-16"/>
            </svg>
        `;
        } else {
            modalTitle.textContent = "Pendaftaran Gagal!";
            modalTitle.className = "text-2xl font-bold mt-4 mb-2 text-red-600";
            // SVG Animasi Silang Merah (Warna langsung ditanam di sini)
            iconContainer.innerHTML = `
                <svg class="animate-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="circle" cx="26" cy="26" r="25" fill="none" stroke="#EF4444"/>
                <path class="cross" fill="none" stroke="#EF4444" d="M16 16 36 36 M36 16 16 36"/>
                </svg>
            `;
        }
        modalMessage.textContent = message;

        // Hapus class yang menyembunyikan, lalu tambahkan class yang memunculkan (Tailwind)
        modal.classList.remove('opacity-0', 'invisible');
        modal.classList.add('opacity-100', 'visible');
        
        // Animasi efek memantul
        modalBox.classList.remove('scale-75', 'translate-y-8');
        modalBox.classList.add('scale-100', 'translate-y-0');
    }

    // Tombol Tutup Modal (menyembunyikan kembali)
    document.getElementById('closeModalBtn').addEventListener('click', function() {
        const modal = document.getElementById('statusModal');
        const modalBox = document.getElementById('modalBox');
        
        // Kembalikan ke state awal (Tailwind)
        modal.classList.remove('opacity-100', 'visible');
        modal.classList.add('opacity-0', 'invisible');
        
        modalBox.classList.remove('scale-100', 'translate-y-0');
        modalBox.classList.add('scale-75', 'translate-y-8');
    });

    /* =====================================
       6. LOGIKA SUBMIT PENGIRIMAN FORM
       Fungsi: Mengambil semua data dari form HTML, mengecek validasi,
       dan mengirimkannya secara NYATA ke database melalui PHP.
    ===================================== */
    const form = document.getElementById("mainForm");

    if (form) {
        form.addEventListener("submit", async function (e) {
            e.preventDefault(); // Mencegah halaman refresh otomatis

            // Pengecekan Wajib Isi (Validation Check)
            if (!form.checkValidity()) {
                form.reportValidity(); 
                return; // STOP! Jika ada yang kosong
            }

            const btnSubmit = document.getElementById("btnSubmit");
            const btnText = document.getElementById("btnText");

            try {
                // Efek loading diaktifkan
                btnSubmit.disabled = true;
                btnText.textContent = "Mengirim ke Server...";

                // Fungsi mengambil nilai input
                const getVal = (id) => document.getElementById(id)?.value || "";

                // Menangkap data ter-update
                const data = {
                    nama_santri: getVal("nama_santri"),
                    nik: getVal("nik"),
                    nisn: getVal("nisn"),
                    jenis_kelamin: getVal("jenis_kelamin"),
                    tempat_lahir: getVal("tempat_lahir"),
                    tanggal_lahir: getVal("tanggal_lahir"),
                    agama: getVal("agama"),
                    jumlah_saudara: getVal("jumlah_saudara"),
                    anak_ke: getVal("anak_ke"),
                    tinggi_badan: getVal("tinggi_badan"),
                    berat_badan: getVal("berat_badan"),
                    hobi: getVal("hobi"),
                    cita_cita: getVal("cita_cita"),
                    jenjang_pendidikan: getVal("jenjang_pendidikan"),
                    mukim: getVal("mukim"),
                    unit_pesantren: getVal("unit_pesantren"),
                    nomor_kk: getVal("nomor_kk"),
                    nama_kepala_keluarga: getVal("nama_kepala_keluarga"),

                    status_ayah: getVal("status_ayah"),
                    nama_ayah: getVal("nama_ayah"),
                    nik_ayah: getVal("nik_ayah"),
                    agama_ayah: getVal("agama_ayah"),
                    tempat_lahir_ayah: getVal("tempat_lahir_ayah"),
                    tanggal_lahir_ayah: getVal("tanggal_lahir_ayah"),
                    pekerjaan_ayah: getVal("pekerjaan_ayah"),
                    pendapatan_ayah: getVal("pendapatan_ayah"),
                    pendidikan_ayah: getVal("pendidikan_ayah"),

                    status_ibu: getVal("status_ibu"),
                    nama_ibu: getVal("nama_ibu"),
                    nik_ibu: getVal("nik_ibu"),
                    agama_ibu: getVal("agama_ibu"),
                    tempat_lahir_ibu: getVal("tempat_lahir_ibu"),
                    tanggal_lahir_ibu: getVal("tanggal_lahir_ibu"),
                    pekerjaan_ibu: getVal("pekerjaan_ibu"),
                    pendapatan_ibu: getVal("pendapatan_ibu"),
                    pendidikan_ibu: getVal("pendidikan_ibu"),

                    alamat: getVal("alamat"),
                    rt_rw: getVal("rt_rw"),
                    desa_kelurahan: getVal("desa_kelurahan"),
                    kecamatan: getVal("kecamatan"),
                    kabupaten: getVal("kabupaten"),
                    provinsi: getVal("provinsi"),
                    kode_pos: getVal("kode_pos"),
                    nomor_hp: getVal("nomor_hp")
                };

                /* =========================================================
                   [KONTROL NYATA] Mengirim data ke server
                ========================================================= */
                const kirimData = await fetch('admin/proses_daftar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                // KEMBALI KE MODE NORMAL: Baca respon sebagai JSON
                const responServer = await kirimData.json();

                if (responServer.status === 'success') {
                    // Munculkan toast sukses hijau
                    showModal(responServer.message, "success");
                    
                    form.reset();
                    updateMukimLogic();
                    setupParentStatus("status_ayah", "ayah_fields");
                    setupParentStatus("status_ibu", "ibu_fields");
                } else {
                    showModal(responServer.message, "error");
                }

            } catch (error) {
                console.error("Error Javascript:", error);
                showModal("❌ Terjadi kegagalan koneksi jaringan ke server!", "error");
            } finally {
                btnSubmit.disabled = false;
                btnText.textContent = "Kirim Pendaftaran";
            }
        });
    }
});