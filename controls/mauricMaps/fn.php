<?php class fn {

function loadModel($n) { $q=&$this->q; $m="";
    $mdl='models/'.$q->folder.'/mdl_'.$n.'.html';	
    if (file_exists($mdl)) { if (fopen($mdl,"r")) {
		$m.=file_get_contents($mdl);
	}	}	
	return $m;
}

function toModel(&$q,$s="",$tag="",$type="simple") {
	switch ($type) {
	case "simple":
		$q->html=str_replace("[".$tag."]",$s,$q->html);
	break;
	}
}

function toUTF($a) { $s="";
	$s.=trim(iconv("cp1251","UTF-8",$a));
	return $s;
}


function GetDBF(&$q) {
	$q->dbf=dbase_open("../files/base.dbf",0);
}

function closeDBF($q) {
	dbase_close($q->dbf);
}

function initArray(&$q){
	foreach (array("STREET","NOMER","SREGION","SSERVICE") as $key) { $q->$key=array(); }
}

} ?>
