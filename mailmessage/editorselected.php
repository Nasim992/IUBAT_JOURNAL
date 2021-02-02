<?php 

$subject = "Editor Request in IUBAT JOURNAL";
$msg = "You have been requested as a Editor for $papername. Here, is the link for this paper title and Abstract:
    http://localhost/IUBAT_JOURNAL/$filepathmessagetitle

If you want to accept this Request as a Editor for this paper please click the following acceptation link:
    http://localhost/IUBAT_JOURNAL/acceptrequesteditor.php?paperid=$id&email=$pemail

---------------------------------------------------------------------------------------------------------------
For Rejecting the Review Request of this paper Please Click on the Following link:
    http://localhost/IUBAT_JOURNAL/rejectrequesteditor.php?paperid=$id&email=$pemail";


// $msg = "You have been requested as a Editor for $papername. Here, is the link for this paper title and Abstract:
//     http://nasim992.epizy.com/$filepathmessage

// If you want to accept this Request as a Editor for this paper please click the following acceptation link:
//     http://nasim992.epizy.com/acceptrequesteditor.php?paperid=$id&email=$pemail

// ---------------------------------------------------------------------------------------------------------------
// For Rejecting the Review Request of this paper Please Click on the Following link:
// http://nasim992.epizy.com/rejectrequesteditor.php?paperid=$id&email=$pemail";


$headers = "From: journal.iubat@gmail.com";

// send_email($pemail, $subject, $msg, $headers);


?>