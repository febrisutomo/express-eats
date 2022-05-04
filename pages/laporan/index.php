<?php
$menu = $lib->show_menu();
?>

<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">sell</i>
        </div>
        <h4 class="card-title">Laporan Penjualan</h4>
    </div>
    <div class="card-body">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <div class="input-group col" style="width: 180px;">
                    <select class="form-control selectpicker" data-style="btn btn-link" name="bulan" id="bulan">
                        <option value="">BULAN</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                        <option value="">BULAN</option>
                    </select>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group col" style="width: 160px;">
                    <select class="form-control selectpicker" data-style="btn btn-link" name="tahun" id="tahun">
                        <option value="" selected>TAHUN</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>

                </div>
            </li>
        </ul>
        <div class="table-responsive data">

        </div>
    </div>
</div>
<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">fastfood</i>
        </div>
        <h4 class="card-title">Laporan Menu Makanan</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table dataTable" id="laporan">
                <thead class="text-primary">
                    <th>
                        No
                    </th>
                    <th>
                        Nama Menu
                    </th>
                    <th>
                        Kategori
                    </th>
                    <!-- <th>
                        Harga
                    </th> -->
                    <th>
                        Favorit
                    </th>
                    <th>
                        Rating
                    </th>
                    <th>
                        Ulasan
                    </th>
                    <th>
                        Terjual
                    </th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $rating = 0;
                    $ulasan = 0;
                    $terjual = 0;
                    $x = 0;
                    ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $m['nama_menu'] ?></td>
                            <td><?= $m['nama_kategori'] ?></td>
                            <!-- <td><?= rupiah($m['harga_menu']) ?></td> -->
                            <td><?= $lib->jml_favorit($m['id_menu']); ?></td>
                            <td><?= $lib->avg_rating($m['id_menu']); ?></td>
                            <td><?= count($lib->show_ulasan($m['id_menu'])); ?></td>
                            <td><?= $lib->menu_terjual($m['id_menu']) ? $lib->menu_terjual($m['id_menu']) : '0'; ?></td>
                        </tr>
                        <?php
                        $rating += $lib->avg_rating($m['id_menu']);
                        if ($lib->avg_rating($m['id_menu']) != 0) {
                            $x += 1;
                        } else {
                            $x += 0;
                        }
                        $ulasan += count($lib->show_ulasan($m['id_menu']));
                        $terjual += $lib->menu_terjual($m['id_menu'])
                        ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-primary" style="font-size:large"><?= $rating / $x ?></td>
                        <td class="text-primary" style="font-size:large"><?= $ulasan ?></td>
                        <td class="text-primary" style="font-size:large"><?= $terjual ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.data').load("./pages/laporan/data-laporan.php");
        $("#bulan").change(function() {
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            $.ajax({
                type: 'POST',
                url: "./pages/laporan/data-laporan.php",
                data: {
                    bulan: bulan,
                    tahun: tahun,
                },
                success: function(hasil) {
                    $('.data').html(hasil);
                }
            });
        });
        $("#tahun").change(function() {
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            $.ajax({
                type: 'POST',
                url: "./pages/laporan/data-laporan.php",
                data: {
                    bulan: bulan,
                    tahun: tahun,
                },
                success: function(hasil) {
                    $('.data').html(hasil);
                }
            });
        });
    });
</script>