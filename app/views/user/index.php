<style>
    /* ========================================== */
    /* CSS DASHBOARD (FRESH & CLEAN)              */
    /* ========================================== */
    .dashboard-container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px;
        display: flex;
        gap: 30px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    /* --- Bagian Kiri (Profil) --- */
    .profile-card {
        flex: 1;
        min-width: 280px;
        background: white;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        padding: 30px;
        text-align: center;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        background-color: #F3F4F6;
        color: var(--biru-unnes);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 35px;
        margin: 0 auto 15px auto;
    }

    .profile-card h3 {
        margin: 0 0 5px 0;
        color: var(--biru-unnes);
        font-size: 22px;
    }

    .profile-card p {
        margin: 0;
        color: #6B7280;
        font-size: 15px;
    }

    .status-badge {
        display: inline-block;
        background-color: var(--kuning-btn);
        color: var(--biru-unnes);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: bold;
        margin-top: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* --- Bagian Kanan (Daftar Driver) --- */
    .driver-section {
        flex: 2;
        min-width: 320px;
        background: white;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        padding: 30px;
    }

    .driver-section-header {
        border-bottom: 2px solid #F3F4F6;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .driver-section-header h2 {
        margin: 0;
        color: var(--biru-unnes);
        font-size: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Item List Driver */
    .driver-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #F3F4F6;
    }

    .driver-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .driver-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .driver-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        background-color: #E5E7EB;
    }

    .driver-name {
        margin: 0 0 3px 0;
        font-size: 16px;
        font-weight: bold;
        color: #1F2937;
    }

    .driver-detail {
        margin: 0;
        font-size: 13px;
        color: #6B7280;
    }

    .status-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .btn-pesan {
        background-color: var(--biru-unnes);
        color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .btn-pesan:hover {
        background-color: #122b59;
    }

    @media (max-width: 600px) {
        .driver-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        .btn-pesan {
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }
    }
</style>

<!-- ========================================== -->
<!-- STRUKTUR HTML                              -->
<!-- ========================================== -->
<div class="dashboard-container">
    
    <!-- KARTU PROFIL (KIRI) -->
    <div class="profile-card">
        <div class="profile-avatar">👤</div>
        <h3><?= $_SESSION['nama']; ?></h3>
        <div class="status-badge"><?= $_SESSION['role']; ?></div>
    </div>

    <!-- AREA DRIVER AKTIF (KANAN) -->
    <div class="driver-section">
        <div class="driver-section-header">
            <h2><span style="font-size: 24px;">🛵</span> Driver yang Sedang Aktif</h2>
        </div>
        
        <div id="wadah-driver">
            <!-- Teks loading sementara -->
            <div style="text-align: center; color: #9CA3AF; padding: 40px 0;">
                Memindai area kampus...
            </div>
        </div>
    </div>

</div>

<!-- Copyright Bawah -->
<div style="text-align: center; margin-top: 40px; padding-bottom: 30px; font-size: 14px; color: #bbb;">
    
</div>

<!-- ========================================== -->
<!-- SCRIPT RENDER DRIVER (AJAX)                -->
<!-- ========================================== -->
<script>
    function muatDriverLive() {
        fetch('<?= BASEURL; ?>/user/ambilDriverLive')
            .then(response => response.json())
            .then(data => {
                const wadahDriver = document.getElementById('wadah-driver');
                wadahDriver.innerHTML = ''; 

                if (data.length === 0) {
                    wadahDriver.innerHTML = `
                        <div style="text-align: center; color: #9CA3AF; padding: 40px 0;">
                            <span style="font-size: 40px; display:block; margin-bottom:10px;">😴</span>
                            <p style="margin:0; font-size:15px;">Saat ini tidak ada driver yang standby di sekitar UNNES.</p>
                        </div>
                    `;
                    return;
                }

                data.forEach(d => {
                    // Warna indikator status (Hijau untuk Ready, Oranye untuk Still Deliver)
                    let warnaDot = '#9CA3AF';
                    let warnaTeksStatus = '#6B7280';
                    
                    if(d.status === 'Ready') {
                        warnaDot = '#10B981'; // Hijau
                        warnaTeksStatus = '#10B981';
                    } else if(d.status === 'Still Deliver') {
                        warnaDot = '#F59E0B'; // Oranye
                        warnaTeksStatus = '#F59E0B';
                    }

                    const htmlDriver = `
                        <div class="driver-item">
                            <div class="driver-info">
                                <img src="<?= BASEURL; ?>/assets/img/${d.foto_profil}" class="driver-img">
                                <div>
                                    <h4 class="driver-name">${d.nama}</h4>
                                    <p class="driver-detail">
                                        ${d.jenis_motor} • <strong style="color: var(--biru-unnes);">${d.plat_nomor}</strong>
                                    </p>
                                    <div style="font-size: 12px; font-weight: bold; color: ${warnaTeksStatus}; margin-top: 4px;">
                                        <span class="status-dot" style="background-color: ${warnaDot};"></span> ${d.status}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="<?= BASEURL; ?>/order/buat/${d.id_user}" class="btn-pesan">Pesan</a>
                            </div>
                        </div>
                    `;
                    
                    wadahDriver.innerHTML += htmlDriver;
                });
            })
            .catch(error => console.error('Gagal memuat list driver:', error));
    }

    muatDriverLive();
    setInterval(muatDriverLive, 3000); // Sinkronisasi otomatis tiap 3 detik
</script>