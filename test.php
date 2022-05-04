<?php
require_once 'utility/library.php';
$lib = new Library();

$menu = $lib->show_menu(3);
// foreach ($menu as $m){
//     echo $m['id_menu'];
// }
echo $menu['img_menu'];
// $ulasan = $lib->jml_ulasan(1);
// echo $ulasan;

