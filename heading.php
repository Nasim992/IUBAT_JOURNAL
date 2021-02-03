<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
<style>
.navbar-nav li a {
  font-size:14px;
}
</style>
</head>
<body> 
<nav id="navbar_top" class="navbar nav-class navbar-expand-xl  navbar-light "> 
  <a class="navbar-brand" href="index"><img src="images/Iubat-logo.png">JOURNAL</a>
  <button style="margin-top:0px;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> 
 
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto ul-nav">
     <li class="nav-item active">
     <span class="navbar-text"><a class="nav-link" href="aimandscope">Aim and Scope</a></span>
     </li>
   <li class="nav-item active">
   <span class="navbar-text"><a class="nav-link" href="instructionforauthors">Instruction</a></span>
      </li>
   
   <li class="nav-item active">
   <span class="navbar-text"><a class="nav-link" href="journalinfo">Journal Info</a></span>
      </li>
      <li class="nav-item active">
      <span class="navbar-text"><a class="nav-link" href="editorialboard">Editorial Board</a></span>
      </li>
 
        
<li class="nav-item active">
<span class="navbar-text"><a class="nav-link" href="archive">Archive</a></span>
      </li>
<li class="nav-item active">
<span class="navbar-text"><a class="nav-link" href="login">Submit an Article</a></span>
      </li>
<li class="nav-item active">
<span class="navbar-text"><form class="form-inline  my-lg-0">
      <input id="heading-input" class="form-control mr-sm-2" type="text" placeholder="Search paper" aria-label="Search">
    </form></span>
        </li>
<li class="nav-item active">
<span class="navbar-text"><a class="nav-link" href="login">Login</i></a></span>
  </li>
 
</ul>
  
  </div>
</nav>
<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>

<script>
///////////////// fixed menu on scroll for desktop

  $(window).scroll(function(){  
     if ($(this).scrollTop() > 40) {
        $('#navbar_top').addClass("fixed-top");
        // add padding top to show content behind navbar
        $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
      }else{
        $('#navbar_top').removeClass("fixed-top");
         // remove padding top from body
        $('body').css('padding-top', '0');
      }   
  });

</script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>