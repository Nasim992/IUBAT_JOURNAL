<?php 

$subject = "Reviwer Request in IUBAT JOURNAL";

include 'url.php';

$msg = "You have been requested as a reviewer for $papername. Here, is the link for this paper title and Abstract:
    $url/$filepathmessagetitle

If you want to accept this Request as a Reviewer for this paper please click the following acceptation link:
    $url/acceptrequestreviewer.php?paperid=$id&email=$pemail

---------------------------------------------------------------------------------------------------------------
For Rejecting the Review Request of this paper Please Click on the Following link:
    $url/rejectrequestreviewer.php?paperid=$id&email=$pemail";
    
$headers = "From: journal.iubat@gmail.com";
 
// $msg = "You have been requested as a reviewer for $papername. Here, is the link for this paper title and Abstract:
//     http://nasim992.epizy.com/$filepathmessage

// If you want to accept this Request as a Reviewer for this paper please click the following acceptation link:
//     http://nasim992.epizy.com/acceptrequestreviewer.php?paperid=$id&email=$pemail

// ---------------------------------------------------------------------------------------------------------------
// For Rejecting the Review Request of this paper Please Click on the Following link:
//     http://nasim992.epizy.com/rejectrequestreviewer.php?paperid=$id&email=$pemail";
// $headers = "From: journal.iubat@gmail.com";

// send_email($pemail, $subject, $msg, $headers);

?>