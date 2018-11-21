<?php

function testaim($x_params) {

$DEBUGGING					= 1;				# Display additional information to track down problems
$TESTING					= 1;				# Set the testing flag so that transactions are not live
$ERROR_RETRIES				= 2;				# Number of transactions to post if soft errors occur

$auth_net_login_id			= "8Q2b4qBt2y";
$auth_net_tran_key			= "57bWY88pp7U7T5nE";
# $auth_net_url				= "https://test.authorize.net/gateway/transact.dll";
#  Uncomment the line ABOVE for test accounts or BELOW for live merchant accounts
  $auth_net_url				= "https://secure.authorize.net/gateway/transact.dll";
$testmode= ($x_params[2]=='test'?"TRUE":"FALSE");
$authnet_values				= array
(
	"x_login"				=> $auth_net_login_id,
	"x_version"				=> "3.1",
	"x_delim_char"			=> "|",
	"x_delim_data"			=> "true",
	"x_test_request" 		=> $testmode,//change when not testing
	"x_type"				=> "AUTH_CAPTURE",
	"x_method"				=> "CC",
 	"x_tran_key"			=> $auth_net_tran_key,
 	"x_relay_response"		=> "FALSE",
	"x_card_num"			=> $x_params[0],
	"x_exp_date"			=> $x_params[1],
	"x_description"			=> $x_params[7],
	"x_amount"				=> $x_params[6],
	"x_first_name"			=> $x_params[2],
	"x_last_name"			=> $x_params[3],
	"x_address"				=> $x_params[4],
	"x_city"				=> $x_params[5],
	"x_state"				=> $x_params[8],
	"x_zip"					=> $x_params[9],
	"x_phone"  				=> $x_params[10],
"x_email"					=>$x_params[11],
	"x_invoice_num" =>$x_params[12],
	"CustomerBirthMonth"	=> "",
	"CustomerBirthDay"		=> "",
	"CustomerBirthYear"		=> "",
	"SpecialCode"			=> "",
);

$fields = "";
foreach( $authnet_values as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";


###$ch = curl_init("https://test.authorize.net/gateway/transact.dll"); 
###  Uncomment the line ABOVE for test accounts or BELOW for live merchant accounts
 $ch = curl_init("https://secure.authorize.net/gateway/transact.dll"); 
				
			
curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response. ###
$resp = curl_exec($ch); //execute post and get results
curl_close ($ch);
	

$tok = strtok($text,"|");
while(!($tok === FALSE)){
//while ($tok) {
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tok."<br>";
    $tok = strtok("|");
}


$howMany = substr_count($resp, "|");
$text = $resp;
$h = substr_count($text, "|");
$h++;
for($j=1; $j <= $h; $j++){
	$p = strpos($text, "|");

	if ($p === false) { // note: three equal signs

			//  x_delim_char is obviously not found in the last go-around

			if($j>=69){


			} else {


			}



	}else{

		$p++;

		//  We found the x_delim_char and accounted for it . . . now do something with it

		//  get one portion of the response at a time
		$pstr = substr($text, 0, $p);

		//  this prepares the text and returns one value of the submitted
		//  and processed name/value pairs at a time
		//  for AIM-specific interpretations of the responses
		//  please consult the AIM Guide and look up
		//  the section called Gateway Response API
		 $pstr_trimmed = substr($pstr, 0, -1); // removes "|" at the end
//$response = $pstr_trimmed;
		if($pstr_trimmed==""){
			$pstr_trimmed="NO VALUE RETURNED";
		}

		switch($j){

			case 1:
				

				$fval="";
				if($pstr_trimmed=="1"){
					$fval="Approved";
				}elseif($pstr_trimmed=="2"){
					$fval="Declined";
				}elseif($pstr_trimmed=="3"){
					$fval="Error";
				}

				//echo $fval;
		$response = $fval;

				//echo "<br>";
				break;

			case 2:
				
				break;

			case 3:
				
				break;

			case 4:
				
				break;

			case 5:
				
			
				break;

			case 6:
				
				break;

			case 7:
				//echo "Transaction ID: ";

				//echo "</td>";
				///echo "<td class=\"v\">";

				//echo $pstr_trimmed;
				$transID = $pstr_trimmed;
				//echo "<br>";
				break;

			case 8:
				
				break;

			case 9:
				
				break;

			case 10:
				
				break;

			case 11:
				
				break;

			case 12:
				
				break;

			case 13:
				
				break;

			case 14:
				
				break;

			case 15:
				
				break;

			case 16:
				
				break;

			case 17:
				
				break;

			case 18:
			
				break;

			case 19:
				
				break;

			case 20:
				
				break;

			case 21:
				
				break;

			case 22:
				
				break;

			case 23:
				
				break;

			case 24:
				
				break;

			case 25:
			
				break;

			case 26:
				
				break;

			case 27:
				
				break;

			case 28:
				
				break;

			case 29:
			
				break;

			case 30:
				
				break;

			case 31:
				
				break;

			case 32:
				
				break;

			case 33:
				
				break;

			case 34:
				
				break;

			case 35:
				
				break;

			case 36:
				
				break;

			case 37:
				
				break;

			case 38:
				
				break;

			case 39:
				
				break;

			case 40:
			case 41:
			case 42:
			case 43:
			case 44:
			case 45:
			case 46:
			case 47:
			case 48:
			case 49:
			case 50:
			case 51:
			case 52:
			case 53:
			case 54:
			case 55:
			case 55:
			case 56:
			case 57:
			case 58:
			case 59:
			case 60:
			case 61:
			case 62:
			case 63:
			case 64:
			case 65:
			case 66:
			case 67:
			case 68:
				
				break;

			default:

			

				break;
		}


		// remove the part that we identified and work with the rest of the string
		$text = substr($text, $p);

	}

}

return ($response);
}
?>