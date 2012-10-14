<?php class tpl_maps {

function checkIcon($r){ $icon="";
	switch($r->SSERVICE) {
		case "Элетроэнергия (071)":
			$icon="twirl#violetDotIcon";
		break;
		case "Электроэнерг.(авар.заяв)":
			$icon="twirl#redDotIcon";
		break;
		case "Холодная вода":
			$icon="twirl#lightblueDotIcon";
		break;
		case "Горячая вода":
			$icon="twirl#blueDotIcon";
		break;
		case "Лифт":
			$icon="twirl#greyDotIcon";
		break;
		default:
			$icon="twirl#blueDotIcon";
	}
	return $icon;	
}

function scriptHeader(){ $s="";
    $s.="<script type=\"text/javascript\">"; 
	$s.="function getBalloonContent(id){";
		$s.="$.ajax({";
			$s.="url:'index.php',";
			$s.="cache:false,";
			$s.="type:'GET',";
			$s.="data:{";
				$s.="ajax:true,";
				$s.="uuid:id,";
				$s.="category:'balloon'";
			$s.="},";
			$s.="dataType:'json',";
			$s.="timeout:10000,";
			$s.="success:function(s){";
			$s.="\$('#balloon-content-'+s.uuid).html(s.html);";
			$s.="},";
			$s.="error:function(XMLHttpRequest,textStatus,error){ alert(error); }";
		$s.="});";
	$s.="}";
    $s.="function map_init(){";
    $s.="window.myMap=new ymaps.Map(\"map\",{";
    $s.="center:[56.840001,53.239778],";
    $s.="zoom:12,";
    $s.="behaviors:['default','scrollZoom']";
    $s.="});";
    $s.="clusterer=new ymaps.Clusterer({";
 	$s.="});";
	$s.="var myGeoObjects=[];";
	$s.="var ind=0;";
    return $s;
}

function scriptContent($q,$r,$i){ $s=""; $upd=true;
	if ($i<40000) {
		$icon=$this->checkIcon($r);
		if (isset($r->COORDINATE)) { 
			if (($r->COORDINATE!="") && ($r->COORDINATE!="-")) {
				$upd=false;
			}
		}
		if ($upd) {
			$s.="ymaps.geocode('Удмуртская республика ".$r->STREET." ".$r->NOMER."',{";
			$s.="results:1, strictBounds:false, kind:'house'";
			$s.="}).then(function(res){";
			$s.="myPlacemark".$i."=new ymaps.Placemark(res.geoObjects.get(0).geometry.getCoordinates(),{";
		} else {
			$s.="myPlacemark".$i."=new ymaps.Placemark(".$r->COORDINATE.",{";
		}
		$s.="clusterCaption:'".$r->STREET.", ".$r->NOMER."',";
		$s.="hintContent:'".$r->STREET.", ".$r->NOMER."<br><em>".$r->SSERVICE."</em>',";
		$s.="balloonContentHeader:'".$r->STREET.", ".$r->NOMER." <em>(".$r->SSERVICE.")</em><br><br>',";
		$s.="balloonContentBody:'<div id=\"balloon-content-".$r->UUID."\">*</div>'";
		//$s.="balloonContentBody:'".$q->tpl_main->lineInfo($q,$r,$i,true)."'";
			$s.="},{";
		$s.="balloonMinWidth:760,";
		$s.="balloonMinHeight:380,";
		$s.="preset:'".$icon."'";
		$s.="});";
		$s.="myPlacemark".$i.".events.add('balloonopen',function(e){";
		$s.="getBalloonContent('".$r->UUID."');";
        $s.="});";
	 	$s.="ind++;";
		$s.="clusterer.add(myPlacemark".$i.");";
		if ($upd) {
			$s.="});";
		}
	} 
    return $s;    
}

function scriptFooter(){ $s="";
	$s.="clusterer.options.set({";
	$s.="'gridSize':100,";
	$s.="'maxZoom':16,";
	$s.="'minClusterSize':2";
	$s.="});";
	$s.="myMap.geoObjects.add(clusterer);";

	/*$s.="for (i=0;i<1;i++){";
	$s.="clusterer.events.add('objectsaddtomap',function(){";
    $s.="geoObjectState=clusterer.getObjectState(myGeoObjects[i]);";
    $s.="if (geoObjectState.isShown) {";
    $s.="if (geoObjectState.isClustered) {";
    $s.="geoObjectState.cluster.state.set('activeObject',myGeoObjects[i]);";
    $s.="geoObjectState.cluster.options.set('balloonSidebarWidth',300);";
    $s.="geoObjectState.cluster.options.set('balloonWidth',1200);";
    //$s.="geoObjectState.cluster.balloon.options.set('minWidth',900);";
    $s.="geoObjectState.cluster.balloon.open([56.840001,53.239778]);";
    //$s.="alert('go!');";
	$s.="}";
	$s.="}";
	$s.="});";
	$s.="}";*/

	//$s.="$(\"#var-coords\").append('".$r->UUID.":'+res.geoObjects.get(0).geometry.getCoordinates()+'|');";
   

    $s.="myMap.options.set('scrollZoomSpeed',1);";
    $s.="myMap.controls";
    $s.=".add('zoomControl')";
    $s.=".add('typeSelector')";
    $s.=".add('mapTools');";
    $s.="}";
    $s.="</script>"; 
    return $s;
}

} ?> 
