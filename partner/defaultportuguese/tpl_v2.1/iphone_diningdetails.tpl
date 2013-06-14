 <div id="main" role="main">
	<ul id="placesList" class="mainList" ontouchstart="touchStart(event,'list');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);">
<li>
	<?php 
	while($row=mysql_fetch_array($rec))
	
	{
	$lat2=$row['geolat'];
	$lon2=$row['geolon'];
	?>
	
		<h1><?php echo $row['title'];?></h1>
		<p>
			<?php
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			if(stripos($ua,'android') == true) { 
			?>
			<strong>Endere&#231;o:</strong>&nbsp;&nbsp<a href="map.php?lat=<?php echo $lat2;?>&long=<?php echo $lon2;?>">;<?php echo $row['street'];?></a>
			<br />
			<?php } 
			else {
			?>
			<strong>Endere&#231;o:</strong>&nbsp;&nbsp<a href="javascript:linkClicked('APP30A:SHOWMAP:<?php echo $lat2;?>:<?php echo $lon2;?>')"><?php echo $row['street'];?></a>
			<?php } ?>
		</p>
	
		
		<p>
		<strong>Telefone:</strong>&nbsp;&nbsp;<a href="tel:<?php echo str_replace(array(' ','(',')','-','.'), '',$row[phone])?>"><?php echo $row[phone];?></a>
		</p>
		
		<p><strong>Distancia:</strong>&nbsp;&nbsp;<?=round(distance($lat1, $lon1, $lat2, $lon2,$dunit),'1')?><?php echo $dunit;?></p>
		
		<?php if ($row['url']!=''){ ?>
		<p>
			<strong>Website:</strong>&nbsp;&nbsp;
			<a href="http://<?php echo str_replace('http://','',$row['url']); ?>" target="_blank">
				<?php echo str_replace('http://','',$row['url']); ?>
			</a>
		</p>
		<?php } ?>
		
		<?php if ($row['description']!=''){ ?>
		<p>
			<strong>Descri&#231;&#227;o:</strong>
			 <?php echo stripJunk(utf8_encode($row['description'])); ?>
		</p>

		<?php } ?>
		<ul class="btnList">
			<li><a href="tel:<?php echo str_replace(array(' ','(',')','-','.'), '',$row[phone])?>" class="button small">Ligue</a></li>
			
			<?php
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			if(stripos($ua,'iphone') == true) { 
			?>
			<li><a href="javascript:linkClicked('APP30A:FBCHECKIN:<?php echo $row[geolat];?>:<?php echo $row[geolon];?>')" class="button small">Check In</a></li>
			<?php } ?>
		</ul>
		<?php  } ?>
	</li> <!-- end place -->
</ul> <!-- end place list -->
</div> <!-- main -->
<div style='display:none;'>
<?php echo $pageglobal['googgle_map_api_keys']; ?>
</div>
