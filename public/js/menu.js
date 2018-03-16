$(document).ready(function(){
	var maxwidth = Math.max($("#menu-e1").width(), $("#menu-e2").width(), $("#menu-e3").width());
	var diff1 = maxwidth-$("#menu-e2").width();
	$("#sub-menu1").css("margin-left", diff1/2 + "px");
	
	$("#menu-e1").width(maxwidth);
	$("#menu-e2").width(maxwidth);
	$("#menu-e3").width(maxwidth);
});