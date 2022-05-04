<?php
$menus = count($lib->show_menu());
$sells = count($lib->show("SELECT * FROM vw_pesanan WHERE status = 'selesai'"));
$customers = count($lib->show("SELECT * FROM pengguna"));
$fastfood = $lib->kategori(1);
$desert = $lib->kategori(2);
$drinks = $lib->kategori(3);
$healthy = $lib->kategori(4);
$meals = $lib->kategori(5);
?>
<div class="row">
    <div class="col-md-4">
        <div class="card card-stats">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">sell</i>
                </div>
                <p class="card-category">Total Penjualan</p>
                <h3 class="card-title"><?= $sells ?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">info</i> Total Pesanan Terselesaikan
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">fastfood</i>
                </div>
                <p class="card-category">Jumlah Menu</p>
                <h3 class="card-title"><?= $menus; ?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">info</i> Total Menu yang Tersedia
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">people</i>
                </div>
                <p class="card-category">Jumlah Pelanggan</p>
                <h3 class="card-title"><?= $customers ?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">info</i> Total Akun Pelanggan
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">timeline</i>
                </div>
                <h4 class="card-title">Grafik Penjualan
                </h4>
            </div>
            <div class="card-body">
                <div id="LineChart" class="ct-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-danger">
                <div class="card-icon">
                    <i class="material-icons">pie_chart</i>
                </div>
                <h4 class="card-title">Kategori Menu</h4>
            </div>
            <div class="card-body">
                <div id="PieChart" class="ct-chart"></div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="card-category">Legend</h6>
                    </div>
                    <div class="col-md-12">
                        <i class="fa fa-circle text-info"></i> Fast Food
                        <i class="fa fa-circle text-danger"></i> Dessert
                        <i class="fa fa-circle text-warning"></i> Drinks
                        <i class="fa fa-circle text-success"></i> Healthy
                        <i class="fa fa-circle text-primary"></i> Meals
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.ct-series-d .ct-area,.ct-series-d .ct-slice-donut-solid,.ct-series-d .ct-slice-pie{fill:#4CA750}
.ct-series-e .ct-area,.ct-series-e .ct-slice-donut-solid,.ct-series-e .ct-slice-pie{fill:#9C27B0}
</style>
<script>
    new Chartist.Line('#LineChart', {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            series: [
                [24, 34, 55, 48, 50, 60, 70],
            ]
        }, {
            fullWidth: true,
        });

        var data = {
            series: [<?= $fastfood ?>, <?= $desert ?>, <?= $drinks ?>, <?= $healthy ?>, <?= $meals ?>],
        };

        var sum = function(a, b) {
            return a + b
        };

        new Chartist.Pie('#PieChart', data, {
            labelInterpolationFnc: function(value) {
                return Math.round(value / data.series.reduce(sum) * 100) + '%';
            }
        });
</script>