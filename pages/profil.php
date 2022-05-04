<?php
$admin = $lib->show_profil()

?>
<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">contacts</i>
        </div>
        <h4 class="card-title">Akun Admin</h4>
    </div>
    <div class="card-body ">
        <form class="form-horizontal" method="POST" action="">
            <div class="row">
                <label class="col-md-3 col-form-label">Nama Lengkap</label>
                <div class="col-md-9">
                    <div class="form-group has-default">
                        <input type="text" class="form-control" name="nama" value="<?= $admin['nama'] ?>" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-md-3 col-form-label">Alamat Email</label>
                <div class="col-md-9">
                    <div class="form-group has-default">
                        <input type="email" class="form-control" name="email" value="<?= $admin['email'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-md-3 col-form-label">Ganti Password</label>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Tulis Password Baru">
                    </div>
                </div>
            </div>
            <div class="row">
                <button type="submit" name="update" class="btn btn-fill btn-rose m-auto">Update Akun</button>
        </div>
        </form>
    </div>
    <!-- <div class="card-footer">
        
    </div> -->
</div>

<?php
if (isset($_POST['update'])) {
    $update = $lib->update_profil($_POST);
    if ($update > 0) {
        echo "
            <script>
            swal({
                text: 'Profil berhasil diupdate!',
                type: 'success',
                showConfirmButton: false,
                timer: 1500,
            })
            .then(function() {
                window.location = '?page=profil';
            });
            </script>
        ";
        exit;
    }
    elseif($update == 'sama') {
        echo "
            <script>
            swal({
                text: 'Tidak ada yang berubah!',
                type: 'warning',
            })
            </script>
        ";
        exit;
    }
     else {
        echo "
            <script>
            swal({
                text: 'Profil gagal diupdate!',
                type: 'warning',
            })
            </script>
        ";
    }
}
?>