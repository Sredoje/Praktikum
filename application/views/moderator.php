<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title>Hotels | Moderator</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>contact/style.css" media="all" />
  <link rel="stylesheet" media="all" href="<?php echo base_url();?>style/type/folks.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/button.css" media="all" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/css/ie7.css" media="all" />
<![endif]-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script type="text/javascript" src="<?php echo base_url();?>style/js/jquery-1.5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/jquery.infieldlabel.min.js"></script>
 <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/button.css" media="all" /> -->


<script type="text/javascript">
$(document).ready(function(){

  $('#edit_select').change(function(){

    var data={podaci:$(this).val()}
    $.post(
      '<?php echo base_url()."ajax/get_hotel_all" ?>',data,function(mmm){
        var niz=mmm.split(",");
        var ime=niz[0];
        var tekst=niz[1];

        $('#edit_name').val(ime);
        $('#edit_text').val(tekst);

      }      );
  });

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
              <li><a href="<?php echo base_url();?>">Home</a>

              </li>
              <li><a href="<?php echo base_url();?>hotel/show_hotels/">Hotels</a>

              </li>
              <li><a href="<?php echo base_url();?>room/show_rooms/1" >Rooms</a>

              </li>
              <li><a href="services.html">Services</a></li>
              


              
              <li><a href="<?php echo base_url();?>main/show_contact" >Contact</a></li>
              <?php
              $base=base_url();
              if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['je_logovan']==1)
              {


                echo ("<li><a href='".$base."main/logout'>Logout</a>");
              }
              else{
                echo ("<li><a href='".$base."login/show_login'>Log in</a>");
              } ?>
              


              

              
              <?php if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['uloga']==1){
                echo  "<li><a href='".$base."main/show_admin'>Admin</a>";

              } ?>
              <?php if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['uloga']==2){
                echo  "<li><a href='".$base."main/show_moderator' class='selected'>Moderator</a>";

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
  
  <!-- Begin Wrapper -->
  <div id="wrapper"> 

    <!-- Begin Content -->
    <div class="content">

      <h3>Moderator page</h3>

      <br />
      <!-- Begin Form -->
      <?php  echo validation_errors();?>
      <?php if(isset($hotel_message)){
        echo $hotel_message;

      } ?>
      <div class="toggle">
        <h2 class="trigger">+Add/Edit hotels</h2>
        <div class="togglebox">
          <div>

            <ul class="tabs">
              <li><a href="#tab1">Add hotel</a></li>


              <li><a href="#tab2">Edit hotel</a></li>

            </ul>
            <div class="tab_container">
              <div style="display: none;" id="tab1" class="tab_content">

               <form method="post" action="<?php echo base_url() ?>hotel/form_hotel_valid" enctype="multipart/form-data">


                Hotel name:<br>
                <input type="text" name="hotel_name" value="<?php echo set_value('hotel_name'); ?>">
                <br>
                About hotel:<br>
                <textarea name="hotel_text" value=""><?php echo set_value('hotel_text'); ?></textarea><br>

                Hotel picture:<br>

                <input type="file" name="prva_slika">


                <br>
                <input type="submit" class="btn btn-info" value="Add hotel"></input>
              </form>

            </div>


            <div style="display: none;" id="tab2" class="tab_content">
              <form method="post" action="<?php echo base_url() ?>hotel/form_hotel_edit" enctype="multipart/form-data">
                Hotel:
                <select id="edit_select" name="edit_select">
                 <?php foreach ($all_hotels_from_user as $hotel){
                  $ime=$hotel['ime'];
                  echo "<option value=".$hotel['id_hotel'].">$ime</option>";
                } ?>



              </select><br>
              Hotel name:<br>
              <input type="text" id="edit_name" name="edit_name">
              <br>
              About hotel:<br>
              <textarea id="edit_text" name="edit_text"></textarea><br>
              Hotel picture:<br>
              <input type="file" name="edit_slika">
              <br>

              <br>
              
              <br>
              <input type="submit" class="btn btn-info" value="Edit hotel"></input>
            </div>   
          </form>
        </div>
      </div>
    </div>
    <br>
    <div class="toggle">
      <h2 class="trigger">+Add/Edit rooms</h2>
      <div class="togglebox">
        <div>
          <form method="post" action="<?php echo base_url() ?>room/form_room_valid" enctype="multipart/form-data">
           <ul class="tabs">
            <li><a href="#tab4">Add room</a></li>
            <li><a href="#tab5">Edit room</a></li>

          </ul>
          <!-- Add room -->
          <div class="tab_container">
            <div style="display: none;" id="tab4" class="tab_content">
             To which hotel this room belongs:<br>
             <select name="room_hotel">
              <?php foreach ($all_hotels_from_user as $hotel){
                $ime=$hotel['ime'];
                echo "<option value=".$hotel['id_hotel'].">$ime</option>";
              } ?>
            </select>
            <br>
            
            Room name:<br>
            <input type="text" name="room_name"><br><br>

            Room category:<br>
            <select name="room_category">
             <?php foreach ($room_category as $category) {
              $ime_kategorije=$category['category_name'];
              //echo "<option value=".$category['id_category'].">$ime_kategorije</option>";
            } ?> 
              <option value='1'>Standard room</option>
              <option value='2'>Family room</option>
              <option value='3'>Senior Suite</option>
              <option value='4'>Presidential Suite</option>
            </select>
          
            <br><br>
            Main room picture:<br>
            <input type="file" name="room_picture">
            <br><br>
            About room:<br>
            <textarea name="room_about">Nesto</textarea>
            <br><br>
            Living space:
            <br>
            <input type="text" name="room_space"><br><br>
            Convenient for(how many people):
            <br>
            From <input type="text" name="room_from">  To <input type="text" name="room_to"><br><br>
            Mini packet cost:<br>
            <input type="text" name="mini_price"><br>
            Medium packet: cost:<br>
            <input type="text" name="medium_price"><br>
            Full packet: cost:<br>
            <input type="text" name="full_price"><br>

            Room facilities:<br>
            <br><input type="checkbox" name="room_facilities[]" value="Free Wifi">Free WiFi
            <br><input type="checkbox" name="room_facilities[]" value="Free access to Sauna and Jacuzzi">Free access to Sauna and Jacuzzi
            <br><input type="checkbox" name="room_facilities[]" value="Bathroom with Bathtub">Bathroom with Bathtub
            <br><input type="checkbox" name="room_facilities[]" value="Bathrobe">Bathrobe
            <br><input type="checkbox" name="room_facilities[]" value="Hairdyer">Hairdyer
            <br><input type="checkbox" name="room_facilities[]" value="Air conditioning">Air conditioning
            <br><input type="checkbox" name="room_facilities[]" value="Direct dial phone">Direct dial phone
            <br><input type="checkbox" name="room_facilities[]" value="Laundry service">Laundry service
            <br><input type="checkbox" name="room_facilities[]" value="Minibar">Minibar
            <br><input type="checkbox" name="room_facilities[]" value="Pay TV">Pay TV
            <br><input type="checkbox" name="room_facilities[]" value="Safety box">Safety box
            <br><input type="checkbox" name="room_facilities[]" value="Iron + board on request">Iron + board on request
            <br><input type="checkbox" name="room_facilities[]" value="Slippers on request">Slippers on request
            <br><input type="checkbox" name="room_facilities[]" value="24 hours room service">24 hours room service
            <br>
            <br>
            <input type="submit" class="btn btn-info" value="Add room"></input>
             </form>
          </div>
          <!-- Edit room -->
          <div style="display: none;" id="tab5" class="tab_content">
             <form method="post" action="<?php echo base_url() ?>room/edit_room_valid" enctype="multipart/form-data">
            Room:
            <select id="edit_room_select" name="edit_room_select">
              <?php 
              foreach ($all_rooms_from_user as $room) {
                $room_name=$room['room_name'];
                 echo "<option value=".$room['room_id'].">$room_name</option>";
              }
               ?>


            </select>
            <br><br>
            Room name:<br>
            <input type="text" name="edit_room_name"><br><br>
            Room category:<br>
            <select name="edit_room_category" class="edit_room_category">
              <option value="1">Standard room</option>
              <option value="2">Family room</option>
              <option value="3">Senior Suite</option>
              <option value="4">Presidential Suite</option>
            </select>

            <br><br>
            About room:<br>
            <textarea name="edit_room_about">Nesto</textarea>
            <br><br>
            Living space:
            <br>
            <input type="text" name="edit_room_space"><br>
            Convenient for:
            <br><br>
            From <input type="text" name="edit_room_from">  To <input type="text" name="edit_room_to"><br><br>
            Mini packet cost:<br>
            <input type="text" name="edit_mini_price"><br>
            Medium packet: cost:<br>
            <input type="text" name="edit_medium_price"><br>
            Full packet: cost:<br>
            <input type="text" name="edit_full_price"><br>
            Room facilities:<br>
            <br><input type="checkbox" name="edit_room_facilities[]" value="Free Wifi">Free WiFi
            <br><input type="checkbox" name="edit_room_facilities[]" value="Free access to Sauna and Jacuzzi">Free access to Sauna and Jacuzzi
            <br><input type="checkbox" name="edit_room_facilities[]" value="Bathroom with Bathtub">Bathroom with Bathtub
            <br><input type="checkbox" name="edit_room_facilities[]" value="Bathrobe">Bathrobe
            <br><input type="checkbox" name="edit_room_facilities[]" value="Hairdyer">Hairdyer
            <br><input type="checkbox" name="edit_room_facilities[]" value="Air conditioning">Air conditioning
            <br><input type="checkbox" name="edit_room_facilities[]" value="Direct dial phone">Direct dial phone
            <br><input type="checkbox" name="edit_room_facilities[]" value="Laundry service">Laundry service
            <br><input type="checkbox" name="edit_room_facilities[]" value="Minibar">Minibar
            <br><input type="checkbox" name="edit_room_facilities[]" value="Pay TV">Pay TV
            <br><input type="checkbox" name="edit_room_facilities[]" value="Safety box">Safety box
            <br><input type="checkbox" name="edit_room_facilities[]" value="Iron + board on request">Iron + board on request
            <br><input type="checkbox" name="edit_room_facilities[]" value="Slippers on request">Slippers on request
            <br><input type="checkbox" name="edit_room_facilities[]" value="24 hours room service">24 hours room service
            <br>
            <br>
            <input type="submit" class="btn btn-info" value="Edit room"></input>
          </div>
        </form>


       

      </div>
    </div>

  </div>
</div>
<div class="toggle">
  <h2 class="trigger">+Add/Remove room pictures</h2>
  <div class="togglebox">
    <div>
      <form method="post" action="<?php echo base_url() ?>room/do_upload3" enctype="multipart/form-data">
      <select id="add_room_pictures" name="add_room_pictures">
              <?php 
                foreach ($all_rooms_from_user as $room) {
                  $room_name=$room['room_name'];
                   echo "<option value=".$room['room_id'].">$room_name</option>";
                }
               ?>
      </select>
      <div class="room_pictures_space"></div>
      <br><br>
      <input type="file" name="room_pictures"><br><br>
      <input type="submit" class="btn btn-info" value="Add picture"></input>
      <br>
    </form>
  </div>
</div>
</div>
<div class="toggle">
  <h2 class="trigger">+Add hotel actions</h2>
  <div class="togglebox">
    <div>
      <form method="post" action="<?php echo base_url() ?>hotel/add_hotel_action" enctype="multipart/form-data">
      Hotel:<br>
       <select name="action_hotel">
              <?php foreach ($all_hotels_from_user as $hotel){
                $ime=$hotel['ime'];
                echo "<option value=".$hotel['id_hotel'].">$ime</option>";
              } ?>
        </select>
        <br>
        <table></table>
      Actions:<br>
      Start date:<br>
      <input name="action_start" type="text" id="from">
      <br><br>
      End date:<br>

      <input name="action_end" type="text" id="to"><br><br>
      Mini price:<br>
      <input name="action_mini" type="text"><br><br>
      Medium price:<br>
      <input name="action_medium" type="text"><br><br>
      Full price:<br>
      <input name="action_full" type="text"><br><br>

      
      <input type="submit" class="btn btn-info" value="Add action"></input>
      <br>
    </form>
  </div>
</div>
</div>
</div>





<!-- End Content --> 

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
      <script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
<script type="text/javascript">
$('#add_room_pictures').change(function(){
        $.ajax({
    // the URL for the request
    url: '<?php echo base_url()."ajax/get_room_pictures" ?>',
 
    // the data to send (will be converted to a query string)
    data: {
        id: $('#add_room_pictures').val()
    },
 
    // whether this is a POST or GET request
    type: "POST",
 
    // the type of data we expect back
    dataType : "json",
 
    // code to run if the request succeeds;
    // the response is passed to the function
    success: function( json ) {
      var test=document.createElement("button");
          $('.room_pictures_space').html("");
        for(var i = 0 ; i < json.room.length ; i ++) {
           var link="<img src='<?php echo base_url() ?>img/"+json.room[i].picture_path+"' style='width:100px;'/><br><a href='<?php echo base_url() ?>room/delete_room_picture/"+json.room[i].room_id+"/"+json.room[i].picture_path+"' class='deletehref btn btn-info' >Delete</a><br>";
          $('.room_pictures_space').append(link);
        }
    },
    // code to run if the request fails; the raw request and
    // status codes are passed to the function
    error: function( xhr, status ) {
        alert( "Sorry, there was a problem!" );
    },
 
    // code to run regardless of success or failure
    complete: function( xhr, status ) {

    }
});
    });

   $('#edit_room_select').change(function(){
        $.ajax({
    // the URL for the request
    url: '<?php echo base_url()."ajax/get_room" ?>',
 
    // the data to send (will be converted to a query string)
    data: {
        id: $('#edit_room_select').val()
    },
 
    // whether this is a POST or GET request
    type: "POST",
 
    // the type of data we expect back
    dataType : "json",
 
    // code to run if the request succeeds;
    // the response is passed to the function
    success: function( json ) {
        console.log(json.room[0]);
         $("input[name='edit_room_name']").val(json.room[0].room_name);
         $("select.edit_room_category").val(json.room[0].room_category);
         $("textarea[name='edit_room_about']").text(json.room[0].room_about);
         $("input[name='edit_room_space']").val(json.room[0].room_space);
         $("input[name='edit_room_from']").val(json.room[0].room_from);
         $("input[name='edit_room_to']").val(json.room[0].room_to);
         $("input[name='edit_mini_price']").val(json.room[0].mini_price);
         $("input[name='edit_medium_price']").val(json.room[0].medium_price);
         $("input[name='edit_full_price']").val(json.room[0].full_price);
    },
    // code to run if the request fails; the raw request and
    // status codes are passed to the function
    error: function( xhr, status ) {
        alert( "Sorry, there was a problem!" );
    },
 
    // code to run regardless of success or failure
    complete: function( xhr, status ) {

    }
});
    });
</script>
</body>
</html>