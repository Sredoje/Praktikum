<?php 
if(!isset($this->session->userdata['uloga'])||$this->session->userdata['uloga']!=1){

  redirect('main/restricted');
}
 ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Hotels | Admin</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>contact/style.css" media="all" />
<link rel="stylesheet" media="all" href="<?php echo base_url();?>style/type/folks.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/button.css" media="all" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/css/ie7.css" media="all" />
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>style/js/jquery-1.5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/jquery.infieldlabel.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/button.css" media="all" /> -->



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
              <li><a href="<?php echo base_url();?>main/show_hotels/0">Hotels</a>
                
              </li>
              <li><a href="<?php echo base_url();?>room/show_rooms/1" >Rooms</a>
                
              </li>
             <li><a href="services.html">Services</a></li>
              

               
              
              <li><a href="<?php echo base_url();?>main/show_contact" >Contact</a></li>
              <?php
              $base=base_url();
               if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['je_logovan']==1){
                

                echo ("<li><a href='".$base."main/logout'>Logout</a>");
              }
              else{
                echo ("<li><a href='".$base."login/show_login'>Log in</a>");
              } ?>
              
          
             
              
                
              
              <?php if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['uloga']==1){
                echo  "<li><a href='".$base."main/show_admin' class='selected'>Admin</a>";

               } ?>
               <?php if(isset($this->session->userdata['je_logovan'])&&$this->session->userdata['uloga']==2){
                echo  "<li><a href='".$base."main/show_moderator' >Moderator</a>";

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

      
        <div class="toggle">
        <h2 class="trigger">+Add Moderator</h2>
        <div class="togglebox">
          <div><form>
            Moderator name:<br>
            
            <input type="text"><br>
            Moderator password:<br>
            <input type="password">
            <br>
            <input type="submit" class="btn btn-info" value="Add moderator"></input>
            <br>
          </form>
          </div>
        </div>
      </div>

      

      
        <div class="toggle">
        <h2 class="trigger">+Remove Moderator</h2>
        <div class="togglebox">
          <div><form>
            Moderator name:<br>
            <select><option>Moderator1</option><option>Moderator2</option><option>Moderator3</option></select><br>
           
            <br>
            <input type="submit" class="btn btn-info" value="Remove moderator"></input>

            <br>
          </form>
          </div>
        </div>
      </div>

      <div class="toggle">
        <h2 class="trigger">+Add main slider pictures</h2>
        <div class="togglebox">
          <div><form>
            Moderator name:<br>
            <select><option>Moderator1</option><option>Moderator2</option><option>Moderator3</option></select><br>
           
            <br>
            <input type="submit" class="btn btn-info" value="Add picture"></input>

            <br>
          </form>
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
</body>
</html>