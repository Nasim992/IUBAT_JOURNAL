<?php 
include('mailmessage/url.php');
if (isset($_SESSION['alogin'])){
  $authoremail = $_SESSION["email"];
} 
?>
    <nav id="navbar_top" class="navbar nav-class navbar-expand-xl navbar-expand{-sm|-md|-lg|-xl} navbar-light ">
        <a class="navbar-brand ml-3" style="font-size:20px;" href="<?php  echo $url; ?>"><img src="images/Iubat-logo.png"> IUBAT Review</a>
        <button style="margin-top:0px;" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ul-nav">
                <li class="nav-item">
                    <span class="navbar-text"><a class="nav-link active" href="<?php  echo $url; ?>">Home</a></span>
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
                    <span class="navbar-text"><a class="nav-link" href="login">Submit an Article</a></span>
                </li>
                <li class="nav-item ">
                    <span class="navbar-text">
                        <form class="form-inline  my-lg-0">
                            <input id="heading-input" class="form-control mr-sm-2" type="text"
                                placeholder="Search paper" aria-label="Search">
                        </form>
                    </span>
                </li>

                <?php if(empty($authoremail)) {?>
                <li class="nav-item">
                    <span class="navbar-text mr-3"><a class="nav-link" href="login">Login</i></a></span>
                </li>
                <?php  }
                        else {
                        ?>
                <li class="nav-item">
                    <span class="navbar-text mr-3"><a class="nav-link" href="logout">logout</i></a></span>
                </li>
                <?php  } ?>
            </ul>
        </div>
    </nav>