
jQuery(document).ready(function($) {

	if ( jQuery('.photo_grid').length > 0 ) {
		var grid = jQuery('.photo_grid').masonry({
			// options
			itemSelector: '.photo_grid_item',
			columnWidth: '.photo_grid_sizer',
			percentPosition: true
		});

		// layout Masonry after each image loads
		grid.imagesLoaded().progress( function() {
			grid.masonry('layout');
			console.log('imagesLoaded: done relayout');
		});
	}

});
