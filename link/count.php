<?php 

    //  New Paper count section starts here 
    $querypublished = "SELECT COUNT(*) as total_rowspublished FROM paper WHERE action =0";
    $stmt = $dbh->prepare($querypublished);     
    // execute query
    $stmt->execute();       
    // get total rows
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_unpublished = $row['total_rowspublished'];
    // New Paper count section ends here 

    // Number of Published paper  count section starts here 
    $query = "SELECT COUNT(*) as total_rows FROM paper WHERE action = 1";
    $stmt = $dbh->prepare($query);                
     // execute query
    $stmt->execute();                 
    // get total rows
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_published = $row['total_rows'];                  
    // Number of Published paper  count section ends here

    //  Number of Authors  count section starts here 
    $query = "SELECT COUNT(*) as total_rows FROM author WHERE associateeditor IS NULL and academiceditor IS  NULL";
    $stmt = $dbh->prepare($query);                
    // execute query
    $stmt->execute();                
    // get total rows
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_authors = $row['total_rows'];
    // Number of Authors count section ends here 

    //  Number of Admins  count section starts here 
    $query = "SELECT COUNT(*) as total_rows FROM admin";
    $stmt = $dbh->prepare($query);                      
    // execute query
    $stmt->execute();                      
     // get total rows
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_admin = $row['total_rows'];                      
    // Number of Admins count section ends here 

    //  Number of Associate Editor  count section starts here 
    $query = "SELECT COUNT(*) as total_rows FROM author where associateeditor=1";
    $stmt = $dbh->prepare($query);                           
    // execute query
     $stmt->execute();                               
    // get total rows
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_associateeditors = $row['total_rows'];                
    // Number of Associate  Editor count section ends here 

    //  Number of Academic  Editor  count section starts here 
    $query = "SELECT COUNT(*) as total_rows FROM author where academiceditor=1";
    $stmt = $dbh->prepare($query);                                   
     // execute query
     $stmt->execute();                                    
     // get total rows
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     $total_academiceditors = $row['total_rows'];                
    // Number of Academic Editor count section ends here 

    //  Number of Editor  count section starts here 
    $query = "SELECT COUNT(*) as total_rows FROM author where reviewerselection=1";
    $stmt = $dbh->prepare($query);                               
     // execute query
     $stmt->execute();                              
     // get total rows
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     $total_reviewered = $row['total_rows'];
                       
                       
    // Number of Editor count section ends here 

    //  Number of Reviewer Feedback  count section starts here 
    $query = "SELECT COUNT(*) as total_rows FROM reviewertable where feedback IS NOT NULL";
    $stmt = $dbh->prepare($query);                           
     // execute query
     $stmt->execute();                                
     // get total rows
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     $total_feedback = $row['total_rows'];                                               
     // Number of Reviewer Feedback count section ends here 


    //  Number of Reviews   count section starts here 
    $query = "SELECT COUNT(*) as total_rowsrev FROM reviewertable where primaryemail = '$authoremail' and feedback IS NOT NULL";
    $stmt = $dbh->prepare($query);                           
     // execute query
     $stmt->execute();                        
    // get total rows
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_reviewed = $row['total_rowsrev'];
    // Number of Reviews  count section ends here 

    
        //  Assigned Paper Section Starts Here 
        $query = "SELECT COUNT(*) as total_rowsrev FROM reviewertable where primaryemail = '$authoremail' and feedback IS NULL and accepted IS NOT NULL";
         $stmt = $dbh->prepare($query);
                
         // execute query
         $stmt->execute();
              
         // get total rows
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_reviewing = $row['total_rowsrev'];
        // Assigned Paper Section Ends Here 
     
        //  Selected EDitor paper section starts here  
        $query = "SELECT COUNT(*) as total_rowsrev FROM editortable where primaryemail = '$email'  and associateeditor IS NOT NULL";
         $stmt = $dbh->prepare($query);
               
         // execute query
         $stmt->execute();
              
         // get total rows
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_assopaper = $row['total_rowsrev'];
        // Selected Editor paper section ends here 

        //  Selected EDitor paper section starts here  
        $query = "SELECT COUNT(*) as total_rowsrev FROM editortable where primaryemail = '$email'  and academiceditor IS NOT NULL";
        $stmt = $dbh->prepare($query);
                      
        // execute query
        $stmt->execute();
                     
         // get total rows
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_acapaper = $row['total_rowsrev'];
        // Selected Editor paper section ends here 

                //  Selected Archive  paper section starts here  
                $query = "SELECT COUNT(*) as total_rowsrev FROM archive";
                $stmt = $dbh->prepare($query);
                              
                // execute query
                $stmt->execute();
                             
                 // get total rows
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_archive = $row['total_rowsrev'];
                // Selected Archive paper section ends here 



?>