<?php
/**
* tc sorgula
*
* @author fatih çırak
* @copyright Copyright (c) 2013, Faih çırak
* @link http://www.moreyazilim.com

*/
class tckimlik_soap {

  private $bilgiler;

  public function __construct($bilgiler)
	{
		$this->tc = trim($bilgiler["tcno"]);
		$this->ad = trim($bilgiler["isim"]);
		$this->soyad = trim($bilgiler["soyisim"]);
		$this->dyili = trim($bilgiler["dogumyili"]);

	}
	
	public function tr_toUpper($veri) {
    return strtoupper (str_replace(array ('ı', 'i', 'ğ', 'ü', 'ş', 'ö', 'ç' ),array ('I', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç' ),trim($veri)));
}

    
     public function check_tc(){
		return $this->test();
		}
	private function test()
	  {
		$impossible = array(
			'11111111110',
			'22222222220',
			'33333333330',
			'44444444440',
			'55555555550',
			'66666666660',
			'77777777770',
			'88888888880',
			'99999999990'
		);

    	if ( $this->tc[0]==0 || !ctype_digit($this->tc) || strlen($this->tc)!=11) {
    		return false;
    	} else {
        	for ( $a=0;$a<9;$a=$a+2)
        		$first=$first+$this->tc[$a];
        	for ( $a=1;$a<9;$a=$a+2)
        		$last=$last+$this->tc[$a];
        	for ( $a=0;$a<10;$a=$a+1)
        		$all=$all+$this->tc[$a];

        	if ( ( $first*7-$last )%10!=$this->tc[9] || $all%10!=$this->tc[10]) {
        		return false;
        	} else {
            	foreach ($impossible as $item) {
            		if($this->tc==$item)
            			return false;
            	}
            	return true;
        	}
    	}
	}
	public function dogrula()
	{
		return $this->sorgula_v1_1();
	}

	private function sorgula_v1_1()
	{
		$gonder = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
<soap:Body>
<TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
<TCKimlikNo>'.$this->tc.'</TCKimlikNo>
<Ad>'.$this->tr_toUpper($this->ad).'</Ad>
<Soyad>'.$this->tr_toUpper($this->soyad).'</Soyad>
<DogumYili>'.$this->dyili.'</DogumYili>
</TCKimlikNoDogrula>
</soap:Body>
</soap:Envelope>';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,            "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_POST,           true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,    $gonder);
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array(
'POST /Service/KPSPublic.asmx HTTP/1.1',
'Host: tckimlik.nvi.gov.tr',
'Content-Type: text/xml; charset=utf-8',
'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
'Content-Length: '.strlen($gonder)
));
$gelen = curl_exec($ch);
curl_close($ch);
		return strip_tags($gelen);
        
       
	}



}
