function selectChange() {
	var currentProgram = $("#select-program").val();
	switch(currentProgram) {
		case "":
		$("#program-status").fadeOut();
		$("#program-comment").fadeOut();
		break;
		case "Program Completed":
		$("#program-status > label").fadeOut(function() {
			$(this).text("Program Completed").fadeIn(400);
		});
		$("#program-status").fadeIn(600);
		$("#program-comment").fadeIn(600);
		break;
		case "Program not Completed":
		$("#program-status > label").fadeOut(function() {
			$(this).text("Program Not Completed").fadeIn(400);
		});
		$("#program-status").fadeIn(600);
		$("#program-comment").fadeIn(600);
		break;
		case "On Hold":
		$("#program-status > Label").fadeOut(function() {
			$(this).text("On Hold").fadeIn(400);
		});
		$("#program-status").fadeIn(600);
		$("#program-comment").fadeIn(600);
		break;
		default:
		console.log("please update the load_content.js file if new program status were added");
	}
}

function radioChangeOff() {
	$("#hired-option-1").fadeOut(200,function(){
        $(this).css({"visibility":"hidden",display:'block'}).slideUp();
    });
	$("#hired-option-2").fadeOut(200,function(){
        $(this).css({"visibility":"hidden",display:'block'}).slideUp();
    });
	$("#hired-option-3").fadeOut(200,function(){
        $(this).css({"visibility":"hidden",display:'block'}).slideUp();
    });
    $("#hired-option-4").fadeOut(200,function(){
        $(this).css({"visibility":"hidden",display:'block'}).slideUp();
    });
}

function radioChangeOn() {
	$("#hired-option-1").fadeIn(200,function(){
        $(this).css({"visibility":"visible"}).slideDown();
    });
	$("#hired-option-2").fadeIn(200,function(){
        $(this).css({"visibility":"visible",display:'block'}).slideDown();
    });
	$("#hired-option-3").fadeIn(200,function(){
        $(this).css({"visibility":"visible",display:'block'}).slideDown();
    });
    $("#hired-option-4").fadeIn(200,function(){
        $(this).css({"visibility":"visible",display:'block'}).slideDown();
    });
}

function selectNoShowOn() {
	$("#noshow-option-1").fadeIn(200,function(){
        $(this).css({"visibility":"visible"}).slideDown();
    });
}

function selectNoShowOff() {
	$("#noshow-option-1").fadeOut(200,function(){
        $(this).css({"visibility":"hidden",display:'block'}).slideUp();
    });
}

function ongoingStatus() {
	$("#program-option-0").show();
	$("#program-option-1").hide();
	$("#program-option-2").hide();
	$("#program-option-3").show();
	$('#select-status').val('Select Status');
}

function pCompletedStatus() {
	$("#program-option-0").hide();
	$("#program-option-1").show();
	$("#program-option-2").show();
	$("#program-option-3").hide();
	$('#select-status').val('Employed');
}

function pNotCompletedStatus() {
	$("#program-option-0").hide();
	$("#program-option-1").show();
	$("#program-option-2").show();
	$("#program-option-3").show();
	$('#select-status').val('Employed');
}

function ongoingStatusNH() {
	$("#option-status-0").show();
	$("#option-status-1").show();
	$("#option-status-2").hide();
	$("#option-status-3").hide();
	$('#select-status-NH').val('Select Status');
}

function pCompletedStatusNH() {
	$("#option-status-0").hide();
	$("#option-status-1").hide();
	$("#option-status-2").show();
	$("#option-status-3").show();
	$('#select-status-NH').val('Employed');
}

function pNotCompletedStatusNH() {
	$("#option-status-0").hide();
	$("#option-status-1").hide();
	$("#option-status-2").show();
	$("#option-status-3").show();
	$('#select-status-NH').val('Employed');
}

$(document).ready(function(){
	$("#program-status").hide();
	$("#program-comment").hide();
	$("#noshow-option-1").hide();
	ongoingStatus();
});