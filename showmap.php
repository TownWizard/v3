<?php
global $var;
include_once('./inc/var.php');
include_once($var->inc_path.'base.php');
_init();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps</title>
    
     <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $var->googgle_map_api_keys;?>"
            type="text/javascript"></script>

    <script language="javascript">
    
    	////////////////////////////////////////////////////////////////////
    	// GMap script talks to Obj C
 		var version 	= "1.0";
 		var map 		= null;
		//var baseicon 	= null;
 		
    	function get_version()
    	{
    		document.location = "gmapApp:version:" + version;
    	}

		////////////////////////////////////////////////
		function add_marker(lat, lng)
		{
			var latlng = new GLatLng(lat,lng);
       		
       		var marker = new GMarker(latlng,{draggable: true});
       		map.addOverlay(marker);
		
		
		    GEvent.addListener(marker, "click", function() 
		    {
    	        sText = marker.getLatLng().lat() + ":" + marker.getLatLng().lng();
    	        window.opener.document.getElementById("ctl00_mainContent_txtLatitude").value = marker.getLatLng().lat().toFixed(8);
                window.opener.document.getElementById("ctl00_mainContent_txtLongitude").value = marker.getLatLng().lng().toFixed(8);
		    });
    	    return marker;
		}


 		////////////////////////////////////////
		// Create a GMap with center lying
		// on specified center
		function create_map(lt, lng)
		{
			if (GBrowserIsCompatible())
			{
				map = new GMap2(document.getElementById("map_canvas"));
		        map.setCenter(new GLatLng(lt, lng), 13);
		        map.addControl(new GSmallMapControl());
        		map.addControl(new GMapTypeControl());
        		
		        add_marker(lt,lng);
			}
		}
    </script>

    <style>
    	body
    	{
    		margin-top:0px;
    		margin-left:0px;
    	}
    </style>

  </head>

  <body onload="create_map(<?=$_REQUEST['lat']?>, <?=$_REQUEST['long']?>)" onunload="GUnload()">

    <div id="map_canvas" style="background-color=: #009ACF; width: 298px; height: 248px; border:#CCC 1px solid;"></div>
<br />
  </body>
</html>