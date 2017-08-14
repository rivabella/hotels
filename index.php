<?php
include 'header.php';
include 'classes/excel_reader.php'; //include the class to read the xls
// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;
$excel->read('files/Fletcher_Hotels.xls');
//Put the data in an array
$b = $excel->sheets;


//get the values from the provinces in an array from column 6
$values= array_column($b['0']['cells'],'6');

?>
<legend>Search</legend>

<div class="col-md-12">
    <div class="form-area rounded">
         <form action="index.php" method="POST" role="form">

             <div class="form-group">
                 <label for="plaats">In welke provincie zoekt u een hotel?</label>
                     <select class="form-control" name="places">

                     <?php
//                    find the unique values and put them in drop down
                     $unique_values= array_unique($values);
//                     sort the values alphabeticaly
                     sort($unique_values);
//                     loop true the array $unique_values to get $unique_value for the options
                     foreach($unique_values as $unique_value) { ?>
                         <option value="<?= $unique_value ?>"><?= $unique_value ?></option>
                         <?php
                     }
                     ?>

                     ​</select>
             </div>

             <button type="submit" class="btn btn-default">Search</button>
         </form>
    </div>
</div>

<?php

//find the keys from the search value in the array
$keys = array_keys($values, $_POST?$_POST['places']:'' );

//make the head for the table
$re = '<div class="col-md-12"><legend>Selecteer uw hotel.</legend>';
$re .= '<table class="table table-hover table-striped table-responsive" >';
$re .= '<thead class="thead">';
$re .= '<tr>';
$re .= '<th>Naam Hotel</th>';
$re .= '<th>Straat</th>';
$re .= '<th>Plaats</th>';
$re .= '<th>Provincie</th>';
$re .= '<th>Telefoonnummer</th>';
$re .= ' <th>Email</th>';
$re .= '</tr>';
$re .= '</thead>';
$re .= '<tbody>';


//    make the body for the table with the search values
    foreach ($keys as $key) {
    $key++;
       $value = $b['0']['cells'][$key];
        $re .= "<tr><td><a href='details.php?naam=".$value['2']."'>".$value['2']."</a></td>";
        $re .= "<td>".$value['4']."</td>";
        $re .= "<td>".$value['5']."</td>";
        $re .= "<td>".$value['6']."</td>";
        $re .= "<td>".$value['7']."</td>";
        $re .= "<td>".$value['8']."</td>";
    }

$re .= "</tr></tbody></table></div>";
print $re;

?>
<?php
include 'footer.php';
?>
