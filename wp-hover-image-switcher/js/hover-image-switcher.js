jQuery(document).ready(function($) {

  	//Add the hover class to the images
  	$('div.hover-image-switcher img').addClass('hover-image-switcher')
  	
  	//preload each image for quick swaps
	$('img.hover-image-switcher').each(function () {
  		var image_url = $(this).attr('src').replace(".","-hover.");
  		var image_preload = $('<img />').attr('src', image_url);  		
  	});
  	
  	//Switch the image files
	$('img.hover-image-switcher').hover( 
		
			function() { 
			
				$(this).attr("src",$(this).attr("src").replace(".","-hover.")); 
			}, 
			function () { 
				
				$(this).attr("src",$(this).attr("src").replace("-hover.",".")); 
				
			}
	);  

}); 