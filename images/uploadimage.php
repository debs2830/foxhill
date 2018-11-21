<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ( isset( $_POST["abc"]) && $_POST["abc"] == "" ) {	
	$target_dir ='';

	$randomNum = rand(1, 1200);

	$target_file = $target_dir . $randomNum .  "-" . date("d-H-i-s"). "." .pathinfo(basename($_FILES["photo"]["name"]),PATHINFO_EXTENSION);

$target_filename  = $target_dir .'popupflyerHP.png';


	$uploadOk = 1;

	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["photo"]["tmp_name"]);
   /* if($check !== false) {

        $uploadOk = 1;
    } else {
        $errormsg=  "<br>There was a problem with this file. Please try a different image";
        $uploadOk = 0;
    }
*/
// Check if file already exists
// Check file size
if ($_FILES["photo"]["size"] > 16291456) {
   $errormsg="Sorry, your file is too large. Size is " . $_FILES["photo"]["size"];
    $uploadOk = 0;
}

// Allow certain file formats
if( $imageFileType != "png"  && $imageFileType != "PNG" ) {
   $errormsg="Sorry, only PNG files are allowed. Your file is " . $imageFileType;
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $errormsg= "Sorry, your file was not uploaded." . $errormsg . '<br>Please try again.';
;
// if everything is ok, try to upload file
} else {
	
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_filename)) {
         $errormsg =  "The file has been uploaded.";
	}
}
	if ($uploadOk == 1 ) {
//		echo $fullurl;
    echo "<span style='background-color:pink; font-weight:bold;' >File has been uploaded</span>";

	} else {
		echo  "<span style='background-color:pink; font-weight:bold;' >$errormsg</span>";
	}

}//end submit
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Upload Images </title>
</head>

<body style="font-size:1.5em;"><div align="center"><img src="images/logo-fox.gif"></div><form method="post" enctype="multipart/form-data" name="form1" id="form1">

<p >Upload Popup Homepage Image: (must be in PNG format) </p>
<input name="photo" id="photo" type="file" size=35  required style="font-size:18px; margin-bottom:15px;padding:10px;" />
   <input name="upload" type="submit" style="font-size:18px; margin-bottom:15px;padding:10px;" class="submit" id="upload"  value="Submit"  /> 
<input name="abc" type="hidden" id="abc">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="id">
<br>
Max upload size 5 MB
</form>
</body>
</html>
