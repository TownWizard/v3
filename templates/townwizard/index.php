<?php
/**
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

global $var;

include_once($_SERVER['DOCUMENT_ROOT'].'/inc/var.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

_init();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />


<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo $var->keywords; ?>" />
<meta name="description" content="<?php echo $var->metadesc; ?>" />
<meta name="description" content="<?php echo $var->extra_meta; ?>" />
<meta property="og:image" content="http://<?php echo $_SERVER['HTTP_HOST']?>/partner/<?php echo $_SESSION['partner_folder_name']?>/images/logo/logo.png"/>

<!-- set css and js path for new design v3 -->

<meta name="viewport" content="width=device-width;initial-scale = 1.0,maximum-scale = 1.0" />
<link rel="stylesheet" type="text/css" href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/css/fonts.css" />
<link rel="stylesheet" type="text/css" href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/css/core.css" />
<link rel="stylesheet" type="text/css" href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/css/tablet.css" />
<link rel="stylesheet" type="text/css" href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/css/events.css" />

<!-- Add css for location image pop up -->
<link rel="stylesheet" type="text/css" href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/css/jquery.fancybox.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/js/jquery.carouFredSel-6.1.0-packed.js"></script>
<script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/js/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/js/yetii-min.js"></script>
<script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/js/tw.js"></script>

<!-- Add jQuery library for location image pop up -->

<script type="text/javascript">
 
$(document).ready(function(){
//open popup
$("#pop").click(function(){
$("#overlay_form").fadeIn(500);
positionPopup();
});
 
//close popup
$("#close").click(function(){
$("#overlay_form").fadeOut(500);
});
});
 
//position the popup at the center of the page
function positionPopup(){
if(!$("#overlay_form").is(':visible')){
return;
}
$("#overlay_form").css({
left: ($(window).width() - $('#overlay_form').width()) / 2,
top: ($(window).width() - $('#overlay_form').width()) / 6,
position:'absolute'
});
}
 
//maintain the popup at center of the page when browser resized
$(window).bind('resize',positionPopup);
 
</script>
<!-- Add jQuery library for location image pop up END-->

<!-- Share This -->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
	stLight.options({
		publisher:'fe72f22e-436e-4b4e-9486-bbcb87276adc',
	});
</script>
<!-- Share This End-->

<!-- End css and js path for new design v3 -->

<!-- use favicon icon for v2 -->
<link rel="shortcut icon" href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/partner/<?php echo $_SESSION['partner_folder_name'];?>/images/favicon.ico" />

<!--  CODE for SAFARI BROWSER DETECTION BEGIN -->
	<script>
	// First Time Visit Processing
	// copyright 10th January 2006, Stephen Chapman
	// permission to use this Javascript on your web page is granted
	// provided that all of the below code in this script (including this
	// comment) is used without any alteration
	function rC(nam) {var tC = document.cookie.split('; '); for (var i = tC.length - 1; i >= 0; i--) {var x = tC[i].split('='); if (nam == x[0]) return unescape(x[1]);} return '~';} function wC(nam,val) {document.cookie = nam + '=' + escape(val);} function lC(nam,pg) {var val = rC(nam); if (val.indexOf('~'+pg+'~') != -1) return false; val += pg + '~'; wC(nam,val); return true;} function firstTime(cN) {return lC('pWrD4jBo',cN);} function thisPage() {var page = location.href.substring(location.href.lastIndexOf('\/')+1); pos = page.indexOf('.');if (pos > -1) {page = page.substr(0,pos);} return page;}

	// example code to call it - you may modify this as required
	function start() {
	   if (firstTime(thisPage())) {
	      // this code only runs for first visit
	     if((navigator.userAgent.match(/iphone/i)) || (navigator.userAgent.match(/ipad/i)) || (navigator.userAgent.match(/ipod/i))) {
	  var r=confirm("We have an iPhone app too! Click OK to install the app.");
	   if (r==true){window.location = "<?php echo $var->iphone?>";}
	     } 
	     else if (navigator.userAgent.match(/android/i)) {
	     var r=confirm("We have an Android app too! Click OK to install the app.");
	     if (r==true){location.href="<?php echo $var->android?>";}
	 }else {}
	   }
	   // other code to run every time once page is loaded goes here
	}
	onload = start;

	</script>
<!--  CODE for SAFARI BROWSER DETECTION END -->


<script>
	/* Facebook login function */
	function fb_login() {
		window.open("/townwizard-db-api/fb-login.php", "_blank", "height=400,width=600,status=no,toolbar=no,menubar=no");
	}

	/* Twitter login function */
	function twitter_login() {
		window.open("/townwizard-db-api/twitter-login.php", "_blank", "height=400,width=600,status=no,toolbar=no,menubar=no");
	}
  	
	function tw_logout() {
		$.ajax({
			url: "townwizard-db-api/logout.php",
			type: "get",
			complete: function() {
			window.location.reload();
			}
		});
	}
	
	/* Function for RSVP */
	function tw_create_rsvp() {
		alert("hello1");
		$.ajax({
			url: "townwizard-db-api/sample_pages/rsvp/rsvp.php",
			type: "POST",
			complete: function() {
			window.location.reload();
			}
		});
	}

</script>

<script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle("slow");
  });
});
</script>

<style type="text/css"> 
#panel,#flip
{
padding:5px;
text-align:center;
background-color:#f8f8f8;
}
#panel
{
padding:50px;
display:none;
}
</style>

<!--  Town wizard Google Analytic code -->
<?php include("ga.php"); ?>

</head>

<body>
 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);	
}(document, 'script', 'facebook-jssdk'));</script>
  
 			  
 <!-- Top Bar Start -->
  <div id="TopBar" style="background:url('<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/header/whitezig_zag.png') repeat-x scroll left bottom <?php echo $var->Header_color; ?>;height: 50px;">
  	<div class="sWidth">
  	  <div class="fl powered"><?php echo JText::_("TW_POWERED_BY") ?><img alt="townwizard" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/header/twBanner.png" /></div>
		  <?php if($this->countModules('top')): ?>
          <div class="fr links">
            <jdoc:include type="modules" name="top" style="rounded" />
          </div>
          <?php endif; ?>
  	</div>
  </div>

  <!-- Top Bar End -->

  <!-- Content Start -->

  <div id="Content" class="sWidth">
  	
  	<!-- Header Start -->

	  	<div id="Header">
	  	  <div id="Logo" class="fl">
	  	  	<a href="index.php" title="HOME"> <img src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/partner/<?php echo $_SESSION['partner_folder_name']?>/images/logo/logo.png" height="118" width="192" /> </a>
	  	  </div>
	  	     <div class="headerAdFlex fl">
	  	  	  <div id="Social" class="fr">
	            <div>
					<!-- SOCIAL LOGIN START -->
					<?php if($_SESSION['tw_user_name']) { ?>
						<div id="LoggedIn" class="fl" style="font-size:11.5px; width:270px; text-align: right;">
							<img style="float:right;padding:0px;" src="<?php echo $_SESSION['tw_user_image_url']; ?>">
                			<span style="padding-right:60px; display: block;">Welcome to <?php echo $var->site_name.' '.$_SESSION['tw_user_name']; ?>!</span>
							<span><a style="padding-right:60px;"   class="logOut" href="javascript:void(0)" onclick="tw_logout();">Click here to sign out</a></span>
							<?php $user = $_SESSION['tw_user']; ?>                      				
						</div>	
					<?php }  else { ?>
						<div>
							<a href="javascript:void(0)" onclick="fb_login();"><img alt="Login with Facebook" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/header/fbLoginBtn.png" /></a>
							<a href="javascript:void(0)" onclick="twitter_login();"><img alt="Login with Twitter" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/header/twtLoginBtn.png" /></a>
						</div>	
					<?php } ?>
						
				  <!-- SOCIAL LOGIN END -->
	              <!-- <a href="#"><img alt="Help" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/header/helpBtn.png" /></a> -->
	            </div>
	          </div>
              <div id="UpperBannerAd" class="bannerAd">
	  	  	  	<?php if($this->countModules('banner1')) : ?>
				<div class="bannerCont">
	  	  	      <!-- TOP BANNER AD -->
	  	  	    	 <jdoc:include type="modules" name="banner1" style="rounded" />
         		 </div>
				 <?php else: ?>
					 <img alt="Default Banner" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/header/default_banner.png" />
				  <?php endif; ?>
	  	  	  </div>
	  	    </div>
	  	    
			<?php require ("./inc/config.php"); 
				$handle = fopen($query, "r");
				$xml = '';
				// Applying condition for $handle variable to check weather it is null or not
				if($handle != null || !empty($handle)){
					while (!feof($handle)) {
				  		$xml.= fread($handle, 8192);
					}
				}
				fclose($handle);
				$data = XML_unserialize($xml);
			?>
	  	    <div id="GuideInfo" class="cr">
	  	      <div class="localCont">
	            <div id="Local" class="fl">
					<div id="Weather" class="fr">
	  				<?php
						echo str_replace('N/A','--',$data[weather][cc][tmp]) . "&#176; ";
						echo " <a href='http://www.weather.com/weather/today/$var->location_code' target='_blank'><img  SRC='/common/images/weather/" . $data[weather][cc][icon] . ".png' height='25' border='0' style='vertical-align: middle;'></a>";
					?>
					</div> 
	  	      	    <?php echo $var->beach; ?> 
	            </div>
	          </div>
              
			  <?php if($this->countModules('search')) : ?>
	          <div class="search fr">
	  	  	    <jdoc:include type="modules" name="search" style="rounded" />
         	 </div>
         	 <?php endif; ?>
             
	  	    </div>
	  	</div>

  		<!-- Header End -->

  	<div id="MainContent">
  	  
  	 <!-- Left Column Start -->

        <div id="LeftCol" class="fl">
		        <?php if($this->countModules('menu')) : ?>
                <div id="MainNav" class="display">
                  	<jdoc:include type="modules" name="menu" style="rounded" />
				</div>
				<?php endif; ?>
               
                <?php if($var->android != "" || $var->iphone != ""):?>
                <div id="SideMobile" class="sect">
                  <h2>TownWizard <?php echo JText::_("TW_MOBILE") ?>!</h2>
                  <p><?php echo JText::_("TW_CLICKHERE") ?>.</p>
                  <?php if($var->iphone != ""):?>
                    <a href="<?php echo $var->iphone?>" target="_blank"><img alt="Download for the iPhone/iPad" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/sidebar/iphoneAppBtn.png" /></a>
                  <?php endif;?>
                  
                  <?php if($var->android != ""):?>
                  <a href="<?php echo $var->android?>" target="_blank"><img alt="Download for Android" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/sidebar/androidAppBtn.png" /></a>
                  <?php endif;?>
                </div>
                  <?php endif;?>

                
                <?php if($var->youtube != "" || $var->twitter != ""):?>
                  <div id="SideSocial" class="sect">
                  <h3 class="display"><?php echo JText::_("TW_FOLLOWUS") ?></h3>
                   <?php if($var->twitter != ""):?>
                  <a class="twitter" href="<?php echo $var->twitter ?>" target="_blank"><img alt="Follow us on Twitter" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/sidebar/twtFollowBtn.png" /></a>
                  <?php endif;?>
                  <?php if($var->youtube != ""):?>
                  <a class="youtube" href="<?php echo $var->youtube ?>" target="_blank"><img alt="Follow us on YouTube" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/sidebar/ytFollowBtn.png" /></a>
                  <?php endif;?>
                </div>
                  <?php endif;?>
                
                <?php if($this->countModules('banner2')) : ?>
                <div id="SideAds" class="sect">
                            <div class="ad space">
                                <jdoc:include type="modules" name="banner2" style="rounded" />
                            </div>
                   
                </div>
                <?php endif; ?>
        </div>

  	  <!-- Left Column End -->

  	  <div id="WidgetArea">
		 <!-- Placeholder for Header Banner Ad in Vertical Layout Start -->

     	<div id="LowerBannerAd" class="bannerAd"></div>

      <!-- Placeholder for Header Banner Ad in Vertical Layout End -->
	  
       <!-- Event Rotator Start -->
 	<?php if(JRequest::getVar('Itemid') == 97 && JRequest::getVar('task') == 'range.listevents'):?>
  
 	<div class="fl">
			<?php if($this->countModules('searchevent')) : ?>
	            <div>
	                  <jdoc:include type="modules" name="searchevent" style="rounded" />
	                   <div class="cb"></div>
	             </div>
          	<?php endif; ?>
       		
			<?php if($this->countModules('slider')) : ?>
	            <div>
	                  <jdoc:include type="modules" name="slider" style="rounded" />
	                   <div class="cb"></div>
	             </div>
          	<?php endif; ?>
    </div>
       	<?php endif; ?>     
     <!-- Event Rotator End -->
     
	 <?php if(JRequest::getVar('task') == 'range.listevents') :?>
		 <?php if($this->countModules('right')) : ?>
	            <div class="rightCol fr">
	             	<jdoc:include type="modules" name="right" style="rounded" />
	            </div>
	      <?php endif; ?>
	  <?php endif; ?>
	  
      <!-- Main body start -->
            <div class="centerCol fl">
            		<div id="Try3" class="sect">
                    	<?php if( JRequest::getVar( 'view' ) == 'frontpage' ) { ?>
						 <div class="description">
						<?php } else { ?>
						<div class="cont">	
						<?php } ?>
	                             <jdoc:include type="message" />
	                            
								 <jdoc:include type="component" />
								
								
								<?php if($_SESSION['tw_user_name']){ ?> 
									<!-- Code for RSVP begin here --> 
									<!-- <form id="rsvp_form" method="POST" onsubmit="tw_create_rsvp();"> -->
									<form id="rsvp_form" method="POST" action="townwizard-db-api/sample_pages/rsvp/rsvp.php">
										Please enter your reponse.<br/><br/>
										<input type="hidden" value="3380" name="eventId" />
										<input type="hidden" value="" name="eventDate" />
										<b>Yes <input type="radio" name="value" value="Y"/>
										No <input type="radio" name="value" value="N" />
										May be <input type="radio" name="value" value="M" />&nbsp;&nbsp;
										</b>
										<input type="submit" name="Submit" />
									</form>
									 <?php //echo tw_get_rsvps_by_user(); ?>
									 <!-- Code for RSVP End here --> 
								<?php }else{ ?>
								
									<div id="flip"><strong>RSVP This Event</strong></div>
									<div id="panel">
										<a href="javascript:void(0)" onclick="fb_login();"><img alt="Login with Facebook" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/header/fbLoginBtn.png" /></a>
										<a href="javascript:void(0)" onclick="twitter_login();"><img alt="Login with Twitter" src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/templates/townwizard/images/header/twtLoginBtn.png" /></a></div>
									</div>
								<?php }?>
								
								
	                            
                         </div>
						 
              	   </div>
             </div>
  	  <!-- Main body end -->	
	  
	  
	  <?php if(JRequest::getVar('evid') != '') :?>
	  
			 <?php if($this->countModules('ev_right')) : ?>
		            <div class="rightCol fr">
		             	<jdoc:include type="modules" name="ev_right" style="rounded" />
		            </div>
		      <?php endif; ?>
			 
	 <?php endif; ?>	
	  
 	<?php if(JRequest::getVar('Itemid') == 97 && JRequest::getVar('task') == 'range.listevents'):?>
				<?php if($this->countModules('slider')) : ?>
					<div id="neg" class="adSect rightCol fr">
				<?php else: ?>
					<div class="adSect rightCol fr">	
				<?php endif; ?>
	<?php else: ?>
				<div class="adSect rightCol fr">	
	<?php endif; ?>		

		  	  	<!-- 300 x 100 Banner Ad Start -->
				<?php if($this->countModules('banner3')) : ?>
		  	  	<div class="ad space">
		  	  		 <jdoc:include type="modules" name="banner3" style="rounded" />
		        </div>
		       <?php endif; ?>

		  	  	<!-- 300 x 100 Banner Ad End -->

  	  </div>

  	  

		  	   <div class="adSect tall rightCol fr cr">

		            <!-- 300 x 600 Banner Ad Start -->
		    		<?php if($this->countModules('banner4')) : ?>
		            <div class="ad">
		              <jdoc:include type="modules" name="banner4" style="rounded" />
		            </div>
		           <?php endif; ?>
		    
		            <!-- 300 x 600 Banner Ad End -->

		  	  </div>
  	  
		</div>
  	  <div class="cb"></div>
  	</div>
  </div>

  <!-- Content End -->

  <!-- Footer Start -->

  <div id="Footer">
  	<div class="sWidth">
  	  <ul>
    	<?php if($this->countModules('footer1')) : ?>
        <li class="about">
          <div class="pad">
          	<h3 class="display"><?php echo JText::_("TW_ABOUT").' '.$var->site_name; ?></h3>
           	<jdoc:include type="modules" name="footer1" style="rounded" />
           </div>
         </li>
         <?php endif; ?>
         
         <?php if($this->countModules('footer2')) : ?>
        <li class="site">
          <div class="pad">
         		<h3 class="display"><?php echo $var->site_name." is a TownWizard Site" ?></h3>
                <span><?php echo JText::_("TW_OTHER_TW") ?></span>
           		<jdoc:include type="modules" name="footer2" style="rounded" />
                <a class="all" href="http://www.townwizard.com/locations/" target="_blank"><?php echo JText::_("TW_SEE_ALL_PARTNER") ?> &gt;</a>
           </div>
         </li>
         <?php endif; ?>
          <?php if($this->countModules('footer3')) : ?>
            <li class="community">
              <div class="pad">
                    <h3 class="display"><?php echo JText::_("TW_COMMUNITY") ?></h3>
                    <jdoc:include type="modules" name="footer3" style="rounded" />
              </div>
            </li>
         <?php endif; ?>
      </ul>
      <div class="footer_tag">
     		 <?php if($this->countModules('footer')) : ?>
            <div class="legal bold">
                   <jdoc:include type="modules" name="footer" style="rounded" />
            </div>
            <?php endif; ?>
        	<div class="twlogo bold">| &copy;&nbsp;<?PHP $time = time () ; $year= date("Y",$time); echo $year . "&nbsp;" . $var->site_name; ?> TownWizard</div>
        </div>
  	</div>
  </div>

  <!-- Footer End -->

</body>
</html>