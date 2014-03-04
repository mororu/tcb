$(document).ready(function() {
	
	console.log('document ready');
	
	var searchBox;
	var list = $('#result');
	
	// Ajax request by typing player name
	$(".search").keyup(function() {
	
		console.log('keyup');
	
		var searchKey = $(this).val();
		searchBox = $(this);
						
		if(searchKey.length >= 1) {
			autoComplete(searchKey);
		} else {
			list.empty();
		}				
	});
	
	// Create list items with the given data
	function populateListItems(data) {
		var output = "";
	
		list.empty();
		$(data).each(function(index,obj) {
			output += '<li class="player" id="' + obj.id + '"><a href="#">' + obj.name + '</a></li>';
		});
		list.append(output);
		list.listview('refresh');
	}

	// Does the AJAX request
	function autoComplete(searchKey) {
		var dynamicData = {};
		dynamicData['term'] = searchKey;
		return $.ajax({
					url: '?cmd=ajax',
					type: 'GET',
					data: dynamicData,
					dataType: 'json',
					error: function() {console.log('No player with key: ' + searchKey);},
					success: populateListItems
		});
	}
	
	// Write the selected name in the searchbox
	list.on('click', 'li', function() {
		searchBox.val($(this).text());
		list.empty();
	});	
	
	// Handles the click on the clear button	
	$('.ui-content').on('click', '.ui-input-clear', function(e) {
		list.empty();
	});		
	
	// Handles the click on the cancel button
	$('#cancelBooking').click(function() {
		alert('cancel Booking');
	});
});