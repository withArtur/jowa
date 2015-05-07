$(document).ready(function(){
// 


	// jquery ui
	// https://jqueryui.com/sortable/
	// API - http://api.jqueryui.com/sortable/
	$(function() {
		var real_page = 1;
		
		$("#sortable, .connectPage").sortable({
			connectWith: ".connectPage",
			cancel: '.connectPage',
			handle: ".srtbl-move",
			cursor: "move",
			placeholder: "danger srtbl-item"
		});
		
		
		$(".connectPage").sortable("option", "dropOnEmpty", false);
		
		
		// Ajax save position in database
		$("#sortable").on("sortupdate", function( event, ui ) {
			// 0 - 9
			var newPosition = ui.item.index(), 
				elementId = parseInt(ui.item.data('elementid')),
				currPage = $("#pagination li.active"),
				page = currPage.children().data('page');
			
			updatePos(newPosition, elementId, currPage, page);
		});
		
		
		$(".connectPage").on("sortover", function( event, ui ) {
			var currPage = $(this), page = currPage.data('page');
			
			$("#pagination li").removeClass('active');
			
			currPage.parent().addClass('active');
		});
		
		$(".connectPage").on("sortout", function( event, ui ) {
			var currPage = $("#pagination a[data-page="+real_page+"]"), page = currPage.data('page');
			
			$("#pagination li").removeClass('active');
			
			currPage.parent().addClass('active');
		});
		
		$(".connectPage").on("sortreceive", function( event, ui ) {
			//0 - 9
			var newPosition = 0, 
				elementId = parseInt(ui.item.data('elementid')),
				currPage = $("#pagination li.active"),
				page = currPage.children().data('page');
			
			real_page = page;
			
			updatePos(newPosition, elementId, currPage, page);
			
			$(ui.sender).sortable("cancel");
		});
		
		
		$("#pagination a").click(function(e){
			var currPage = $(this), page = currPage.data('page');
			real_page = page;
			$("#pagination li").removeClass('active');

			getTbody(currPage, page);

			return false;
		});
		
		function updatePos(newPosition, elementId, currPage, page){
			$.ajax({
				url: 'position-update.php',
				method: 'POST',
				data: {position: newPosition, id: elementId, page: page},
				dataType: 'json',
				success: function(json){					
					if(json.success){
						getTbody(currPage, page);
					} else {
						console.info('Errore');
						// errore riprovare per favore
					}
				},
				error: function(){
					console.info('Errore generale');
				}
			});
		}

		function getTbody(currPage, page){
			$.ajax({
				url: 'pagination.php',
				method: 'GET',
				data: {page: page},
				dataType: 'json',
				success: function(json){	
					if(json.success){
						$("#sortable").html(json.tbody);

						currPage.parent().addClass('active');
						// aggiornare lhtml per mostrare le nuove posizioni
					} else {
						console.info('Errore');
						// errore riprovare per favore
					}
				},
				error: function(){
					console.info('Errore generale');
				}
			});
		}
	});

});