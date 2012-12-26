<?php defined('_JEXEC') or die('Restricted access'); 
include("pagination.php");
if ( JRequest::getInt("jlpriority_fv",0)>0){
	echo $this->loadTemplate('hotspot');
	return;
}

if (!JRequest::getInt("iphoneapp",0)){
	// revert to main layout if not called from iphone
	$maintemplate = dirname(__FILE__)."/../locations2/".basename(__FILE__);
	if ($maintemplate){
		include($maintemplate);
		return;
	}
	else {
		$maintemplate = JPath::find(JPATH_SITE."/components/com_jevlocations/views/locations/tmpl/",basename(__FILE__));
		if ($maintemplate){
			include($maintemplate);
			return;
		}
	}
}
function distance($lat1, $lon1, $lat2, $lon2, $unit) { 

  $theta = $lon1 - $lon2; 
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
  $dist = acos($dist); 
  $dist = rad2deg($dist); 
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344); 
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}
if ($_REQUEST['lat']!="")
	$lat1=$_REQUEST['lat'];
else
	$lat1=0;
if ($_REQUEST['lon']!="")
	$lon1=$_REQUEST['lon'];
else
	$lon1=0;

if ($_REQUEST['filter_loccat']!=0)
	$filter_loccat=$_REQUEST['filter_loccat'];
if (isset($_REQUEST['start']))
	$ii=$_REQUEST['start'];
else
	$ii=0;
	
if(isset($_REQUEST['filter_order']) && $_REQUEST['filter_order']!="")
	$filter_order = $_REQUEST['filter_order'];
else	
	$filter_order = "";
	
if(isset($_REQUEST['filter_order_Dir']) && $_REQUEST['filter_order_Dir']!="")
	$filter_order_Dir = $_REQUEST['filter_order_Dir'];
else	
	$filter_order_Dir = "ASC";
	

#@#
$RES=mysql_query("select id from jos_categories where parent_id=151");
while($idsrow=mysql_fetch_assoc($RES)){
	$allCatIds[] = $idsrow['id'];
}
$allCatIds[] = 151;

$subquery = " AND loccat IN (".implode(',',$allCatIds).") ";
#@#


$path="indexiphone.php?option=com_jevlocations&task=locations.listlocations&tmpl=component&needdistance=1&sortdistance=1&lat=".$lat1."&lon=".$lon1."&bIPhone=". $_REQUEST[bIPhone]."&iphoneapp=1&search=". $_REQUEST[search]."&limit=0&jlpriority_fv=0&filter_loccat=".$filter_loccat."&filter_order=".$filter_order."&filter_order_Dir=".$filter_order_Dir;	
if ($_REQUEST['search']!=='')
	$subquery.="  and (title like '%".$_REQUEST['search']."%' or description like '%".$_REQUEST['search']."%')";
		
	if ($filter_loccat==0)
		$query1 = "SELECT *,(((acos(sin(($lat1 * pi() / 180)) * sin((geolat * pi() / 180)) + cos(($lat1 * pi() / 180)) * cos((geolat * pi() / 180)) * cos((($lon1 - geolon) * pi() / 180)))) * 180 / pi()) * 60 * 1.1515) as dist FROM jos_jev_locations WHERE published=1 ".$subquery;
	else
		$query1 = "SELECT *,(((acos(sin(($lat1 * pi() / 180)) * sin((geolat * pi() / 180)) + cos(($lat1 * pi() / 180)) * cos((geolat * pi() / 180)) * cos((($lon1 - geolon) * pi() / 180)))) * 180 / pi()) * 60 * 1.1515) as dist FROM jos_jev_locations WHERE published=1 and loccat=".$filter_loccat.$subquery;
		
	if($filter_order != "")
		$query1 .= " ORDER BY title ASC ";
	else
		$query1 .= " ORDER BY dist ASC";	
		$rec1=mysql_query($query1) or die(mysql_error());
		$total_data=mysql_num_rows($rec1);
		
		$total_rows=$total_data;
		$page_limit=50;
		$entries_per_page=$page_limit;
		$current_page=(empty($_REQUEST['page']))? 1:$_REQUEST['page'];
		$start_at=($current_page * $entries_per_page)-$entries_per_page;
		$link_to=$path;

//ob_end_clean();
header( 'Content-Type:text/html;charset=utf-8');
?>
<html>
	<head>
		<meta name="viewport" content="width=310, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<script language="javascript">
		ddsmoothmenu.init({
			mainmenuid: "smoothmenu1", //menu DIV id
			orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
			classname: 'ddsmoothmenu', //class added to menu's outer DIV
			//customtheme: ["#1c5a80", "#18374a"],
			contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
		})

		ddsmoothmenu.init({
			mainmenuid: "smoothmenu2", //Menu DIV id
			orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
			classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
			//customtheme: ["#804000", "#482400"],
			contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
		})
		
		function redirecturl(val) {
			url='indexiphone.php?option=com_jevlocations&task=locations.listlocations&tmpl=component&needdistance=1&sortdistance=1&lat=<?=$_REQUEST['lat']?>&lon=<?=$_REQUEST['lon']?>&bIPhone=<?=$_REQUEST['bIPhone']?>&iphoneapp=1&search=<?=$_REQUEST['search']?>&limit=0&jlpriority_fv=0&filter_loccat='+val;
			window.location=url;
		}
		
		function linkClicked(link) { document.location = link; }
		function divopen(str) {
		
			if(document.getElementById(str).style.display=="none") {
				document.getElementById(str).style.display="block";
			} else {
				document.getElementById(str).style.display="none";
			}
		}
		</script>
		<style>
			body { margin-top: 1px; margin-left: 0px; margin-right: 0px; font-family: Helvetica, Arial, sans-serif; }
			.bluetext { color: #0088BB; font-size: 13px; font-weight:bold; }
			.bluetextsmall { color: #00AADD; font-size: 13px; /*font-style: italic;*/}
			.headertext { color: #000000; font-size: 17px; }
			.graytext { color: #777777; font-size: 14px; }
			.graytextSmall { color: #777777; font-size: 13px; }
			.linktext { color: blue; font-size: 14px; text-decoration: underline; }
			.pageitem { background-color: #FFFFFF;display: block;font-size: 12pt;height: auto;list-style: none outside none;margin: 3px 5px 17px;overflow: hidden;padding: 0;position: relative;width: auto;}

		</style>
	</head>
	<body>
		<ul class="pageitem">
		<li class="select">		
			<?php
				//$recsub=mysql_query("select * from jos_categories where section='com_jevlocations2' and published=1 order by `ordering`") or die(mysql_error());
				$recsub=mysql_query("select * from jos_categories where (parent_id=151 OR id=151) AND section='com_jevlocations2' and published=1 order by `ordering`") or die(mysql_error());
			?>
        			<select name="d" onChange="redirecturl(this.value)" style="width:90%; height:40px;border: 0pt none;font-weight:bold;font-size:17px;border: 1px solid #878787;">
					<option value="0">Select a Category</option>
					<option value="0">All</option>
					<?php

						while($rowsub=mysql_fetch_array($recsub)) {
							$querycount = "SELECT * FROM jos_jev_locations WHERE published=1 and loccat=".$rowsub['id'];
							$reccount=mysql_query($querycount) or die(mysql_error());	
							if(mysql_num_rows($reccount)) { ?>
							  <option value="<?=$rowsub['id'];?>" <?php if ($_REQUEST['filter_loccat']==$rowsub['id']) {?> selected <?php }?>><?=$rowsub['title'];?></option>
					<?php
							}
						}
					?>
				</select>
				<div onclick="divopen('q1')" style="padding-top:5px;width:25px; height:25px;float:right;cursor:pointer"><img src="images/find.png" height="25px" width="25px"/></div>		
		</li>
		<div id="q1" style="display:none;cursor:pointer;float:right;margin-top:15px"><form action="" method="post" name="location_form"><input type="text" name="searchvalue" value="" size="35"/><input type="submit" name="search_rcd" value="Search"/></form></div>
		
	</ul>
	<?php if($_POST['search_rcd']!="Search") { ?>
	<ul class="pageitem" style="margin-top:-17px">
		<li>
			<table width="300" cellpadding="0" cellspacing="0" border="0">
			<tr><td colspan="2"></td></tr>
		<?php
		
		if ($filter_loccat==0)
			$query = "SELECT *,(((acos(sin(($lat1 * pi() / 180)) * sin((geolat * pi() / 180)) + cos(($lat1 * pi() / 180)) * cos((geolat * pi() / 180)) * cos((($lon1 - geolon) * pi() / 180)))) * 180 / pi()) * 60 * 1.1515) as dist FROM jos_jev_locations WHERE published=1 ".$subquery;
		else
			$query = "SELECT *,(((acos(sin(($lat1 * pi() / 180)) * sin((geolat * pi() / 180)) + cos(($lat1 * pi() / 180)) * cos((geolat * pi() / 180)) * cos((($lon1 - geolon) * pi() / 180)))) * 180 / pi()) * 60 * 1.1515) as dist FROM jos_jev_locations WHERE published=1 and loccat=".$filter_loccat.$subquery;

		if($filter_order != "")
			$query .= " ORDER BY title ASC LIMIT " .$start_at.','.$entries_per_page;
		else
			$query .= " ORDER BY dist ASC LIMIT " .$start_at.','.$entries_per_page;
		
		$rec=mysql_query($query) or die(mysql_error());
				while($row=mysql_fetch_assoc($rec)) {
					$distance = distance($lat1, $lon1, $row[geolat],  $row[geolon], "m");
					
			?>		
			<tr>
				<td style="width:260px;border-bottom:solid 1px #777777">
					<table cellpadding="1" cellspacing="0" border=0>
						<tr><td style="height:3px"></td></tr>
						<tr><td class="headertext"><?php echo $row[title]; ?></td></tr>		            
						<tr><td class="graytext"><?php 
							$words = str_word_count(strip_tags($row[description]),1);
							$desc = htmlspecialchars(implode(" ",array_slice($words,0,30)));
							if(!empty($desc)){echo $desc .' ...' ;}
							?></td></tr>
						<tr><td class="graytext">
							<?php if (JRequest::getInt("bIPhone",0)){?>
								<!--<a class="linktext" href="javascript:linkClicked('APP30A:MAKECALL:<?php echo $this->escape($row->phone); ?>')"><?php echo $this->escape($row->phone); ?></a> |     -->
								<a class="linktext" href="javascript:linkClicked('APP30A:MAKECALL:<?php echo $this->escape($row[phone]); ?>')"><?php echo $this->escape($row[phone]); ?></a> |     
							<?php } else { 
								echo $this->escape($row[phone])." | ";
							} ?>
								<!--<a class="linktext" href="javascript:linkClicked('APP30A:SHOWDETAILS:<?php echo $row->loc_id; ?>:<?php echo round($distance,1); ?>')">more info</a>
								<a class="linktext" href="javascript:linkClicked('APP30A:SHOWMAP:<?php echo $row->geolon; ?>:<?php echo $row->geolat; ?>')"></a>-->
								<a class="linktext" href="javascript:linkClicked('APP30A:SHOWDETAILS:<?php echo $row[loc_id]; ?>:<?php echo round($distance,1); ?>')">more info</a>
								<a class="linktext" href="javascript:linkClicked('APP30A:SHOWMAP:<?php echo $row[geolon]; ?>:<?php echo $row[geolat]; ?>')"></a>
							</td>
						</tr>
						<tr><td style="height:5px"></td></tr>
					</table>
				</td>
				<td class="graytext" width="40px" style="border-bottom:solid 1px #777777" valign="middle" align="center"><?php echo round($distance,1); ?> miles</td>			
			</tr>			

			<?php } ?>
			</table>
		<?php 
if($total_rows>50) {
echo get_paginate_links($total_rows,$entries_per_page,$current_page,$link_to);}?>	
	
</li>
</ul>
<?php } ?>
		<?php
			if($_POST['search_rcd']=="Search") {
			$searchdata=$_POST['searchvalue'];
		?>
		<ul class="pageitem" style="margin-top:-17px">
		<li>
			<table width="300" cellpadding="0" cellspacing="0" border="0">
			<?php
				$search_query=mysql_query("select * from `jos_jev_locations` where published=1 and title like '%$searchdata%' or description like '%$searchdata%' order by title LIMIT " .$start_at.','.$entries_per_page);
				while($data = mysql_fetch_array($search_query)) {
				$title=$data[title];
				$lat2=$data[geolat];
				$lon2=$data[geolon];
				
			if (JRequest::getFloat("needdistance",0)){
				$lat=JRequest::getFloat("lat",999);
				$lon=JRequest::getFloat("lon",999);
				$km=JRequest::getInt("km",0)?1.609344:1;
	
				$dist = (((acos(sin(($lat*pi()/180)) * sin(($lat2 * pi()/180)) + cos(($lat * pi() / 180)) * cos(($lat2 * pi() / 180)) * cos((($lon - $lon2) * pi() / 180)))))*180/pi())*60*1.1515*$km;
			}
?>
				
			<tr>
				<td style="width:260px;border-bottom:solid 1px #777777">
				<table cellpadding="1" cellspacing="0" border=0>
					<tr><td style="height:3px"></td></tr>
					<tr><td class="headertext"><?php echo $title ?></td></tr>		            
					<tr><td class="graytext"><?php 
					$words = str_word_count(strip_tags($data[description]),1);
					echo htmlspecialchars(implode(" ",array_slice($words,0,30)));
					?></td></tr>
					<tr><td class="graytext">
					<?php if (JRequest::getInt("bIPhone",0)){?>
						<a class="linktext" href="javascript:linkClicked('APP30A:MAKECALL:<?php echo $this->escape($data['phone']); ?>')"><?php echo $this->escape($data['phone']); ?></a> |     
					<?php } else { 
						echo $this->escape($data['phone'])." | ";
					} ?>
						<a class="linktext" href="javascript:linkClicked('APP30A:SHOWDETAILS:<?php echo $data['loc_id']; ?>:<?php echo round($dist,1); ?>')">more info</a>
						<a class="linktext" href="javascript:linkClicked('APP30A:SHOWMAP:<?php echo $data['geolon']; ?>:<?php echo $data['geolat']; ?>')"></a>
			        	</td>
					</tr>
					<tr><td style="height:5px"></td></tr>
				</table>
				</td>
				<td class="graytext" width="40px" style="border-bottom:solid 1px #777777" valign="middle" align="center"><?php echo round($dist,1); ?> miles</td>			
			</tr>				
	
			<?php } ?>
			</table>
		</li>
		</ul>
		<?php } ?>
	</body>
</html>
<?php
exit();