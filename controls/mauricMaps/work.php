<?php class work {

function checkBase(&$q) { $s=""; $i=0; $q->more=false; $q->script="";
	if ($q->url->category=="cross") {
		$s.=$this->cross($q);
	}
	if ($q->url->category=="balloon") {
		$s.=$this->balloon($q);
	}

	if (($q->url->category=="map") || ($q->url->category=="list")) { 
		$sql=$q->sql->table($q);
		$query=ibase_query($q->fdb_it,$sql);
		while ($r=ibase_fetch_object($query)) {
			$q->validate->row($r);
			$q->validate->setDate($r->DOCDATE);
			$q->validate->setDate($r->DATE_OFF);
			$q->validate->setDate($r->DATE_ON_PLAN);
			if ($q->url->category=="map") {
				$q->script.=$q->tpl_maps->scriptContent($q,$r,$i+$q->url->last);
			}
			if ($q->url->category=="list") {
				$s.=$q->tpl_main->line($q,$r,$i+$q->url->last);
				if ($i>20) break;
			}
			$i++;
		}
	}
	$q->count=$i;
	if ($i>20) { $q->more=true; }
	return $s;
}

function balloon(&$q) { $s="";
	$sql=$q->sql->balloon($q);
	$query=ibase_query($q->fdb_it,$sql);
	$r=ibase_fetch_object($query);
	$q->validate->row($r);
	$q->validate->setDate($r->DOCDATE);
	$q->validate->setDate($r->DATE_OFF);
	$q->validate->setDate($r->DATE_ON_PLAN);
	$s.=$q->tpl_main->lineInfo($q,$r,time(),true);
	//$s.=$r->SISPOLNITEL;
	return $s;	
}

function checkTotal(&$q) { $s="";
	$sql=$q->sql->getTotal($q);
	$query=ibase_query($q->fdb_it,$sql);
	while ($r=ibase_fetch_object($query)) {
		$q->validate->total($r);
		$s.=$q->tpl_main->total($q,$r);
	}
	return $s;
}

function cross(&$q){ $s=""; $k="";
	$cr_ms=array(); $cr_vals=array();
	for ($i=0;$i<6;$i++) { 
 		for ($j=0;$j<6;$j++) { 
			switch ($i) {
				case 0: $service="Горячая вода"; 				break;
				case 1: $service="Холодная вода"; 				break;
				case 2: $service="Лифт"; 						break;
				case 3: $service="Электроэнерг.(авар.заяв)"; 	break;
				case 4: $service="Элетроэнергия (071)"; 		break;
				case 5: $service="Итого";		 				break;
			}
			switch ($j) {
				case 0: $sector="Индустриальный"; 				break;
				case 1: $sector="Ленинский"; 					break;
				case 2: $sector="Октябрьский"; 					break;
				case 3: $sector="Первомайский"; 				break;
				case 4: $sector="Устиновский"; 					break;
				case 5: $sector="Итого";		 				break;
			}
			$cr_ms[$i][$j]=$service."|".$sector;
		}		
	}
	
	for ($i=0;$i<6;$i++) { 
 		for ($j=0;$j<6;$j++) { 
			$sql=$q->sql->getCross($q,$cr_ms[$i][$j]);
			$query=ibase_query($q->fdb_it,$sql);
			while ($r=ibase_fetch_object($query)) {
				$q->validate->cross($r);
				$k.=$r->ISP." - ".$r->COUNT_ISP."<br>";
			}
			//$k.=$sql;
			$cr_vals[$i][$j]=$k; $k="";
		}		
	}
	$s.=$q->tpl_main->cross($q,$cr_ms,$cr_vals);
	return $s;
}

function getList(&$q,$key) { $s=""; $ms=array();
	$sql=$q->sql->getList($q,$key);
	$query=ibase_query($q->fdb_it,$sql);
	while ($r=ibase_fetch_object($query)) {
		$ms[]=$q->validate->strForList($r->$key);
	}
	$q->$key=$ms;	
}

function checkDIRECTION(&$q) { $s="";
	$this->getList($q,"DIRECTION");
	$s=$q->tpl_main->select("УК","direction",$q->DIRECTION);
	return $s;
}

function checkCTP(&$q) { $s="";
	$this->getList($q,"CTP");
	$s=$q->tpl_main->select("ЦТП","ctp",$q->CTP);
	return $s;
}

function checkSSERVICE(&$q) { $s="";
	$this->getList($q,"SSERVICE");
	$s=$q->tpl_main->select("Услуга","service",$q->SSERVICE);
	return $s;
}

function checkSREGION(&$q) { $s="";
	$this->getList($q,"SREGION");
	$s=$q->tpl_main->select("Район","sector",$q->SREGION);
	return $s;
}

function checkSTREET(&$q) { $s="";
	$this->getList($q,"STREET");
	$s=$q->tpl_main->select("Улица","street",$q->STREET);
	return $s;
}

function checkNOMER(&$q) { $s="";
	$this->getList($q,"NOMER");
	$s=$q->tpl_main->select("Дом","home",$q->NOMER);
	return $s;
}

function checkScript(&$q) { $scH=""; $scF=""; $sc="";
	if ($q->url->category=="map") {
		$scH=$q->tpl_maps->scriptHeader();
		$scF=$q->tpl_maps->scriptFooter();
		$sc=$scH.$q->script.$scF;
	}
	return $sc;
}

function checkTR(&$q) { $s="";
	$s=$q->tpl_main->tr();
	return $s;
}


} ?>
