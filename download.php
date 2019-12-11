

<title>Shared file list</title>
<style>

#head {
display:block;
text-align:center;
}

.borde {
border-color:red;
border-style:solid;
}

#list {
display:block;
padding-top:50px;
}

</style>

<div class='border' id='head'>
	<h1>이용가능한 파일 목록</h1>
</div>


<?php

$dir='./upload';
$handle=opendir($dir);

echo "<div class='border' id='list'>";
echo "<table border=1 style='margin-left:auto; margin-right:auto'>";
echo "<tr>";
echo "<th>순서</th>";
echo "<th>파일 이름</th>";
echo "<th>파일 크기(바이트)</th>";
echo "<th>업로드 시간</th>";

echo "</tr>";

$idx=1;

while (($filename = readdir($handle)) != false)
{
	if ($filename == '.' || $filename == '..')
		continue;

	$fullpath=$dir."/".$filename;

?> 

	<td><?php echo $idx++ ?></td>
	<td style='cursor:pointer; text-decoration:underline' onClick="location.href=
	'./push.php?name=<?php echo $fullpath ?>'"><?php echo $filename ?></td>

	<td><?php echo filesize($fullpath) ?></td>
	<td><?php echo date('y/m/d---H:i:s', filemtime($fullpath)) ?></td>

	</tr>
<?php

}

echo "</table>";
echo "</div>";

closedir($handle);

?>
