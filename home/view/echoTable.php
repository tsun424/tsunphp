<?php
	const TS = '<table border = "1px" cellpadding = "0" cellspacing = "0">';
	const TH = '<tr><th style = "background-color:#DBEAF9" width = "30"> # </th><th style = "background-color:#DBEAF9" width = "100"> sum </th></tr>';
	const TE = '</table>';
	function echoTable($tableArr){
		echo TS;
		echo TH;
		foreach($tableArr as $i => $value){
			echo "<tr> <td>$i</td> <td>$value</td> </tr>";
		}
		echo TE;
		
	}
	//$arr = array(1=>'张三',2=>'李四',3=>'王二麻子');
	//echoTable($arr);
?>