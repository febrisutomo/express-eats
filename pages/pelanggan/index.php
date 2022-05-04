<?php
$customers = $lib->show("SELECT * FROM pengguna");
?>
<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">group</i>
        </div>
        <h4 class="card-title">Daftar Akun Pelanggan</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table dataTable">
                <thead class="text-primary">
                    <th>
                        No
                    </th>
                    <th>
                        Username
                    </th>
                    <th>
                        Nama Lengkap
                    </th>
                    <th>
                        Alamat
                    </th>
                    <th>
                        Aksi
                    </th>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($customers as $customer) : ?>
                        <tr>
                            <td>
                                <?= $no; ?>
                            </td>
                            <td>
                                <?= $customer['username'] ?>
                            </td>
                            <td>
                                <?= $customer['nama'] ?>
                            </td>
                            <td>
                                <?= $customer['alamat'] ?>
                            </td>
                            <td class="td-actions">
                                <button type="button" rel="tooltip" class="btn btn-info btn-simple" data-toggle="modal" data-target="#modal-detail<?= $customer['username']; ?>">
                                    <i class="material-icons">info</i> Detail
                                </button>
                                <!-- <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                                    <i class="material-icons">edit</i>
                                </button> -->
                                <a href="?page=kelola-pelanggan&delete=<?= $customer['username'] ?>" type="button" rel="tooltip" class="btn btn-danger btn-simple" onclick="return confirm('Apakah anda yakin ingin menghapus akun <?= $customer['username']; ?>?')">
                                    <i class="material-icons">close</i> Hapus
                                </a>
                                <?php include('./pages/pelanggan/detail-pelanggan.php') ?>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
if (isset($_GET["delete"])) {
    $hapus = $lib->hapus_pengguna($_GET["delete"]);
    if ($hapus > 0) {
        echo "
            <script>
            swal({
                text: 'Akun berhasil dihapus!',
                type: 'success',
                showConfirmButton: false,
                timer: 1500,
            })
            .then(function() {
                window.location = '?page=kelola-pelanggan';
            });
            </script>
        ";
        exit;
    } else {
        echo "
            <script>
            swal({
                text: 'Akun gagal dihapus!',
                type: 'warning',
            })
            </script>
        ";
    }
}
?>