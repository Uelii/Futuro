$(document).ready(function() {
	$('#liar').show();

//Dieser Abschnitt wird ausgeführt sobald man auf den Button geklickt hat
	$('#show').click(function() {
		//Den ausgewählten Beruf aus dem Dropdown auslesen
		var lid = $('#lid').val();
		console.log(lid);
		var link = "showjobs.php?lid=";
		console.log(link+lid);
		
		window.location.href=link+lid;

	});
});
