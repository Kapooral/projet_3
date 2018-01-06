$(function() {

	$('.blogForm').on('submit', function(e){
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');
		var data = {};

		form.find('[name]').each(function(index, value) {
			var input = $(this);
			var name = input.attr('name');
			var value = input.val();
			data[name] = value;
		});

		$.ajax({
			type: type,
			url: url,
			data: data,
			dataType: 'JSON',
			success: function(data){
				if(data.success){
					swal({
					    type: 'success',
					    text: data.text,
					    showConfirmButton: false,
					    timer: 1500
				    });

				    setTimeout(function(){ location.reload(); }, 1500);
				}
			},
			error: function(response){
				swal({
					type: 'error',
					text: response,
					showConfirmButton: false,
					timer: 1500
				});
			}
		});

		e.preventDefault();

	});

});


function authorizeComment(id){

	swal({
	    type: 'warning',
	    text: 'Voulez-vous autoriser ce commentaire ?',
	    showCancelButton: true,
	    cancelButtonText: 'Non',
	    cancelButtonColor: '#a94442',
	    confirmButtonColor: '#3c763d',
	    confirmButtonText: 'Oui'
	}).then((result) => {
		if (result.value){
			$.ajax({
				type: 'GET',
				url: 'index.php',
				data: 'action=authorize&id=' + id,
				dataType: 'JSON',
				success: function(data){
					if(data.success){
						swal({
						    type: 'success',
						    text: data.text,
						    showConfirmButton: false,
						    timer: 1500
					    });
					    $('#' + id).remove();
					}
				},
				error: function(data){
					swal({
						type: 'error',
						text: data,
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
		}
	});	
}


function deleteComment(id){

	swal({
	    type: 'warning',
	    text: 'Voulez-vous supprimer ce commentaire ?',
	    showCancelButton: true,
	    cancelButtonText: 'Non',
	    cancelButtonColor: '#a94442',
	    confirmButtonColor: '#3c763d',
	    confirmButtonText: 'Oui'
	}).then((result) => {
		if (result.value){
			$.ajax({
				type: 'GET',
				url: 'index.php',
				data: 'action=deleteComment&id=' + id,
				dataType: 'JSON',
				success: function(data){
					if(data.success){
						swal({
						    type: 'success',
						    text: data.text,
						    showConfirmButton: false,
						    timer: 1500
					    });
					    $('#' + id).remove();
					}
				},
				error: function(data){
					swal({
						type: 'error',
						text: data,
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
		}
	});
}


function deletePost(id){

	swal({
	    type: 'warning',
	    text: 'Voulez-vous supprimer cet article ?',
	    showCancelButton: true,
	    cancelButtonText: 'Non',
	    cancelButtonColor: '#a94442',
	    confirmButtonColor: '#3c763d',
	    confirmButtonText: 'Oui'
	}).then((result) => {
		if (result.value){
			$.ajax({
				type: 'GET',
				url: 'index.php',
				data: 'action=deletePost&id=' + id,
				dataType: 'JSON',
				success: function(data){
					if(data.success){
						swal({
						    type: 'success',
						    text: data.text,
						    showConfirmButton: false,
						    timer: 1500
					    });
					    $('#' + id).remove();
					}
				},
				error: function(data){
					swal({
						type: 'error',
						text: data,
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
		}
	});
}


function reportComment(id){

	swal({
	    type: 'warning',
	    text: 'Voulez-vous signaler ce commentaire ?',
	    showCancelButton: true,
	    cancelButtonText: 'Non',
	    cancelButtonColor: '#a94442',
	    confirmButtonColor: '#3c763d',
	    confirmButtonText: 'Oui'
	}).then((result) => {
		if (result.value){
			$.ajax({
				type: 'GET',
				url: 'index.php',
				data: 'action=report&id=' + id,
				dataType: 'JSON',
				success: function(data){
					if(data.success){
						swal({
						    type: 'success',
						    text: data.text,
						    showConfirmButton: false,
						    timer: 1500
					    });
					}
				},
				error: function(data){
					swal({
						type: 'error',
						text: data,
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
		}
	});	
}