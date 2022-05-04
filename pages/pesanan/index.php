<?php

$orders = $lib->show("SELECT * FROM vw_pesanan WHERE status != 'selesai'");
$histories = $lib->show("SELECT * FROM vw_pesanan WHERE status = 'selesai'");

// $tes = $lib->db; 
// $query = $tes->prepare("SELECT * FROM vw_pesanan");
// $query->execute();
// $orders = $query->fetchAll();

?>

<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">Pesanan Berlangsung</h4>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table dataTable">
                <thead class=" text-primary">
                    <th>
                        ID Pesanan
                    </th>
                    <th>
                        Tanggal
                    </th>
                    <th>
                        Jam
                    </th>
                    <th>
                        Pemesan
                    </th>
                    <!-- <th>
                        Alamat Lengkap
                    </th> -->
                    <th>
                        Total Bayar
                    </th>
                    <th>
                        Metode
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Aksi
                    </th>
                </thead>
                <tbody>

                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td>
                                TRX<?= $order['id_pesanan'] ?>
                            </td>
                            <td>
                                <?= date('d F Y', strtotime($order['tgl_pemesanan'])); ?>
                            </td>
                            <td>
                                <?= date('H:i', strtotime($order['tgl_pemesanan'])); ?>
                            </td>
                            <td>
                                <?= $order['username'] ?>
                            </td>
                            <!-- <td>
                                <?= $order['alamat'] ?>
                            </td> -->
                            <td>
                                <?= rupiah($order['total']) ?>
                            </td>
                            <td>
                                <?php if ($order['metode_pembayaran'] == 'tunai') : ?>
                                    <div class="text-primary">
                                        <?= $order['metode_pembayaran']; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="text-info">
                                        <?= $order['metode_pembayaran']; ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- <div class="badge badge-default">
                                    <?= $order['status']; ?>
                                    <?= (($order['metode_pembayaran'] == 'non tunai') and ($order['bukti_pembayaran'] == NULL)) ? 'Pembayaran' : ''  ?>
                                </div> -->
                                <?php if ($order['status'] == 'menunggu') : ?>
                                    <div class="badge badge-default">
                                        menunggu
                                        <?= (($order['metode_pembayaran'] == 'non tunai') and ($order['bukti_pembayaran'] == NULL)) ? 'Pembayaran' : 'Diproses'  ?>
                                    </div>
                                <?php elseif ($order['status'] == 'diproses') : ?>
                                    <div class="badge badge-default">
                                        sedang diproses
                                    </div>
                                <?php elseif ($order['status'] == 'diantar') : ?>
                                    <div class="badge badge-default">
                                        sedang diantar
                                    </div>
                                <?php else : ?>
                                    <div class="badge badge-success">
                                        <?= $order['status']; ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($order['status'] == 'menunggu') : ?>
                                    <button type="button" rel="tooltip" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-detail<?= $order['id_pesanan']; ?>" <?= (($order['metode_pembayaran'] == 'non tunai') and ($order['bukti_pembayaran'] == NULL)) ? 'disabled' : ''  ?>>
                                        <i class="material-icons">local_dining</i> Proses
                                    </button>
                                <?php elseif ($order['status'] == 'diproses') : ?>
                                    <button type="button" rel="tooltip" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-detail<?= $order['id_pesanan']; ?>">
                                        <i class="material-icons">delivery_dining</i> Antar
                                    </button>
                                <?php else : ?>
                                    <button type="button" rel="tooltip" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail<?= $order['id_pesanan']; ?>">
                                        <i class="material-icons">info</i> Detail
                                    </button>
                                <?php endif; ?>
                                <?php include('./pages/pesanan/detail-pesanan.php') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">history</i>
        </div>
        <h4 class="card-title">Pesanan Terselesaikan</h4>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table dataTable">
                <thead class=" text-primary">
                    <th>
                        ID Pesanan
                    </th>
                    <th>
                        Tanggal
                    </th>
                    <th>
                        Jam
                    </th>
                    <th>
                        Pemesan
                    </th>
                    <th>
                        Alamat Lengkap
                    </th>
                    <th>
                        Total Bayar
                    </th>
                    <th>
                        Metode
                    </th>
                    <!-- <th>
                        Status
                    </th> -->
                    <th>
                        Aksi
                    </th>
                </thead>
                <tbody>

                    <?php foreach ($histories as $history) : ?>
                        <tr>
                            <td>
                                TRX<?= $history['id_pesanan'] ?>
                            </td>
                            <td>
                                <?= date('d F Y', strtotime($history['tgl_pemesanan'])); ?>
                            </td>
                            <td>
                                <?= date('H:i', strtotime($history['tgl_pemesanan'])); ?>
                            </td>
                            <td>
                                <?= $history['username'] ?>
                            </td>
                            <td>
                                <?= $history['alamat'] ?>
                            </td>
                            <td>
                                <?= rupiah($history['total']) ?>
                            </td>
                            <td>
                                <?php if ($history['metode_pembayaran'] == 'tunai') : ?>
                                    <div class="text-primary">
                                        <?= $history['metode_pembayaran']; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="text-info">
                                        <?= $history['metode_pembayaran']; ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" rel="tooltip" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail<?= $history['id_pesanan']; ?>">
                                    <i class="material-icons">info</i> Detail
                                </button>
                                <?php include('./pages/pesanan/detail-pesanan.php') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>