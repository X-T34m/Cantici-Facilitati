<?php

	$cantici = array(
		"10", "24", "34", "40", "44", "45", "79", "81", "88", "105", "106", "107", "115",
		"116", "119", "121", "123", "124", "134", "139", "141", "143", "150", "151", "154"
	);
	$giorni__ = array();
	$giorni = array(10 =>
						array(
							array("start" => "18:40", "end" => "19:10", "n" => "123"),
							array("start" => "19:50", "end" => "20:15", "n" => "119"),
							array("start" => "20:30", "end" => "21:00", "n" => "40")
						),
					14 =>
						array(
							array("start" => "18:25", "end" => "18:50", "n" => "105"),
							array("start" => "19:30", "end" => "19:55", "n" => "107")
						)
	);

	if(array_key_exists(date("j"), $giorni)) {
		$ore = date("H");
		$min = date("i");

		foreach($giorni[date("j")] as $row) {

			$date1 = DateTime::createFromFormat('H:i', $ore . ":" . $min);
			$start = DateTime::createFromFormat('H:i', $row["start"]);
			$end = DateTime::createFromFormat('H:i', $row["end"]);

			if($date1 > $start && $date1 < $end) {
				array_push($giorni__, $row["n"]);
			}
		}
	}

	if(empty($giorni__)) $giorni__ = $cantici;

	echo json_encode($giorni__);