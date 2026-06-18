<div style="display: flex; justify-content: center; gap: 30px; margin-top: 40px; flex-wrap: wrap;">

    <div style="background: var(--putih-bersih); padding: 30px; border-radius: 10px; width: 350px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="color: var(--biru-unnes); margin-top: 0;">Login</h2>
        <p style="font-size: 14px; color: #666;">Sudah punya akun? Silakan masuk.</p>
        
        <form action="<?= BASEURL; ?>/auth/login" method="POST">
            <input type="hidden" name="role_daftar" value="user">

            <label style="font-weight: bold; font-size: 14px;">Nomor HP:</label><br>
            <input type="text" name="no_hp" placeholder="Masukkan No HP" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;" required>

            <label style="font-weight: bold; font-size: 14px;">Password:</label><br>
            <input type="password" name="password" placeholder="Masukkan Password" style="width: 100%; padding: 10px; margin-bottom: 25px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;" required>

            <button type="submit" class="btn-utama" style="width: 100%; padding: 12px; font-size: 16px;">Masuk</button>
        </form>
    </div>


    <div style="background: var(--putih-bersih); padding: 30px; border-radius: 10px; width: 350px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="color: var(--biru-unnes); margin-top: 0;">Sign In</h2>
        <p style="font-size: 14px; color: #666;">Belum punya akun? Daftar dulu yuk!</p>
        
        <form action="<?= BASEURL; ?>/auth/register" method="POST" enctype="multipart/form-data">
            
            <label style="font-weight: bold; font-size: 14px;">Daftar Sebagai:</label><br>
            <select name="role_daftar" id="role_daftar" onchange="tampilkanFormDriver()" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="user">User / Mahasiswa</option>
                <option value="driver">Driver</option>
            </select>

            <label style="font-weight: bold; font-size: 14px;">Nama Lengkap:</label><br>
            <input type="text" name="nama" placeholder="Nama Lengkap" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;" required>

            <label style="font-weight: bold; font-size: 14px;">Nomor HP:</label><br>
            <input type="number" name="no_hp" placeholder="Contoh: 0812345678" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;" required>

            <label style="font-weight: bold; font-size: 14px;">Password:</label><br>
            <input type="password" name="password" placeholder="Buat Password" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;" required>

            <div id="kolom_khusus_driver" style="display: none; background: #EBF8FF; padding: 15px; border-radius: 5px; margin-bottom: 15px; border: 1px dashed var(--biru-unnes);">
                <label style="font-weight: bold; font-size: 14px; color: var(--biru-unnes);">Upload Foto Profil:</label><br>
                <input type="file" name="foto_profil" style="width: 100%; margin-bottom: 15px; font-size: 13px;">

                <label style="font-weight: bold; font-size: 14px; color: var(--biru-unnes);">Jenis Motor:</label><br>
                <input type="text" name="jenis_motor" placeholder="Misal: Vario 125 Hitam" style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">

                <label style="font-weight: bold; font-size: 14px; color: var(--biru-unnes);">Plat Nomor:</label><br>
                <input type="text" name="plat_nomor" placeholder="Misal: H 1234 ABC" style="width: 100%; padding: 8px; margin-bottom: 5px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>

            <button type="submit" style="width: 100%; padding: 12px; font-size: 16px; background-color: var(--biru-unnes); color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">Daftar Sekarang</button>
        </form>
    </div>
</div>

<script>
    function tampilkanFormDriver() {
        var pilihanRole = document.getElementById("role_daftar").value;
        var kotakDriver = document.getElementById("kolom_khusus_driver");
        
        if (pilihanRole === "driver") {
            // Jika memilih Driver, ubah CSS menjadi block (tampil)
            kotakDriver.style.display = "block";
        } else {
            // Jika memilih User, ubah CSS menjadi none (sembunyi)
            kotakDriver.style.display = "none";
        }
    }
</script>