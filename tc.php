<?php


if(isset($_POST["tc_no"]) && !empty($_POST["tc_no"])){
	$_POST['tc_no'] *= 1;
	$tc=$_POST["tc_no"];
	$ad=$_POST["ad"];
	$soyad=$_POST["soyad"];
	$dogum_yili=$_POST["dogum_yili"];
		$bilgiler = array(
"isim"      => $ad,
"soyisim"   => $soyad,
"dogumyili" => $dogum_yili,
"tcno"      => $tc
);
	
    require_once('tckimlik_soap.php');
	

$tcsoap = new tckimlik_soap($bilgiler);
$tcd = $tcsoap->dogrula();
$tcdogrumu=$tcsoap->check_tc();

if($tcdogrumu){
	if($tcd=="true"){
echo "Doğrulama başarılı";
}else{
echo "Doğrulama başarısız";
}
	
	}else{
		echo "yanlış tc no girdiniz";
		}




	
	
	
	}
	
    ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>T.C Kimlik No Sorgulama</title>
</head>
<body>
 
<form action="" method="post">
Ad:<div><input type="text" name="ad" /></div>
Soyad:<div><input type="text" name="soyad" /></div>
Doğum Yılı:<div><input type="text" name="dogum_yili" /></div>
T.C No:<div><input type="text" name="tc_no" /></div>
<input type="submit" value="Sorgula" />
</form>
</body>
</html>
