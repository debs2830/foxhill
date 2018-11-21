<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
// send email
mail("debs2830@gmail.com","My subject2",$msg);

$headers = "From: info@flatsatfoxhill.com" . "\r\n" ;
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'Bcc: debs2830@gmail.com' . "\r\n";

mail("debs2830@gmail.com","My subject4",$msg, $headers);

?>