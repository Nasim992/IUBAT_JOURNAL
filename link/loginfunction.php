<?php 
// Author login 
function author_login() { 
    global $dbh;
    $email = $_POST['input-email']; 
    $password=md5($_POST["input-password"]); 
    $_SESSION["email"]=$_POST['input-email'];
    $sql ="SELECT primaryemail,password,activation FROM author WHERE primaryemail=:email and password=:password and activation IS NOT NULL";
    $query= $dbh -> prepare($sql); 
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();  

    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) 
    {
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'author/dashboard'; </script>";
    } else{ 
        echo "<script>alert('Invalid Details.Or, You are not a activate your account');</script>";
        header("refresh:0;url=login");
    }
}
// Author login 

// Reviewer Login 
function reviewer_login() {
    global $dbh;
    $email = $_POST['input-email'];
    $password=md5($_POST["input-password"]); 
    $_SESSION["email"]=$_POST['input-email'];
    // Checking that reviewer is selected or not 
    $sql ="SELECT primaryemail,password,reviewerselection FROM author WHERE primaryemail=:email and password=:password and reviewerselection=1";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();   
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    // Checking that reviewer is selected or not

    if($query->rowCount() > 0)
    {
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'reviewer/dashboard'; </script>";
    } else{ 

        echo "<script>alert('Invalid Details.Or,You are not selected as a Reviewer');</script>";
        header("refresh:0;url=login");
     
    }
}
// Reviewer Login 

// Editor login 
function editor_login() {
    global $dbh;
    $email = $_POST['input-email'];
    $password=md5($_POST["input-password"]); 
    $_SESSION["email"]=$_POST['input-email'];

    // Admin 
    $sql ="SELECT email,password FROM admin WHERE email=:email and password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute(); 

    $results=$query->fetchAll(PDO::FETCH_OBJ);
 
    if($query->rowCount() > 0)
    { 
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'admin/dashboard'; </script>";
    }else {
    // Admin
    // Chiefeditor 
    $sql ="SELECT chiefeditor.id,chiefeditor.fullname,chiefeditor.password,chiefeditor.contact FROM chiefeditor WHERE email=:email and password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR); 
        $query-> execute();  
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
     
            $_SESSION['alogin']=$_POST['input-email'];
            echo "<script>alert('Logged in Success');</script>";
            echo "<script type='text/javascript'> document.location = 'chiefeditor/dashboard'; </script>";
       }
       else {
    // Chiefeditor 
        $sql ="SELECT author.id,author.primaryemail,author.password,author.associateeditor,author.academiceditor FROM author WHERE primaryemail=:email and password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR); 
        $query-> execute();  
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
        // Selecting Associate Editor and Academic Editor
        foreach($results as $result) {
            $associateeditor = htmlentities($result->associateeditor);
            $academiceditor = htmlentities($result->academiceditor);
            if($associateeditor==1) {
                $_SESSION['alogin']=$_POST['input-email'];
                echo "<script>alert('Logged in Success');</script>";
                echo "<script type='text/javascript'> document.location = 'associateeditor/dashboard'; </script>";
            }
            else if($academiceditor==1) {
                $_SESSION['alogin']=$_POST['input-email']; 
                echo "<script>alert('Logged in Success');</script>";
                echo "<script type='text/javascript'> document.location = 'academiceditor/dashboard'; </script>";
            }
            else {
                echo "<script>alert('You are not selected as an editor.');</script>";
                header("refresh:0;url=login");
            }
        }
     // Selecting Associate Editor and Academic Editor
    } else{ 
        
        echo "<script>alert('Invalid Details.Or,You are not selected as a Editor');</script>";
        header("refresh:0;url=login");
    }
    }
}
}
// Editor Login 

// Sign-up/Register
function sign_up() {
    global $dbh;
    global $link;

    $username=$_POST['pemail'];
    $title=$_POST['title'];
    $firstname=$_POST['firstName'];
    $middlename=$_POST['middleName'];  
    $lastname=$_POST['lastName'];
    $pemail=$_POST['pemail'];
    $pemailAgain=$_POST['pemailAgain'];
    $pemailcc=$_POST['pemail'];
    $semail=$_POST['semail'];
    $semailcc=$_POST['semail'];
    $userpassword=md5($_POST['user-password']);
    $repeatpassword=md5($_POST['repeat-password']);
    $contact=$_POST['user-contact'];
    $address=$_POST['user-address'];

    // Adding Reviewer username on the reviewertable(When seding reviewer request through email)  
    $revieweremail = array();
    $sqlreviewer = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.primaryemail from reviewertable Where primaryemail='$pemail'";
    $queryreviewer = $dbh->prepare($sqlreviewer); 
    $queryreviewer ->execute(); 
    $resultreviewer=$queryreviewer ->fetchAll(PDO::FETCH_OBJ); 
    $cnt=1;

    if($queryreviewer->rowCount() > 0)   
    {
    foreach($resultreviewer as $result) 
    { 
    $usernameeditor = htmlentities($result->primaryemail);
    array_push($revieweremail,$usernameeditor);
    }}
    if (!empty($revieweremail)) {
    foreach($revieweremail as $pp) {
        $selectreviewerupdate = "UPDATE reviewertable set username='$username' where primaryemail='$pp'";
        mysqli_query($link,$selectreviewerupdate);  
    }
    }
    // Adding Reviewer username on the reviewertable(When sending reviewer request through email)

    $validation_code = md5($username . microtime()); 
    
    if(is_author_available($pemail)>0) {
        echo "<script>alert('This email is already is in use.Try different email or Logged in your account');</script>";
    }else
    {
    $sql="INSERT INTO  author(username,title,firstname,middlename,lastname,primaryemail,primaryemailcc,secondaryemail,secondaryemailcc,password,contact,address,validation_code) VALUES(:username,:title,:firstname,:middlename,:lastname,:pemail,:pemailcc,:semail,:semailcc,:userpassword,:contact,:address,:validation_code)";

    $query = $dbh->prepare($sql);

    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':title',$title,PDO::PARAM_STR);
    $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
    $query->bindParam(':middlename',$middlename,PDO::PARAM_STR);
    $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
    $query->bindParam(':pemail',$pemail,PDO::PARAM_STR);
    $query->bindParam(':pemailcc',$pemailcc,PDO::PARAM_STR);
    $query->bindParam(':semail',$semail,PDO::PARAM_STR);
    $query->bindParam(':semailcc',$semailcc,PDO::PARAM_STR);
    $query->bindParam(':userpassword',$userpassword,PDO::PARAM_STR);
    $query->bindParam(':contact',$contact,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':validation_code',$validation_code,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0) 
    {
        if (!empty($revieweremail)) {
                $selectreviewerselection = "UPDATE author set reviewerselection=1 where primaryemail='$pemail'";
                mysqli_query($link,$selectreviewerselection);  
            }
                // Activation Link sending Messages starts here
                include './mailmessage/accountactivation.php'; 
                // Activation Link sending Messages section ends here                  
                send_email($pemail, $subject, $msg, $headers);
    echo "<script>alert('Activation Link is sent to this $pemail.Log in to your gmail Account and Activate your Account.');</script>";
    echo "<script type='text/javascript'> document.location = 'login'; </script>";
    } else{
        
        echo "<script>alert('Invalid Details !UserName or Email address already is in use');</script>";
        header("refresh:0;url=login");
    }     
    }
}
// Sign-up/Register

// forget passwords

function forgot_password() {
    global $dbh;
    $pemail = $_POST['remail'];
    // Reseting link sending mail section starts here.
    include './mailmessage/resetpasswordmessage.php';
    // Reseting link sending mail section ends here 
    //  Check that the email is available or not in the database
    $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$pemail'"; 
    $query = $dbh->prepare($sql); 
    $query->execute(); 
    $results=$query->fetchAll(PDO::FETCH_OBJ); 
    $cnt=1;
    if($query->rowCount() > 0) 
    {
    // Check that the email is available or not in the database

    if(send_email($pemail, $subject, $msg, $headers)) {
        echo "<script>alert('Reset password link is given to your gmail.');</script>";
    }
    else {
            echo "<script>alert('Something went wrong!');</script>";
        }
    }else
    {
        echo "<script>alert('You are not registered yet!');</script>";
    }
}
// forget passwords 

// Admin login 
function admin_login() {
    global $dbh;
    $email = $_POST['input-email']; 
    $password = md5($_POST['input-password']);
    $_SESSION["email"]=$_POST['input-email']; 

    $sql ="SELECT email,password FROM admin WHERE email=:email and password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute(); 

    $results=$query->fetchAll(PDO::FETCH_OBJ);
 
    if($query->rowCount() > 0)
    { 
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'admin/dashboard'; </script>";
    } else{     
        echo "<script>alert('Invalid Details.Enter Correct Information');</script>";
        header("refresh:0;url=login");  
    }
}
// Admin login 

?>