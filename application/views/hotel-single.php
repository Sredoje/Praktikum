<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Hotels | Single hotel </title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style.css">
<link rel="stylesheet" media="all" href="<?php echo base_url();?>style/type/folks.css" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/css/ie7.css" media="all" />
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>style/js/jquery-1.5.min.js"></script>
<script type="srele/javascript" src="<?php echo base_url();?>style/js/jquery.cycle.all.min.js"></script>
<script type="srele/javascript" src="<?php echo base_url();?>style/js/ddsmoothmenu.js"></script>
<script type="srele/javascript" src="<?php echo base_url();?>style/js/scripts.js"></script>
<style type="text/css">
#acom{
text-decoration: underline;

  }</style>
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
              <li><a href="<?php echo base_url();?>">Home</a>
               
              </li>
              <li><a href="<?php echo base_url();?>hotel/show_hotels/" class="selected">Hotels</a>
                <ul>
                  <li><a href="blog-1.html">Blog</a></li>
                  <li><a href="blog-2.html">News</a></li>
                  <li><a href="blog-single.html">Single Blog Post</a></li>
                </ul>
              </li>
              <li><a href="<?php echo base_url();?>room/show_rooms/1" >Rooms</a>
               
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
              
               
              </li>
            </ul>
          </div>
        </div>
        <!-- End Menu -->
      </div>
      <!-- End Header --> 
    </div>
  </div>
  <!-- End Header Wrapper --> 
  
  <!-- Begin Wrapper -->
  <div id="wrapper">
    <div id="portfolio-single">
      <div class="image"> <img class="hotel_img" src="<?php 
      echo base_url();
      echo "img/".$hotel['slika1'];
      ?>" alt="" width="660px" height="450px"/>  </div>
      <div class="text">
        <h3 class="hotel_name"><?php echo $hotel['ime'];?></h3>
        <p  class="hotel_text"><?php echo $hotel['tekst'];?></p>

       <!--  <a id ="acom" href="" text-decoration="">Accommodation</a> -->
       <?php 
        $id_hotel=$hotel['id_hotel'];
        echo "<a  id ='acom' href=".base_url()."room/show_rooms/".$id_hotel." text-decoration=''>Accommodation</a>";
        ?>
        <div class="divider3"></div>
         <p class="p-project" <?php echo "data-id='".$row."' data-rows='".$num_rows."'" ?> style="visibility:hidden">Prev Hotel &raquo;</p> 
         <p class="n-project" <?php echo "data-id='".$row."' data-rows='".$num_rows."'" ?> >Next Hotel &raquo;</p> 
       </div>
        

    </div>
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
<script type="text/javascript">
		$(document).ready(function(){
			$("#gallery a[rel^='prettyPhoto']").prettyPhoto({theme:'light_square',autoplay_slideshow: false});
		});
		
		
		
		$(function() {
            var offset = $(".text").offset();
            var topPadding = 15;
            $(window).scroll(function() {
                if ($(window).scrollTop() > offset.top) {
                    $(".text").stop().animate({
                        marginTop: $(window).scrollTop() - offset.top + topPadding
                    });
                } else {
                    $(".text").stop().animate({
                        marginTop: 0
                    });
                };
            });
        });
</script>
<script type="text/javascript">
$('.n-project, .p-project').click(function(e){
  var hotel_row = $(this).data('id');
  hotel_row = $(this).hasClass("n-project") == true ? hotel_row += 1 : hotel_row -= 1;
    $.ajax({
    // the URL for the request
    url: '<?php echo base_url()."ajax/get_hotel" ?>',
 
    // the data to send (will be converted to a query string)
    data: {
        id: hotel_row
    },
 
    // whether this is a POST or GET request
    type: "POST",
 
    // the type of data we expect back
    dataType : "json",
 
    // code to run if the request succeeds;
    // the response is passed to the function
    success: function( json ) {
        $('.hotel_name').text(json.hotel.ime);
        $('.hotel_text').text(json.hotel.tekst);
        var picture = "<?php echo base_url(); ?>img/"+json.hotel.slika1;
        $('.hotel_img').attr('src',picture);
        $('.n-project, .p-project').data('id',hotel_row);
        if (hotel_row > 0) {
          $('.p-project').css({'visibility':'visible'});
        }
        else {
          $('.p-project').css({'visibility':'hidden'});
        }
        if (hotel_row == $('.n-project').data('rows')) {
          $('.n-project').css({'visibility':'hidden'});
        }
        else {
          $('.n-project').css({'visibility':'visible'});
        }
        var acom="<?php echo base_url(); ?>room/show_rooms/"+json.hotel.id_hotel;
        $('#acom').attr('href',acom);
    },
 
    // code to run if the request fails; the raw request and
    // status codes are passed to the function
    error: function( xhr, status ) {
        alert( "Sorry, there was a problem!" );
    },
 
    // code to run regardless of success or failure
    complete: function( xhr, status ) {
        // alert( "The request is complete!" );
    }
});
});

</script>
</body>
</html>