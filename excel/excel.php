<?php 
//include the following 2 files
require 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';

$file = $_FILES['excel']['tmp_name'];
  
$objPHPExcel = PHPExcel_IOFactory::load($file);
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
 //   echo "<br>The worksheet ".$worksheetTitle." has ";
 //   echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
  //  echo ' and ' . $highestRow . ' row.';
  //  echo '<br>Data: <table border="1"><tr>';
    for ($row = 1; $row <= $highestRow; ++ $row) {
      //  echo '<tr>';
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
     //       echo '<td>' . $val . '</td>';
        }
     //   echo '</tr>';
    }
    //echo '</table>';
}
	$file = fopen("convert.txt","w+");
	$array_row=array();
	for ($row = 2; $row <= $highestRow; ++ $row) {
		$val=array();
		for ($col = 0; $col < $highestColumnIndex; ++ $col) {
			$cell = $worksheet->getCellByColumnAndRow($col, $row);
			$val[] = $cell->getValue();
		}
		$array_row="\"".$val[1]."\",\"".$val[2]."\",\"".$val[3]."\",\"".$val[4]."\",\"".$val[5]."\",\"".$val[6]."\",\"".$val[7]."\",\"".$val[8]."\",\"".$val[9]."\",\"".$val[10]."\",\"".$val[11]."\",\"".$val[12]."\",\"".$val[13]."\",\"".$val[14]."\"\r\n";
		fwrite($file,$array_row);
	}
	fclose($file);

	$myfile = fopen("convert.txt", "r");
	$array_byline=array();
	while(!feof($myfile)) {
		array_push($array_byline,fgets($myfile) . "<br>");
	}
	fclose($myfile);
	echo ("<table width=100% align=center>");	
	for($i=0;$i<count($array_byline)-1;$i++){
			$value = $array_byline[$i];
			$spl="\"\,\"";
			$str_value = split ($spl, $value); 
			$value_01 = $str_value[0];	$value_01 = str_replace("\""," ", $value_01);
			$value_02 = $str_value[1];	
			$value_03 = $str_value[2];
			$value_04 = $str_value[3];	
			$value_05 = $str_value[4];
			$value_06 = $str_value[5];	
			$value_07 = $str_value[6];
			$value_08 = $str_value[7];	
			$value_09 = $str_value[8];
			$value_10 = $str_value[9];	
			$value_11 = $str_value[10];
			$value_12 = $str_value[11];	
			$value_13 = $str_value[12];
			$value_14 = $str_value[13];$value_14 = str_replace("\""," ", $value_14);
					
			echo ("
				<tr>
				<td height=22 style='border: 1px solid #ccc'>$value_01</td>
				<td height=22 style='border: 1px solid #ccc'>$value_02</td>
				<td height=22 style='border: 1px solid #ccc'>$value_03</td>
				<td height=22 style='border: 1px solid #ccc'>$value_04</td>
				<td height=22 style='border: 1px solid #ccc'>$value_05</td>
				<td height=22 style='border: 1px solid #ccc'>$value_06</td>
				<td height=22 style='border: 1px solid #ccc'>$value_07</td>
				<td height=22 style='border: 1px solid #ccc'>$value_08</td>
				<td height=22 style='border: 1px solid #ccc'>$value_09</td>
				<td height=22 style='border: 1px solid #ccc'>$value_10</td>
				<td height=22 style='border: 1px solid #ccc'>$value_11</td>
				<td height=22 style='border: 1px solid #ccc'>$value_12</td>
				<td height=22 style='border: 1px solid #ccc'>$value_13</td>
				<td height=22 style='border: 1px solid #ccc'>$value_14</td>
				
				
				</tr>");
		}
			echo ("</table>");
?>
