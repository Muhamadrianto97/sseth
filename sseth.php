<?php
error_reporting(0);
function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,($str[1]));
	return $str[0];
}
function claim($email,$devid){
	$arr = array("\r","	");
	$url = "http://sscoinmedia.tech/EthereumWebService/ethereumBalanceUpdate1.php";
	$h = explode("\n",str_replace($arr,"","Content-Type: application/x-www-form-urlencoded; charset=UTF-8
	User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0.1; vivo 1606 Build/MMB29M)
	Host: sscoinmedia.tech
	Connection: Keep-Alive"));
	$body = "email=$email&devid=$devid&claimok=ok&";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$x = curl_exec($ch); 
	curl_close($ch);
	return json_decode($x,true);
}
echo "#################\n#  @muhtoevill  #\n#   SGB-Team    #\n#  Binary-Team  #\n#################\n";
echo "email	:";
$email = trim(fgets(STDIN));
echo "devid	:";
$devid = trim(fgets(STDIN));
while(TRUE){
	$submit = claim($email,$devid);
	$output = json_encode($submit);
	$balance = getStr($output,'"message":',',');
	$balance = getStr($output,'"ubal":',',');
	$claim = getStr($output,'"claimamt":',',');
	if(strpos($output,"devid")==true){
                $text = " Berhasil Balance: $balance Claim : $claim Credit By:Muhtoevill Delay 5 menit";
                $text1 = "\033[32m".$text."\033[0m";
            }else{
                $text =" GAGAL";
                $text1 = "\033[31m".$text."\033[0m";
        }
	echo date('d-m-Y H:i:s');
	echo $text1."\n";
	sleep(300);
	
}