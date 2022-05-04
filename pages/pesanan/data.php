<?php
require_once '../../utility/library.php';
$lib = new Library();
$query = $lib->show("SELECT * FROM pesanan WHERE status ='menunggu'");
$pesanan = count($query);
echo json_encode(array('jumlah' => $pesanan));
?>