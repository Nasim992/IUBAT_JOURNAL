<?php 

$subject = "Reviwer Request in IUBAT JOURNAL";

include 'url.php'; 
 
$msg = "You have been requested as a reviewer for - $papername.
     Here, is the abstract of this paper
      $abstract.

If you want to accept this Request as a Reviewer for this paper please click the following acceptation link and read the full manuscript:
    $url/acceptrequestreviewer.php?paperid=$paperid&email=$pemail.
You have been selected as a reviewer till $endingdate.

---------------------------------------------------------------------------------------------------------------
For Rejecting the Review Request of this paper Please Click on the Following link:
    $url/rejectrequestreviewer.php?paperid=$id&email=$pemail";
    
$headers = "From: journal.iubat@gmail.com";
 
?>