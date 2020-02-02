$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	
    $("#site_logo").change(function(){
        readURL(this, '#image_logo');
    });

    //for load selected
    var selected = $('#email_protocal').val();
    if(selected == 'sendmail'){
        $('#sendmail_input').show();
        $('.smtp_input').hide();   
    } else if(selected == 'smtp'){
        $('#sendmail_input').hide();
        $('.smtp_input').show();
    } else {
        $('#sendmail_input').hide();
        $('.smtp_input').hide();
    }

    //for change select
    $('#email_protocal').change(function(){
        if(this.value == 'sendmail'){
            $('#sendmail_input').show();
            $('.smtp_input').hide();
        } else if(this.value == 'smtp'){
            $('#sendmail_input').hide();
            $('.smtp_input').show();
        } else {
            $('#sendmail_input').hide();
            $('.smtp_input').hide();
        }

    });

    $("#og_image").change(function(){
        readURL(this, '#image_og');
    });

    $('#site_enabled').click(function(){
        if ($(this).prop('checked') == true) {
            $('#offline_reason').prop("readonly", true);
        } else {
            // the checkbox is now no longer checked
            $('#offline_reason').removeAttr("readonly");
        }
    })

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