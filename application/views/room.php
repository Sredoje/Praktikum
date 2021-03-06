<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Hotels | Room</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/button.css" media="all" />
<link rel="stylesheet" media="all" href="<?php echo base_url();?>style/type/folks.css" />
<link rel="stylesheet" media="all" href="<?php echo base_url();?>style/type/folks.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/fullcalendar.css" media="all" />

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/css/ie7.css" media="all" />
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>style/js/jquery-1.5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/jquery.jcarousel.js"></script>
 <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
 <script src="<?php echo base_url();?>style/js/fullcalendar.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script type="text/javascript">
jQuery(document).ready(function() {
    // Initialise the first and second carousel by class selector.
  // Note that they use both the same configuration options (none in this case).
  jQuery('.d-carousel .carousel').jcarousel({
        scroll: 1,
        
    });
});
</script>
<style type="text/css">
  #tabzor{
    margin-bottom:35px;
  }
</style>
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
              <li><a href="<?php echo base_url();?>hotel/show_hotels/">Hotels</a>
                
              </li>
              <li><a href="<?php echo base_url();?>room/show_rooms/1" class="selected">Rooms</a>
               
              </li>
             
              <li><a href="<?php echo base_url();?>main/show_contact">Contact</a></li>

                 <?php
              $base=base_url();
               if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['je_logovan']==1){
                

                echo ("<li><a href='".$base."main/logout'>Logout</a>");
              }
              else{
                echo ("<li><a href='".$base."login/show_login'>Log in</a></li>");
                 echo ("<li><a href='".$base."register/show_register'>Register</a></li>");
              } ?>
              
          
             
              
                
              
              <?php if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['uloga']==1){
                echo  "<li><a href='".$base."admin/show_admin'>Admin</a>";

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
     <?php 

     if(isset($book_errors)) {
        echo "<div class='spawn'>";
          if($book_errors['succes']===true) {
            echo "<h1 class='green'>Successfully booked room</h1><a href='".  base_url()."room/make_pdf'>Here you can download a receipt.</a> ";
          }
          else {
            echo "<h2>This room is reserved from ".$book_errors['error_from']."to ".$book_errors['error_to'].". You should try some other date</h2>";
          }
        echo "</div>";
     }
       ?>
       <?php if(!empty($booked_rooms)) {
        foreach ($booked_rooms as $booked_room) {
          echo $booked_room['from'];
        }

       } ?>
       

    <div class="tab-wrapper">
      <ul id="tab-menu">
        <li class="selected"><img src="<?php echo base_url();?>style/images/icon-palette.png" alt="" />About room</li>
        <li><img src="<?php echo base_url();?>style/images/icon-art.png" alt="" /> Price</li>
        <li><img src="<?php echo base_url();?>style/images/icon-laptop.png" alt="" /> Book this room</li>
        
      </ul>
      <div class="tab-content" id="tabzor" >
        <div class="tab show">
         
          <h3><?php echo $room['room_name']; ?></h3>
          <p><?php echo $room['room_about']; ?></p>
           <h3>Living space:<?php echo $room['room_space']; ?>m2</h3>
          <br>
          <h3>Convenient for: <?php echo $room['room_from']; ?> - <?php echo $room['room_to']; ?> guests</h3><br>
          <h3>Room facilities:</h3>
          <ul class="check-list">
           <?php 
          
               $facilities=unserialize($room['room_facilities']);
              if($facilities == "") {
                echo "None";
              }
              else {
                foreach ($facilities as $facility) {
                 echo "<li>".$facility."</li>";
                }
              }
            ?>
         </ul>
        </div>
        <div class="tab">
           <table width="100%" border="0" cellspacing="0" cellpadding="0" class="price">
      <tr class="border_bottom">
        <td>&nbsp;</td>
        
        <td><h2>Mini <span><?php echo $room['mini_price'] ?> $/<sup>day</sup></span></h2></td>
        <td><h2>Medium <span><?php echo $room['medium_price'] ?> $/<sup>day</sup></span></h2></td>
        <td><h2>Full <span><?php echo $room['full_price'] ?> $/<sup>day</sup></span></h2></td>
      </tr>
      <tr class="even">
        <td class="right">Breakfast</td>
       
        <td><img src="<?php echo base_url();?>style/images/check.png"/></td>
        <td><img src="<?php echo base_url();?>style/images/check.png"/></td>
        <td><img src="<?php echo base_url();?>style/images/check.png"/></td>
      </tr>
      <tr>
        <td class="right">Lunch</td>
        
        <td>&mdash;</td>
        <td><img src="<?php echo base_url();?>style/images/check.png"/></td>
        <td><img src="<?php echo base_url();?>style/images/check.png"/></td>
      </tr>
      <tr class="even">
        <td class="right">Dinner</td>
       
        <td>&mdash;</td>
        <td>&mdash;</td>
        <td><img src="<?php echo base_url();?>style/images/check.png"/></td>
      </tr>
      <tr>
        <td class="right">Dessert</td>
       
        <td>&mdash;</td>
        <td>&mdash;</td>
        <td><img src="<?php echo base_url();?>style/images/check.png"/></td>
      </tr>
     
    </table>
    <!-- Actions -->
    <h3>Actions:</h3>

     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="price">
      <tr class="border_bottom">
        <td>Action date:</td>
        
        <td><h2>Mini </h2></td>
        <td><h2>Medium </h2></td>
        <td><h2>Full </h2></td>
      </tr>
     <?php
      foreach ($hotel_action as $action) {
        echo "<tr class='even'>";
        echo '<td class="right">'.$action['action_start_date'].' -  '.$action['action_end_date'].'</td>';
        echo '<td>'.$action['action_mini'].'$</td>';
        echo '<td>'.$action['action_medium'].'$</td>';
        echo '<td>'.$action['action_full'].'$</td>';
      }

      ?>
     
    </table>
    <!-- END Actions -->
        </div>
        <div class="tab">
          <div id="calendar"></div>
          <h2>Book this room !</h2><br>
          <form method="post" action="<?php echo base_url() ?>room/book_room/<?php echo $room['room_id'] ?>" enctype="multipart/form-data">

       <table border="0px black solid">
        <thead>
          <tr><td>Check in:</td><td>Check out:</td><td>Packet</td></tr>
        </thead>
        <tbody>
          <tr><td><input type="text" id="datepicker" name="from" /></td><td><input type="text" id="datepicker2" name="to" /></td><td><select name="packet"><option value="mini">Mini</option><option value="medium">Medium</option><option value="full">Full</option></select></td></tr>
        </tbody>

       </table>
       <br>
       <br>
       <input type="submit" class="btn btn-info" value="Book Now"></input>
       </form>
       <br>

        </div>
          
       
      </div>
    </div>
    <div class="clear"></div>
    <div class="d-carousel sgrid" >
      <?php if(!$room_pictures) {
        echo "<div class='test'>";
      } ?>
      <ul class="carousel">


           <?php 
           if($room_pictures) {
              foreach ($room_pictures as $room) {
             echo "<li><a href='#'' title=''>";
             echo "<img src='".base_url().'img/'.$room['picture_path']."' style='width:175px;height:120px;'/>";
              echo "</li></a>";
           }
           }
           else {
            echo " no pictures ATM";
           }
         
            ?>
    
      </ul>
<?php if(!$room_pictures) {
  echo "</div>";
} ?>
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

$(document).ready(function() {	
  //Get all the LI from the #tabMenu UL
  $('#tab-menu > li').click(function(){
    //remove the selected class from all LI    
    $('#tab-menu > li').removeClass('selected');
    //Reassign the LI
    $(this).addClass('selected');
    //Hide all the DIV in .tab-content
    $('.tab-content div.tab').slideUp('slow');
    //Look for the right DIV in boxBody according to the Navigation UL index, therefore, the arrangement is very important.
    $('.tab-content div.tab:eq(' + $('#tab-menu > li').index(this) + ')').slideDown('slow');
  }).mouseover(function() {
    //Add and remove class, Personally I dont think this is the right way to do it, anyone please suggest    
    $(this).addClass('mouseover');
    $(this).removeClass('mouseout');   
  }).mouseout(function() {
    //Add and remove class
    $(this).addClass('mouseout');
    $(this).removeClass('mouseover');    
  });
});


$(function() {
            var offset = $("#tab-menu").offset();
            var topPadding = 15;
            $(window).scroll(function() {
                if ($(window).scrollTop() > offset.top) {
                    $("#tab-menu").stop().animate({
                        marginTop: $(window).scrollTop() - offset.top + topPadding
                    });
                } else {
                    $("#tab-menu").stop().animate({
                        marginTop: 0
                    });
                };
            });
            $('div.test').hide();

});
</script>
    <script>
  $(function() {
    $( "#datepicker" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#datepicker2" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#datepicker2" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#datepicker" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
    $('#datepicker, #datepicker2').datepicker("option","dateFormat",  "yy-mm-dd");

  });
  </script>
  <script type="text/javascript">
(function () {

  

  
        var booked_rooms=<?php echo json_encode($booked_rooms); ?>;
        console.log(booked_rooms);

          var allEvents = {
              events: []
          };
 
    
          $(booked_rooms).each(function(e,i) {
            var book_start=i.from;
            var book_end=i.to;
           


          // Adding events to calendar if there are both teams
          
            allEvents.events.push({
              title:"Already booked!",
              start:book_start,
              end:book_end
            });
          
          
          });
        $('#calendar').fullCalendar({
          viewDisplay   : function(view) {
              var now = new Date(); 
              var end = new Date();
              end.setMonth(now.getMonth() + 6); //Adjust as needed

              var cal_date_string = view.start.getMonth()+'/'+view.start.getFullYear();
              var cur_date_string = now.getMonth()+'/'+now.getFullYear();
              var end_date_string = end.getMonth()+'/'+end.getFullYear();

              if(cal_date_string == cur_date_string) { jQuery('.fc-button-prev').addClass("fc-state-disabled"); }
              else { jQuery('.fc-button-prev').removeClass("fc-state-disabled"); }

              if(end_date_string == cal_date_string) { jQuery('.fc-button-next').addClass("fc-state-disabled"); }
              else { jQuery('.fc-button-next').removeClass("fc-state-disabled"); }
            },
          eventSources: [
                allEvents
            ],
        eventRender: function(event, element) {
              element.html(event.description);
          }
        });
$('.fc-button-today').text("Show calendar");


  



  

})();
  </script>
</body>
</html>