<div style="max-width: 600px; margin: 20px auto; background: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
    
    <div style="background: var(--biru-unnes); color: white; padding: 18px 15px; display: flex; align-items: center; position: relative;">
        <a href="javascript:history.back()" style="color: var(--kuning-btn); font-size: 15px; text-decoration: none; font-weight: bold; position: absolute; left: 20px;">
             Kembali
        </a>
        
        <h3 style="margin: 0; width: 100%; text-align: center; font-size: 18px;">
            Sesi chat dengan <?= $data['nama_lawan']; ?>
        </h3>
    </div>

    <div id="kotak-pesan" style="height: 400px; overflow-y: auto; padding: 20px; background: #e5ddd5; display: flex; flex-direction: column; gap: 10px;">
    </div>

    <div style="padding: 15px; background: #f0f0f0; display: flex; gap: 10px; align-items: center;">
        
        <label for="input-gambar" id="label-gambar" style="cursor: pointer; color: var(--biru-unnes); padding: 5px; transition: 0.3s; display: flex; align-items: center;" title="Kirim Foto">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
        </label>
        <input type="file" id="input-gambar" accept="image/*" style="display: none;" onchange="ceklampiran(this)">

        <input type="text" id="input-pesan" placeholder="Ketik pesan..." style="flex: 1; padding: 10px; border-radius: 20px; border: 1px solid #ccc; outline: none;">
        <button onclick="kirimPesan()" class="btn-utama" style="border-radius: 20px; padding: 10px 20px;">Kirim</button>
    </div>

</div>

<script>
    const idLawan = <?= $data['id_lawan']; ?>;
    const idSaya = <?= $_SESSION['id_user']; ?>;
    const kotakPesan = document.getElementById('kotak-pesan');
    const inputPesan = document.getElementById('input-pesan');
    const inputGambar = document.getElementById('input-gambar');
    const labelGambar = document.getElementById('label-gambar');

    // Variabel untuk menyimpan bentuk Ikon
    const ikonFotoSVG = `
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <circle cx="8.5" cy="8.5" r="1.5"></circle>
            <polyline points="21 15 16 10 5 21"></polyline>
        </svg>
    `;
    
    // Ikon centang SVG untuk UX yang lebih pro
    const ikonCentangSVG = `
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
    `;

    // --- UX: Mengubah Ikon jika ada gambar yang dipilih ---
    function ceklampiran(input) {
        if (input.files && input.files[0]) {
            labelGambar.innerHTML = ikonCentangSVG; // Berubah jadi centang hijau
        } else {
            labelGambar.innerHTML = ikonFotoSVG; // Kembali ke ikon foto
        }
    }

    // 1. Fungsi untuk menarik pesan dari database
    function muatPesan() {
        fetch('<?= BASEURL; ?>/chat/ambilPesan/' + idLawan)
            .then(response => response.json())
            .then(data => {
                kotakPesan.innerHTML = ''; 
                
                data.forEach(chat => {
                    let isSaya = (chat.pengirim_id == idSaya);
                    let warnaBg = isSaya ? '#dcf8c6' : 'white'; 
                    let posisi = isSaya ? 'align-self: flex-end;' : 'align-self: flex-start;';
                    
                    // Logika memunculkan gambar jika ada
                    let elemenGambar = '';
                    if (chat.gambar !== null && chat.gambar !== '') {
                        elemenGambar = `<img src="<?= BASEURL; ?>/assets/img/chat/${chat.gambar}" style="max-width: 100%; max-height: 250px; border-radius: 8px; margin-bottom: 8px; cursor: pointer;" onclick="window.open(this.src, '_blank')"><br>`;
                    }

                    // Teks Pesan
                    let teksPesan = chat.pesan !== null ? chat.pesan : '';

                    kotakPesan.innerHTML += `
                        <div style="background: ${warnaBg}; padding: 10px 15px; border-radius: 10px; max-width: 70%; ${posisi} box-shadow: 0 1px 1px rgba(0,0,0,0.1);">
                            ${elemenGambar}
                            <span style="font-size: 14px; color: #333;">${teksPesan}</span>
                            <div style="font-size: 10px; color: #999; text-align: right; margin-top: 5px;">${chat.waktu.substring(11, 16)}</div>
                        </div>
                    `;
                });
                
                // Otomatis scroll ke paling bawah
                kotakPesan.scrollTop = kotakPesan.scrollHeight;
            });
    }

    // 2. Fungsi untuk mengirim pesan dan/atau gambar
    function kirimPesan() {
        let isiPesan = inputPesan.value;
        let fileGambar = inputGambar.files[0];

        // Pencegah agar tidak mengirim ruang kosong sama sekali
        if(isiPesan.trim() === '' && !fileGambar) return;

        let formData = new FormData();
        formData.append('id_lawan', idLawan);
        formData.append('pesan', isiPesan);
        
        // Jika ada gambar, sisipkan ke dalam FormData
        if(fileGambar) {
            formData.append('gambar', fileGambar);
        }

        fetch('<?= BASEURL; ?>/chat/kirim', {
            method: 'POST',
            body: formData
        }).then(() => {
            // Bersihkan kolom input setelah terkirim
            inputPesan.value = ''; 
            inputGambar.value = ''; 
            
            // Kembalikan ikon foto ke awal
            labelGambar.innerHTML = ikonFotoSVG; 
            
            // Langsung muat ulang pesannya
            muatPesan(); 
        });
    }

    // Biar bisa kirim pakai tombol Enter di keyboard
    inputPesan.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            kirimPesan();
        }
    });

    // 3. Muat pesan pertama kali, lalu ulangi otomatis setiap 1 detik
    muatPesan();
    setInterval(muatPesan, 1000);
</script>