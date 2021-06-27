<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "netfarm";

$conn = mysqli_connect($host,$user,$pass,$db);
$data = "SELECT batas_waktu FROM pekerjaan";
$query = mysqli_query($conn,$data);

while($r = mysqli_fetch_array($query)){
	echo $r['batas_waktu'];
}