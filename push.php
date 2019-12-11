<?php

$filepath=$_GET['name'];
$filesize=filesize($filepath);
$path_parts=pathinfo($filepath);
$filename=$path_parts['basename'];
$extensioin=$path_parts['extension'];

header("Pargma: public");
header("Expires: 0");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");

ob_clean();
flush();
readfile($filepath);

?>
