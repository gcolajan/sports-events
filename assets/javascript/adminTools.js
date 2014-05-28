function matchMatch(el, bloc) {
	if (el.selectedOptions[0].value == -1)
		document.getElementById(bloc).style.display = "block";
	else
		document.getElementById(bloc).style.display = "none";
}

function matchIsGood() {
	var match = document.getElementById('eq1').selectedOptions[0].value != document.getElementById('eq2').selectedOptions[0].value ||  document.getElementById('eq2').selectedOptions[0].value == -1;

	document.getElementById('messageMatch').innerHTML = (!match) ? 'Impossible de faire un match avec deux mêmes équipes' : '';


	return match;
}