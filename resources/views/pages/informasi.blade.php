@extends('layouts.app')

@section('title', 'Formulir Pendaftaran Santri Baru')

@push('styles')
<link rel="stylesheet"
          href="{{ asset('assets/css/styleppdb.css') }}">
@endpush

@section('content')
<div class="app-wrapper">
    <div class="form-container">
        
        <div class="text-center mb-8 text-white">
            <h2 class="text-3xl font-bold text-white text-center mb-6">
            Formulir Pendaftaran Santri Baru <br>
            <span class="text-base font-normal">Yayasan Pendidikan Pondok Pesantren Roudlotussolihin</span>
            </h2>  
        </div>

        <form id="mainForm" novalidate>
            
            <div class="form-card mb-6">
                <div class="border-b border-gray-100 pb-3 mb-4">
                    <h2 class="text-xl font-bold text-emerald-900 flex items-center gap-2">
                        Data Calon Santri
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label>Nama Lengkap Santri <span class="required">*</span></label>
                        <input type="text" id="nama_santri" class="form-input" required placeholder="Nama Lengkap Sesuai Ijazah/KK">
                    </div>

                    <div class="form-group">
                        <label>NIK (Nomor Induk Kependudukan) <span class="required">*</span></label>
                        <input type="text" id="nik" class="form-input" required maxlength="16" placeholder="16 Digit Nomor NIK">
                    </div>

                    <div class="form-group">
                        <label>NISN (Jika Ada)</label>
                        <input type="text" id="nisn" class="form-input" maxlength="10" placeholder="10 Digit Nomor NISN">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin <span class="required">*</span></label>
                        <select id="jenis_kelamin" class="form-input" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir <span class="required">*</span></label>
                        <input type="text" id="tempat_lahir" class="form-input" required placeholder="Kota atau Kabupaten Lahir">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir <span class="required">*</span></label>
                        <input type="text" id="tanggal_lahir" class="form-input" required placeholder="DD/MM/YYYY">
                    </div>

                    <div class="form-group">
                        <label>Agama <span class="required">*</span></label>
                        <select id="agama" class="form-input" required>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Saudara Kandung <span class="required">*</span></label>
                        <input type="text" id="jumlah_saudara" class="form-input" required placeholder="Contoh: 2">
                    </div>

                    <div class="form-group">
                        <label>Anak Ke <span class="required">*</span></label>
                        <input type="text" id="anak_ke" class="form-input" required placeholder="Contoh: 1">
                    </div>

                    <div class="form-group">
                        <label>Tinggi Badan (cm) <span class="required">*</span></label>
                        <input type="text" id="tinggi_badan" class="form-input" required maxlength="3" placeholder="Contoh: 165">
                    </div>

                    <div class="form-group">
                        <label>Berat Badan (kg) <span class="required">*</span></label>
                        <input type="text" id="berat_badan" class="form-input" required maxlength="3" placeholder="Contoh: 50">
                    </div>

                    <div class="form-group">
                        <label>Hobi <span class="required">*</span></label>
                        <input type="text" id="hobi" class="form-input" required placeholder="Contoh: Membaca, Olahraga">
                    </div>

                    <div class="form-group">
                        <label>Cita-cita <span class="required">*</span></label>
                        <input type="text" id="cita_cita" class="form-input" required placeholder="Contoh: Guru, Dokter, Pengusaha">
                    </div>

                    <div class="form-group">
                        <label>Jenjang Pendidikan <span class="required">*</span></label>
                        <select id="jenjang_pendidikan" class="form-input" required>
                            <option value="">-- Pilih Jenjang Pendidikan --</option>
                            <option value="RA Al-quran roudlotussolihin">RA Al-quran Roudlotussolihin</option>
                            <option value="MI Maarif Bumirestu">MI Maarif Bumirestu</option>
                            <option value="MTs Maarif Bumirestu">MTs Maarif Bumirestu</option>
                            <option value="SMA Maarif Bumirestu">SMA Maarif Bumirestu</option>
                            <option value="Hanya Mondok">Hanya Mondok</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status Mukim <span class="required">*</span></label>
                        <select id="mukim" class="form-input" required>
                            <option value="">-- Pilih Status Mukim --</option>
                            <option value="Mukim">Mukim</option>
                            <option value="Tidak Mukim">Tidak Mukim</option>
                        </select>
                    </div>

                    <div class="form-group md:col-span-2">
                        <label>Unit Pesantren <span id="unit_required" class="required" style="display:none;">*</span></label>
                        <select id="unit_pesantren" class="form-input" disabled>
                            <option value="">-- Pilih Unit Pesantren --</option>
                            <option value="MUS Roudlotussolihin">MUS Roudlotussolihin</option>
                            <option value="MUS Roudlotussolihin Tahfidz">MUS Roudlotussolihin Tahfidz</option>
                            <option value="MUS Roudlotul Muttaqin">MUS Roudlotul Muttaqin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nomor Kartu Keluarga (KK) <span class="required">*</span></label>
                        <input type="text" id="nomor_kk" class="form-input" required maxlength="16" placeholder="16 Digit Nomor KK">
                    </div>

                    <div class="form-group">
                        <label>Nama Kepala Keluarga <span class="required">*</span></label>
                        <input type="text" id="nama_kepala_keluarga" class="form-input" required placeholder="Nama Kepala Keluarga sesuai KK">
                    </div>
                </div>
            </div>

            <div class="form-card mb-6">
                <div class="border-b border-gray-100 pb-3 mb-4">
                    <h2 class="text-xl font-bold text-emerald-900">Data Ayah Kandung</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label>Status Ayah Kandung<span class="required">*</span></label>
                        <select id="status_ayah" class="form-input" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Hidup">Hidup</option>
                            <option value="Meninggal">Meninggal</option>
                            <option value="Tidak Diketahui">Tidak Diketahui</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap Ayah Kandung<span class="required">*</span></label>
                        <input type="text" id="nama_ayah" class="form-input" required placeholder="Nama Lengkap Ayah">
                    </div>
                </div>

                <div id="ayah_fields" class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4" style="display: none;">
                    <div class="form-group">
                        <label>NIK Ayah</label>
                        <input type="text" id="nik_ayah" class="form-input" maxlength="16" placeholder="16 Digit NIK Ayah">
                    </div>

                    <div class="form-group">
                        <label>Agama Ayah</label>
                        <select id="agama_ayah" class="form-input">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir Ayah</label>
                        <input type="text" id="tempat_lahir_ayah" class="form-input" placeholder="Kota/Kabupaten Lahir">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir Ayah</label>
                        <input type="text" id="tanggal_lahir_ayah" class="form-input" placeholder="DD/MM/YYYY">
                    </div>

                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select id="pendidikan_ayah" class="form-input">
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SD">SD / Sederajat</option>
                            <option value="SMP">SMP / Sederajat</option>
                            <option value="SMA">SMA / Sederajat</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1 / D4</option>
                            <option value="S2/S3">S2 / S3</option>
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pekerjaan Utama</label>
                        <input type="text" id="pekerjaan_ayah" class="form-input" placeholder="Contoh: Buruh, PNS, Wiraswasta">
                    </div>

                    <div class="form-group md:col-span-2">
                        <label>Pendapatan Bulanan</label>
                        <select id="pendapatan_ayah" class="form-input">
                            <option value="">-- Pilih Rentang Pendapatan --</option>
                            <option value="< 1 Juta">&lt; Rp 1.000.000</option>
                            <option value="1 - 3 Juta">Rp 1.000.000 - Rp 3.000.000</option>
                            <option value="3 - 5 Juta">Rp 3.000.000 - Rp 5.000.000</option>
                            <option value="> 5 Juta">&gt; Rp 5.000.000</option>
                            <option value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-card mb-6">
                <div class="border-b border-gray-100 pb-3 mb-4">
                    <h2 class="text-xl font-bold text-emerald-900">Data Ibu Kandung</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label>Status Ibu Kandung<span class="required">*</span></label>
                        <select id="status_ibu" class="form-input" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Hidup">Hidup</option>
                            <option value="Meninggal">Meninggal</option>
                            <option value="Tidak Diketahui">Tidak Diketahui</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap Ibu Kandung<span class="required">*</span></label>
                        <input type="text" id="nama_ibu" class="form-input" required placeholder="Nama Lengkap Ibu">
                    </div>
                </div>

                <div id="ibu_fields" class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4" style="display: none;">
                    <div class="form-group">
                        <label>NIK Ibu</label>
                        <input type="text" id="nik_ibu" class="form-input" maxlength="16" placeholder="16 Digit NIK Ibu">
                    </div>

                    <div class="form-group">
                        <label>Agama Ibu</label>
                        <select id="agama_ibu" class="form-input">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir Ibu</label>
                        <input type="text" id="tempat_lahir_ibu" class="form-input" placeholder="Kota/Kabupaten Lahir">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir Ibu</label>
                        <input type="text" id="tanggal_lahir_ibu" class="form-input" placeholder="DD/MM/YYYY">
                    </div>

                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select id="pendidikan_ibu" class="form-input">
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SD">SD / Sederajat</option>
                            <option value="SMP">SMP / Sederajat</option>
                            <option value="SMA">SMA / Sederajat</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1 / D4</option>
                            <option value="S2/S3">S2 / S3</option>
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pekerjaan Utama</label>
                        <input type="text" id="pekerjaan_ibu" class="form-input" placeholder="Contoh: Ibu Rumah Tangga, PNS, Dagang">
                    </div>

                    <div class="form-group md:col-span-2">
                        <label>Pendapatan Bulanan</label>
                        <select id="pendapatan_ibu" class="form-input">
                            <option value="">-- Pilih Rentang Pendapatan --</option>
                            <option value="< 1 Juta">&lt; Rp 1.000.000</option>
                            <option value="1 - 3 Juta">Rp 1.000.000 - Rp 3.000.000</option>
                            <option value="3 - 5 Juta">Rp 3.000.000 - Rp 5.000.000</option>
                            <option value="> 5 Juta">&gt; Rp 5.000.000</option>
                            <option value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-card mb-6">
                <div class="border-b border-gray-100 pb-3 mb-4">
                    <h2 class="text-xl font-bold text-emerald-900">Data Domisili &amp; Alamat</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div class="form-group">
                        <label>Nomor HP / WhatsApp Aktif <span class="required">*</span></label>
                        <input type="text" id="nomor_hp" class="form-input" required placeholder="Contoh: 08123456789">
                    </div>

                    <div class="form-group md:col-span-2">
                        <label>Alamat Jalan / Dusun <span class="required">*</span></label>
                        <input type="text" id="alamat" class="form-input" required placeholder="Nama Jalan, Gg, Blok, atau Kampung">
                    </div>

                    <div class="form-group">
                        <label>RT / RW <span class="required">*</span></label>
                        <input type="text" id="rt_rw" class="form-input" required placeholder="Contoh: 002/005">
                    </div>

                    <div class="form-group">
                        <label>Desa / Kelurahan <span class="required">*</span></label>
                        <input type="text" id="desa_kelurahan" class="form-input" required placeholder="Desa atau Kelurahan">
                    </div>

                    <div class="form-group">
                        <label>Kecamatan <span class="required">*</span></label>
                        <input type="text" id="kecamatan" class="form-input" required placeholder="Kecamatan">
                    </div>

                    <div class="form-group">
                        <label>Kabupaten / Kota <span class="required">*</span></label>
                        <input type="text" id="kabupaten" class="form-input" required placeholder="Kabupaten atau Kota">
                    </div>

                    <div class="form-group">
                        <label>Provinsi <span class="required">*</span></label>
                        <input type="text" id="provinsi" class="form-input" required placeholder="Provinsi">
                    </div>

                    <div class="form-group">
                        <label>Kode Pos <span class="required">*</span></label>
                        <input type="text" id="kode_pos" class="form-input" required maxlength="5" placeholder="5 Digit Kode Pos">
                    </div>
                </div>
            </div>

            <div class="form-card text-center">
                <button type="submit" class="btn-submit" id="btnSubmit">
                    <span id="btnText">Kirim Pendaftaran</span>
                </button>
            </div>

        </form>
    </div>
</div>




<div id="statusModal" class="fixed inset-0 z-[99999] flex items-center justify-center bg-black/60 opacity-0 invisible transition-all duration-300">
    <div id="modalBox" class="bg-white p-8 rounded-2xl text-center w-[90%] max-w-[400px] transform scale-75 translate-y-8 transition-all duration-500 shadow-2xl">
        
        <div id="modalIconContainer" class="modal-icon"></div>
        
        <h3 id="modalTitle" class="text-2xl font-bold mt-4 mb-2"></h3>
        <p id="modalMessage" class="text-gray-600 mb-6 font-medium"></p>
        
        <button id="closeModalBtn" class="bg-emerald-600 text-white px-8 py-2.5 rounded-lg font-bold hover:bg-emerald-700 transition shadow-lg w-full">
            Tutup
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/scriptppdb.js') }}"></script>
<script src="https://cdn.tailwindcss.com"></script>
@endpush
