<?php class start {

function engine(&$q) {
	if ($this->init($q)) {
		$this->url($q);
		if (!$q->ajax) {
			$q->fn->toModel($q,$q->work->checkTotal($q),"total");
			$q->fn->toModel($q,$q->work->checkTR($q),"tr-table");
			$q->fn->toModel($q,$q->work->checkBase($q),"content-table");
			$q->fn->toModel($q,$q->work->checkCTP($q),"ctp-select");
			$q->fn->toModel($q,$q->work->checkDIRECTION($q),"direction-select");
			$q->fn->toModel($q,$q->work->checkSSERVICE($q),"service-select");
			$q->fn->toModel($q,$q->work->checkSREGION($q),"sector-select");
			$q->fn->toModel($q,$q->work->checkSTREET($q),"street-select");
			$q->fn->toModel($q,$q->work->checkNOMER($q),"home-select");		
		  } else {
			$this->ajax($q);
		}
	}
}

function url(&$q) {
	foreach (array("uuid","id","page","category","action","click","click_id","last","f_direction","f_ctp","f_service","f_sector","f_street","f_home") as $key) { 
		if (isset($_REQUEST[$key])) { 
			$q->url->$key=strval($_REQUEST[$key]); 
		} else { 
			$q->url->$key=""; 
		} 
	}
	$q->validate->ajax($q);
	$q->validate->skipForSql($q->url->id);
	$q->validate->skipForSql($q->url->last);
	$q->validate->click($q->url->click);
	$q->validate->clickId($q->url->click_id);
	if ($q->url->page=="") { $q->url->page="main"; }
	if ($q->url->uuid=="") { $q->url->uuid="0"; }
	if ($q->url->category=="") { $q->url->category="list"; }
	
	//$q->url->click="street";
	//$q->url->f_street="10 лет Октября";
}

function init(&$q) { $rtn=true;
	if (!$q->base->tpl($q,"main")) $rtn=false;
	if (!$q->base->tpl($q,"maps")) $rtn=false;
	if (!$q->base->controls($q,"fn")) $rtn=false;
	if (!$q->base->controls($q,"sql")) $rtn=false;
	if (!$q->base->controls($q,"work")) $rtn=false;
	if (!$q->base->controls($q,"validate")) $rtn=false;
	return $rtn;
}

function ajax(&$q) { $s=array(); $q->alert="";
		$s['uuid']=$q->url->uuid;
		$s['html']=$q->work->checkBase($q);
		$s['total']=$q->work->checkTotal($q);
		//$s['ctp']=$q->work->checkCTP($q);
		//$s['direction']=$q->work->checkDIRECTION($q);
		//$s['service']=$q->work->checkSSERVICE($q);
		//$s['sector']=$q->work->checkSREGION($q);
		$s['street']=$q->work->checkSTREET($q);
		$s['home']=$q->work->checkNOMER($q);
		$s['script']=$q->work->checkScript($q);
		$s['more']=$q->more;
		$s['count']=$q->count;
		$s['last']=$q->url->last+$q->count;
		$s['alert']=$q->alert;
		$q->html=json_encode($s);
}


} ?>
