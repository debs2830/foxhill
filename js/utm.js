
  var url = window.location.search.substring(1).split('&');
	var url_string =window.location.href;
var url = new URL(url_string);
var utm = url.searchParams.get("utm_source");
  var email = '';
var phone = ''; 

if ($.cookie('the_phone') )  { phone = $.cookie('the_phone');}
if ($.cookie('the_email') )  { email = $.cookie('the_email');}
writead_source(phone,email ) ;
if (utm  ) { 


$.get( "https://script.googleusercontent.com/macros/echo?user_content_key=gt04mVy0zHpDXfE64RUYoh2eE-hpkgwywLDf0TAlTD_Txq6JydgPpAyyAqZrx1mR4ErU8aha-YFvEpgXjiEphXCgmdDRlADQm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnCtpUkcN6I34HqlpM_D1k-q3JZ05X8WiuQukffIJP37EeGAMy9Aw5N0yZQOS0aMpWbpa3ip3Xtvh&lib=MGNrWC6EcnwWgDsctFFqjl88ocQgJ_sae", function( data ) {


 if (!data) {
	 return false;
 }
	   email = data[utm].email;
       phone = data[utm].phone;
       ad_source = data[utm].AdSource;
	

	
	$.cookie('the_phone', phone);
	$.cookie('the_email', email);
	$.cookie('ad_source',   ad_source);
	
	writead_source( phone, email) ;
//	
  //alert( "Load was performed."  + data);
});
}// end has url 

function writead_source(phone,email )  {
if (phone  )  {

       $('#phone').html( '<a href="tel:'+ phone + '" onclick="return gtag_report_conversion("tel:' + phone + '")">' + phone + '</a>' ) ;
	$('#residenttel').remove();
	$('#leasingwords').html("Office:");
	}
if (email  )  {
       $('.link1').text( email).attr('href', 'mailto:' + email) ;
    
	$('input[name="owneremail"]').val(email);
}
	
	}