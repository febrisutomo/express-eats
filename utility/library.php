<?php
class Library
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "express_eats";
        $username = "root";
        $password = "";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
        $this->nama = "febri";
    }

    public function show($sql)
    {
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public function show_menu($id = false)
    {
        if ($id == false) {
            $query = $this->db->prepare('SELECT * FROM vw_menu');
            $query->execute();
            $result = $query->fetchAll();
        } else {
            $query = $this->db->prepare('SELECT * FROM vw_menu WHERE id_menu= ?');
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();
        }
        return $result;
    }

    public function show_ulasan($id)
    {
        $query = $this->db->prepare('SELECT * FROM ulasan WHERE id_menu = ? ORDER BY id_ulasan DESC');
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function avg_rating($id)
    {
        $query = $this->db->prepare('CALL avg_rate(?)');
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetch();
        $result = $result['avg_rate'];
        return $result;
    }
    public function menu_terjual($id)
    {
        $query = $this->db->prepare('CALL menu_terjual(?)');
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetch();
        $result = $result['terjual'];
        return $result;
    }
    public function jml_favorit($id)
    {
        $query = $this->db->prepare('SELECT * FROM favorit WHERE id_menu = ?');
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetchAll();
        return count($result);
    }

    function upload($gambar)
    {
        $nama_file = $_FILES[$gambar]['name'];
        $tmp_file = $_FILES[$gambar]['tmp_name'];
        $ukuran_file = $_FILES[$gambar]['size'];
        $tipe_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $limit = 1 * 1024 * 1024;
        $ekstensi = ['png', 'jpg', 'jpeg', 'gif'];

        if (!in_array($tipe_file, $ekstensi)) {
            return "tipe";
        } elseif ($ukuran_file > $limit) {
            return "ukuran";
        } else {
            $nama_baru = uniqid();
            $nama_baru .= '.';
            $nama_baru .= $tipe_file;

            move_uploaded_file($tmp_file, './assets/img/' . $gambar . '/' . $nama_baru);
            return $nama_baru;
        }
    }


    public function tambah_menu($data)
    {
        $nama_menu = htmlspecialchars($data['nama_menu']);
        $id_kategori = htmlspecialchars($data['id_kategori']);
        $harga_menu = htmlspecialchars($data['harga_menu']);
        $desc_menu = htmlspecialchars($data['desc_menu']);
        if (empty($_FILES['img_menu']['name'])) {
            $gambar = 'menu.jpg';
        } else {
            $gambar = $this->upload('img_menu');
            if ($gambar == "tipe") {
                return $gambar;
            } elseif ($gambar == "ukuran") {
                return $gambar;
            }
        }
        $query = $this->db->prepare('INSERT INTO menu (nama_menu, id_kategori, harga_menu, desc_menu, img_menu) VALUES (?, ?, ?, ?, ?)');
        $query->bindParam(1, $nama_menu);
        $query->bindParam(2, $id_kategori);
        $query->bindParam(3, $harga_menu);
        $query->bindParam(4, $desc_menu);
        $query->bindParam(5, $gambar);

        $query->execute();
        return $query->rowCount();
    }

    public function update_menu($id, $data)
    {
        $menu = $this->show_menu($id);
        $nama_menu = htmlspecialchars($data['nama_menu']);
        $id_kategori = htmlspecialchars($data['id_kategori']);
        $harga_menu = htmlspecialchars($data['harga_menu']);
        $desc_menu = htmlspecialchars($data['desc_menu']);
        $img_lama = $data['img_lama'];

        if (($nama_menu == $menu['nama_menu']) and
            ($id_kategori == $menu['id_kategori']) and
            ($harga_menu == $menu['harga_menu']) and
            ($desc_menu == $menu['desc_menu']) and
            empty($_FILES['img_menu']['name'])
        ) {
            return "sama";
        } elseif (empty($_FILES['img_menu']['name'])) {
            $gambar = $img_lama;
        } else {
            $gambar = $this->upload('img_menu');
            if ($gambar == "tipe") {
                return $gambar;
            } elseif ($gambar == "ukuran") {
                return $gambar;
            }
            if (file_exists('./assets/img/img_menu/' . $img_lama) and $img_lama != 'menu.jpg') {
                unlink('./assets/img/img_menu/' . $img_lama);
            }
        }

        $query = $this->db->prepare('UPDATE menu SET nama_menu=?, id_kategori=?, desc_menu=?, harga_menu=?, img_menu=? WHERE id_menu = ?');

        $query->bindParam(1, $nama_menu);
        $query->bindParam(2, $id_kategori);
        $query->bindParam(3, $desc_menu);
        $query->bindParam(4, $harga_menu);
        $query->bindParam(5, $gambar);
        $query->bindParam(6, $id);

        $query->execute();
        return $query->rowCount();
    }
   
    public function hapus_menu($id)
    {
        $menu = $this->show_menu($id);
        $gambar = $menu['img_menu'];

        $query = $this->db->prepare("DELETE FROM menu where id_menu=?");
        $query->bindParam(1, $id);
        $query->execute();
        $rowCount = $query->rowCount();

        if ( $rowCount > 0 && file_exists('./assets/img/img_menu/' . $gambar) && $gambar!= 'menu.jpg') {
            unlink('./assets/img/img_menu/' . $gambar);
        }
    
        return $rowCount;
    }

    public function login($data)
    {
        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);

        $query = $this->db->prepare('SELECT * FROM admin WHERE email = ?');
        $query->bindParam(1, $email);
        $query->execute();
        $result = $query->fetch();
        if (count($result) > 0) {
            if ($password == $result['password']) {
                session_start();
                $_SESSION['nama'] = $result['nama'];
                $_SESSION['email'] = $result['email'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function update_pesanan($status, $id)
    {
        $query = $this->db->prepare('UPDATE pesanan SET status = ? WHERE id_pesanan = ?');
        $query->bindParam(1, $status);
        $query->bindParam(2, $id);
        $query->execute();
        return $query->rowCount();
    }


    public function hapus_pengguna($id)
    {
        $query = $this->db->prepare("DELETE FROM pengguna where username=?");

        $query->bindParam(1, $id);

        $query->execute();
        return $query->rowCount();
    }
    public function show_profil(){
        $email = $_SESSION['email'] ;
        $query = $this->db->prepare('SELECT * FROM admin WHERE email=?');
        $query->bindParam(1, $email);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }
    public function update_profil($data){
        $admin = $this->show_profil();
        $nama = $data['nama'];
        $email = $data['email'];
        $password = $data['password'];

        if(($nama == $admin['nama']) AND ($email == $admin['email']) AND ($password == '')){
            return "sama";
        }
        if($password == ''){
            $query = $this->db->prepare("UPDATE admin SET nama = ? WHERE email = ?");
            $query->bindParam(1, $nama);
            $query->bindParam(2, $email);

        }
        else{
            $query = $this->db->prepare("UPDATE admin SET nama = ?, password = ? WHERE email = ?");
            $query->bindParam(1, $nama);
            $query->bindParam(2, $password);
            $query->bindParam(3, $email);
        }
        $query->execute();
        return $query->rowCount();
    }
    public function kategori ($id){
        $query = $this->db->prepare("SELECT COUNT(*) AS jumlah FROM menu WHERE id_kategori = ?");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetch();
        $jumlah = $result['jumlah'];
        return $jumlah;
    }



}

function rupiah($angka)
{

    $hasil_rupiah = "Rp" . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
