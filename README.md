tc kimlik doğrulama
==================

tc kimlik doğrulama(N.V.İ) -ad,soyad,doğum tarihi,tc no ile kullanıcının bilgilerini karşılaştırabilir doğrulayabilirsiniz.

tckimlik_soap.php class 
=====================
kullanımı

require_once('tckimlik_soap.php');
  

$tcsoap = new tckimlik_soap($bilgiler);
       
$tc_validate  =  $tcsoap->check_tc();              //dönen değer true yada false 

if($tc_validate){

$tcnvi_validate = $tcsoap->dogrula();               //dönen değer true yada false


      if($tcnvi_validate){echo "Doğrulama başarılı";}else{ echo "Doğrulama başarısız";}
}


GEREKSİNİMLER
=====================
