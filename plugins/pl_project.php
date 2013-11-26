<?php class pl_project {

function engine(&$q) {
	if ($q->base->controls($q,"start")) {
		$q->start->engine($q);
	}
}

} ?>


