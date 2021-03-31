<?php 

$subject = "Editor Request in IUBAT Review";
  
include 'url.php';

$msg = "You have been requested as a Editor for - $papername.
Here, is the abstract of this paper-
$abstract
If you want to accept this Request as a Editor for this paper please click the following acceptation link:
$url/acceptrequesteditor.php?paperid=$paperid&email=$pemail.

You have been selected as an Editor till $endingdate.

---------------------------------------------------------------------------------------------------------------
For Rejecting the Review Request of this paper Please Click on the Following link:
$url/rejectrequesteditor.php?paperid=$paperid&email=$pemail";

$headers = "From: journal.iubat@gmail.com";

?>