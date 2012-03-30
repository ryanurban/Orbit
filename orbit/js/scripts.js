function orbitDev(){
	miscRun();
}

jQuery(document).ready(function($) {
	orbitDev();
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