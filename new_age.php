<?php
	if ($_COOKIE['birthday'] != "") {
		$age = date('Y-m-d') - date($_COOKIE['birthday']);
		if ( (date('d') < date(substr($_COOKIE['birthday'], 8, 2))) && (date('m') < date(substr($_COOKIE['birthday'], 5, 2))) )
			$age = $age - 1;
		echo "$age";
	} else {
		echo "No";
	}
?>