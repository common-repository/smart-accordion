(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */



	var pe_team_types = $("#pe_team_types").val();
	if( pe_team_types == 1 ){
		$("#team01").show();
		$("#team02").hide();
	}
	else {
		$("#team01").hide();
		$("#team02").show();
	}
	
	$("#pe_team_types").on('change', function(){

		var pe_team_types = $("#pe_team_types").val();
		if( pe_team_types == 2 ){
			$("#team01").hide();
			$("#team02").show();
		}
		else{
			$("#team01").show();
			$("#team02").hide();
		}
	});

	$(document).on('click', '.expandable .header', function(){
		if($(this).parent().hasClass('active')){
			$(this).parent().removeClass('active');
		}
		else{
			$(this).parent().addClass('active');	
		}
	});	

	$(document).on('click', '.tab-nav li', function(){
		$(".active").removeClass("active");
		$(this).addClass("active");
		var nav = $(this).attr("nav");
		$(".box li.tab-box").css("display","none");
		$(".box"+nav).css("display","block");
		$("#sf_ac_tabs").val(nav);
	});

		

	var pe_team_gridtypes = $("#pe_team_gridtypes").val();
	if( pe_team_gridtypes == 1 ){
		$("#type1").hide('slow');
	}
	else {
		$("#type1").show('slow');
	}	

	$("#pe_team_gridtypes").on('change', function(){

		var pe_team_gridtypes = $("#pe_team_gridtypes").val();
		if( pe_team_gridtypes == 2 ){
			$("#type1").show('slow');
		}
		else{
			$("#type1").hide('slow');
		}
	});

})( jQuery );