<?php
require_once '../../utility/library.php';
$lib = new Library();
$page = (isset($_POST['page'])) ? $_POST['page'] : 1;
$limit = 8;
$limit_start = ($page - 1) * $limit;
$no = $limit_start + 1;

if (isset($_POST['kategori']) && $_POST['kategori'] != 'Semua') {
    $kategori = $_POST['kategori'];
    $keyword = $_POST['keyword'];
    $keyword = '%' . $keyword . '%';
    $query = "SELECT * FROM vw_menu WHERE nama_kategori = '$kategori' AND nama_menu LIKE '$keyword' ORDER BY id_menu ASC LIMIT $limit_start, $limit";
    $query2 = "SELECT * FROM vw_menu WHERE nama_kategori = '$kategori' AND nama_menu LIKE '$keyword'";
} elseif (isset($_POST['kategori']) && $_POST['kategori'] == 'Semua') {
    $keyword = $_POST['keyword'];
    $keyword = '%' . $keyword . '%';
    $query = "SELECT * FROM vw_menu WHERE nama_menu LIKE '$keyword' ORDER BY id_menu ASC LIMIT $limit_start, $limit";
    $query2 = "SELECT * FROM vw_menu WHERE nama_menu LIKE '$keyword'";
} else {
    $query = "SELECT * FROM vw_menu ORDER BY id_menu ASC LIMIT $limit_start, $limit";
    $query2 = "SELECT * FROM vw_menu";
}
$menus = $lib->show($query);

$total_record = $lib->show($query2);
$total_record = count($total_record);

$jumlah_page = ceil($total_record / $limit);
$jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
$start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
$end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;
?>
<?php if (empty($menus)) : ?>
    <div class=" m-auto">
        <h3>Maaf, menu yang anda cari tidak tersedia! :(</h3>
    </div>
<?php else : ?>
    <div class="row">
        <?php foreach ($menus as $menu) : ?>
            <div class="col-md-3">
                <div class="card card-product">
                    <div class="card-header card-header-image" data-header-animation="true">
                        <a href="#">
                            <img class="img" src="../../assets/img/img_menu/<?= $menu['img_menu']; ?>">
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card-actions text-center">
                            <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button>
                            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="View" data-toggle="modal" data-target="#modal-detail<?= $menu['id_menu']; ?>">
                                <i class="material-icons">art_track</i>
                            </button>
                            <button type="button" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="Edit" data-toggle="modal" data-target="#modal-edit<?= $menu['id_menu']; ?>">
                                <i class="material-icons">edit</i>
                            </button>
                            <a href="?page=kelola-menu&delete=<?= $menu['id_menu']; ?>" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Remove" onclick="return confirm('Apakah anda yakin ingin menghapus <?= $menu['nama_menu']; ?>?')">
                                <i class="material-icons">close</i>
                            </a>
                        </div>
                        <h4 class="card-title text-left">
                            <a href="#"><?= $menu['nama_menu']; ?></a>
                        </h4>
                    </div>
                    <div class="card-footer">
                        <div class="price">
                            <h4 class=" text-success"><?= rupiah($menu['harga_menu']); ?></h4>
                        </div>
                        <div class="stats">
                            <p class="card-category"><i class="material-icons">fastfood</i> <?= $menu['nama_kategori']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('./detail-menu.php') ?>
            <?php include('./edit-menu.php') ?>
        <?php endforeach; ?>
    </div>

    <nav class="ml-auto">
        <ul class="pagination">
            <?php
            if ($page == 1) {
                echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            } else {
                $link_prev = ($page > 1) ? $page - 1 : 1;
                echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            }

            for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($page == $i) ? ' active' : '';
                echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
            }

            if ($page == $jumlah_page) {
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
            } else {
                $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
            }
            ?>
        </ul>
    </nav>
<?php endif; ?>