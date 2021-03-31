<?php 
include('mailmessage/url.php');
if (isset($_SESSION['alogin'])){
  $email = $_SESSION["email"];
} 
?>
    <nav id="navbar_top" class="navbar p-1 nav-class navbar-expand-xl navbar-expand{-sm|-md|-lg|-xl} navbar-light ">
        <a class="navbar-brand ml-3" style="font-size:20px;" href="<?php  echo $url; ?>"><img src="images/Iubat-logo.png"> IUBAT Review</a>
        <button style="margin-top:0px;" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ul-nav">
                <li class="nav-item">
                   <?php  if(empty($email)) {?>
                    <span class="navbar-text"><a class="nav-link active" id="home" href="<?php  echo $url; ?>">Home</a></span>
                    <?php  } else if(checkAuthorEmail($email)==1) {  ?>
                    <span class="navbar-text"><a class="nav-link active" id="home" href="author/dashboard">Dashboard</a></span>
                             <?php   }
                                else if(adminemailcheck($email)==1) { ?>
                    <span class="navbar-text"><a class="nav-link active" id="home" href="admin/dashboard">Dashboard</a></span>
                               <?php }
                                else if(chiefeditorcheckemail($email)==1) { ?>
                    <span class="navbar-text"><a class="nav-link active" id="home" href="chiefeditor/dashboard">Dashboard</a></span>
                               <?php  }
                                else if(checkacademiceditoremail($email)==1) { ?>
                    <span class="navbar-text"><a class="nav-link active" id="home" href="academiceditor/dashboard">Dashboard</a></span>
                             <?php   }
                                else if(checkassociateeditoremail($email) ==1) { ?>
                    <span class="navbar-text"><a class="nav-link active" id="home" href="associateeditor/dashboard">Dashboard</a></span>
                            <?php    }
                                else { ?>
                    <span class="navbar-text"><a class="nav-link active" id="home" href="reviewer/dashboard">Dashboard</a></span>
                            <?php    } ?>
                </li>
                <li class="nav-item ">
                    <span class="navbar-text"><a class="nav-link" href="aimandscope">Aim and Scope</a></span>
                </li>
                <li class="nav-item ">
                    <span class="navbar-text"><a class="nav-link" href="guideline">Guidelines</a></span>
                </li>

                <li class="nav-item ">
                    <span class="navbar-text"><a class="nav-link" href="journalinfo">Journal Info</a></span>
                </li>
                <li class="nav-item">
                    <span class="navbar-text"><a class="nav-link" href="editorialboard">Editorial Board</a></span>
                </li>
                <li class="nav-item ">
                    <span class="navbar-text"><a class="nav-link" href="archive">Archive</a></span>
                </li>
                <li class="nav-item ">
                    <span class="navbar-text"><a class="nav-link" href="author/uploadpaper">Submit an Article</a></span>
                </li>
                <li class="nav-item ">
                    <span class="navbar-text">
                        <form class="form-inline  my-lg-0">
                            <input id="heading-input" class="form-control mr-sm-2" type="text" placeholder="Search paper" aria-label="Search">
                        </form>
                    </span>
                </li>
           <?php if(empty($email)) {?>
                <li class="nav-item">
                    <span class="navbar-text mr-3"><a class="nav-link" href="login">Login</i></a></span>
                </li>
           <?php  } else { ?> 
            <li class="nav-item">
                <span onclick="return confirm('Are you sure you want Logging out the system?');" class="navbar-text mr-3"><a class="nav-link" href="logout"><small style="font-size:12px;">(<?php echo $email; ?>)</small>logout<i class="fas fa-sign-in-alt"></i></a></span>
            </li>
           <?php  } ?>
            </ul>
        </div>
    </nav>