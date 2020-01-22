$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	
	$("a#deleteBtn").click(function(e){
		e.preventDefault();
		var get_val = $(this).data('id');
		$('#id_user').val(get_val);

		$("#removeModal").modal('show');
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
				window.location  = baseUrl + '/admin/users/';

				} else {
	
				$("#removeModal").modal('hide');
				alert(response.messages);  
				window.location  = baseUrl + '/admin/users/';
				}
			}
		}); 

		return false;
	});

	$("a#deleteBtnGroup").click(function(e){
		e.preventDefault();
		var get_val = $(this).data('id');
		$('#id_group').val(get_val);

		$("#removeModal").modal('show');
	});

	$("#removeFormGroup").on('submit', function() {
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
				window.location  = baseUrl + '/admin/users/index_group';

				} else {
	
				$("#removeModal").modal('hide');
				alert(response.messages);  
				window.location  = baseUrl + '/admin/users/index_group';
				}
			}
		}); 

		return false;
	});
	
});