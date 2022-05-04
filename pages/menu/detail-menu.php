<?php
$id_menu = $menu['id_menu'];
$rating = $lib->avg_rating($id_menu) ?? 0;
$star = (float) $rating / 5 * 100;
$ulasan = $lib->show_ulasan($id_menu);
$jml_ulasan = count($ulasan);
?>
<div class="modal fade" tabindex="-1" id="modal-detail<?= $menu['id_menu']; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title d-flex justify-content-start">Detail Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="rounded mb-3 w-100" src="../assets/img/img_menu/<?= $menu['img_menu']; ?>">
                    </div>
                    <div class="col-md-8">
                        <p class="font-weight-bold" style="font-size: xx-large;"><?= $menu['nama_menu']; ?></p>
                        <p class=" text-gray"><i class="material-icons">fastfood</i> <?= $menu['nama_kategori']; ?></p>

                        <p class=" text-success" style="font-size: x-large;"><?= rupiah($menu['harga_menu']); ?></p>
                        <?= $menu['desc_menu']; ?>
                    </div>
                </div>
                <p style="font-size: 18px;">Review</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="font-weight-bold text-center" style="font-size: 72px;">
                            <?= $rating; ?>
                        </div>
                        <p class="text-center mt-4"><?= "dari " . $jml_ulasan . " ulasan"; ?></p>
                        <div class="d-flex justify-content-center" style="margin-top: -12px;">
                            <div class="rating">
                                <div class="rating-upper" style="width: <?= $star; ?>%">
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                </div>
                                <div class="rating-lower">
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php if(empty($ulasan)): ?>
                        <p>Yah, belum ada user yang meberikan ulasan :(</p>
                        <?php else: ?>
                        <?php foreach ($ulasan as $u): ?>
                        <div class="row ulasan">
                            <div class="col-md-1">
                                <i class="material-icons" style="font-size: 30px;">account_circle</i>
                            </div>
                            <div class="col-md-11">
                                <p style="margin-top: -12px;"><?= $u['username'] ?></p>
                                <div style="margin-top: -16px;">
                                    <div class="rating rating2">
                                        <div class="rating-upper" style="width: <?= $u['rating']/5*100?>%">
                                            <span>★</span>
                                            <span>★</span>
                                            <span>★</span>
                                            <span>★</span>
                                            <span>★</span>
                                        </div>
                                        <div class="rating-lower">
                                            <span>★</span>
                                            <span>★</span>
                                            <span>★</span>
                                            <span>★</span>
                                            <span>★</span>
                                        </div>
                                    </div>
                                    <span style="font-size: small;"><?= date('d F Y', strtotime($u['tgl_ulasan'])) ?></span>
                                </div>
                                <p style="font-size: small;"><?= $u['deskripsi']?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button> -->
            </div>
        </div>
    </div>
</div>


<style>
    .rating {
        display: inline-block;
        unicode-bidi: bidi-override;
        color: #888888;
        font-size: 35px;
        height: 35px;
        width: auto;
        margin: 0;
        position: relative;
        padding: 0;
    }

    .rating2 {
        font-size: 20px;
        height: 20px;
    }

    .rating-upper {
        color: orange;
        padding: 0;
        position: absolute;
        z-index: 1;
        display: flex;
        top: 0;
        left: 0;
        overflow: hidden;
    }

    .rating-lower {
        padding: 0;
        display: flex;
        z-index: 0;
    }
</style>