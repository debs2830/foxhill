<?php require_once('Connections/Application.php'); ?>
<?php require_once('Connections/verifyLog.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 1;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Application, $Application);
$query_Recordset1 = "SELECT * FROM `Application` ORDER BY ID DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Application) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type=text/javascript>
var gAutoPrint = true;
function printSpecial(divID)
{
    if (document.getElementById != null)
    {
        var html = '<HTML>\n<HEAD>\n';

        if (document.getElementsByTagName != null)
        {
            var headTags = document.getElementsByTagName("head");
            if (headTags.length > 0)
                html += headTags[0].innerHTML;
        }
        
        html += '\n</HE' + 'AD>\n<BODY>\n';
        
        var printReadyElem = document.getElementById(divID);
        
        if (printReadyElem != null)
        {
                html += printReadyElem.innerHTML;
        }
        else
        {
            alert("Could not find the printReady section in the HTML");
            return;
        }
            
        html += '\n</BO' + 'DY>\n</HT' + 'ML>';
        
        var printWin = window.open("","printSpecial");
        printWin.document.open();
        printWin.document.write(html);
        printWin.document.close();
        if (gAutoPrint)
            printWin.print();
            printWin.close();
    }
    else
    {
        alert("Sorry, the print ready feature is only available in modern browsers.");
    }
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Application</title>
<style type="text/css">
<!--
.style1 {
	font-size: 36px
}
-->
</style>
<link href="emeraldgardens/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="text.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" valign="top" background="images/top-bg.gif"><img src="images/login-top.gif" width="800" height="146" /></td>
    </tr>
    <tr>
      <td align="center" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top">
       
<p class="style1">View Applications</p>
<p><a href="search.php">Search for specific applicant:</a></p>
<p>Here will be a list of applications filled out. starting from most recent</p>
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
        <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
        <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
        <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
        <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<p>&nbsp;
Records <?php echo ($startRow_Recordset1 + 1) ?>  of <?php echo $totalRows_Recordset1 ?> </p>
<p><input type="button" name="printMe" onClick="printSpecial('printThis')" value="Print this Application">&nbsp;
<input name="button" type="submit" id="button" onclick="MM_goToURL('parent','deleteApp.php?ID=<?php echo $row_Recordset1['ID']; ?>');return document.MM_returnValue" value="Delete This Application">
</p>
<div id="printThis">
      <div align="left" ></div>
<table width="578" align="center" cellpadding="0" cellspacing="0">
      <?php do { ?>
          <tr>
<?php 

 if ($row_Recordset1['read']== 0) {
echo '<td colspan="6" style="background-color: red; color:white;" class="read">Application: UNREAD - <button class="updatebtn" data-id="'. $row_Recordset1['ID'] .'">MARK AS READ</button></td>';
} else {
echo '<td colspan="6" style="background-color: lightseagreen; color:white;">Application: READ</td>';
} ?>
</tr>
          
              
              <tr>
                <td width="576" align="left"><table width="576" border="0" cellpadding="5" cellspacing="0" bgcolor="#ffffff">
                    <tr>
                      <td width="562" valign="top" bgcolor="#F3E3C8"><table width="550" border="0" cellpadding="2" cellspacing="0">
                  <tr>
                            <td colspan="6" align="left" valign="top" bgcolor="#d49977" class="text"><b class="hometext">Applicant Name</b></td>
                        </tr>
                          <tr>
                            <td width="105" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left" class="text">Last:</div></td>
                            <td width="148" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['app_last_name']; ?>&nbsp;</td>
                            <td width="39" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">First: </div></td>
                            <td width="111" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['app_first_name']; ?>&nbsp;</td>
                            <td width="67" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">MI: </div></td>
                            <td width="81" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['app_middle_name']; ?>                            &nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text">Soc. Sec. # </td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['app_ss_num']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text">Marital Status: &nbsp;</td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['app_marital_status']; ?>&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text">Date of Birth: </td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['app_dob']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#F3E3C8" class="text">*Email Address:</td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#F3E3C8" class="text"><span class="text"><?php echo $row_Recordset1['email']; ?></span></td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Drivers Lic # </div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['dri_lic']; ?>&nbsp; </td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text">State Issued: &nbsp;</td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['driver_lic_State']; ?>&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text">Home Phone: </td>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['home_phone']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text">Cell phone: &nbsp;</td>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['cell_phone']; ?>&nbsp;</td>
                          </tr><tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="twelvepix"><strong>How did you hear of our community? </strong><br />
                            <?php echo $row_Recordset1['howheard']; ?>
</td>
                          </tr> 
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#d49977" class="text"><strong class="hometext">Co-Applicant Name </strong></td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left" class="text">Last:</div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['co_app_last_name']; ?>&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">First: </div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['co_app_first_name']; ?>&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">MI: </div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['co_app_middle_name']; ?>                            </td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text">Soc. Sec. # </td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['co_app_ss_num']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text">&nbsp;</td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#F3E3C8" class="text">*DOB (M/D/Y): </td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#F3E3C8" class="text"><span class="text"><?php echo $row_Recordset1['sp_dob']; ?></span></td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#F3E3C8" class="text">&nbsp;</td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#F3E3C8" class="text">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" valign="bottom" bgcolor="#fceed7" class="text">&nbsp;</td>
                            <td align="left" valign="bottom" nowrap="nowrap" bgcolor="#fceed7" class="text">&nbsp;</td>
                            <td colspan="2" align="left" valign="bottom" bgcolor="#fceed7" class="text">&nbsp;</td>
                            <td colspan="2" align="left" valign="bottom" bgcolor="#fceed7" class="text">&nbsp;</td>
                          </tr> <tr>
                            <td align="left" valign="middle" bgcolor="#F0F4F3" class="twelvepix"><div align="left" class="twelvepix">Last:</div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#F0F4F3" class="twelvepix"><?php echo $row_Recordset1['SecondTenantName']; ?>&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#F0F4F3" class="twelvepix"><div align="left">First: </div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#F0F4F3" class="twelvepix"><?php echo $row_Recordset1['secondTenantFirstName']; ?>&nbsp;</td>
                            <td align="left" valign="middle" bgcolor="#F0F4F3" class="twelvepix"><div align="left">MI: </div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#F0F4F3" class="twelvepix"><?php echo $row_Recordset1['secondTenantMi']; ?>                            </td>
                          </tr>
                          <tr>
                            <td align="left" valign="bottom" bgcolor="#fceed7" class="text">Other Occupants:</td>
                            <td align="left" valign="bottom" nowrap="nowrap" bgcolor="#fceed7" class="text">&nbsp;Birth Date:</td>
                            <td colspan="2" align="left" valign="bottom" bgcolor="#fceed7" class="text">SS#:</td>
                            <td colspan="2" align="left" valign="bottom" bgcolor="#fceed7" class="text">Relationship:</td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ1']; ?>&nbsp;</td>
                            <td align="left" valign="top" nowrap="nowrap" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ1_bd1']; ?>&nbsp;&nbsp;</td>
                            <td colspan="2" align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ1_ss1']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ1_rel1']; ?>&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ2']; ?>&nbsp;</td>
                            <td align="left" valign="top" nowrap="nowrap" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ2_bd2']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ2_ss2']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ2_rel2']; ?>&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ3']; ?>&nbsp;</td>
                            <td align="left" valign="top" nowrap="nowrap" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ3_bd3']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ3_ss3']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ3_rel3']; ?>&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ4']; ?>&nbsp;</td>
                            <td align="left" valign="top" nowrap="nowrap" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ4_bd4']; ?></td>
                            <td colspan="2" align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ4_ss4']; ?>&nbsp;</td>
                            <td colspan="2" align="left" valign="top" bordercolor="#000000" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['occ4_rel4']; ?>&nbsp;</td>
                          </tr>
                           <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix"><strong class="hometext">Pet Information: </strong></td>
                          </tr>
                          <tr>
                            <td colspan="4" align="left" valign="top" bgcolor="#F0F4F3" class="twelvepix">Do you own a pet ?
                              <input name="own_pet" type="radio" value="yes" <?php if (!(strcmp($row_Recordset1['own_pet'],"1"))) {echo "checked=\"checked\"";} ?> />
                              yes &nbsp;&nbsp;&nbsp;
                              <input name="own_pet" type="radio" value="no" <?php if (!(strcmp($row_Recordset1['own_pet'],"0"))) {echo "checked=\"checked\"";} ?>/>
								no </td><td colspan="2" align="left" valign="top" bgcolor="#F0F4F3" class="twelvepix">
									Amount of Pets:<?php echo $row_Recordset1['petAmount']; ?>
								</td>
                            </tr>
                             <tr> <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              <input <?php if (!(strcmp($row_Recordset1['petOneType'],"Dog"))) {echo "checked=\"checked\"";} ?> name="dog" type="checkbox" id="dog" value="yes" />
                              <span class="hometext">Dog</span> &nbsp;&nbsp;&nbsp;
                              <input <?php if (!(strcmp($row_Recordset1['petOneType'],"Cat"))) {echo "checked=\"checked\"";} ?> name="cat" type="checkbox" id="cat" value="yes" />
                              <span class="hometext">Cat </span> &nbsp;
                              &nbsp;&nbsp;
								 </td>                    
                      <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              	Breed:<?php echo $row_Recordset1['PetOneBreed']; ?>
								 </td>                    
                          <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              	Weight:<?php echo $row_Recordset1['PetOneWeight']; ?>
								 </td>                    
                          </tr><tr> <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              <input <?php if (!(strcmp($row_Recordset1['petTwoType'],"Dog"))) {echo "checked=\"checked\"";} ?> name="dog" type="checkbox" id="dog" value="yes" />
                              <span class="hometext">Dog</span> &nbsp;&nbsp;&nbsp;
                              <input <?php if (!(strcmp($row_Recordset1['petTwoType'],"Cat"))) {echo "checked=\"checked\"";} ?> name="cat" type="checkbox" id="cat" value="yes" />
                              <span class="hometext">Cat </span> &nbsp;
                              &nbsp;&nbsp;
								 </td>                    
                      <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              	Breed:<?php echo $row_Recordset1['PetTwoBreed']; ?>
								 </td>                    
                          <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              	Weight:<?php echo $row_Recordset1['PetTwoWeight']; ?>
								 </td>                    
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix"><strong class="hometext">Is a service animal: 
                            <?php if (!(strcmp($row_Recordset1['serviceAnimal'],"1"))) {echo "Yes";} ?>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix"><strong class="hometext">Vehicle Information: </strong></td>
                          </tr>
                          <tr> <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                             Make:<?php echo $row_Recordset1['MakeOne']; ?>
								 </td>                    
                      <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              	Model:<?php echo $row_Recordset1['ModelOne']; ?>
								 </td>                    
                          <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              	License Plate:<?php echo $row_Recordset1['TwoWeLicensePlateTwo']; ?>
								 </td>                    
                          </tr><tr> <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                             Make:<?php echo $row_Recordset1['MakeTwo']; ?>
								 </td>                    
                      <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              	Model:<?php echo $row_Recordset1['ModelTwo']; ?>
								 </td>                    
                          <td colspan="2" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix">
                              	License Plate:<?php echo $row_Recordset1['TwoWeLicensePlateTwo']; ?>
								 </td>                    
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#CFDEDB" class="twelvepix"><strong class="hometext">Please provide 5 years of continuous history: </strong></td>
                          </tr>
                          <tr><td colspan="6" align="left" valign="top" bgcolor="#F0F4F3" class="twelvepix">Currently:<?php echo $row_Recordset1['RentOwn']; ?></td></tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text">Complete current address: </td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['current_address']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Mortgage Rent $:                              <?php echo $row_Recordset1['mort_rent']; ?></div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#fceed7" class="text">Dates from:
                              &nbsp;<?php echo $row_Recordset1['rent1_dates_from']; ?>To:
                              
                              <?php echo $row_Recordset1['rent1_dates_to']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Landlord/Mortgage company name: </div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['mor_name']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Landlord/Mortgage company address: </div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['mor_add']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Landlord/Mortgage company phone #: </div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['mor_phone']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text">What is your reason for moving? </td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['reason_move']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text">Previous address: </td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['previous_add']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Mortgage Rent $:                              <?php echo $row_Recordset1['previous_mort_rent']; ?></div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#fceed7" class="text">Dates from:
                              
                              <?php echo $row_Recordset1['previous_mort_dates_from']; ?>&nbsp;To:
                              
                              <?php echo $row_Recordset1['previous_mort_dates_to']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><div align="left">Landlord/Mortgage company name: </div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><?php echo $row_Recordset1['prev_mor_name']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><div align="left">Landlord/Mortgage company address: </div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><?php echo $row_Recordset1['pre_mor_add']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><div align="left">Landlord/Mortgage company phone #: </div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><?php echo $row_Recordset1['pre_mor_phone']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text">What is your reason for moving? </td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><?php echo $row_Recordset1['pre_reason_move']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><hr noshade="noshade" class="text" /></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text">Complete Previous address: </td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><?php echo $row_Recordset1['previous_add2']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><div align="left">Mortgage Rent $:
                              <?php echo $row_Recordset1['previous_mort_rent2']; ?></div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text">Dates from:
                              
                              <?php echo $row_Recordset1['previous_mort_dates_from2']; ?>                              &nbsp;To:
                              
                              <?php echo $row_Recordset1['previous_mort_dates_to2']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><div align="left">Landlord/Mortgage company name: </div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><?php echo $row_Recordset1['pre_mor_name2']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><div align="left">Landlord/Mortgage company address: </div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><?php echo $row_Recordset1['pre_mor_add2']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><div align="left">Landlord/Mortgage company phone #: </div></td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><?php echo $row_Recordset1['pre_mor_phone2']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="left" valign="middle" bgcolor="#F3E3C8" class="text">What is your reason for moving? </td>
                            <td colspan="4" align="left" valign="middle" bgcolor="#F3E3C8" class="text"><?php echo $row_Recordset1['pre_reason_move2']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="" class="text">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#d49977" class="text"><strong class="hometext">EMPLOYMENT: &nbsp;&nbsp;&nbsp;</strong><span class="hometext">Please provide 2 years of continuous history</span></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text">Please check off all applicable: </td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">
                                
                                <span class="hometext">
                                <input <?php if (!(strcmp($row_Recordset1['employ_full'],"Y"))) {echo "checked=\"checked\"";} ?> name="employ_full2" type="checkbox" id="employ_full2" value="yes" />
                                Employed full time</span> 
                                <input <?php if (!(strcmp($row_Recordset1['employ_part'],"Y"))) {echo "checked=\"checked\"";} ?> name="employ_full" type="checkbox" id="employ_full" value="yes" />
                                <span class="hometext">Employed part time</span>
                                 <input <?php if (!(strcmp($row_Recordset1['retired'],"Y"))) {echo "checked=\"checked\"";} ?> name="retired" type="checkbox" id="retired" value="yes" />
                                <span class="hometext">Retired</span> &nbsp;
                                <input <?php if (!(strcmp($row_Recordset1['employ_self'],"Y"))) {echo "checked=\"checked\"";} ?> name="employ_self" type="checkbox" id="employ_self" value="yes" />
                                <span class="hometext">Self employed</span>
                                <input <?php if (!(strcmp($row_Recordset1['unemployed'],"Y"))) {echo "checked=\"checked\"";} ?> name="unemployed" type="checkbox" id="unemployed" value="yes" />
                            <span class="hometext">Unemployed</span> </div></td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Current Employer: </div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['curr_employer']; ?> </td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text">Position:</td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['current_occ_position']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text">Address:</td>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['current_occ_address']; ?></td>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text">Phone Number: </td>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['current_occ_phone_num']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text">Dates from:
                              
                              <?php echo $row_Recordset1['cur_employ_date_from']; ?>&nbsp;&nbsp;To:
                              
                              <?php echo $row_Recordset1['cur_employ_date_to']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text">Current Salary $:
                              &nbsp;<?php echo $row_Recordset1['cur_salary']; ?>&nbsp;
                              <input <?php if (!(strcmp($row_Recordset1['cur_slry_per_hour'],"Y"))) {echo "checked=\"checked\"";} ?> name="cur_slry_per_hour" type="checkbox" id="cur_slry_per_hour" value="yes" />
                              <span class="hometext">Per hour</span>
                              <input <?php if (!(strcmp($row_Recordset1['cur_slry_per_year'],"Y"))) {echo "checked=\"checked\"";} ?> name="cur_slry_per_year" type="checkbox" id="cur_slry_per_year" value="yes" />
                              <span class="hometext">Per Year </span> &nbsp;
                              <input <?php if (!(strcmp($row_Recordset1['cur_slry_per_pay'],"Y"))) {echo "checked=\"checked\"";} ?> name="cur_slry_per_pay" type="checkbox" id="cur_slry_per_pay" value="yes" />
                            <span class="hometext">Per pay </span></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text">Pay Cycle:
                              <input <?php if (!(strcmp($row_Recordset1['cur_slry_cycle_weekly'],"Y"))) {echo "checked=\"checked\"";} ?> name="cur_slry_cycle_weekly" type="checkbox" id="cur_slry_cycle_weekly" value="yes" />
                                <span class="hometext">Weekly</span>
                                <input <?php if (!(strcmp($row_Recordset1['cur_slry_cycle_biweekly'],"Y"))) {echo "checked=\"checked\"";} ?> name="cur_slry_cycle_biweekly" type="checkbox" id="cur_slry_cycle_biweekly" />
                                <span class="hometext">Bi Weekly </span> &nbsp;
                                <input <?php if (!(strcmp($row_Recordset1['cur_slry_cycle_monthly'],"Y"))) {echo "checked=\"checked\"";} ?> name="cur_slry_cycle_monthly" type="checkbox" id="cur_slry_cycle_monthly"  />
                               
                            <span class="hometext">Monthly</span></td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Supervisor's Name: </div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['cur_sup_name']; ?> </td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text">Supervisor's Phone Number: </td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['cur_sup_num']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Previous Employer : </div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['pre_employ']; ?> </td>
                            <td colspan="4" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text">Position:
                              
                              <?php echo $row_Recordset1['pre_pos']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text">Address:</td>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['pre_occ_add']; ?></td>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text">Phone Number: </td>
                            <td colspan="2" align="left" valign="middle" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['pre_occ_phone']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text">Dates from:
                              
                              <?php echo $row_Recordset1['pre_occ_dates_form']; ?>&nbsp;&nbsp;To:
                              
                              <?php echo $row_Recordset1['pre_occ_dates_to']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text">Previous  Salary $:
                              &nbsp;<?php echo $row_Recordset1['previous_salary']; ?>&nbsp;
                              <input <?php if (!(strcmp($row_Recordset1['pre_slry_per_hour'],"Y"))) {echo "checked=\"checked\"";} ?> name="pre_slry_per_hour" type="checkbox" id="pre_slry_per_hour" value="checkbox" />
                              <span class="hometext">Per hour</span>
                              <input <?php if (!(strcmp($row_Recordset1['pre_slry_per_year'],"Y"))) {echo "checked=\"checked\"";} ?> name="pre_slry_per_year" type="checkbox" id="pre_slry_per_year" value="checkbox" />
                              <span class="hometext">Per Year </span> &nbsp;
                              <input <?php if (!(strcmp($row_Recordset1['pre_slry_per_pay'],"Y"))) {echo "checked=\"checked\"";} ?> name="pre_slry_per_pay" type="checkbox" id="pre_slry_per_pay" value="checkbox" />
                            <span class="hometext">Per pay </span></td>
                          </tr>
                          <tr>
                            <td align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left">Supervisor's Name: </div></td>
                            <td align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['prev_sup_name']; ?> </td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text">Supervisor's Phone Number: </td>
                            <td colspan="2" align="left" valign="middle" nowrap="nowrap" bgcolor="#fceed7" class="text"><?php echo $row_Recordset1['pre_sup_num']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#d49977" class="text"><strong class="hometext">In case of emergency, notify: </strong><span class="hometext"></span></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left" class="text">Name:&nbsp;<strong>&nbsp;</strong><?php echo $row_Recordset1['emerg_name']; ?><strong>&nbsp;&nbsp;</strong>Phone:&nbsp;&nbsp;&nbsp;<?php echo $row_Recordset1['emerg_phone']; ?><strong>&nbsp;&nbsp;&nbsp;</strong>Relationship:<?php echo $row_Recordset1['emerg_rel']; ?></div>
                                <strong> </strong>
                                <div align="left"></div>
                            <div align="left"></div></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text">In the event of serious illness or death of resident(s), the above person
                              <strong><?php echo $row_Recordset1['Ems_RemoveContents']; ?>                              </strong>
                               enter, remove and/or store all contents found in dwelling or mailbox. </td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#d49977" class="text"><strong class="hometext">Credit References: </strong></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#fceed7" class="text"><div align="left" class="text">Name of Institution:&nbsp;<strong>&nbsp;&nbsp;</strong><?php echo $row_Recordset1['cred_ref_name']; ?><strong>&nbsp;</strong>Phone:&nbsp; <strong>&nbsp;&nbsp;&nbsp;</strong><?php echo $row_Recordset1['cre_ref_phone']; ?></div>
                                <strong> </strong>
                                <div align="left"></div>
                            <div align="left"></div></td>
                          </tr>
                          <tr>
                            <td colspan="6" bgcolor="#fceed7" class="text">Other loans: &nbsp;<span class="hometext"><?php echo $row_Recordset1['other_loans']; ?></span></td>
                          </tr>
                          <tr>
                            <td colspan="6" bgcolor="#fceed7" class="text"> Do you have any of the following credit cards:<br />
                                <input <?php if (!(strcmp($row_Recordset1['have_visa'],"Y"))) {echo "checked=\"checked\"";} ?> name="have_visa" type="checkbox" id="have_visa" value="yes" />
                                <span class="hometext">Visa</span> &nbsp;&nbsp;&nbsp;
                                <input <?php if (!(strcmp($row_Recordset1['have_mcard'],"Y"))) {echo "checked=\"checked\"";} ?> name="have_mcard" type="checkbox" id="have_mcard" value="yes" />
                                <span class="hometext">Master card </span> &nbsp;
                              &nbsp;&nbsp;
                                                              <input <?php if (!(strcmp($row_Recordset1['have_dis_card'],"Y"))) {echo "checked=\"checked\"";} ?> name="have_dis_card" type="checkbox" id="have_dis_card" value="yes" />
                                                              <span class="hometext">Discover Card &nbsp;&nbsp;&nbsp;&nbsp;
                                                              <input <?php if (!(strcmp($row_Recordset1['have_amer_ex'],"Y"))) {echo "checked=\"checked\"";} ?> name="have_amer_ex" type="checkbox" id="have_amer_ex" value="yes" />
                                                                American Express<br />
                            Other:                                                                <?php echo $row_Recordset1['have_cred_other']; ?></span></td>
                          </tr>
                          <tr>
                            <td colspan="6" bgcolor="#fceed7" class="text">Have you ever filed bankruptcy?
                              <?php echo $row_Recordset1['filed_bankruptcy']; ?><br />
                              Discharge date and case #:
                              
                            <?php echo $row_Recordset1['dis_date_case']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" bgcolor="#fceed7" class="text">Have you ever been evicted?
                              <?php echo $row_Recordset1['evicted']; ?><br />
                            When? &nbsp;&nbsp;<?php echo $row_Recordset1['evicted_date']; ?></td>
                          </tr>
                         <tr>
                            <td colspan="6" bgcolor="#F0F4F3" class="twelvepix">Have you ever willfully or intentionally refused to pay rent when due? <br />
                              <?php echo $row_Recordset1['refuse_rent']; ?></td>
                          </tr> <tr>
                            <td colspan="6" bgcolor="#F0F4F3" class="twelvepix">Have you, or any anticipated occupant of the Premises, been convicted of a sex offense? <br />
                              <?php if (!(strcmp($row_Recordset1['convictedoffense'] ,"1"))) {echo "Yes";} ?></td>
                          </tr> <tr>
                            <td colspan="6" bgcolor="#F0F4F3" class="twelvepix">Have you, or any anticipated occupant of the Premises, been convicted of the illegal possession, manufacturing, or distribution of any controlled substance? <br />
                              <?php if (!(strcmp($row_Recordset1['convictedPossession'] ,"1"))) {echo "Yes";} ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="top" bgcolor="#F3E3C8" class="text"><p>The Management relies on the  information provided above to be complete and accurate in order for the  application to be processed in a timely manner.&nbsp;  Any false statements, misrepresentations, inaccurate information or  failure to supply the information requested may serve as a rejection of your  application.&nbsp; By signing this  application, you are authorizing the use of any credit reporting/screening  agencies to verify credit, validate the accuracy of the information  reported.&nbsp; Further, your signature  authorizes the management and the credit reporting/screening agencies to later  exchange credit information.</p>
                              <p><strong><u>I/We hereby deposit $35.00, which  is a <em>non-refundable  payment</em> for a credit and processing charge,</u></strong>receipt of which  acknowledged by Management, such sum is not a rental payment.&nbsp; In the event this application is disapproved,  this sum will be retained by Management to cover the cost of processing the  application as furnished by applicant.&nbsp;  This application must be signed before Management will process it.  </p>
                              <table width="590" border="0" cellpadding="5" cellspacing="5" class="border">
                                <tr>
                                  <td valign="top" class="hometext"><strong>I/We hereby deposit $
                                    99
                                    , which is a holding fee that will be  applied to my security deposit</strong>.&nbsp; <strong><em>I  understand that in the event I/We cancel this application, the Management will  retain our holding fee</em></strong>.&nbsp; I/We  acknowledge the Landlord will suffer damages as a result of the processing of  this application and holding a specified unit for a specified move in  date.&nbsp; The deposit will be returned if  this application in not approved, providing all questions are answered  correctly and truthfully.&nbsp; (Applicant&rsquo;s  Initials:
                                    <?php echo $row_Recordset1['app_initial']; ?> )</td>
                                </tr>
                              </table>
                              <p>The above information, to the best of my knowledge is true  and correct.</p>
                              <p><strong>I AUTHORIZE AN INVESTIGATION OF MY CREDIT, A CRIMINAL BACKROUND CHECK,  TENANT HISTORY, BANKING AND EMPLOYMENT FOR THE PURPOSES OF RENTING AN APARTMENT  FROM THIS OWNER/MANAGER</strong></p></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="left" valign="top" bgcolor="#fceed7" class="text">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="6" bgcolor="#fceed7" class="12pix"><strong>Comments:</strong></td>
                          </tr>
                          <tr>
                            <td colspan="6" bgcolor="#fceed7" class="12pix"><?php echo $row_Recordset1['comment']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="6" bgcolor="#fceed7" class="text">Name:&nbsp;<?php echo $row_Recordset1['sig_name']; ?><strong>&nbsp;&nbsp;&nbsp;</strong>Date:&nbsp; <?php echo $row_Recordset1['sig_date']; ?><strong>&nbsp;&nbsp;&nbsp;</strong></td>
                          </tr><tr><td>Application Date: </td><td><?php
			
	
	$date=date_create($row_Recordset1['dateEntered']);
echo date_format($date,"m/d/Y");
			  
				   ?></td></tr>
                          <tr>
                            <td colspan="6" align="left" valign="middle" bgcolor="#d49977" class="text"><strong class="hometext">Credit Card Information: </strong></td>
                          </tr>
                          <tr>
                            <td class="text"><div align="left"><strong> Card Type:</strong></div></td>
                            <td align="left" nowrap="nowrap" class="text"><?php echo $row_Recordset1['CardType']; ?></td>
                            <td align="left" nowrap="nowrap" class="text"><strong>Card Number:</strong></td>
                            <td align="left" nowrap="nowrap" class="text">&nbsp;</td>
                            <td align="left" nowrap="nowrap" class="text">&nbsp;</td>
                            <td align="left" nowrap="nowrap" class="text">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="text"><div align="left"><strong>Exp. Month:</strong></div></td>
                            <td align="left" class="text"><?php echo $row_Recordset1['ExpMonth']; ?></td>
                            <td align="left" class="text"><strong>Exp. Year:</strong></td>
                            <td align="left" class="text"><?php echo $row_Recordset1['ExpYear']; ?></td>
                            <td align="left" class="text"><strong>CVV: </strong></td>
                            <td align="left" class="text"><?php echo $row_Recordset1['cardcode']; ?></td>
                          </tr>
                          <tr>
                            <td class="text"><div align="left">Account ID:</div></td>
                            <td align="left" class="text"><?php echo $row_Recordset1['account_id']; ?></td>
                            <td align="left" class="text"><strong>Amount Charged</strong>:</td>
                            <td align="left" class="text"><?php echo $row_Recordset1['invoice']; ?></td>
                            <td align="left" class="text">&nbsp;</td>
                            <td align="left" class="text"><?php echo $row_Recordset1['email_customer']; ?></td>
                          </tr>
                          <tr>
                            <td valign="top" nowrap="nowrap" class="text"><div align="left"><strong>Merchant Email:<br />
                            </strong></div></td>
                            <td align="left" valign="top" class="text"><?php echo $row_Recordset1['merchant_email']; ?></td>
                            <td align="left" valign="top" class="text">Affiliate:</td>
                            <td align="left" valign="top" class="text"><?php echo $row_Recordset1['affiliate']; ?></td>
                            <td align="left" valign="top" class="text">Trans ID:</td>
                            <td align="left" valign="top" class="text"><?php echo $row_Recordset1['trans_id']; ?></td>
                          </tr>
                         
                        </table>
                      <script type="text/javascript" language="JavaScript"><!--
function PresentForm(tid1,tid2) {
document.getElementById(tid1).style.display = "none";
document.getElementById(tid2).style.display = "";
}
//--></script></td>
                    </tr>
                   
                </table></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
           
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table></DIV> 
<p>

<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
        <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
        <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
        <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
        <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
  </td>
    </tr>
    <tr>
      <td align="center" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top">&nbsp;</td>
    </tr>
  </table>
</div>


<p><a href="loginLanding.php"><font size="2">View Other Administrative Options</font></a></p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?><script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
 <script>
	  $( document ).ready(function() {
	  $('.updatebtn').click(function() {
$.get( "updateRead.php", {ID: $(this).attr('data-id') }, function( data ) {
  $( ".read" ).css('background-color', 'lightseagreen').text('Application: READ');
  
});
		  });//end butn
		    });//end page
</script>