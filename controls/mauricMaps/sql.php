<?php class sql {

function table(&$q) { $s=""; $i=0; $k="";
	$q->validate->skipForSql($q->url->last);
	$s.="SELECT SKIP ".$q->url->last." * FROM VW_DISCONNECTION_WEB WHERE (1=1) ";
	if ($q->validate->direction($q)) { 
		$s.="AND (DIRECTION='".$q->validate->toWin($q->url->f_direction)."') ";
	}
	if ($q->validate->ctp($q)) { 
		$s.="AND (CTP='".$q->validate->toWin($q->url->f_ctp)."') ";
	}
	if ($q->validate->service($q)) { 
		$s.="AND (SSERVICE='".$q->validate->toWin($q->url->f_service)."') ";
	}
	if ($q->validate->sector($q)) { 
		$s.="AND (SREGION='".$q->validate->toWin($q->url->f_sector)."') ";
	}
	if ($q->validate->street($q)) { 
		$s.="AND (STREET='".$q->validate->toWin($q->url->f_street)."') ";
	}
	if ($q->validate->home($q)) { 
		$s.="AND (NOMER='".$q->validate->toWin($q->url->f_home)."') ";
	}
	$s.="ORDER by STREET, SORTEDCAPTION ASC ";

	//$q->alert=$k;
	return $s;
}

function balloon(&$q) { $s="";
	$s.="SELECT * FROM VW_DISCONNECTION_WEB WHERE (UUID='".$q->url->uuid."') ";
	//$q->alert=$k;
	return $s;
}



function getList($q,$key) { $s=""; $k="";
	$s.="SELECT ".$key." FROM VW_DISCONNECTION_WEB WHERE (1=1) ";
	if ($q->validate->direction($q)) { 
		$s.="AND (DIRECTION='".$q->validate->toWin($q->url->f_direction)."') ";
	}
	if ($q->validate->ctp($q)) { 
		$s.="AND (CTP='".$q->validate->toWin($q->url->f_ctp)."') ";
	}
	if ($q->validate->service($q)) { 
		$s.="AND (SSERVICE='".$q->validate->toWin($q->url->f_service)."') ";
	}
	if ($q->validate->sector($q)) { 
		$s.="AND (SREGION='".$q->validate->toWin($q->url->f_sector)."') ";
	}
	if ($q->validate->street($q)) { 
		$s.="AND (STREET='".$q->validate->toWin($q->url->f_street)."') ";
	}
	if ($q->validate->home($q)) { 
		$s.="AND (NOMER='".$q->validate->toWin($q->url->f_home)."') ";
	}
	$s.="GROUP by ".$key." ";
	$s.="ORDER by ".$key." ASC ";
	
	return $s;
}

function getTotal($q) { $s=""; $k="";
	$s.="SELECT ";
	$s.="sum(coalesce(SALL,0)) as SUM_SALL, ";
	$s.="sum(coalesce(RESIDENT,0)) as SUM_RESIDENT, ";
	$s.="sum(coalesce(COUNTAPARTMENT,0)) as SUM_COUNTAPARTMENT,  ";
	$s.="count(UUID) as COUNT_BUILDINGS ";
	$s.="FROM VW_DISCONNECTION_WEB WHERE (1=1) ";
	if ($q->validate->direction($q)) { 
		$s.="AND (DIRECTION='".$q->validate->toWin($q->url->f_direction)."') ";
	}
	if ($q->validate->ctp($q)) { 
		$s.="AND (CTP='".$q->validate->toWin($q->url->f_ctp)."') ";
	}
	if ($q->validate->service($q)) { 
		$s.="AND (SSERVICE='".$q->validate->toWin($q->url->f_service)."') ";
	}
	if ($q->validate->sector($q)) { 
		$s.="AND (SREGION='".$q->validate->toWin($q->url->f_sector)."') ";
	}
	if ($q->validate->street($q)) { 
		$s.="AND (STREET='".$q->validate->toWin($q->url->f_street)."') ";
	}
	if ($q->validate->home($q)) { 
		$s.="AND (NOMER='".$q->validate->toWin($q->url->f_home)."') ";
	}
	
	return $s;
}


function getCross($q,$ln) { $s=""; $k="";
	$ln_ms=explode("|",$ln);
	$service=$ln_ms[0];
	$sector=$ln_ms[1];
	$s.="SELECT count(UUID) as COUNT_ISP, SISPOLNITEL as ISP  FROM VW_DISCONNECTION_WEB WHERE (1=1) ";
	if ($q->validate->direction($q)) { 
		$s.="AND (DIRECTION='".$q->validate->toWin($q->url->f_direction)."') ";
	}
	if ($q->validate->ctp($q)) { 
		$s.="AND (CTP='".$q->validate->toWin($q->url->f_ctp)."') ";
	}
	if ($q->validate->service($q)) { 
		$s.="AND (SSERVICE='".$q->validate->toWin($q->url->f_service)."') ";
	}
	if ($q->validate->sector($q)) { 
		$s.="AND (SREGION='".$q->validate->toWin($q->url->f_sector)."') ";
	}
	if ($q->validate->street($q)) { 
		$s.="AND (STREET='".$q->validate->toWin($q->url->f_street)."') ";
	}
	if ($q->validate->home($q)) { 
		$s.="AND (NOMER='".$q->validate->toWin($q->url->f_home)."') ";
	}
	if ($service!="Итого") { 
		$s.="AND (SSERVICE='".$q->validate->toWin($service)."') ";
	}
	if ($sector!="Итого") { 
		$s.="AND (SREGION='".$q->validate->toWin($sector)."') ";
	}
	$s.="GROUP by SISPOLNITEL ";
	$s.="ORDER by SISPOLNITEL ASC ";
	
	return $s;
}

} ?>
