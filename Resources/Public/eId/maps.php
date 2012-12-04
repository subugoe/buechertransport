<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

require_once(t3lib_extMgm::extPath('nkwlib') . 'class.tx_nkwlib.php');

/**
 * Ajax Funktion fuer das bedarfsorientierte Nachladen der Maps
 * $Id: maps.php 1957 2012-12-04 16:09:00Z simm $
 * @author Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>, Dominic Simm <simm@sub.uni-goettingen.de>
 */

if (!$_POST['uid']) {
	die('Buechertransport: Direktes Aufrufen des Scripts ist nicht erlaubt');
}	else 	{
	$uid = intval(t3lib_div::_GP('uid'));
}

$db_name = 'tx_buechertransport_domain_model_province';
$db_handler = tslib_eidtools::connectDB();

$sql_result = $GLOBALS["TYPO3_DB"]->exec_SELECTquery(
		"name",		 		// SELECT ...
		$db_name, 			// FROM ...
		"uid=" . $uid, 		// WHERE...
		"", 				// GROUP BY...
		"", 				// ORDER BY...
		"1"					// LIMIT ...
);

$lat = ''; $lng = '';
if ($sql_result) {
	if ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($sql_result)) {
		$geo = tx_nkwlib::geocodeAddress($row['name']);
		if ($geo["status"] == "OK")	{
			$lat = $geo["results"][0]["geometry"]["location"]["lat"];
			$lng = $geo["results"][0]["geometry"]["location"]["lng"];
			$coords = $lat . ',' . $lng;
		}	else {
			print "Problem while retrieving map data.";
		}
	}
}

/**
 * Adresse erstellen
 * @param <type> $titel
 * @param <type> $strasse
 * @param <type> $plz
 * @param <type> $ort
 * @return string 
 */
function generiereAdresse($titel, $strasse, $plz, $ort) {
	$adresse = '<strong>' . $titel . '</strong><br />' . $strasse . '<br />' . $plz . ' ' . $ort;
	return $adresse;
}
?>

<!-- Fusion_table_id: 419167, 420419 -->
<!-- https://www.google.com/fusiontables/DataSource?dsrcid=419167 -->

<script type="text/javascript">
	
	var latlng = new google.maps.LatLng(<?php echo $coords; ?>);
	var myOptions = {
		center: latlng,

		zoom: 7,
		mapTypeId: google.maps.MapTypeId.HYBRID,
		navigationControl: true,
		navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
		scaleControl: true,
		streetViewControl: false 
		
		// zoom: 14,
		// disableDefaultUI: true,
		// mapTypeId: google.maps.MapTypeId.ROADMAP,
	};
	var map = new google.maps.Map(document.getElementById("map-province_<?php echo $uid; ?>"), myOptions);
	var myLatLng = new google.maps.LatLng(<?php echo $coords; ?>);

		//Content
	var inhalt = '<div class="standorte-infobox"><?php echo $adresse . ' ' . $url; ?></div>';

		//Info-Bubble
	var infowindow = new google.maps.InfoWindow({
		content: inhalt
	});

		//Marker
	var marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: <?php echo json_encode($titel); ?>
	});

		//Click Listener
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map,marker);
	});
</script>
