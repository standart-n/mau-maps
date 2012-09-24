<?php class pl_alphaModel {
function engine(&$q) {
	//if (!$q->ajax) {
		if ($q->base->controls($q,"fn")) {
			$q->html=$q->fn->loadModel('alpha');
		}
	//}
}
} ?>
