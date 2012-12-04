/* Split the passed string and return second part */
function str_split(str) {
	substr = str.split('_');
	return substr[1];
}

/* Load Google Map from uid and paste in map-div-container */
function getGMap(uid, type)	{
	jQuery("#map-province_" + uid).html(
		function(){
			jQuery.ajax({
				url: '/?eID=buechertransport',
				type: "POST",
				data: "uid=" + uid + "&map=" + type,
				success: function(data) {
					if (typeof(piwikTracker) != 'undefined') {
						piwikTracker.trackPageView('Map/Buechertransport');
					}
					jQuery("#map-province_" + uid).html(data);
					// alert(data);
				}
			});
		}
	);
}

// Run
jQuery(document).ready(function() {

	// Initialize normal Germany Map
	// id = jQuery('div[id^="map-province_"]').attr('id');
	// uid = str_split(id);
	// getGMap(uid, 'small');

	// Initialize FusionTable Maps
	initialize();

	// Define link action
	// jQuery('.map').click(function(){
	// 	uid = str_split(jQuery(this).attr('id'));
	// 	getGMap(uid, 'small');
	// 	jQuery("#map-province_" + uid).show();
	// 	return false;
	// });
	// Enable all small maps
	// jQuery('.map').trigger('click');
});

