$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	
	if($('.alert').is(':visible')){
        $('.alert').fadeTo(2000, 500).slideUp(500, function(){
            $('.alert').slideUp(500);
        });
    }
	
});