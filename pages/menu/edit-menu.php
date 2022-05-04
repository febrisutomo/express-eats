<div class="modal fade" tabindex="-1" id="modal-edit<?= $menu['id_menu']; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title d-flex justify-content-start">Edit Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fileinput fileinput-new text-center w-100" data-provides="fileinput">
                                <div class="fileinput-new thumbnail img-raised">
                                    <img src="../../assets/img/img_menu/<?= $menu['img_menu']; ?>" rel="nofollow">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                <div>
                                    <span class="btn btn-raised btn-round btn-default btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="img_menu" />
                                    </span>
                                    <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                </div>
                            </div>
                            <input type="text" name="id_menu" value="<?= $menu['id_menu']; ?>" hidden>
                            <input type="text" name="img_lama" value="<?= $menu['img_menu']; ?>" hidden>
                        </div>
                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="nama_menu">Nama Menu</label>
                                <input type="text" class="form-control" name="nama_menu" value="<?= $menu['nama_menu']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="id_kategori">Kategori Menu</label>
                                <svg>
                                    <use xlink:href="#select-arrow-down"></use>
                                </svg>
                                <svg class="sprites">
                                    <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                        <polyline points="1 1 5 5 9 1"></polyline>
                                    </symbol>
                                </svg>
                                <select class="" name="id_kategori">
                                    <option value="1" <?= $menu['id_kategori'] == "1" ? 'selected' : ''; ?>>Fast Food</option>
                                    <option value="2" <?= $menu['id_kategori'] == "2" ? 'selected' : ''; ?>>Desert</option>
                                    <option value="3" <?= $menu['id_kategori'] == "3" ? 'selected' : ''; ?>>Drink</option>
                                    <option value="4" <?= $menu['id_kategori'] == "4" ? 'selected' : ''; ?>>Helathy</option>
                                    <option value="5" <?= $menu['id_kategori'] == "5" ? 'selected' : ''; ?>>Meals</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_menu">Harga Menu</label>
                                <input type="number" class="form-control" name="harga_menu" value="<?= $menu['harga_menu']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="desc_menu">Deskripsi Menu</label>
                                <textarea class="form-control" name="desc_menu" rows="3"><?= $menu['desc_menu']; ?></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary" name="ubah">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    select {
        -webkit-appearance: none;
        padding: 0;
        padding-bottom: 4px;
        width: 100%;
        border: none;
        border-bottom: 1.5px solid lightgrey;
        cursor: pointer;
        font-size: 14px;
        outline: none;
    }

    select:focus {
        border-bottom: 2px solid purple;
    }

    .sprites {
        position: absolute;
        width: 0;
        height: 0;
        pointer-events: none;
        user-select: none;
    }

    svg {
        position: absolute;
        right: 12px;
        top: calc(50%);
        width: 10px;
        height: 6px;
        stroke-width: 2px;
        stroke: #9098a9;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        pointer-events: none;
    }
</style>