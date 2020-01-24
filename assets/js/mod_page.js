$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	
	$("a#deleteBtn").click(function(e){
		e.preventDefault();
		var get_val = $(this).data('id');
		$('#id_page').val(get_val);

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
				window.location  = baseUrl + '/admin/pages/';

				} else {
	
				$("#removeModal").modal('hide');
				alert(response.messages);  
				window.location  = baseUrl + '/admin/pages/';
				}
			}
		}); 

		return false;
	});
	
});