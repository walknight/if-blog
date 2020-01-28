$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	
    $("#site_logo").change(function(){
        readURL(this, '#image_logo');
    });

    $('#email_protocal').change(function(){
        alert(this.value);
    });

    $("#og_image").change(function(){
        readURL(this, '#image_og');
    });

    $("#editor").editor();

    function readURL(input, image_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(image_id)
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
});