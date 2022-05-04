<?php
require_once '../../utility/library.php';
$lib = new Library();
$data = $lib->show("SELECT * FROM pesanan WHERE status ='menunggu'");
echo json_encode(array('result' => $data));
?>