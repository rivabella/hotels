<?php
include 'header.php';
include 'classes/excel_reader.php'; //include the class to read the xls
// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;
$excel->read('files/Fletcher_Hotels.xls');
//Put the data in an array
$b = $excel->sheets;


//get the values from the provinces in an array from column 6
$values = array_column($b['0']['cells'],'6');
//get the values from the names in an array from column 2
$hotels = array_column($b['0']['cells'],'2');
?>
<legend>Search</legend>
<!--make the from-->
<div class="col-md-12">
    <div class="form-area rounded">
        <form action="index.php" method="POST" role="form">

            <div class="form-group">
                <label for="search">Welk hotel zoekt u?</label>
                <input type="text" name="search" class="form-control">
                <label for="plaats">In welke provincie zoekt u een hotel?</label>
                <select class="form-control" name="places">
                    <option value="">Maak een keus</option>
                    <?php
                    //                    find the unique values and put them in drop down
                    $unique_values= array_unique($values);
                    //                     sort the values alphabeticaly
                    sort($unique_values);
                    //                     loop true the array $unique_values to get $unique_value for the options
                    foreach($unique_values as $unique_value) { ?>

                        <option value="<?= $unique_value ?>"> <?= $unique_value ?></option>
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
if(isset($_POST['places'])&&isset($_POST['search'])){
//find the keys from the places values in the array with the same value as in $post['places']
    $key_places = array_keys($values, $_POST['places']?$_POST['places']:'' );

    function my_search($haystack) {
        $needle = $_POST['search']?$_POST['search']:'0';
//    case-insensitive
        return(stripos($haystack, $needle));
    }

//filters the array $hotels with the my_search function and returns the value with key with the same value as $post['search']
    $matches = array_filter($hotels, 'my_search');
//get only the keys
    $key_search = array_keys($matches);
    $keys = array_unique(array_merge($key_places,$key_search));
    if(empty($key_places) && empty($keys)){
        echo '<p>Er zijn geen opties gevonden.</p>';
    }
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
}



?>
<?php
include 'footer.php';
?>
