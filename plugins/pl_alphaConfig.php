<?php class pl_alphaConfig {
function engine(&$q) { $q->ini_path="settings/config.ini";
	//if ($q->ajax!="TRUE") {
	if (file_exists($q->ini_path)) {
		$q->config_ini=parse_ini_file($q->ini_path,true);
		while (list($option,$line)=each($q->config_ini)) {
			while (list($field,$value)=each($line)) {
				$q->$field=$value;
			}
		}
	}
	//}
}
} ?>
