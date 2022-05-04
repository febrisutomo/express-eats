<div class="modal fade" tabindex="-1" id="modal-detail<?= $customer['username']; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pelanggan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="rounded w-100" src="./assets/img/img_pengguna/<?= $customer['img_pengguna']; ?>" alt="">
                    </div>
                    <div class="col-md-8">
                        <table class=" table-striped w-100">
                            <tr>
                                <td>Username</td>
                                <td>: <?= $customer['username']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>: <?= $customer['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <?= $customer['alamat']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: <?= $customer['email']; ?></td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>: <?= $customer['no_hp']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>