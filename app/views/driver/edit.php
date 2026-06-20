<div style="padding: 20px; max-width: 500px; margin: 30px auto; background: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h3 style="color: var(--biru-unnes); border-bottom: 2px solid #ccc; padding-bottom: 10px; margin-top: 0;">Edit Profil Anda</h3>
    
    <form action="<?= BASEURL; ?>/driver/updateProfil" method="POST" enctype="multipart/form-data">
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Lengkap:</label>
            <input type="text" name="nama" value="<?= $data['profil']['nama']; ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;" required>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Jenis Kendaraan (Motor):</label>
            <input type="text" name="jenis_motor" value="<?= $data['profil']['jenis_motor']; ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;" required>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Plat Nomor:</label>
            <input type="text" name="plat_nomor" value="<?= $data['profil']['plat_nomor']; ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;" required>
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Foto Profil Baru (Opsional):</label>
            <div style="margin-bottom: 10px;">
                <img src="<?= BASEURL; ?>/assets/img/<?= $data['profil']['foto_profil']; ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; border: 2px solid #ccc;">
            </div>
            <input type="file" name="foto_profil" accept="image/png, image/jpeg, image/jpg" style="width: 100%;">
            <small style="color: #888; display: block; margin-top: 5px;">*Biarkan kosong jika tidak ingin mengubah foto saat ini.</small>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" style="flex: 1; padding: 12px; background-color: var(--biru-unnes); color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 15px;">Simpan</button>
            <a href="<?= BASEURL; ?>/driver" style="flex: 1; padding: 12px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 5px; text-align: center; font-weight: bold; font-size: 15px; box-sizing: border-box;">Batal</a>
        </div>
    </form>
</div>