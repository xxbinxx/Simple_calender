<!DOCTYPE html>
<html>
     <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<link rel="stylesheet" href="master.css">
<SCRIPT src="script.js"></SCRIPT>
<body>
    <div class="info message">
            <h3>Data Added!</h3>
            <p></p>
        </div>
        <div class="error message">
            <h3>Ups, an error ocurred</h3>
            <p></p>
        </div>
        <div class="warning message">
            <h3>Hey, You just changed that Event!</h3>
            <p>Don't forget to save.</p>
        </div>
        <div class="success message">
            <h3>Success!</h3>
            <p>All events saved successfully.</p>
        </div>
<?php
$monthNames = Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

// get year from dateStamp
$year = date("Y");
for ($i = 0; $i < count($monthNames); $i++) {
    $month = $i+1; //+1 because array has 0 based indexing  

    // mktime(hour,minute,second,month,day,year,is_dst); (is_dist) is OPTIONAL
    $firstDay = mktime(0, 0, 0, $month, 1, $year);

    // get the total no. of days in specified month ( $i ).
    $daysInMonth = date("t", $firstDay); 

    // get the start day of the month 0 for sunday, 1 for monday ...
    $firstDay = date("w", $firstDay);
    echo '        
        <div class="row">
        <table>
            <tr class="ruler">
                <td></td>
            </tr>
            <tr>
                <td class="header">';
    // Print month names
    echo $monthNames[$i];
    echo '</td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2">             
                    <tr>
                    <td class="holiday weekday"><strong >Su</strong></td>
                    <td class="weekday"><strong>M</strong></td>
                    <td class="weekday"><strong>T</strong></td>
                    <td class="weekday"><strong>W</strong></td>
                    <td class="weekday"><strong>T</strong></td>
                    <td class="weekday"><strong>F</strong></td>
                    <td class="weekday"><strong>S</strong></td>
                    </tr>';
    
    // Calculate number of rows
    // $totalCells = $firstDay + $daysInMonth;
    // if ($totalCells < 36) {
    //     $rowNumber = 5;
    // } else {
    $rowNumber = 6;

    // }
    $dayNumber = 1;    
    // Create Rows
    for ($currentRow = 1; $currentRow <= $rowNumber; $currentRow++) {

        if ($currentRow == 1) {

            // Create First Row
            echo "<tr>\n";
            for ($currentCell = 0; $currentCell < 7; $currentCell++) {
                if ($currentCell == $firstDay) {

                    // First Day of the Month    
                    echo "<td width='40' data-date=". $dayNumber."-".$month ."-".$year . ">" . $dayNumber . "</td>\n";
                    $dayNumber++;
                } else {
                    if ($dayNumber > 1) {

                        // First Day Passed so output Date
                        echo "<td width='40' data-date=". $dayNumber."-".$month ."-".$year . ">" . $dayNumber . "</td>\n";
                        $dayNumber++;
                    } else {

                        // First Day Not Reached so display blank cell
                        echo "<td width='40' class='blank'>&nbsp;</td>\n";
                    }
                }
            }
            echo "</tr>\n";
        } else {

            // Create remaining Rows
            echo "\n<tr align='center'>\n";
            for ($currentCell = 0; $currentCell < 7; $currentCell++) {
                if ($dayNumber > $daysInMonth) {
                    
                    // Days in month exceeded so display blank cell
                    echo "<td width='40' class='blank' >&nbsp;</td>\n";
                } else {
                    echo "<td width='40' data-date=". $dayNumber."-".$month ."-".$year . ">" . $dayNumber . "</td>\n";
                    $dayNumber++;
                }
            }
            echo "</tr>\n";
        }

    }
    echo '</table>
                </td>
            </tr>
            <tr class="ruler">
                <td></td>
            </tr>
        </table>
        <div>
         ';
}
?>
<input type="submit" name="save" value="save" onclick="savedata();">


</body>
</html>