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
            })
            .catch(error => console.error('Gagal memuat live data admin:', error));
    }

    // Eksekusi langsung saat admin buka halaman
    muatAdminLive();
    
    // Ulangi pengambilan data setiap 3 detik agar selalu up-to-date
    setInterval(muatAdminLive, 3000);
</script>