/*function initialize()
{
	var mapOptions = {
		center: new google.maps.LatLng(-34.397, 150.644),
		zoom: 8
	};

	var map = new google.maps.Map(document.getElementById("map-canvas") ,mapOptions);
}

$(document).load(initialize);
//google.maps.event.addDomListener(window, 'load', initialize);
*/
$(document).load(function()
{
	var mapOptions = {
		center: new google.maps.LatLng(34.397, 150.644),
		zoom: 8
	};

	var map = new google.maps.Map($("#map-canvas"), mapOptions);
});