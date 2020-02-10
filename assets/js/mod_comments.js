$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	
	$("a#deleteBtn").click(function(e){
		e.preventDefault();
		var get_val = $(this).data('id');
		$('#id_comment').val(get_val);

		$("#removeModal").modal('show');
    });
    
    $("a#PublishBtn").click(function(e){
		e.preventDefault();
        var get_val = $(this).data('id');
        var show = $(this).data('publish');

        console.log(get_val);
        $.ajax({
			url: baseUrl+'/admin/comments/publish',
			type: 'POST',
			data: {'id_comment' : get_val, 'show' : show}, 
			dataType: 'json',
			success:function(response) {
				console.log(response);
				if(response.success === true) {
				// hide the modal
				$("#replyModal").modal('hide');
				alert(response.messages);  
				window.location  = baseUrl + '/admin/comments/';

				} else {
	
				$("#replyModal").modal('hide');
				alert(response.messages);  
				window.location  = baseUrl + '/admin/comments/';
				}
			}
		}); 

    });
    
    $("a#ViewBtn").click(function(e){
		e.preventDefault();
        var get_val = $(this).data('id');        
        var name = $('input[name="name_'+get_val+'"').val();
        var comment = $('input[name="comment_'+get_val+'"').val();
      
        $('#name_view').html(name);
        $('#comment_view').html(comment);
		$("#viewModal").modal('show');
    });
    
    $("a#ReplyBtn").click(function(e){
		e.preventDefault();
        var get_val = $(this).data('id');
        var post_id = $(this).data('post-id');
        $('#id_parent').val(get_val);
        $('#id_post').val(post_id)
        
		$("#replyModal").modal('show');
	});

    $("#replyForm").on('submit', function() {
		var form = $(this);

		console.log(form.serialize());
		
		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize(), 
			dataType: 'json',
			success:function(response) {
				console.log(response);
				if(response.success === true) {
				// hide the modal
				$("#replyModal").modal('hide');
				alert(response.messages);  
				window.location  = baseUrl + '/admin/comments/';

				} else {
	
				$("#replyModal").modal('hide');
				alert(response.messages);  
				window.location  = baseUrl + '/admin/comments/';
				}
			}
		}); 

		return false;
    });
    
	$("#removeForm").on('submit', function() {
		var form = $(this);

		console.log(form.serialize());
		
		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize(), 
			dataType: 'json',
			success:function(response) {
				console.log(response);
				if(response.success === true) {
				// hide the modal
				$("#removeModal").modal('hide');
				alert(response.messages);  
				window.location  = baseUrl + '/admin/comments/';

				} else {
	
				$("#removeModal").modal('hide');
				alert(response.messages);  
				window.location  = baseUrl + '/admin/comments/';
				}
			}
		}); 

		return false;
	});
	
});