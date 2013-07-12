<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Hotels | home</title>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style.css">
<link rel="stylesheet" media="all" href="<?php echo base_url();?>style/type/folks.css" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/css/ie7.css" media="all" />
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>style/js/jquery-1.5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/scripts.js"></script>
<script type="text/javascript">
$(function() {
			if ($('#sliderholder-cycle').length) {
			// timeouts per slide (in seconds) 
			var timeouts = [150,390,25]; 
			function calculateTimeout(currElement, nextElement, opts, isForward) { 
			    var index = opts.currSlide; 
			    return timeouts[index] * 1000;
			}
			jQuery('#sliderholder-cycle').cycle({
				fx: 'fade',
				pager: '.slidernav',
				prev:    '.sliderprev',
        		next:    '.slidernext',
				speed: 1000,
				timeoutFn: calculateTimeout,
				pagerEvent: 'click',
    			pauseOnPagerHover: true,
    			cleartype: 1
});
			jQuery('#sliderholder-cycle').css("display", "block");
			jQuery('.slidernav').css("display", "block");
			
			}
}); 
</script>
</head>
<body>
<div id="container"> 
  <!-- Begin Header Wrapper -->
  <div id="page-top">
    <div id="header-wrapper"> 
      <!-- Begin Header -->
      <div id="header">
        <div id="logo"><a href="index.html"><img src="<?php echo base_url();?>style/images/logo2.png" alt="Delphic" /></a></div>
        <!-- Logo --> 
        <!-- Begin Menu -->
        <div id="menu-wrapper">
          <div id="smoothmenu1" class="ddsmoothmenu">
            <ul>
              <li><a href="<?php echo base_url();?>" class="selected">Home</a>
               
              </li>
              <li><a href="<?php echo base_url();?>hotel/show_hotels/">Hotels</a>
               <!--  <ul>
                  <li><a href="blog-1.html">Blog</a></li>
                  <li><a href="blog-2.html">News</a></li>
                  <li><a href="blog-single.html">Single Blog Post</a></li>
                </ul> -->
              </li>
              <li><a href="<?php echo base_url();?>room/show_rooms/1">Rooms</a>
                
              </li>
             <li><a href="services.html">Services</a></li>

              <li><a href="<?php echo base_url();?>main/show_contact">Contact</a></li>
              <?php
              $base=base_url();
               if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['je_logovan']==1){
                

                echo ("<li><a href='".$base."main/logout'>Logout</a>");
              }
              else{
                echo ("<li><a href='".$base."login/show_login'>Log in</a>");
              } ?>
              
          
             
              
                
              
              <?php if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['uloga']==1){
                echo  "<li><a href='".$base."main/show_admin'>Admin</a>";

               } ?>
               <?php if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['uloga']==2){
                echo  "<li><a href='".$base."main/show_moderator'>Moderator</a>";

               } ?>
            </ul>
          </div>
        </div>
        <!-- End Menu --> 
      </div>
      <!-- End Header --> 
    </div>
  </div>
  <!-- End Header Wrapper --> 
  
  <!-- Begin Slider -->
  <div id="cycle-wrapper">
    <div id="sliderholder-cycle">
	<!-- <img src="style/images/art/slider-1.jpg" width="960" height="380" /> -->
  <img src="style/images/slajdovi/slika1.jpg" width="960" height="380" />
  <img src="style/images/slajdovi/slika2.jpg" width="960" height="380" />
  <img src="style/images/slajdovi/slika3.jpg" width="960" height="380" />
  
  <img src="style/images/slajdovi/slika5.jpg" width="960" height="380" />
  <img src="style/images/slajdovi/slika6.jpg" width="960" height="380" />
	  </div>
    <ul class="slidernav">
    </ul>
    <div class="sliderdir"> <a href="#"><span class="sliderprev">Prev</span></a> <a href=""><span class="slidernext">Next</span></a> </div>
  </div>
  <!-- End Slider --> 
  
  <!-- Begin Wrapper -->
  <div id="wrapper"> 
    
    <!-- Begin Intro -->
    <div class="intro">
      <h1>Our hotel reviews will help you find the best deal in the right location. Whether you are travelling last minute, as a family or need a hotel for business we have the right hotel deal for you</h1>
    </div>
    <!-- End Intro --> 
    
    <!-- Begin About -->
    <div id="about">
      <div class="one-fourth"> <a href="#"><img src="<?php echo base_url();?>img/firstthumb.png" alt="" width="211px" height="120px"/></a>
        <h4>Elegant Style</h4>
        <p>Guests can choose from variety of rooms and suites, distinguished by simplicity in form, inspired by the cosmopolitan spirit and needs of modern businessmen.</p>
      </div>
      <div class="one-fourth"> <a href="#"><img src="<?php echo base_url();?>img/secondthumb.png" alt="" width="211px" height="120px"/></a>
        <h4>Soothing Ambience</h4>
        <p>Warm colors and esthetic diversity, a play of light and fragrances combined with a soothing ambience, will give you the relaxation you need.</p>
      </div>
      <div class="one-fourth"> <a href="#"><img src="<?php echo base_url();?>img/thirdthumb.png" alt="" width="211px" height="120px"/></a>
        <h4>Take Care Of Your Body</h4>
        <p>Wellness and fitness club catering to both body and mind, featuring the latest in fitness and training equipment. Recreation facilities include an indoor swimming pool, whirlpool, sauna, steam bath etc.</p>
      </div>
      <div class="one-fourth last"> <a href="#"><img src="<?php echo base_url();?>img/forththumb.png" alt="" width="211px" height="120px"/></a>
        <h4>Group Booking Request</h4>
        <p>If you are planning to travel as part of a group and need to book 6 or more rooms please make a request, and our group department will respond to your request within 2 business days.</p>
      </div>
    </div>
    <!-- End About --> 
    
  </div>
  
  <!-- End Wrapper -->
  <div class="clearfix"></div>
  <div class="push"></div>
</div>

<!-- Begin Footer -->
<div id="footer-wrapper">
  <div id="footer">
    <div id="footer-content"> 
      
      <!-- Begin Copyright -->
      <div id="copyright">
        <p>© Copyright 2011 Delphic | Creative Portfolio Template</p>
      </div>
      <!-- End Copyright --> 
      
      <!-- Begin Social Icons -->
      <div id="socials">
        <ul>
          <li><a href="#"><img src="<?php echo base_url();?>style/images/icon-rss.png" alt="" /></a></li>
          <li><a href="#"><img src="<?php echo base_url();?>style/images/icon-twitter.png" alt="" /></a></li>
          <li><a href="#"><img src="<?php echo base_url();?>style/images/icon-dribble.png" alt="" /></a></li>
          <li><a href="#"><img src="<?php echo base_url();?>style/images/icon-tumblr.png" alt="" /></a></li>
          <li><a href="#"><img src="<?php echo base_url();?>style/images/icon-flickr.png" alt="" /></a></li>
          <li><a href="#"><img src="<?php echo base_url();?>style/images/icon-facebook.png" alt="" /></a></li>
        </ul>
      </div>
      <!-- End Social Icons --> 
      
    </div>
  </div>
</div>
<!-- End Footer -->
</body>
</html>