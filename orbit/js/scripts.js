function jigsawDev(){
	miscRun();
}

jQuery(document).ready(function($) {
	jigsawDev();
});

/*-------------------------------------------    
	 Miscellaneous
-------------------------------------------*/
function miscRun() {			
	// iOS scale bug fix
	MBP.scaleFix();
	
	// Responsive Image Enhance
	responsiveEnhance(document.getElementById('demo'), 400);
}