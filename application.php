<?php ini_set('display_errors', 0); ?><?php 

require_once('Connections/Application.php'); ?>
<?php require_once('php_aim.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

	#dim arrParams(52)
		$arrParams[0] = $_POST['cardnum'];
		$arrParams[1] = $_POST['ExpMonth'] . "/" . $_POST['ExpYear'];#
		$arrParams[2] = $_POST['app_first_name'];
		$arrParams[3]= $_POST['app_last_name'];
	$arrParams[4]= $_POST['current_address']; //address
	
	$arrParams[10]= $_POST['home_phone']; //phone
		$arrParams[11] = $_POST['email'];
	$arrParams[12] = ""; //invoice id
if ( $_POST['deposit_app_initial'] != "" ) {

$amtDep = 	0 ;
//echo $arrParams[6];
}
//payment is dependant on choice they select
	$arrParams[6] = 	$_POST['payment'];



		$howheard = (isset($_POST['howheardOther']) && $_POST['howheardOther'] != ""  ? $_POST['howheardOther']: $_POST['howheard']);
		
		
		$strArrayVal = testaim($arrParams);
		//echo $strArrayVal;
		if ( $strArrayVal == "Approved" ) {
	
  $insertSQL = sprintf("INSERT INTO `Application` (app_last_name, app_first_name, app_middle_name, app_ss_num, app_marital_status, app_dob, dri_lic, driver_lic_State, home_phone, cell_phone, email, co_app_last_name, co_app_first_name, occ1, co_app_middle_name, co_app_ss_num, occ1_bd1, occ1_ss1, occ1_rel1, occ2, occ2_bd2, occ2_ss2, occ2_rel2, occ3_bd3, occ3, occ3_ss3, occ3_rel3, occ4, occ4_bd4, occ4_ss4, occ4_rel4, current_address, mort_rent, rent1_dates_from, rent1_dates_to, mor_name, mor_add, mor_phone, previous_add, reason_move, previous_mort_rent, previous_mort_dates_from, previous_mort_dates_to, employ_full, employ_part, retired, employ_self, unemployed, curr_employer, current_occ_address, current_occ_position, current_occ_phone_num, cur_employ_date_from, cur_employ_date_to, cur_salary, cur_slry_per_hour, cur_slry_per_year, cur_slry_per_pay, cur_slry_cycle_weekly, cur_slry_cycle_monthly, cur_slry_cycle_biweekly, cur_sup_name, cur_sup_num, pre_employ, pre_pos, pre_occ_add, pre_occ_phone, pre_occ_dates_form, pre_occ_dates_to, previous_salary, pre_slry_per_hour, pre_slry_per_year, pre_slry_per_pay, prev_sup_name, pre_sup_num, emerg_name, emerg_phone, emerg_rel, Ems_RemoveContents, cred_ref_name, cre_ref_phone, other_loans, have_visa, have_mcard, have_dis_card, have_amer_ex, have_cred_other, dis_date_case, evicted_date, filed_bankruptcy, evicted, refuse_rent, app_initial, deposit_app_initial, sig_name, sig_date, cardnum, ExpMonth, ExpYear, sp_dob, prev_mor_name, pre_mor_phone, pre_mor_add, pre_reason_move, previous_add2, previous_mort_rent2, previous_mort_dates_from2, previous_mort_dates_to2, pre_mor_name2, pre_mor_add2, pre_mor_phone2, pre_reason_move2, comment , invoice,own_pet, RentOwn,convictedPossession, convictedoffense,SecondTenantName,secondTenantFirstName,secondTenantMi,petAmount,petOneType, petTwoType, PetOneBreed,PetTwoBreed,PetOneWeight,PetTwoWeight,MakeOne,MakeTwo,ModelOne,ModelTwo,LicensePlateOne,LicensePlateTwo ,serviceAnimal,howheard) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
                       GetSQLValueString($_POST['app_last_name'], "text"),
                       GetSQLValueString($_POST['app_first_name'], "text"),
                       GetSQLValueString($_POST['app_middle_name'], "text"),
                       GetSQLValueString($_POST['app_ss_num'], "text"),
                       GetSQLValueString($_POST['app_marital_status'], "text"),
                       GetSQLValueString($_POST['app_dob'], "text"),
                       GetSQLValueString($_POST['dri_lic'], "text"),
                       GetSQLValueString($_POST['driver_lic_State'], "text"),
                       GetSQLValueString($_POST['home_phone'], "text"),
                       GetSQLValueString($_POST['cell_phone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['co_app_last_name'], "text"),
                       GetSQLValueString($_POST['co_app_first_name'], "text"),
                       GetSQLValueString($_POST['occ1'], "text"),
                       GetSQLValueString($_POST['co_app_middle_name'], "text"),
                       GetSQLValueString($_POST['co_app_ss_num'], "text"),
                       GetSQLValueString($_POST['occ1_bd1'], "text"),
                       GetSQLValueString($_POST['occ1_ss1'], "text"),
                       GetSQLValueString($_POST['occ1_rel1'], "text"),
                       GetSQLValueString($_POST['occ2'], "text"),
                       GetSQLValueString($_POST['occ2_bd2'], "text"),
                       GetSQLValueString($_POST['occ2_ss2'], "text"),
                       GetSQLValueString($_POST['occ2_rel2'], "text"),
                       GetSQLValueString($_POST['occ3_bd3'], "text"),
                       GetSQLValueString($_POST['occ3'], "text"),
                       GetSQLValueString($_POST['occ3_ss3'], "text"),
                       GetSQLValueString($_POST['occ3_rel3'], "text"),
                       GetSQLValueString($_POST['occ4'], "text"),
                       GetSQLValueString($_POST['occ4_bd4'], "text"),
                       GetSQLValueString($_POST['occ4_ss4'], "text"),
                       GetSQLValueString($_POST['occ4_rel4'], "text"),
                       GetSQLValueString($_POST['current_address'], "text"),
                       GetSQLValueString($_POST['mort_rent'], "text"),
                       GetSQLValueString($_POST['rent1_dates_from'], "text"),
                       GetSQLValueString($_POST['rent1_dates_to'], "text"),
                       GetSQLValueString($_POST['mor_name'], "text"),
                       GetSQLValueString($_POST['mor_add'], "text"),
                       GetSQLValueString($_POST['mor_phone'], "text"),
                       GetSQLValueString($_POST['previous_add'], "text"),
                       GetSQLValueString($_POST['reason_move'], "text"),
                       GetSQLValueString($_POST['previous_mort_rent'], "text"),
                       GetSQLValueString($_POST['previous_mort_dates_from'], "text"),
                       GetSQLValueString($_POST['previous_mort_dates_to'], "text"),
                       GetSQLValueString(isset($_POST['employ_full']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['employ_part']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['retired']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['employ_self']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['unemployed']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['curr_employer'], "text"),
                       GetSQLValueString($_POST['current_occ_address'], "text"),
                       GetSQLValueString($_POST['current_occ_position'], "text"),
                       GetSQLValueString($_POST['current_occ_phone_num'], "text"),
                       GetSQLValueString($_POST['cur_employ_date_from'], "text"),
                       GetSQLValueString($_POST['cur_employ_date_to'], "text"),
                       GetSQLValueString($_POST['cur_salary'], "text"),
                       GetSQLValueString(isset($_POST['cur_slry_per_hour']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['cur_slry_per_year']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['cur_slry_per_pay']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['cur_slry_cycle_weekly']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['cur_slry_cycle_monthly']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['cur_slry_cycle_biweekly']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['cur_sup_name'], "text"),
                       GetSQLValueString($_POST['cur_sup_num'], "text"),
                       GetSQLValueString($_POST['pre_employ'], "text"),
                       GetSQLValueString($_POST['pre_pos'], "text"),
                       GetSQLValueString($_POST['pre_occ_add'], "text"),
                       GetSQLValueString($_POST['pre_occ_phone'], "text"),
                       GetSQLValueString($_POST['pre_occ_dates_form'], "text"),
                       GetSQLValueString($_POST['pre_occ_dates_to'], "text"),
                       GetSQLValueString($_POST['previous_salary'], "text"),
                       GetSQLValueString(isset($_POST['pre_slry_per_hour']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['pre_slry_per_year']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['pre_slry_per_pay']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['prev_sup_name'], "text"),
                       GetSQLValueString($_POST['pre_sup_num'], "text"),
                       GetSQLValueString($_POST['emerg_name'], "text"),
                       GetSQLValueString($_POST['emerg_phone'], "text"),
                       GetSQLValueString($_POST['emerg_rel'], "text"),
                       GetSQLValueString($_POST['Ems_RemoveContents'], "text"),
                       GetSQLValueString($_POST['cred_ref_name'], "text"),
                       GetSQLValueString($_POST['cre_ref_phone'], "text"),
                       GetSQLValueString($_POST['other_loans'], "text"),
                       GetSQLValueString(isset($_POST['have_visa']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['have_mcard']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['have_dis_card']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['have_amer_ex']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['have_cred_other'], "text"),
                       GetSQLValueString($_POST['dis_date_case'], "text"),
                       GetSQLValueString($_POST['evicted_date'], "text"),
                       GetSQLValueString($_POST['filed_bankruptcy'], "text"),
                       GetSQLValueString($_POST['evicted'], "text"),
                       GetSQLValueString($_POST['refuse_rent'], "text"),
                       GetSQLValueString($_POST['app_initial'], "text"),
                       GetSQLValueString($_POST['deposit_app_initial'], "text"),
                       GetSQLValueString($_POST['sig_name'], "text"),
                       GetSQLValueString($_POST['sig_date'], "text"),
                       GetSQLValueString($_POST['cardnum'], "text"),
                       GetSQLValueString($_POST['ExpMonth'], "text"),
                       GetSQLValueString($_POST['ExpYear'], "text"),
                       GetSQLValueString($_POST['sp_dob'], "text"),
                       GetSQLValueString($_POST['prev_mor_name'], "text"),
                       GetSQLValueString($_POST['pre_mor_phone'], "text"),
                       GetSQLValueString($_POST['pre_mor_add'], "text"),
                       GetSQLValueString($_POST['pre_reason_move'], "text"),
                       GetSQLValueString($_POST['previous_add2'], "text"),
                       GetSQLValueString($_POST['previous_mort_rent2'], "text"),
                       GetSQLValueString($_POST['previous_mort_dates_from2'], "text"),
                       GetSQLValueString($_POST['previous_mort_dates_to2'], "text"),
                       GetSQLValueString($_POST['pre_mor_name2'], "text"),
                       GetSQLValueString($_POST['pre_mor_add2'], "text"),
                       GetSQLValueString($_POST['pre_mor_phone2'], "text"),
                       GetSQLValueString($_POST['pre_reason_move2'], "text"),
					      GetSQLValueString($_POST['comment'], "text"),
					                          GetSQLValueString($arrParams[6], "text"),
					  GetSQLValueString(isset($_POST['own_pet']) ? "true" : "", "defined","'1'","'0'"),
GetSQLValueString($_POST['RentOwn'], "text"),
GetSQLValueString(isset($_POST['convictedPossession']) ? "true" : "", "defined","'1'","'0'"),
GetSQLValueString(isset($_POST['convictedoffense']) ? "true" : "", "defined","'1'","'0'"),
GetSQLValueString($_POST['SecondTenantName'], "text"),
GetSQLValueString($_POST['secondTenantFirstName'], "text"),
GetSQLValueString($_POST['secondTenantMi'], "text"),
GetSQLValueString($_POST['petAmount'], "text"),
GetSQLValueString($_POST['petOneType'], "text"),
GetSQLValueString($_POST['petTwoType'], "text"),
GetSQLValueString($_POST['PetOneBreed'], "text"),
GetSQLValueString($_POST['PetTwoBreed'], "text"),
GetSQLValueString($_POST['PetOneWeight'], "text"),
GetSQLValueString($_POST['PetTwoWeight'], "text"),
GetSQLValueString($_POST['MakeOne'], "text"),
GetSQLValueString($_POST['MakeTwo'], "text"),
GetSQLValueString($_POST['ModelOne'], "text"),
GetSQLValueString($_POST['ModelTwo'], "text"),
GetSQLValueString($_POST['LicensePlateOne'], "text"),
GetSQLValueString($_POST['LicensePlateTwo'], "text"),
GetSQLValueString($_POST['serviceAnimal'], "text"),
GetSQLValueString($howheard, "text"));
			

  mysql_select_db($database_Application, $Application);
  $Result1 = mysql_query($insertSQL, $Application) or die(mysql_error());
//
//$headers = "From: info@flatsatfoxhill.com" . "\r\n" ;
//			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//   $email = "Leasing@foxhillapts.com,Mstockman2018@gmail.com" ;// to email address
//			 //   $headers.= "Bcc: debs2830@gmail.com";
//
//   $subject = "An Foxhill Application has been filled out."; //subject
// //  $from = "osher@firstnj.com"; // from email address
//
// mail( $email, $subject, "Someone filled out an application online. You can view the application here: http://www.flatsatfoxhill.com/login.php", $headers); 
 
  } else {
  
  echo "There has been a problem processing your credit card. Please try again.";
  }
}



?>