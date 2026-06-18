<style>
    /* --- CSS Bagian Atas (Hero Rata Tengah) --- */
    .hero-text-section {
        min-height: 60vh; 
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .hero-content {
        max-width: 700px; 
        text-align: center;
        margin: 0 auto;
    }

    .hero-content h1 {
        color: var(--biru-unnes);
        font-size: 48px;
        line-height: 1.2;
        margin-top: 0;
        margin-bottom: 20px;
    }

    .hero-content p {
        color: #555;
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 35px;
    }

    .btn-mulai {
        display: inline-block;
        background-color: var(--kuning-btn);
        color: var(--biru-unnes);
        padding: 15px 35px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 8px;
        text-decoration: none;
    }

    .btn-mulai:hover {
        background-color: #e6c200; 
    }

    /* Responsif untuk layar HP */
    @media (max-width: 768px) {
        .hero-text-section { min-height: 50vh; }
        .hero-content h1 { font-size: 36px; }
    }

    /* --- CSS Fitur "Kenapa Anjem?" --- */
    .section-kenapa {
        max-width: 1000px;
        margin: 20px auto 60px auto;
        padding: 20px;
    }

    .header-kenapa {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 40px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .title-area .subtitle {
        color: var(--kuning-btn);
        font-weight: bold;
        font-size: 14px;
        letter-spacing: 1px;
    }

    .title-area h2 {
        color: var(--biru-unnes);
        font-size: 36px;
        margin: 5px 0 0 0;
        line-height: 1.2;
    }

    .toggle-container {
        background-color: #E5E7EB;
        border-radius: 30px;
        padding: 5px;
        display: flex;
        gap: 5px;
    }

    .toggle-btn {
        background: transparent;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: bold;
        color: #6B7280;
        cursor: pointer;
        font-size: 15px;
    }

    .toggle-btn.active {
        background-color: var(--biru-unnes);
        color: var(--putih-bersih);
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .card {
        padding: 30px;
        border-radius: 15px;
        border: 1px solid #E5E7EB; 
    }

    .card h3 { margin-top: 0; font-size: 22px; margin-bottom: 10px; }
    .card p { font-size: 15px; line-height: 1.6; margin: 0; }

    .card-gelap { background-color: var(--biru-unnes); color: var(--putih-bersih); border: none; }
    .card-gelap p { color: #D1D5DB; }
    .card-putih { background-color: var(--putih-bersih); color: var(--biru-unnes); }
    .card-putih p { color: #6B7280; }
    .card-kuning { background-color: #FFFBEB; color: var(--biru-unnes); border: 1px solid #FEF3C7; }
    .card-kuning p { color: #6B7280; }

    /* --- CSS SECTION TARIF KALKULATOR --- */
    .section-tarif {
        max-width: 1000px;
        margin: 80px auto;
        padding: 20px;
    }

    .tarif-container {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
        align-items: center;
        margin-top: 40px;
    }

    .tarif-kiri {
        flex: 1;
        min-width: 300px;
    }

    .tier-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 25px;
    }

    .tier-box {
        border: 1px solid #E5E7EB;
        padding: 15px 20px;
        border-radius: 12px;
        background-color: #FAFAFA;
    }

    .tier-box span {
        display: block;
        font-size: 14px;
        color: #6B7280;
        margin-bottom: 5px;
    }

    .tier-box strong {
        font-size: 22px;
        color: var(--biru-unnes);
    }

    /* Kotak Kalkulator Interaktif */
    .tarif-kanan {
        flex: 1;
        min-width: 300px;
        background-color: var(--biru-unnes);
        color: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .calc-label {
        font-size: 12px;
        letter-spacing: 2px;
        color: #9CA3AF;
        text-transform: uppercase;
        font-weight: bold;
    }

    .calc-price {
        font-size: 56px;
        font-weight: bold;
        color: var(--kuning-btn);
        margin: 5px 0 0 0;
        line-height: 1.1;
    }

    .calc-desc {
        font-size: 15px;
        color: #D1D5DB;
        margin-bottom: 50px;
    }

    /* Custom Slider (Range Input) */
    input[type=range] {
        -webkit-appearance: none;
        width: 100%;
        background: transparent;
    }
    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 24px;
        width: 24px;
        border-radius: 50%;
        background: var(--kuning-btn);
        cursor: pointer;
        margin-top: -10px;
        box-shadow: 0 0 10px rgba(255, 204, 0, 0.5);
    }
    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 4px;
        cursor: pointer;
        background: #4B5563;
        border-radius: 2px;
    }
</style>

<!-- ========================================== -->
<!-- BAGIAN 1: HERO SECTION                     -->
<!-- ========================================== -->
<div class="hero-text-section">
    <div class="hero-content">
        <h1>Selamat Datang di Anjem UNNES!</h1>
        <p>Solusi mobilitas dan jasa titip cepat untuk mahasiswa UNNES.</p>
        <a href="<?= BASEURL; ?>/auth" class="btn-mulai">Mulai Sekarang</a>
    </div>
</div>

<!-- ========================================== -->
<!-- BAGIAN 2: KENAPA ANJEM?                    -->
<!-- ========================================== -->
<div class="section-kenapa">
    <div class="header-kenapa">
        <div class="title-area">
            <span class="subtitle">— KENAPA ANJEM UNNES?</span>
            <h2>Kenapa harus<br>pakai <span style="color: var(--kuning-btn);">Anjem UNNES?</span></h2>
        </div>
        
        <div class="toggle-container">
            <button class="toggle-btn active" id="btn-tab-penumpang" onclick="gantiTab('penumpang')">Penumpang</button>
            <button class="toggle-btn" id="btn-tab-driver" onclick="gantiTab('driver')">Driver</button>
        </div>
    </div>

    <div id="konten-penumpang" class="cards-container">
        <div class="card card-gelap">
            <h3 style="color: var(--kuning-btn);">Nggak Ribet</h3>
            <p>Gak perlu chat di grup, tinggal klik dan chat, driver terdekat di area kampus langsung jalan menuju lokasimu.</p>
        </div>
        <div class="card card-putih">
            <h3>Harga Jelas dari Awal</h3>
            <p>Gak ada nego atau bingung soal tarif. Semua transparan dan sesuai dengan yang tertera</p>
        </div>
        <div class="card card-kuning">
            <h3>Lebih Aman & Terpercaya</h3>
            <p>Driver terverifikasi. Identitas jelas, jadi perjalananmu di sekitar kampus jauh lebih aman.</p>
        </div>
    </div>

    <div id="konten-driver" class="cards-container" style="display: none;">
        <div class="card card-kuning">
            <h3>Waktu Fleksibel</h3>
            <p>Tanpa seragam, tanpa shift ketat. Kamu bebas atur sendiri kapan mau menyalakan status 'Ready' di sela-sela jam kosong kuliah.</p>
        </div>
        <div class="card card-putih">
            <h3>Pendapatan Penuh</h3>
            <p>100% pendapatan adalah milikmu. Cocok banget buat nambah-nambah uang saku atau modal nongkrong anak kos.</p>
        </div>
        <div class="card card-gelap">
            <h3 style="color: var(--kuning-btn);">Eksklusif Mahasiswa</h3>
            <p>Lingkungan kerja yang nyaman karena penumpangmu adalah sesama mahasiswa. Lebih nyambung diajak ngobrol di jalan!</p>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- BAGIAN 3: ESTIMASI TARIF                   -->
<!-- ========================================== -->
<div class="section-tarif">
    <div class="title-area">
        <span class="subtitle">— GAK PERLU TANYA HARGA LAGI.</span>
        <h2>Semua tarif langsung<br>kelihatan sebelum order.</h2>
    </div>

    <div class="tarif-container">
        <!-- Rincian Harga Kiri -->
        <div class="tarif-kiri">
            <p style="color: #6B7280; font-size: 16px; line-height: 1.6; margin: 0;">Makin jauh, tarif per km naik bertahap. <br>Geser kalkulator untuk lihat harga pastimu.</p>
            
            <div class="tier-grid">
                <div class="tier-box">
                    <span>< 1 km</span>
                    <strong>Rp 3.500</strong>
                </div>
                <div class="tier-box">
                    <span>1 - 5 km</span>
                    <strong>Rp 6.000</strong>
                </div>
                <div class="tier-box">
                    <span>5 - 7 km</span>
                    <strong>Rp 12.000</strong>
                </div>
                <div class="tier-box">
                    <span>> 7 km</span>
                    <strong>Rp 20.000</strong>
                </div>
            </div>
        </div>

        <!-- Kalkulator Interaktif Kanan -->
        <div class="tarif-kanan">
            <div class="calc-label">Estimasi Tarif</div>
            <div class="calc-price" id="tampil-harga">Rp 8.000</div>
            <div class="calc-desc">untuk <span id="tampil-km" style="color: white; font-weight: bold;">3.0</span> km perjalanan</div>

            <div style="display: flex; justify-content: space-between; font-size: 13px; color: #9CA3AF; margin-bottom: 10px;">
                <span>Geser untuk estimasi</span>
                <span id="tampil-km-bawah" style="color: white;">3.0 km</span>
            </div>
            
            <!-- Slider Input: range dari 0.5 km sampai 10 km -->
            <input type="range" id="slider-km" min="0.5" max="10" step="0.5" value="3.0" oninput="hitungEstimasi()">
        </div>
    </div>

    <!-- Footer Copyright -->
    <div style="text-align: center; margin-top: 100px; padding-bottom: 30px; font-size: 14px; color: #bbb;">
        
    </div>
</div>

<!-- ========================================== -->
<!-- SCRIPT JAVASCRIPT                          -->
<!-- ========================================== -->
<script>
    // FUNGSI GANTI TAB KENAPA ANJEM
    function gantiTab(target) {
        const btnPenumpang = document.getElementById('btn-tab-penumpang');
        const btnDriver = document.getElementById('btn-tab-driver');
        const kontenPenumpang = document.getElementById('konten-penumpang');
        const kontenDriver = document.getElementById('konten-driver');

        if (target === 'penumpang') {
            btnPenumpang.classList.add('active');
            btnDriver.classList.remove('active');
            kontenPenumpang.style.display = 'grid';
            kontenDriver.style.display = 'none';
        } else if (target === 'driver') {
            btnDriver.classList.add('active');
            btnPenumpang.classList.remove('active');
            kontenDriver.style.display = 'grid';
            kontenPenumpang.style.display = 'none';
        }
    }

    // FUNGSI KALKULATOR HARGA LIVE
    function hitungEstimasi() {
        // Ambil nilai dari slider
        let km = parseFloat(document.getElementById('slider-km').value);
        let harga = 0;

        // Logika penentuan harga (sesuai gambar desainmu)
        if (km < 1) {
            harga = 3500;
        } else if (km <= 5) {
            harga = 6000;
        } else if (km <= 7) {
            harga = 12000;
        } else {
            harga = 20000;
        }

        // Tampilkan format ke dalam layar
        document.getElementById('tampil-km').innerText = km.toFixed(1);
        document.getElementById('tampil-km-bawah').innerText = km.toFixed(1) + " km";
        document.getElementById('tampil-harga').innerText = "Rp " + harga.toLocaleString('id-ID');
    }

    // Panggil fungsi sekali saat halaman baru di-load
    window.onload = function() {
        hitungEstimasi();
    };
</script>