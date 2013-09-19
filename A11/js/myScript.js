$(document).ready(function () {
	//Initially Hides the answers
	$('dd').hide();
	//When Click, show or hide the answers
	$("dt").click(function() {
		$(this).next().slideToggle();
		
		//Check if symbol is + or - and change it
		if ($(this).children(".symbol").text() == " + ") {
			$(this).children(".symbol").text(" - ");
		}
		else {
			$(this).children(".symbol").text(" + ");
		}
	});
});