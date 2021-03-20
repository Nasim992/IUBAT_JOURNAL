<!-- Chief Editor name  -->
<?php 
$sql = "SELECT chiefeditor.id,chiefeditor.fullname,chiefeditor.password,chiefeditor.email,chiefeditor.contact from chiefeditor";
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1; 
 
      if($query->rowCount() > 0) 
      {
      foreach($results as $result)  
      { 
       $chiefeditorname=  htmlentities($result->fullname);
      }
    }
?>
<!-- Chief Editor name   -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <h3 ><b>IUBAT Review</b></h3>
    <h5 >A Multidisciplinary Academic Journal</h5>
    <p ><b>Editor-in-Chief : </b><?php echo $chiefeditorname; ?></p>
    <a  href="editorialboard" title="Journal Editorial Board"> View Editorial Board</a>
    <div class="d-flex justify-content-start">
        <!-- <a class="pr-3 text-secondary" href="#" title="Cite Score"><b>> Cite score : 0.00</b></a>
    <a class="text-secondary" href="#" title="Impact Factor"><b>Impact Factor : 0.00</b></a> -->
    </div>

</body>

</html>