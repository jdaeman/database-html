<?php
require_once('dbconfig.php');

$id=$_GET['index'];

$query="select * from movie ".
	"where m_id=".$id;

$result=mysqli_query($db, $query);
$info=mysqli_fetch_array($result);
$attr=array('title', 'genre', 'release_date', 'run_time',
	'country', 'admission', 'director', 'attendance', 'grade');

$query_cast=
	"with casting(id, role) as ".
	"(select a_id, role from cast where m_id=".$id.") ".
	"select actor.a_id, actor.name, casting.role ".
	"from actor, casting ".
	"where actor.a_id=casting.id";
$casting=mysqli_query($db, $query_cast);

?>

<html>
	<head>
		<title>Movie Information</title>
		<style>
			#info {
			display:block;
			float:left;
			margin-left:10px;
			text-align:center;
			}

			#trailer {
			display:block;
			float:right;
			text-align:center;
			}

			#info_cast {
			display:block;
			text-align:left;
			}
			#home {
			display:block;
			text-align:right;
			font-style:italic;
			}

			table {
			text-align:center;
			border-collapse:collapse;
			}

			footer{
			position:fixed;
			right:10px;
			bottom:0px;
			height:50px;
			width:auto;
			font-size:15px;
			font-style:italic;
			}

		</style>
	</head>
	
	<body>
		<div id="info">
			<h1>영화 포스터</h1>
			<img src=./image/movie/<?php echo $id; ?>.jpg width='250'>
		</div>


		<div id="info">
			<h1>영화 정보</h1>
			<table border="1">
				<tr>
					<th>제목</th> <th>장르</th> <th>개봉일</th> <th>시간(분)</th>
					<th>국가</th> <th>이용가</th> <th>감독</th> <th>관객수</th> <th>평점</th>
				</tr>
				<tr>
<?php
					foreach($attr as $col)
					{ 
						echo "<td>";
						if ($col == 'attendance')
							echo number_format($info[$col]);
						else		
							echo $info[$col];
						echo "</td>";
					}
?>
				</tr>
			</table>

			<h1>출연 목록</h1>

				<div id="info_cast">		
<?php

				while($list=mysqli_fetch_array($casting))
				{
					echo "<a href=./actor.php?index=".$list['a_id'].">".$list['name']."</a>"."  [";
					echo $list['role']."]<br><br>";
				}
?>

				</div>
		</div>

		<div id='trailer'>

			<?php 
				if ($info['link'])
				{
			?>

			<h1>영화 예고편 보기<h1>
			
			<iframe width="500" height="315" 
			src="<?php echo $info['link'] ?>" 
			frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
			</iframe>

			<?php
				}
				else
					echo "<h1>준비 중 입니다.</h1>";
			?>
			

		</div>				

	<footer>
		<a href='home.html'>---> Click me for go to main home page.</a>
	</footer>

	</body>
</html>



	

