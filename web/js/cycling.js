document.getElementById("tourYear").onchange = function() {
	var year = document.getElementById("tourYear").value;
	window.location.href = "http://dev.cyclingsdirtyera.com?year=" + year;
}