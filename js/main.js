jQuery(document).ready(function(){
	
	ifCheck();
	
	jQuery('#sc-checkb').click(function(){
		jQuery('#sc-checkb-r').trigger('click');		
			ifCheck();			
	});	
});



function ifCheck(){
	if(jQuery('#sc-checkb-r').attr('checked')){
		jQuery('#sc-checkb').removeClass('bg-inactive').addClass('bg-active');
		jQuery('#sc-check').animate({left:27},200);
		jQuery('#sc-check-status').text('Active');
	}
	else{
		jQuery('#sc-checkb').removeClass('bg-active').addClass('bg-inactive');
		jQuery('#sc-check').animate({left:3},100);
		jQuery('#sc-check-status').text('Inactive');
	}
}
