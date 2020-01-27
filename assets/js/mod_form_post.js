$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	
	$("input[name$='url_title']").focus(function(){

        var conName = $("input[name$='title']").val().replace(/[^\w\s]/gi, '');
        $(this).val(conName.toLowerCase().replace(/ +/g,'-'));
        
    })
    
    $("#image_header").change(function(){
        readURL(this);
    });

    $("#editor").editor();

    $('#datepicker').datetimepicker({ footer: true, modal: true });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
});