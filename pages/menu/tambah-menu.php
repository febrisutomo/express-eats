<div class="modal fade" tabindex="-1" id="modal-tambah" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title d-flex justify-content-start">Tambah Menu</h4>
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
                                    <img src="./assets/img/img_menu/menu.jpg" rel="nofollow">
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
                        </div>
                        <div class="col-md-8">

                            <div class="form-group row">
                                <label for="nama_menu">Nama Menu</label>
                                <input type="text" class="form-control" name="nama_menu" required>
                            </div>
                            <div class="form-group">
                                <label for="id_kategori">Kategori Menu</label>
                                <select class="form-control selectpicker" data-style="btn btn-link" name="id_kategori">
                                    <option value="1">Fast Food</option>
                                    <option value="2">Desert</option>
                                    <option value="3">Drink</option>
                                    <option value="4">Helathy</option>
                                    <option value="5">Meals</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="harga_menu">Harga Menu</label>
                                <input type="number" class="form-control" name="harga_menu" required>
                            </div>
                            <div class="form-group">
                                <label for="desc_menu">Deskripsi Menu</label>
                                <textarea class="form-control" name="desc_menu" rows="3" required></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST["tambah"])) {
    $tambah = $lib->tambah_menu($_POST);
    if ($tambah > 0) {
        echo "
            <script>
            swal({
                text: 'Menu berhasil ditambahkan!',
                type: 'success',
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = '?page=kelola-menu';
            });
            </script>
        ";
        exit;
    } 
    elseif ($tambah == "tipe") {
        echo "
            <script>
            swal({
                text: 'Format gambar tidak sesuai!',
                type: 'warning',
            })
            </script>
        ";
    }
     elseif ($tambah == "ukuran") {
        echo "
            <script>
            swal({
                text: 'Ukuran gambar terlalu besar!',
                type: 'warning',
            })
            </script>
        ";
    }
     else {
        echo "
            <script>
            swal({
                text: 'Menu gagal ditambahkan!',
                type: 'warning',
            })
            </script>
        ";
    }
}
?>
