<?php
require_once '../../utility/library.php';
$lib = new Library();
$query = "SELECT * FROM vw_pesanan WHERE status = 'selesai'";
if (isset($_POST['bulan']) && isset($_POST['tahun']) && $_POST['bulan'] != '' && $_POST['tahun'] != '') {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $query = "SELECT * FROM vw_pesanan WHERE status = 'selesai' AND month(tgl_pemesanan)='$bulan' AND year(tgl_pemesanan)='$tahun'";
} elseif (isset($_POST['bulan']) && isset($_POST['tahun']) && $_POST['bulan'] == '' && $_POST['tahun'] != '') {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $query = "SELECT * FROM vw_pesanan WHERE status = 'selesai' AND year(tgl_pemesanan)='$tahun'";
}

$laporan = $lib->show($query);
?>
<table class="table">
    <thead class="text-primary">
        <th>
            No
        </th>
        <th>
            ID Transaksi
        </th>
        <th>
            Tgl Transaksi
        </th>
        <th>
            Pemesan
        </th>
        <th>
            Alamat
        </th>
        <th class="text-right">
            Total Bayar
        </th>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $total = 0;
        ?>
        <?php foreach ($laporan as $lap) : ?>
            <tr>
                <td>
                    <?= $no; ?>
                </td>
                <td>
                    TRX<?= $lap['id_pesanan'] ?>
                </td>
                <td>
                    <?= date('d F Y ', strtotime($lap['tgl_pemesanan'])) ?>
                </td>
                <td>
                    <?= $lap['username'] ?>
                </td>
                <td>
                    <?= $lap['alamat'] ?>
                </td>
                <td class="text-right">
                    <?= rupiah($lap['total']) ?>
                </td>
            </tr>
            <?php $total += $lap['total']; ?>
            <?php $no++; ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4"></td>
            <td class=" td-total">Total Pendapatan</td>
            <td class=" td-price" style="font-size: large;"><?= rupiah($total) ?></td>
        </tr>
    </tfoot>
</table>