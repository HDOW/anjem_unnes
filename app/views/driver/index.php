<div style="padding: 20px; max-width: 1000px; margin: 0 auto; display: flex; gap: 20px; flex-wrap: wrap;">
    
    <div style="flex: 1; min-width: 300px; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-height: 450px;">
        <div style="text-align: center;">
            <img src="<?= BASEURL; ?>/assets/img/<?= $data['profil']['foto_profil']; ?>" width="120" height="120" style="border-radius: 50%; object-fit: cover; border: 4px solid var(--biru-unnes);">
            <h3 style="margin-bottom: 0; margin-top: 15px;"><?= $data['profil']['nama']; ?></h3>
            <p style="color: #666; margin-top: 5px; font-size: 14px;"><?= $data['profil']['no_hp']; ?></p>
        </div>

        <div style="border-top: 2px solid #eee; margin-top: 20px; padding-top: 15px;">
            <p><strong>Kendaraan:</strong> <?= $data['profil']['jenis_motor']; ?> (<span style="color: red; font-weight: bold;"><?= $data['profil']['plat_nomor']; ?></span>)</p>
            
            <div style="margin: 15px 0; background: #f9f9f9; padding: 10px; border-radius: 5px; font-size: 14px;">
                Status Anda: 
                <strong style="color: <?php 
                    if($data['profil']['status'] == 'Ready') echo 'green';
                    elseif($data['profil']['status'] == 'Still Deliver') echo 'orange';
                    else echo 'red';
                ?>"><?= $data['profil']['status']; ?></strong>
            </div>

            <form action="<?= BASEURL; ?>/driver/gantiStatus" method="POST">
                <select name="status" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
                    <option value="Ready" <?= ($data['profil']['status'] == 'Ready') ? 'selected' : ''; ?>>🟢 Ready</option>
                    <option value="Still Deliver" <?= ($data['profil']['status'] == 'Still Deliver') ? 'selected' : ''; ?>>🟡 Still Deliver</option>
                    <option value="Off" <?= ($data['profil']['status'] == 'Off') ? 'selected' : ''; ?>>🔴 Off</option>
                </select>
                <button type="submit" class="btn-utama" style="width: 100%; padding: 10px;">Perbarui Status</button>
            </form>
        </div>
    </div>

    <div style="flex: 2; min-width: 400px; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h3 style="color: var(--biru-unnes); margin-top: 0; border-bottom: 2px solid var(--kuning-btn); padding-bottom: 10px;">💬 Pesan Masuk / Orderan</h3>
        <p style="font-size: 14px; color: #666; margin-bottom: 15px;">Mahasiswa berikut sedang menghubungi Anda:</p>
        
        <div id="wadah-inbox" style="display: flex; flex-direction: column; gap: 15px;">
            <div style="text-align: center; color: #888; padding: 40px 0;">Memuat pesan...</div>
        </div>
    </div>

</div>

<script>
    function muatInboxLive() {
        // Tarik data JSON dari Controller
        fetch('<?= BASEURL; ?>/driver/ambilInboxLive')
            .then(response => response.json())
            .then(data => {
                const wadahInbox = document.getElementById('wadah-inbox');
                wadahInbox.innerHTML = ''; // Bersihkan isi sebelumnya

                // Jika tidak ada chat sama sekali
                if (data.length === 0) {
                    wadahInbox.innerHTML = `
                        <div style="text-align: center; color: #888; margin-top: 5px; padding: 40px 0;">
                            <p style="font-size: 16px; margin-bottom: 5px;">Belum ada pesan masuk.</p>
                        </div>
                    `;
                    return; // Hentikan eksekusi ke bawah
                }

                // Jika ada chat, buat kotaknya satu per satu
                data.forEach(c => {
                    // Siapkan badge merah jika ada pesan belum dibaca
                    let badgeMerah = '';
                    if (c.unread_count > 0) {
                        badgeMerah = `
                            <span style="position: absolute; top: -7px; left: -7px; background-color: var(--merah-alert); color: white; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                ${c.unread_count}
                            </span>
                        `;
                    }

                    // Susun HTML untuk setiap kontak
                    const htmlKontak = `
                        <div style="display: flex; align-items: center; justify-content: space-between; border: 1px solid #eee; padding: 15px; border-radius: 8px; background: #fdfdfd; position: relative;">
                            ${badgeMerah}
                            <div>
                                <h4 style="margin: 0; color: #333;">${c.nama}</h4>
                                <p style="margin: 4px 0; font-size: 13px; color: #777;">No. HP: ${c.no_hp}</p>
                            </div>
                            <div>
                                <a href="<?= BASEURL; ?>/chat/index/${c.id_user}" class="btn-utama" style="padding: 8px 15px; font-size: 13px; background-color: var(--biru-unnes); color: white;">Balas Chat</a>
                            </div>
                        </div>
                    `;
                    
                    // Suntikkan ke layar
                    wadahInbox.innerHTML += htmlKontak;
                });
            })
            .catch(error => console.error('Gagal memuat inbox:', error));
    }

    // Eksekusi fungsinya langsung saat halaman pertama kali dibuka
    muatInboxLive();
    
    // Ulangi proses tarik data secara diam-diam setiap 3 detik (3000 milidetik)
    setInterval(muatInboxLive, 3000);
</script>

</div>

