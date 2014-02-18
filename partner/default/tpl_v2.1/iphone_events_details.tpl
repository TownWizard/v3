<div id="main" role="main" ontouchstart="touchStart(event,'list');"  ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);">
	<ul id="placesList" class="mainList">
		<li>
			<?php 
			while($row = mysql_fetch_array($rec))
			{	
				$rowvevdetail = $objevdetail->fetch_eventdetail_data($row['eventdetail_id']);
				if ((int) ($rowvevdetail['location']))
				{
					$rowlocdetail =	$objevdetail->fetch_location_detail($rowvevdetail['location']);
					$lat2 = $rowlocdetail['geolat'];
					$lon2 = $rowlocdetail['geolon'];
				}
			 ?>
			<h1><?php echo $rowvevdetail['summary'];?></h1>
			<p><strong><?php echo JText::_('DATE'); ?>:</strong> <?php echo $todaestring;?></p>
			<p><strong><?php echo JText::_('EV_DISP_TIME'); ?>:</strong>
			<?php
			/* Coded By Akash */
				$displayTime = '';
				if($time_format == "12"){
					if($row['timestart']=='12:00 AM' && $row['timeend']=='11:59 PM'){   
						$displayTime.=JText::_('ALL_DAY');
					}else{
						$displayTime.= $row['timestart'];
						if ($row['timeend'] != '11:59 PM' ){
							$displayTime.="-".$row['timeend'];
						}
					}
				}else{
					$stime = date("H:i", strtotime($row['timestart']));
					$etime = date("H:i", strtotime($row['timeend']));
					if($stime=='00:00' && $etime=='23:59'){   
						$displayTime.=JText::_('ALL_DAY');
					}else{
						$displayTime.= $stime;
						if ($etime!='23:59' ){
							$displayTime.="-".$etime;
						}
					}
				}
				echo $displayTime;
	   		/* End By Akash */	
			?>
			</p>
			<p><strong><?php echo JText::_('LOCATION'); ?>:</strong> <?php echo $rowlocdetail['title'];?></p>
   <p><strong><?php echo JText::_('ADDRESS'); ?>:</strong><?php echo $rowlocdetail['street'];?></p>
<!--   <p><strong><?php echo JText::_('PHONE'); ?>:</strong> <a href="tel:<?php echo str_replace(array(' ','(',')','-','.'), '',$rowlocdetail['phone'])?>"><?php echo $rowlocdetail['phone'];?></a></p>-->
   <p><strong><?php echo JText::_('DISTANCE'); ?>:</strong> <?php echo round(distance(($_SESSION['lat_device1']), ($_SESSION['lon_device1']), $lat2, $lon2,$dunit),'1')?>&nbsp;<?php echo $dunit;?></p>
<!--   <?php if(trim($rowlocdetail['url']) != '') { ?>
   <p><strong><?php echo JText::_('WEBSITE'); ?>:</strong> <a href="http://<?php echo str_replace('http://','',$rowlocdetail['url']); ?>" target="_blank"><?php echo str_replace('http://','',$rowlocdetail['url']); ?></a></p>
    <?php } ?>-->
   <p><strong><?php echo JText::_('DISCRIPTION'); ?>:</strong> <?php echo $rowvevdetail['description'];?></p>
 
   
   <ul class="btnList">
    <li><a href="tel:<?php echo str_replace(array(' ','(',')','-','.'), '',$rowlocdetail['phone'])?>" class="button small"><?php echo $rowlocdetail['phone'];?></a></li>
    <li><a href="http://<?php echo str_replace('http://','',$rowlocdetail['url']); ?>" class="button small"><?php echo JText::_('WEBSITE'); ?></a></li>
    <li><a href="javascript:linkClicked('APP30A:SHOWMAP:<?php echo $lat2;?>:<?php echo $lon2;?>')" class="button small"><?php echo JText::_('TW_MAP'); ?></a></li>
    <li>
     <a href="#" class="button small">
     
    <!-- code for ical calendar start-->
    <?php  $cal_date=date('m-d-Y', mktime(0, 0, 0, $tomonth, $today, $toyear)); ?>      
     <div class="addthisevent">
      <?php if($displayTime=='All Day Event'){ ?> 
       <span class="_all_day_event">true</span>
         <?php } ?>
       <span class="_start"><?php echo $cal_date.' '.$row['timestart'] ?></span>
          <span class="_end"><?php echo $cal_date.' '.$row['timeend'] ?></span> 
        <span class="_summary"><?php echo $rowvevdetail['summary'];?></span>
         <span class="_description"><?php echo $rowvevdetail['description'];?></span>
          <span class="_location"><?php echo $rowlocdetail['title'];?></span>
        <span class="_date_format">MM/DD/YYYY</span>
     </div>
   <!-- code for ical calendar end--> 
     </a>
    </li>
    <li><a href="javascript:linkClicked('APP30A:FBCHECKIN:34.13828278:-118.35331726')" class="button small"><?php echo JText::_('CHECK_IN');?></a></li>
    <li><a href="http://www.addthis.com/bookmark.php?v=300&amp;pubid=xa-530314602dbf0b6a" class="button small addthis_button"><?php echo JText::_('TW_SHARE');?></a></li>
   </ul>
   <?php }?>
  </li>

 </ul>

</div>

<!-- AddThis Button BEGIN -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-530314602dbf0b6a"></script>
<!-- AddThis Button END -->