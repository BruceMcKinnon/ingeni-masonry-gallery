
jQuery(document).ready(function($) {

	if ( jQuery('.photo_grid').length > 0 ) {
		jQuery('.photo_grid').masonry({
			// options
			itemSelector: '.photo_grid_item',
			columnWidth: '.photo_grid_sizer',
			percentPosition: true
		});
	}

});
