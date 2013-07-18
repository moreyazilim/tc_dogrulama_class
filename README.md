tc kimlik doğrulama
==================

tc kimlik doğrulama -ad,soyad,doğum tarihi,tc no ile kullanıcının bilgilerini karşılaştırabilir doğrulayabilirsiniz.

tckimlik_soap.php class 
=====================
kullanımı

require_once('tckimlik_soap.php');
  

$tcsoap = new tckimlik_soap($bilgiler);
$tcd = $tcsoap->dogrula();  //dönen değer true yada undefined
$tcdogrumu=$tcsoap->check_tc();   //dönen değer true yada false validate tc no

if($tcdogrumu){echo "ok";}else{echo "no";}

if($tcd=="true"){ echo "Doğrulama başarılı";}else{ echo "Doğrulama başarısız";}
