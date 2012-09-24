<?php class validate {

function row(&$r) {
	foreach (array("UUID","STREET","NOMER","SREGION","SSERVICE","DATE_OFF",
					"DATE_ON_PLAN","DOCDATE","SERVICE_EMERGENCY","STYPE_DISCONNECTION",
					"AGENT_LIFT","SISPOLNITEL","CTP","SCAUSE","TEC","PHONENUMBER",
					"DIRECTION","SERVICE_ORGANIZATION","SALL","RESIDENT","SHOUSE",
					"COUNTAPARTMENT","GODPOSTR","COORDINATE") 
				as $key) { 
		if (!isset($r->$key)) { $r->$key=""; }
		$r->$key=trim(iconv("cp1251","UTF-8",$r->$key));
		if ($r->$key=="") { $r->$key="-"; } 
	}
}

function total(&$r) {
	foreach (array("SUM_SALL","SUM_RESIDENT","SUM_COUNTAPARTMENT","COUNT_BUILDINGS") as $key) { 
		$r->$key=floatval(trim(iconv("cp1251","UTF-8",$r->$key)));
		if ($r->$key=="") { $r->$key="0"; } 
	}
}


function cross(&$r) {
	foreach (array("ISP","COUNT_ISP") as $key) { 
		$r->$key=trim(iconv("cp1251","UTF-8",$r->$key));
		if ($r->$key=="") { $r->$key="-"; } 
	}
}


function toWin($s) { 
	return iconv("UTF-8","cp1251",$s);
}

function click(&$s) {
	if ($s!="") { $s=str_replace("-select","",$s); }
}

function clickId(&$id) {
	if ($id=="") { $id=-1; }
	if ($id!="") { if ($id==0) $id=-1; }
}

function ajax(&$q){
	if (isset($_REQUEST["ajax"])) { $q->ajax=true; } else { $q->ajax=false; }
}

function direction(&$q){ $flag=false;
	if (isset($q->url->f_direction)) {
		if (($q->url->f_direction!="") && ($q->url->f_direction!="Все")) {
			$flag=true;	
		}
	}
	return $flag;
}

function ctp(&$q){ $flag=false;
	if (isset($q->url->f_ctp)) {
		if (($q->url->f_ctp!="") && ($q->url->f_ctp!="Все")) {
			$flag=true;	
		}
	}
	return $flag;
}

function service(&$q){ $flag=false;
	if (isset($q->url->f_service)) {
		if (($q->url->f_service!="") && ($q->url->f_service!="Все")) {
			$flag=true;	
		}
	}
	return $flag;
}

function sector(&$q){ $flag=false;
	if (isset($q->url->f_sector)) {
		if (($q->url->f_sector!="") && ($q->url->f_sector!="Все")) {
			$flag=true;	
		}
	}
	return $flag;
}

function street(&$q){ $flag=false;
	if (isset($q->url->f_street)) {
		if (($q->url->f_street!="") && ($q->url->f_street!="Все") && ($q->url->click!="sector")) {
			$flag=true;	
		}
	}
	return $flag;
}

function home(&$q){ $flag=false;
	if (isset($q->url->f_home)) {
		if (($q->url->f_home!="") && ($q->url->f_home!="Все") && ($q->url->click!="sector") && ($q->url->click!="street")) {
			$flag=true;	
		}
	}
	return $flag;
}

function idForSql(&$id) {
	$id=intval($id); if ($id<1) { $id=1; }
}

function skipForSql(&$id) {
	if ($id=="") $id=0;
	$id=intval($id); if ($id<0) { $id=0; }
}

function strForList($s) { 
	$s=iconv("cp1251","UTF-8",$s);
	return $s;
}

function searchForSql(&$s) { $rt=false;
	if (($s!="") && ($s!="Поиск по всем товарам...")) {
		$s=iconv("UTF-8","cp1251",$s);
		$rt=true;
	} else {
		$rt=false;
	}
	return $rt;
}

function urlSort(&$sort) {
	$sort=trim(strtoupper($sort));
	switch ($sort) {
		case "SNAME": break;
		case "SCOUNTRY": break;
		case "SERIA": break;
		case "PRICE": break;
		default: $sort="SNAME";
	} 
}

function urlGrad(&$grad) {
	$grad=trim(strtoupper($grad));
	switch ($grad) {
		case "ASC": break;
		case "DESC": break;
		default: $grad="ASC";
	}
}

function urlPresence(&$pr) {
	$pr=trim(strtolower($pr));
	switch ($pr) {
		case "false": break;
		case "true": break;
		default: $pr="false";
	}
}

function baseStr(&$s) {
	$s=strval(trim(iconv("cp1251","UTF-8",$s)));	
}


function urlInt(&$id) {
	$id=intval(trim($id));	
}

function urlStr(&$s) {
	$s=trim(strval($s));
}

function urlQuery(&$s) {
	$s=trim(strval($s));
}

function setDate(&$k,$type="day-month-full") { $s=""; $m=0; $mn=""; $i=0;
	$dt=explode(" ",$k); $d=$dt[0]; $d=str_replace(".","-",$d); $d=str_replace(".","-",$d);
	$di=explode("-",$d); $y=$di[0];
	if (isset($di[1])) { $m=intval($di[1]); }
	if (isset($di[2])) { $i=intval($di[2]); }
	if ($i==0) { $i=""; }
	switch ($type) {
		case "day-month-full": 
			switch ($m) {
				case 1: $mn="января"; break;
				case 2: $mn="февраля"; break;
				case 3: $mn="марта"; break;
				case 4: $mn="апреля"; break;
				case 5: $mn="мая"; break;
				case 6: $mn="июня"; break;
				case 7: $mn="июля"; break;
				case 8: $mn="августа"; break;
				case 9: $mn="сентября"; break;
				case 10: $mn="октября"; break;
				case 11: $mn="ноября"; break;
				case 12: $mn="декабря"; break;
			}
			$s=trim($i." ".$mn." ".$y); 
		break;
		case "day-month": 
			switch ($m) {
				case 1: $mn="янв"; break;
				case 2: $mn="фев"; break;
				case 3: $mn="мар"; break;
				case 4: $mn="апр"; break;
				case 5: $mn="мая"; break;
				case 6: $mn="июня"; break;
				case 7: $mn="июля"; break;
				case 8: $mn="авг"; break;
				case 9: $mn="сен"; break;
				case 10: $mn="окт"; break;
				case 11: $mn="ноя"; break;
				case 12: $mn="дек"; break;
			}
			$s=trim($i." ".$mn); 
		break;
	}
	if ($s=="") { $s="-"; }
	$k=$s;
}

} ?>
