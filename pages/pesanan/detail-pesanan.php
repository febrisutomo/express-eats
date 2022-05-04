<div class="modal fade" tabindex="-1" id="modal-detail<?= $order['id_pesanan']; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pesanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table>
                        <tr style="line-height: 0;">
                            <td>ID Pesanan</td>
                            <td>: TRX<?= $order['id_pesanan'] ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>Tanggal Pesan</td>
                            <td>: <?= date('d F Y H:i', strtotime($order['tgl_pemesanan'])); ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>Pemesan</td>
                            <td>: <?= $order['nama'] ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>Alamat</td>
                            <td>: <?= $order['alamat'] ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>No HP</td>
                            <td>: <?= $order['no_hp'] ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>Metode Pembayaran</td>
                            <td>: <?= $order['metode_pembayaran'] ?></td>
                        </tr>
                    </table>
                    <?php if ($order['metode_pembayaran'] == 'tunai') : ?>
                    <?php else : ?>
                        <p>
                            <button class="btn btn-sm btn-default" type="button" data-toggle="collapse" data-target="#bukti<?= $order['id_pesanan'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                Bukti Pembayaran
                            </button>
                        </p>
                        <div class="collapse" id="bukti<?= $order['id_pesanan'] ?>">
                            <img src="./assets/img/bukti_pembayaran/<?= $order['bukti_pembayaran'] ?>" alt="" width="400px">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped  mt-1">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Catatan</th>
                                <th class="text-right">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_pesanan = $order['id_pesanan'];
                            $details = $lib->show("CALL detail_pesanan($id_pesanan)");
                            ?>
                            <?php foreach ($details as $detail) : ?>
                                <tr>
                                    <td class="td-name">
                                        <a href="#"><?= $detail['nama_menu'] ?></a>
                                        <!-- <br><small>by Dolce&amp;Gabbana</small> -->
                                    </td>
                                    <td>
                                        <?= rupiah($detail['harga_menu']); ?>
                                    </td>
                                    <td>
                                        <?= $detail['jumlah'] ?>
                                    </td>
                                    <td style="font-size:small">
                                        <?= empty($detail['catatan']) ? '-' : $detail['catatan']; ?>
                                    </td>
                                    <td class="text-right">
                                        <?= rupiah($detail['sub_total']); ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td class=" td-total">TOTAL BAYAR :</td>
                                <td class=" td-price"><?= rupiah($order['total']); ?></td>
                            </tr>

                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <?php if ($order['status'] == 'menunggu') : ?>
                    <a href="?page=kelola-pesanan&status=diproses&id=<?= $order['id_pesanan'] ?>" class="btn btn-warning">Proses Pesanan</a>
                <?php elseif ($order['status'] == 'diproses') : ?>
                    <a href="?page=kelola-pesanan&status=diantar&id=<?= $order['id_pesanan'] ?>" class="btn btn-success">Antar Pesanan</a>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal-detail<?= $history['id_pesanan']; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pesanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table>
                        <tr style="line-height: 0;">
                            <td>ID Pesanan</td>
                            <td>: TRX<?= $history['id_pesanan'] ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>Tanggal Pesan</td>
                            <td>: <?= date('d F Y H:i', strtotime($history['tgl_pemesanan'])); ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>Pemesan</td>
                            <td>: <?= $history['nama'] ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>Alamat</td>
                            <td>: <?= $history['alamat'] ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>No HP</td>
                            <td>: <?= $history['no_hp'] ?></td>
                        </tr>
                        <tr style="line-height: 0;">
                            <td>Metode Pembayaran</td>
                            <td>: <?= $history['metode_pembayaran'] ?></td>
                        </tr>
                        <!-- <tr style="line-height: 0;">
                            <td>Bukti Pembayaran</td>
                            <td>: <img src="assets/img/img_menu/60c9985997720.jpg" alt="" width="300px"></td>
                        </tr> -->
                    </table>
                    <?php if ($history['metode_pembayaran'] == 'tunai') : ?>
                    <?php else : ?>
                        <p>
                            <button class="btn btn-sm btn-default" type="button" data-toggle="collapse" data-target="#bukti<?= $history['id_pesanan'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                Bukti Pembayaran
                            </button>
                        </p>
                        <div class="collapse" id="bukti<?= $history['id_pesanan'] ?>">
                            <img src="./assets/img/bukti_pembayaran/<?= $order['bukti_pembayaran'] ?>" alt="" width="300px">
                        </div>
                    <?php endif; ?>
                    <table class="table rounded mt-1">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Catatan</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_pesanan = $history['id_pesanan'];
                            $details = $lib->show("CALL detail_pesanan($id_pesanan)");
                            ?>
                            <?php foreach ($details as $detail) : ?>
                                <tr>
                                    <td class="td-name">
                                        <a href="#"><?= $detail['nama_menu'] ?></a>
                                        <!-- <br><small>by Dolce&amp;Gabbana</small> -->
                                    </td>
                                    <td>
                                        <?= rupiah($detail['harga_menu']); ?>
                                    </td>
                                    <td>
                                        <?= $detail['jumlah'] ?>
                                    </td>
                                    <td style="font-size:small">
                                        <?= empty($detail['catatan']) ? '-' : $detail['catatan']; ?>
                                    </td>
                                    <td>
                                        <?= rupiah($detail['sub_total']); ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class=" float-right">TOTAL BAYAR :</td>
                                <td class="td-number text-primary font-weight-bold"><?= rupiah($history['total']); ?></td>
                            </tr>

                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET["status"])) {
    $status = $_GET["status"];
    $id = $_GET["id"];
    $update = $lib->update_pesanan($status, $id);
    if ($update > 0) {
        echo "
            <script>
            swal({
                text: 'Pesanan akan $status!',
                type: 'success',
                showConfirmButton: false,
                timer: 1500,
            })
            .then(function() {
                window.location = '?page=kelola-pesanan';
            });
            </script>
        ";
        exit;
    } else {
        echo "
            <script>
            swal({
                text: 'Pesanan akan $status!',
                type: 'warning',
            })
            </script>
        ";
    }
}
?>