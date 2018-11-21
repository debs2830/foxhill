<?php

//maintenance form
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['Client_name'])) {
  $email = "maintenance@foxhillapts.com" ;// to email address
  //$email = 'debs2830@gmail.com';

   $subject = "Service Request"; //subject
   $from = $_POST['email']; // from email address
   if (isset($_POST['Permission'])) {
	   $permission = 'YES';
   }else{
$permission = 'NO';
	   }
   $body = "Name: " . $_POST['Client_name'] .  "\nApt: " . $_POST['Unit_Number'] . "\nEmail Adress:  " . $_POST['email']  . "&nbsp;\nHome Phone: " . $_POST['Home_Phone'] . "\nUnit: " . $_POST['unit'] . "\nUnit Option: " . $_POST['UnitOption'] . "\nBuilding Number: ". $_POST['Building'] ."\nComments: " . $_POST['Comments'] . "\nPermission to Enter: " . $permission  . "\nPets: " . $_POST['pets'] ;
$bodyResponse = "Thank you for contacting us.  We will address your problem as quickly as possible \n Flats @ Foxhill Maintenance Team";


mail( $email,'Maintenance Form', $body); 
$headers = "From: donotreply@foxhillapts.com" . "\r\n" ;

mail( $_POST['email'] , 'Maintenance Request', $bodyResponse, $headers); 

die('success' );
	} else {
	$owner_email=(isset($_POST['owneremail'])? $_POST['owneremail']  : 'info@flatsatfoxhill.com' );
	    $subject= (isset($_POST['subject'])? $_POST['subject']  : 'A message from your site visitor ' );


	//SMTP server settings	
	$host = '';
    $port = '465';//"587";
    $username = '';
    $password = '';

    $user_email='';    
	$message_body='';
	$message_type='html';

	$max_file_size=50;//MB 
	$file_types='/(doc|docx|txt|pdf|zip|rar)$/';
	$error_text='something goes wrong';
	$error_text_filesize='File size must be less than';
	$error_text_filetype='Failed to upload file. This file type is not allowed. Accepted files types: doc, docx, txt, pdf, zip, rar.';

	$private_recaptcha_key='6LeZwukSAAAAACmqrbLmdpvdhC68NLB1c9EA5vzU'; //localhost
	
	
	$use_recaptcha=isset( $_POST["recaptcha_challenge_field"]) and isset($_POST["recaptcha_response_field"]);
	$use_smtp=($host=='' or $username=='' or $password=='');
	$max_file_size*=1048576;

	if($owner_email=='' || $owner_email=='#'){
		die('Attention, recipient e-mail is not set! Please define "owner_email" variable in the MailHanlder.php file.');
	}

	if(preg_match('/^(127\.|192\.168\.)/',$_SERVER['REMOTE_ADDR'])){
		die('Attention, contact form will not work locally! Please upload your template to a live hosting server.');
	}

	if($use_recaptcha){
		require_once('recaptchalib.php');
		$resp = recaptcha_check_answer ($private_recaptcha_key,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		if (!$resp->is_valid){
			die ('wrong captcha');
		}
	}
 if (!isset($_POST['subject']))  {
	if(isset($_POST['name']) and $_POST['name'] != ''){$message_body .= '<p>Visitor: ' . $_POST['name'] . '</p>' . "\n" . '<br>' . "\n"; }
	if(isset($_POST['email']) and $_POST['email'] != ''){$message_body .= '<p>Email Address: ' . $_POST['email'] . '</p>' . "\n" . '<br>' . "\n"; $user_email=$_POST['email'];}
	
	if(isset($_POST['state']) and $_POST['state'] != ''){$message_body .= '<p>State: ' . $_POST['state'] . '</p>' . "\n" . '<br>' . "\n";}
	if(isset($_POST['phone']) and $_POST['phone'] != ''){$message_body .= '<p>Phone Number: ' . $_POST['phone'] . '</p>' . "\n" . '<br>' . "\n";}	
	if(isset($_POST['fax']) and $_POST['fax'] != ''){$message_body .= '<p>Fax Number: ' . $_POST['fax'] . '</p>' . "\n" . '<br>' . "\n";}
	if(isset($_POST['message']) and $_POST['message'] != ''){$message_body .= '<p>Message: ' . $_POST['message'] . '</p>' . "\n";}	
	if(isset($_POST['stripHTML']) and $_POST['stripHTML']=='true'){$message_body = strip_tags($message_body);$message_type='text';}

	
} else {
	 $requestatour = 1;
$time = strtotime($_POST['date']. ' 2018');

$newformat = date('m/d/Y',$time);
	 
	 
	$fullname = trim($_POST['name']);
	$parts = explode(" ", $fullname);
	$lastname = array_pop($parts);
	$firstname = implode(" ", $parts);
$TourTime ='';
	 	 if(isset($_POST['todayTour']) and $_POST['todayTour'] != ''){$TourTime .= 'Tour Today Selection : ' . $_POST['todayTour']  ; }
				if(isset($_POST['tommorowTour']) and $_POST['tommorowTour'] != ''){
					   if(isset($_POST['date']) and $_POST['date'] != ''){$TourTime .= '-Future Date: ' . $_POST['date']  . "-" ; 	}
					$TourTime .= '-Time Selection: ' . $_POST['tommorowTour'] ; 	}
	 $TourTime .= '-'. 	 $_POST['message'] ;
	 $housesize = '';
	 if(isset($_POST['housesize']) and $_POST['housesize'] != ''){$housesize = $_POST['housesize'] ; }
	 $message_body ="First Name: $firstname<br>
Last Name: $lastname<br>
Address: <br>
Address2: <br>
City: <br>
State: <br>
Zip: <br>
Home Phone: $_POST[phone] <br>
Cell Phone: <br>
Work Phone: <br>
Service: Apartment Tour <br>
Date: $newformat<br>
Start Time: <br>
End Time: <br>
Email Address: $_POST[email] 
<br>Lead Channel: Property Website <br>
Lead Priority: 2 <br>
Desired Move In: <br>
Desired Lease Term: <br>
Desired Unit Type: $housesize<br>
Desired Bedrooms: <br>
Desired Bathrooms: <br>
Pets: <br>
Pet Types: <br>
Comments: $TourTime";
	


	//$message_body = strip_tags($message_body);$message_type='text';			
	 						
	 		 
}
	
	
try{
	include "libmail.php";
	$m= new Mail("utf-8");
	$m->From('info@flatsatfoxhill.com');
	
	$m->To('fhleasingforward@gmail.com');

	if (isset( $requestatour))  {
	$m->To('TheFlatsatFoxHill.FNAM@lead2lease.com');					 
								
	}
	$m->Subject($subject);
	$m->Body($message_body,$message_type);
	//$m->log_on(true);

	if(isset($_FILES['attachment'])){
		if($_FILES['attachment']['size']>$max_file_size){
			$error_text=$error_text_filesize . ' ' . $max_file_size . 'bytes';
			die($error_text);			
		}else{			
			if(preg_match($file_types,$_FILES['attachment']['name'])){
				$m->Attach($_FILES['attachment']['tmp_name'],$_FILES['attachment']['name'],'','attachment');
			}else{
				$error_text=$error_text_filetype;
				die($error_text);				
			}
		}		
	}
	if(!$use_smtp){
		$m->smtp_on( $host, $username, $password, $port);
	}

	if($m->Send()){
		die('success');
	}	
	
}catch(Exception $mail){
	die($mail);
}	
	}//other email
?>