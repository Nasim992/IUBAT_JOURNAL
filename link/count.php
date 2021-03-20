<?php 
function total_unpublished() { 
    global $dbh;
    $querypublished = "SELECT COUNT(*) as total_rowspublished FROM paper WHERE action =0";
    $stmt = $dbh->prepare($querypublished);     
    $stmt->execute();       
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_unpublished = $row['total_rowspublished'];
    return $total_unpublished; 
  }
function total_published() {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM paper WHERE action = 1";
    $stmt = $dbh->prepare($query);                
    $stmt->execute();                 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_published = $row['total_rows'];  
    return $total_published;
}

function total_authors(){
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM author WHERE associateeditor IS NULL and academiceditor IS  NULL";
    $stmt = $dbh->prepare($query);                
    $stmt->execute();                
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_authors = $row['total_rows'];
    return $total_authors;
}

function total_admin() {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM admin";
    $stmt = $dbh->prepare($query);                      
    $stmt->execute();                      
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_admin = $row['total_rows'];  
    return $total_admin;
}
function total_associateeditors() {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM author where associateeditor=1";
    $stmt = $dbh->prepare($query);                           
    $stmt->execute();                               
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_associateeditors = $row['total_rows'];   
    return $total_associateeditors;
    }
function total_academiceditors() {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM author where academiceditor=1";
    $stmt = $dbh->prepare($query);                                   
    $stmt->execute();                                    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_academiceditors = $row['total_rows'];  
    return $total_academiceditors;
    }
function total_reviewered() {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM author where reviewerselection=1";
    $stmt = $dbh->prepare($query);                               
    $stmt->execute();                              
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_reviewered = $row['total_rows'];
    return $total_reviewered;
    }
function total_feedback() {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM reviewertable where feedback IS NOT NULL";
    $stmt = $dbh->prepare($query);                           
    $stmt->execute();                                
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_feedback = $row['total_rows']; 
    return $total_feedback;
    }
function total_reviewed($authoremail){
    global $dbh;
    $query = "SELECT COUNT(*) as total_rowsrev FROM reviewertable where primaryemail = '$authoremail' and feedback IS NOT NULL";
    $stmt = $dbh->prepare($query);                           
    $stmt->execute();                        
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_reviewed = $row['total_rowsrev'];
    return $total_reviewed;
    }

function total_reviewing($authoremail) {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rowsrev FROM reviewertable where primaryemail = '$authoremail' and feedback IS NULL and accepted IS NOT NULL";
    $stmt = $dbh->prepare($query);              
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_reviewing = $row['total_rowsrev'];
    return $total_reviewing;
    }

function total_assopaper($email){
    global $dbh;
    $query = "SELECT COUNT(*) as total_rowsrev FROM editortable where primaryemail = '$email'  and associateeditor IS NOT NULL";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_assopaper = $row['total_rowsrev'];
    return $total_assopaper;
    }
function total_acapaper($email) {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rowsrev FROM editortable where primaryemail = '$email'  and academiceditor IS NOT NULL";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_acapaper = $row['total_rowsrev'];
    return $total_acapaper;
   }
function total_archive() {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rowsrev FROM archive";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_archive = $row['total_rowsrev'];
    return $total_archive;
    }
function total_paper($authoremail) {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM paper WHERE authoremail = '$authoremail'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_paper = $row['total_rows'];
    return $total_paper;
}
function total_reject($authoremail) {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM paper WHERE authoremail = '$authoremail' and reject=1";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_reject = $row['total_rows'];
    return $total_reject;
}
function reviewed($authoremail) {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM author where primaryemail='$authoremail' and reviewerselection=1";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $reviewered = $row['total_rows'];
    return $reviewered;
}
function feedbackr($authoremail) {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM reviewertable where primaryemail='$authoremail' and feedback IS NOT NULL and permits=1";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $feedbackr = $row['total_rows'];
    return $feedbackr;
}
function editored($authoremail) {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM author where primaryemail='$authoremail' and associateeditor=1";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $editored = $row['total_rows'];
    return $editored;
}
function total_published_author($authoremail) {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM paper WHERE action = 1 and authoremail = '$authoremail'"; 
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_published = $row['total_rows'];
    return $total_published;
}
function total_unpublished_author($authoremail) {
    global $dbh;
    $queryu = "SELECT COUNT(*) as total_rowsu FROM paper WHERE action = 0 and authoremail = '$authoremail'"; 
    $stmtu = $dbh->prepare($queryu);
    $stmtu->execute();
    $rowu = $stmtu->fetch(PDO::FETCH_ASSOC);
    $total_unpublished = $rowu['total_rowsu'];
    return $total_unpublished;

}
function maximumyear() {
    global $dbh;
    $query = "SELECT MAX(versionissue) as total_rows FROM archive";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $maximumyear = $row['total_rows'];
    return $maximumyear;
 }

function is_author_available($authoremail) {
    global $dbh;
    $query = "SELECT COUNT(*) as total_rows FROM author where primaryemail='$authoremail'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $reviewered = $row['total_rows'];
    return $reviewered;
}

?>