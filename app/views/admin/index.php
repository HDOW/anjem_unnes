<div style="padding: 20px; max-width: 1200px; margin: 0 auto;">
    <div style="background: var(--biru-unnes); color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
        <h2>Halo Admin, Selamat Datang di Ruang Kendali!</h2>
        <p>Anda memiliki otoritas penuh untuk memantau seluruh aktivitas, status, dan pendaftaran sistem Anjem UNNES secara REAL-TIME.</p>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 30px; overflow-x: auto;">
        <h3 style="color: var(--biru-unnes); border-bottom: 2px solid var(--kuning-btn); padding-bottom: 10px; min-width: 600px;">Data Mahasiswa / User</h3>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; border-color: #eee; margin-top: 10px; min-width: 600px;">
            <thead>
                <tr style="background: #f9f9f9; text-align: left;">
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Nomor HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tabel-user">
                <tr><td colspan="4" style="text-align: center; color: #888;">Memuat data live...</td></tr>
            </tbody>
        </table>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow-x: auto;">
        <h3 style="color: var(--biru-unnes); border-bottom: 2px solid var(--kuning-btn); padding-bottom: 10px; min-width: 800px;">Data Driver Anjem</h3>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; border-color: #eee; margin-top: 10px; min-width: 800px;">
            <thead>
                <tr style="background: #f9f9f9; text-align: left;">
                    <th>Foto</th>
                    <th>Nama Driver</th>
                    <th>Nomor HP</th>
                    <th>Motor & Plat</th>
                    <th>Status Kerja</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tabel-driver">
                <tr><td colspan="6" style="text-align: center; color: #888;">Memuat data live...</td></tr>
            </tbody>
        </table>
    </div>
</div>

    <!-- ========================================== -->
<!-- DAFTAR KRITIK DAN SARAN MASUK              -->
<!-- ========================================== -->
<div class="panel-pesan" style="margin-top: 50px; background-color: white; padding: 30px; border-radius: 15px; border: 1px solid #E5E7EB;">
   <!-- ... kodingan atasnya ... -->
    <h3 style="color: var(--biru-unnes); margin-top: 0; border-bottom: 2px solid #F3F4F6; padding-bottom: 15px;">
        Kotak Masuk (Kritik & Saran)
    </h3>
    
    <!-- TAMBAHKAN id="wadah-kritik" DI SINI -->
    <div id="wadah-kritik" style="display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
        <?php if(empty($data['kritik'])) : ?>
            <p style="color: #9CA3AF; font-style: italic;">Belum ada pesan masuk saat ini.</p>
        <?php else : ?>
            <?php foreach($data['kritik'] as $pesan) : ?>
                <div style="background-color: #F9FAFB; padding: 20px; border-radius: 10px; border-left: 5px solid var(--kuning-btn);">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong style="color: #111827; font-size: 16px;"><?= $pesan['nama']; ?></strong>
                        <span style="color: #6B7280; font-size: 13px;"><?= date('d M Y, H:i', strtotime($pesan['tanggal'])); ?></span>
                    </div>
                    <p style="margin: 0; color: #4B5563; line-height: 1.5; font-size: 15px;">
                        "<?= $pesan['pesan']; ?>"
                    </p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    function muatAdminLive() {
        // Mengambil paket data (User & Driver) dari server
        fetch('<?= BASEURL; ?>/admin/ambilDataLive')
            .then(response => response.json())
            .then(data => {
                
                // 1. RENDER DATA USER
                const tbodyUser = document.getElementById('tabel-user');
                tbodyUser.innerHTML = ''; // Bersihkan tabel
                if (data.users.length === 0) {
                    tbodyUser.innerHTML = '<tr><td colspan="4" style="text-align: center; color: #888;">Belum ada akun terdaftar.</td></tr>';
                } else {
                    data.users.forEach(u => {
                        tbodyUser.innerHTML += `
                            <tr>
                                <td>${u.id_user}</td>
                                <td><strong>${u.nama}</strong></td>
                                <td>${u.no_hp}</td>
                                <td>
                                    <a href="<?= BASEURL; ?>/admin/hapus/${u.id_user}" onclick="return confirm('Yakin ingin menghapus akun Mahasiswa ini?')" style="background: var(--merah-alert); color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none; font-size: 13px;">Hapus Akun</a>
                                </td>
                            </tr>
                        `;
                    });
                }

                // 2. RENDER DATA DRIVER
                const tbodyDriver = document.getElementById('tabel-driver');
                tbodyDriver.innerHTML = ''; // Bersihkan tabel
                if (data.drivers.length === 0) {
                    tbodyDriver.innerHTML = '<tr><td colspan="6" style="text-align: center; color: #888;">Belum ada driver terdaftar.</td></tr>';
                } else {
                    data.drivers.forEach(d => {
                        // Logika Pewarnaan Status
                        let warnaStatus = 'gray';
                        if (d.status === 'Ready') warnaStatus = 'green';
                        if (d.status === 'Still Deliver') warnaStatus = 'orange';

                        tbodyDriver.innerHTML += `
                            <tr>
                                <td><img src="<?= BASEURL; ?>/assets/img/${d.foto_profil}" width="50" height="50" style="border-radius: 50%; object-fit: cover;"></td>
                                <td><strong>${d.nama}</strong></td>
                                <td>${d.no_hp}</td>
                                <td>${d.jenis_motor} (<span style="color: blue; font-weight: bold;">${d.plat_nomor}</span>)</td>
                                <td>
                                    <span style="background: ${warnaStatus}; color: white; padding: 3px 8px; border-radius: 10px; font-size: 12px; font-weight: bold;">${d.status}</span>
                                </td>
                                <td>
                                    <a href="<?= BASEURL; ?>/admin/hapus/${d.id_user}" onclick="return confirm('Yakin ingin menghapus akun Driver ini?')" style="background: var(--merah-alert); color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none; font-size: 13px;">Hapus Akun</a>
                                </td>
                            </tr>
                        `;
                    });
                }
                
                const wadahKritik = document.getElementById('wadah-kritik');
                
                // Jika belum ada pesan sama sekali
                if (data.kritik.length === 0) {
                    wadahKritik.innerHTML = '<p style="color: #9CA3AF; font-style: italic;">Belum ada pesan masuk saat ini.</p>';
                    return;
                }

                // Bersihkan isi div lama
                let htmlBaru = '';

                // Looping data pesan baru dari database
                data.kritik.forEach(pesan => {
                    // Konversi format waktu bawaan database ke format jam & tanggal Indonesia
                    let waktu = new Date(pesan.tanggal);
                    let formatWaktu = waktu.toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'}) + ', ' + waktu.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
                    
                    // Rangkai elemen HTML-nya
                    htmlBaru += `
                        <div style="background-color: #F9FAFB; padding: 20px; border-radius: 10px; border-left: 5px solid var(--kuning-btn);">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <strong style="color: #111827; font-size: 16px;">${pesan.nama}</strong>
                                <span style="color: #6B7280; font-size: 13px;">${formatWaktu.replace(/\./g, ':')}</span>
                            </div>
                            <p style="margin: 0; color: #4B5563; line-height: 1.5; font-size: 15px;">
                                "${pesan.pesan}"
                            </p>
                        </div>
                    `;
                });

                // Suntikkan HTML baru ke dalam wadah layar Admin
                wadahKritik.innerHTML = htmlBaru;
            
            })
            .catch(error => console.error('Gagal memuat live data admin:', error));
    }

    // Eksekusi langsung saat admin buka halaman
    muatAdminLive();
    
    // Ulangi pengambilan data setiap 3 detik agar selalu up-to-date
    setInterval(muatAdminLive, 3000);
</script>