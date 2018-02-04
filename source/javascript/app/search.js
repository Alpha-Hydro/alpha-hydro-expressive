import $ from "jquery";

export default function search(searchQueryElementId) {
	if (searchQueryElementId){
		$(document).on('keyup', searchQueryElementId, function(e) {
			e.preventDefault();
			e.stopPropagation();
			
			let value = $(this).val();
			if (value.length >= 3) {
				return $.ajax({
					url: '/search',
					type: 'get',
					dataType: 'json',
					data: {
						query: value
					},
					error: function(jqXHR, textStatus, errorThrown) {
						return console.log("AJAX Error: " + textStatus);
					},
					success: function(data, textStatus, jqXHR) {
						return console.log(data);
					}
				});
			}
		});
	}
	return null;
}