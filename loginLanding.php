<?php
//make it a session variaable whatever will be first page viewed.
	if ($_POST['Login'] == "test" && $_POST['Password'] == "1234" || $_COOKIE["loggedIn"]== "logged" ){
 setcookie("loggedIn", "logged");

} else {

    ?>
    <SCRIPT language="JavaScript">
alert("You have entered an incorrect password. Please try again.");
window.location="http://www.flatsatfoxhill.com/login.php";

</SCRIPT>
<?
  }
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration Section</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="text.css" rel="stylesheet" type="text/css">
<!-- Global site tag (gtag.js) - Google AdWords: 864100403 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-864100403"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-864100403'); </script><!-- Event snippet for Mobile Phone Number Clicks conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-864100403/twiSCJLelIEBELPAhJwD', 'event_callback': callback }); return false; } </script>  </head>

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
        <p>&nbsp;</p>
        <table width="500" border="1" cellpadding="0" cellspacing="0" bordercolor="#6A2F0D" class="text">
          <tr>
            <td align="left" valign="top" bordercolor="#6A2F0D"><table width="500" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td align="left" valign="top" bgcolor="#F3E3C8" class="header"><strong>Thank you for logging in.</strong></td>
              </tr>
              <tr>
                <td align="left" valign="top"><a href="viewApplication.php" class="hometext"><strong>View applications</strong></a></td>
              </tr>
              <tr>
                <td align="left" valign="top"><a href="search.php" class="hometext"><strong>Search for specific Application</strong></a></td>
              </tr>
				<tr>
                <td align="left" valign="top"><a href="images/uploadpdf.php" class="hometext"><strong>Upload Pricing Sheet</strong></a></td>
              </tr>
              <tr>
                <td align="left" valign="top"><a href="images/uploadimage.php" class="hometext"><strong>Upload Homepage Popup Image</strong></a></td>
              </tr>
              <tr>
                <td align="left" valign="top"><a href="logout.php" class="hometext"><strong>Log Out</strong></a></td>
              </tr>

            </table>
            </td>
          </tr>
        </table>
        <p>
          <label></label>
        </p>
        <p>
          <label></label>
        </p>
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
</body>
</html>
