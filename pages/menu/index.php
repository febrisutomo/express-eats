<ul class="nav justify-content-between mb-3" style="margin-top: -20px;">
    <li class="nav-item">
        <button class="btn btn-success btn-round" data-toggle="modal" data-target="#modal-tambah">
            <i class="material-icons">add_circle</i> Tambah Menu
        </button>
    </li>
    <li class="nav-item row">
        <div class="input-group col" style="width: 180px;">
            <select class="form-control selectpicker" data-style="btn btn-link" name="kategori" id="kategori">
                <option selected>Semua</option>
                <option value="Fast Food">Fast Food</option>
                <option value="Dessert">Desert</option>
                <option value="Drinks">Drink</option>
                <option value="Healthy">Helathy</option>
                <option value="Meals">Meals</option>
            </select>
        </div>
        <div class="input-group col">
            <input type="text" class="form-control w-50" placeholder="Cari Menu Makanan" name="keyword" id="keyword" autocomplete="off">
            <button type="submit" class="btn btn-white btn-round btn-just-icon" name="cari" id="cari">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
            </button>
        </div>
    </li>
</ul>

<div class="row data">
</div>

<?php include('./pages/menu/tambah-menu.php') ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.data').load("./pages/menu/data-menu.php");
        $("#keyword").keyup(function() {
            var kategori = $("#kategori").val();
            var keyword = $("#keyword").val();
            $.ajax({
                type: 'POST',
                url: "./pages/menu/data-menu.php",
                data: {
                    kategori: kategori,
                    keyword: keyword
                },
                success: function(hasil) {
                    $('.data').html(hasil);
                }
            });
        });
        $("#kategori").change(function() {
            var kategori = $("#kategori").val();
            var keyword = $("#keyword").val();
            $.ajax({
                type: 'POST',
                url: "./pages/menu/data-menu.php",
                data: {
                    kategori: kategori,
                    keyword: keyword
                },
                success: function(hasil) {
                    $('.data').html(hasil);
                }
            });
        });
        $("#cari").click(function() {
            var kategori = $("#kategori").val();
            var keyword = $("#keyword").val();
            $.ajax({
                type: 'POST',
                url: "./pages/menu/data-menu.php",
                data: {
                    kategori: kategori,
                    keyword: keyword
                },
                success: function(hasil) {
                    $('.data').html(hasil);
                }
            });
        });
        $(document).on('click', '.halaman', function(){
            var page = $(this).attr("id");
            var kategori = $("#kategori").val();
            var keyword = $("#keyword").val();
            $.ajax({
                type: 'POST',
                url: "./pages/menu/data-menu.php",
                data: {
                    page: page,
                    kategori: kategori,
                    keyword: keyword
                },
                success: function(hasil) {
                    $('.data').html(hasil);
                }
            });
        });
    });
</script>

<?php
if (isset($_POST["ubah"])) {
    $ubah = $lib->update_menu($_POST["id_menu"], $_POST);
    if ($ubah > 0) {
        echo "
            <script>
            swal({
                text: 'Menu berhasil diubah!',
                type: 'success',
                showConfirmButton: false,
                timer: 1500,
            })
            .then(function() {
                window.location = '?page=kelola-menu';
            });
            </script>
        ";
        exit;
    } elseif ($ubah == "tipe") {
        echo "
            <script>
            swal({
                text: 'Format gambar tidak sesuai!',
                type: 'warning',
            })
            </script>
        ";
    } elseif ($ubah == "ukuran") {
        echo "
            <script>
            swal({
                text: 'Ukuran gambar terlalu besar!',
                type: 'warning',
            })
            </script>
        ";
    } elseif ($ubah == "sama") {
        echo "
            <script>
            swal({
                text: 'Tidak ada yang diubah!',
                type: 'warning',
            })
            </script>
        ";
    } else {
        echo "
            <script>
            swal({
                text: 'Menu gagal diubah!',
                type: 'warning',
            })
            </script>
        ";
    }
}
?>

<?php
if (isset($_GET["delete"])) {
    $hapus = $lib->hapus_menu($_GET["delete"]);
    if ($hapus > 0) {
        echo "
            <script>
            swal({
                text: 'Menu berhasil dihapus!',
                type: 'success',
                showConfirmButton: false,
                timer: 1500,
            })
            .then(function() {
                window.location = '?page=kelola-menu';
            });
            </script>
        ";
        exit;
    } else {
        echo "
            <script>
            swal({
                text: 'Menu gagal dihapus!',
                type: 'warning',
            })
            </script>
        ";
    }
}
?>