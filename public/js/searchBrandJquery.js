
$('#brandSearchButton').on('click', function(){

	$.getJSON(
		"/brand/search?pattern=" + $('#brandSearch').val(),
		function( response ) {console.log(response);
			response.data.forEach(function(element) {
				$('#searchResults').append('<li>'+element.name+'</li>');
			});
		}
	);

});
