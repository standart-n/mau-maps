<?php class base {
function fn(&$q,$s) { $rtn=true;
	foreach (explode("|",$s) as $key) { $fn="fn_".$key;
		if (!isset($q->$fn)) { 
			if (file_exists("fn/".$fn.".php")) { 
				include_once("fn/".$fn.".php"); 
				if (class_exists($fn)) {
					$q->$fn=new $fn; $q->$fn->q=$q;
				}
			}
		}
		if (!isset($q->$fn)) { $rtn=false; }
	}
	return $rtn;
}
function controls(&$q,$s) { $rtn=true;
	foreach (explode("|",$s) as $key) { $ct="".$key;
		if (!isset($q->$ct)) { 
			if (file_exists("controls/".$q->folder."/".$ct.".php")) { 
				include_once("controls/".$q->folder."/".$ct.".php"); 
				if (class_exists($ct)) {
					$q->$ct=new $ct; $q->$ct->q=$q;
				}
			}
		}
		if (!isset($q->$ct)) { $rtn=false; }
	}
	return $rtn;
}
function tpl(&$q,$s) { $rtn=true;
	foreach (explode("|",$s) as $key) { $tpl="tpl_".$key; $path="templates/".$q->folder."/".$tpl.".php";
		if (!isset($q->$tpl)) { 
			if (file_exists($path)) { include_once($path); 
				if (class_exists($tpl)) {
					$q->$tpl=new $tpl;
				}
			}
		}
		if (!isset($q->$tpl)) { $rtn=false; }
	}
	return $rtn;
}

} ?>
