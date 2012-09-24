<?php class pl_baseFdb {
function engine(&$q) {
	//if ($q->ajax!="TRUE") {
		if ((isset($q->fdb_dbname)) && (isset($q->fdb_login)) && (isset($q->fdb_password))) {
			$q->fdb_db=ibase_connect($q->fdb_dbname,$q->fdb_login,$q->fdb_password) or die(" error fbdb connect ".ibase_errmsg());
			$q->fdb_it=ibase_trans(IBASE_WRITE+IBASE_COMMITTED+IBASE_REC_VERSION+IBASE_NOWAIT,$q->fdb_db) or die(" error start transaction".ibase_errmsg());
		}
	//}
}
} ?>
