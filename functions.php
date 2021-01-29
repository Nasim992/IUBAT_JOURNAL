<?php 

    // Return html Entities section starts Here 
    function clean($string){

        return htmlentities($string);
    
    }
    // Return html Entities Section Ends Here

    //   Set Message Function starts Here 
        function set_message($message) {

            if(!empty($message)){
            
            $_SESSION['message']= $message;
            
            }else {
        
            $message = "";
            }
        }
    // Set Message Function Ends Here 
    
        // Display Function Starts Here
        function display_message(){
        
            if(isset($_SESSION['message'])){
        
                echo $_SESSION['message'];
        
                unset($_SESSION['message']);
            }
        }
    // Display Function Ends Here
    
    // Send Mail Function Starts Here 
        function send_email($email, $subject, $msg, $headers) {

        return (mail($email, $subject, $msg, $headers)); 

            }
    // Send Mail Function Ends Here 

        // Redirect Function section starts Here 
        function redirect($location){

            return header("Location: {$location}");
        
        }
        
        // Redirect Function Section Ends Here

        // Activate User Function Starts Here
        function activate_user(){

            if($_SERVER['REQUEST_METHOD'] == "GET") {
        
                if(isset($_GET['email'])){
        
        
                    echo $email = clean($_GET['email']);
        
                    echo $validation_code = clean($_GET['code']);
                  
                    $sql = "SELECT * FROM author WHERE primaryemail = '".escape($_GET['email'])."' AND validation_code ='".escape($_GET['code'])."' ";
                    $result = query($sql); 
                    confirm($result);
        
                    if(row_count($result) ==1) {
        
                    $sql2 = "UPDATE author SET activation =1, validation_code = 0 WHERE primaryemail ='".escape($email)."' AND validation_code ='" .escape($validation_code) ."' ";
                    $result2 = query($sql2);
                    confirm($result2);
        
                    set_message("<p class='bg-success text-white p-2 text-center'>Your Account has been activated please login </p>");

                    redirect("login"); 
        
        
                  } else {
        
        
                      set_message("<p class='bg-danger text-white p-2 text-center'>Sorry Your account is not activated</p>");

                      redirect("login");
                  }  
        
                    
                }
            }
        
        }
        // Activate User Function Ends Here 
            

?>