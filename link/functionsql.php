<?php  
// Mysqli Query Function starts Here 
function query($query){

	global $link;

	return mysqli_query($link, $query);
}
// Mysqli Query Function Ends Here

// Successfully Connection Section Starts here
function confirm($result) {
    global $link;

    if(!$result) {

        die("QUERY FAILED" . mysqli_error($link));
    } 
}
// Successfully Connection Section Ends Here

// Number of rows count section starts Here
function row_count($result){
    //returns no of rows 
   return mysqli_num_rows($result);
   
}
// Number of rows count section ends here

// Mysqli escape string section starts here
function escape($string) {
    global $link;

	return mysqli_real_escape_string($link, $string);
}

// Mysqli escape string section ends here

?>