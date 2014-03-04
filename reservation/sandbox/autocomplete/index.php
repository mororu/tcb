<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>AutoCompletion</title>
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>

	
	<script type="text/javascript">
		$(document).ready(function() {
			
			var searchBox;
			var listName = "#result";
			var list = $(listName);
						
			// search input
			$(".search").keyup(function() {
			
				var searchKey = $(this).val();
				searchBox = $(this);
								
				if(searchKey.length >= 1) {
					
					autoComplete(searchKey); //.done(//function(data) {
					
					// Alternative
					// autoComplete(searchKey).done(function(data) {});
				} else {
					list.empty();
				}				
			});

			// Creates the list items
			function populateListItems(data) {
				var output = "";
				// console.log(JSON.stringify(data));
				
				list.empty();
				$(data).each(function(index,obj) {
					output += '<li class="player" id="' + obj.id + '"><a href="#">' + obj.name + '</a></li>';
				});
				list.append(output);
				list.listview('refresh');
			}
			
			// AJAX Autocomplete Request
			function autoComplete(searchKey) {
				var dynamicData = {};
				dynamicData['term'] = searchKey;
				return $.ajax({
						url: 'autocomplete.php',
						type: 'GET',
						data: dynamicData,
						dataType: 'json',
						error: function() {alert('Error occured');},
						success: populateListItems
				});
			}
			
			// Click on player item function
			list.on('click', 'li', function() {
				searchBox.val($(this).text());
				list.empty();
			});	
			
			$('.ui-content').on('click', '.ui-input-clear', function(e) {
				list.empty();
			});
			
		});
			
		
	</script>
	<style>
		.ui-filter-inset {
			margin-top: 0;
		}
	</style>
</head>

<body>
	
	
	<div data-role="page" id="form">
		<header data-role="header">
			<h1>Header</h1>
		</header>
		<div data-role="content">
			
			<form>
				<div id="player1" class="playerList">
					<input class="search" id="searchBox" type="text" value="" data-clear-btn="true" data-mini="true">
				</div>
				<div id="player2" class="playerList">
					<input class="search" id="searchBox2" type="text" value="" data-clear-btn="true" data-mini="true">
				</div>
			</form>
			<ul data-role="listview" data-inset="true" id="result" class="resultList"></ul>
			
			

		</div>
	</div>

</body>
</html>