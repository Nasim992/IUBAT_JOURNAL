<?php 
 
$assigndate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));

echo $assigndate; 

$date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));

echo $date;

$month = date("M",strtotime($date));  
 
echo $month;

?>

      <!-- Associate Editors -->
      <h6 class="text-center"><b>ASSOCIATE EDITORS</b></h6>
        <div class="row">
        <div  class="col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
        <div class="card h-75">
         <div class="card-body">
         <p><b>Dr. Md. Mahbubur Rahman</b></p>
         <p>Associate Professor
            Department of Physics, IUBAT</p>
         </div>
          </div>
        </div>
        <div  class="col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
        <div class="card h-75">
         <div class="card-body">
         <p><b>Mozaffar Alam Chowdhury</b></p>
         <p>Assistant Professor
          College of Business Administration, IUBAT</p>
         </div>
          </div>
        </div>
        </div>
        <!-- Associate Editors -->
