<?php class tpl_main { 

function total($q,$r) { $s="";
	$s.='<span class="ln-cap">По данному выбору:</span> ';
	$s.='<span class="ln-var">количество домов:</span> ';
	$s.='<span class="ln-value">'.$r->COUNT_BUILDINGS.'</span>';
	$s.='<span class="ln-var">, количество квартир:</span> ';
	$s.='<span class="ln-value">'.$r->SUM_COUNTAPARTMENT.'</span>';
	$s.='<span class="ln-var">, общая площадь:</span> ';
	$s.='<span class="ln-value">'.$r->SUM_SALL.'</span>';
	$s.='<span class="ln-var">, количество жителей:</span> ';
	$s.='<span class="ln-value">'.$r->SUM_RESIDENT.'</span>';
	return $s;
}

function line($q,$r,$i) { $s="";
	$s.=$this->lineRow($q,$r,$i);
	if ($q->url->click_id==$i) { $style="block"; } else { $style="none"; }
	$s.='<div class="comment-wrap" style="display:'.$style.';" comment-id="'.$i.'">';
	$s.='<div class="toup"></div>';
	$s.='<div class="comment-line">';
	$s.=$this->lineInfo($q,$r,$i);
	$s.='</div>';
	$s.='</div>';
	return $s;
}

		
function lineRow($q,$r,$i) { $s="";
	$s.='<div class="content-line" line-id="'.$i.	'">';
	$s.='<table cellpadding="0" cellspacing="0" border="0" width="100%">';
	$s.='<tr valign="top">';
	$s.='<td colspan="2" width="400px">';
	$s.='<a onclick="on_line(\''.$i.'\');" class="link-line" name="line-'.$i.'" link-id="'.$i.'" open-status="close" ';
	$s.='href="#line">';
	$s.=$r->STREET.', ';
	$s.=$r->NOMER.' ';
	$s.='</a>';
	$s.='<span class="line-sector">('.$r->SREGION.' р-н)</span>';
	$s.='<span class="line-postindex">'.$r->POSTINDEX.'</span>';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="line-service">'.$r->SSERVICE.'</span>';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="line-date">'.$r->DATE_OFF.'</span>';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="line-date">'.$r->DATE_ON_PLAN.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='</table>';
	$s.='</div>';
	return $s;
}
	
function lineInfo($q,$r,$i,$footer=false) { $s="";	

	$s.='<div class="comment-line-buttons">';
	$s.='<a href="#comment-info" ';
	$s.='id="comment-info-'.$i.'" ';
	$s.='class="comment-button comment-info-active" ';
	$s.='onclick="showCommentInfo('.$i.')" ';
	$s.='>Информация по дому</a>';
	$s.='<a href="#comment-counters" ';
	$s.='id="comment-counters-'.$i.'" ';
	$s.='class="comment-button comment-counters-disable" ';
	$s.='onclick="showCommentCounters('.$i.')" ';
	$s.='>Общедомовые приборы учета</a>';
	$s.='</div>';

	
	$s.='<div class="comment-line-info" id="comment-line-info-'.$i.'">';
	$s.='<table cellpadding="0" align="left" cellspacing="0" border="0" width="750px">';
	$s.='<tr valign="top">';
	$s.='<td width="150px">';
	$s.='<span class="ln-var">Дата приема заявки:</span> ';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="ln-value">'.$r->DOCDATE.'</span>';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="ln-var">Ремонтно-аварийная служба:</span> ';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="ln-value">'.$r->SERVICE_EMERGENCY.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-var">Тип отключения:</span> ';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-value">'.$r->STYPE_DISCONNECTION.'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">Обслуживание лифта:</span> ';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-value">'.$r->AGENT_LIFT.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-var">Исполнитель:</span> ';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-value">'.$r->SISPOLNITEL.'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">ЦТП:</span> ';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-value">'.$r->CTP.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-var">Причина отключения:</span> ';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-value">'.$r->SCAUSE.'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">ТЭЦ:</span> ';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-value">'.$r->TEC.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-var">Телефон дисп.:</span> ';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-value">'.$r->PHONENUMBER.'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">Управляющая компания:</span> ';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-value">'.$r->DIRECTION.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='</td>';
	$s.='<td>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">Обслуживающая организация:</span> ';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-value">'.$r->SERVICE_ORGANIZATION.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='</table>';
	
	$s.='<div class="dhr"></div>';
	
	$s.='<table cellpadding="0" align="left" cellspacing="0" border="0" width="750px">';
	$s.='<tr valign="top">';
	$s.='<td width="180px">';
	$s.='<span class="ln-var">Общая площадь помещений:</span> ';
	$s.='</td>';
	$s.='<td width="170px">';
	$s.='<span class="ln-value">'.$r->SALL.'</span>';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="ln-var">Год постройки:</span> ';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="ln-value">'.$r->GODPOSTR.' г.</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='</table>';
	$s.='<table cellpadding="0" align="left" cellspacing="0" border="0" width="750px">';
	$s.='<tr valign="top">';
	$s.='<td width="180px">';
	$s.='<span class="ln-var">Жилая площадь:</span> ';
	$s.='</td>';
	$s.='<td width="170px">';
	$s.='<span class="ln-value">'.$r->SHOUSE.'</span>';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="ln-var">Кол-во квартир:</span> ';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="ln-value">'.$r->COUNTAPARTMENT.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='<tr valign="top">';
	$s.='<td width="180px">';
	$s.='<span class="ln-var">Нежилая площадь:</span> ';
	$s.='</td>';
	$s.='<td width="170px">';
	$s.='<span class="ln-value">'.$r->SOTHER.'</span>';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="ln-var">Кол-во жильцов:</span> ';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<span class="ln-value">'.$r->RESIDENT.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='<tr valign="top">';
	$s.='<td width="180px">';
	$s.='<span class="ln-var">Этажность:</span> ';
	$s.='</td>';
	$s.='<td width="200px" colspan="3">';
	$s.='<span class="ln-value">'.$r->COUNTSTOREYS.'</span>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='</table>';

	if ($footer) {
		$s.='<div class="dhr"></div>';
		$s.='<div class="comment-line-footer">';
		$s.='<table cellpadding="0" align="left" cellspacing="0" border="0" width="750px">';
		$s.='<tr valign="top">';
		$s.='<td width="180px">';
		$s.='<span class="ln-var"><b>Дата отключения:</b></span> ';
		$s.='</td>';
		$s.='<td width="170px">';
		$s.='<span class="ln-value">'.$r->DATE_OFF.'</span>';
		$s.='</td>';
		$s.='<td width="200px">';
		$s.='<span class="ln-var"><b>План. дата включения:</b></span> ';
		$s.='</td>';
		$s.='<td width="200px">';
		$s.='<span class="ln-value">'.$r->DATE_ON_PLAN.' г.</span>';
		$s.='</td>';
		$s.='</tr>';	
		$s.='</table>';
		$s.='</div>';
	}

	$s.='</div>';



	$s.='<div class="comment-line-counters" id="comment-line-counters-'.$i.'">';
	$s.='<table cellpadding="0" align="left" cellspacing="0" border="0" width="660px">';
	$s.='<tr valign="top">';
	$s.='<td width="110px">';
	$s.='<span class="ln-var"></span> ';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">Прошлые показания</span>';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">Текущие показания</span> ';
	$s.='</td>';
	$s.='<td width="150px">';
	$s.='</td>';
	$s.='</tr>';	

	$s.='<tr valign="top">';
	$s.='<td width="110px">';
	$s.='<span class="ln-var">ОПУ Отопление</span> ';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span>';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span> ';
	$s.='</td>';
	$s.='<td width="150px">';
	$s.='</td>';
	$s.='</tr>';	

	$s.='<tr valign="top">';
	$s.='<td width="110px">';
	$s.='<span class="ln-var">ОПУ ГВС</span> ';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span>';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span> ';
	$s.='</td>';
	$s.='<td width="150px">';
	$s.='</td>';
	$s.='</tr>';	

	$s.='<tr valign="top">';
	$s.='<td width="110px">';
	$s.='<span class="ln-var">ОПУ ХВС</span> ';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span>';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span> ';
	$s.='</td>';
	$s.='<td width="150px">';
	$s.='</td>';
	$s.='</tr>';	

	$s.='<tr valign="top">';
	$s.='<td width="110px">';
	$s.='<span class="ln-var">ОПУ Э/Э</span> ';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span>';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span> ';
	$s.='</td>';
	$s.='<td width="150px">';
	$s.='</td>';
	$s.='</tr>';	

	$s.='<tr valign="top">';
	$s.='<td width="110px">';
	$s.='<span class="ln-var">ОПУ Газ</span> ';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span>';
	$s.='</td>';
	$s.='<td width="150px" align="center">';
	$s.='<span class="ln-value">-</span> ';
	$s.='</td>';
	$s.='<td width="150px">';
	$s.='</td>';
	$s.='</tr>';	

	$s.='</table>';
	$s.='</div>';
	
	return $s;
}	

function tr() { $s="";
	$s.='<table cellpadding="0" cellspacing="0" border="0" width="100%">';
	$s.='<tr valign="top">';
	$s.='<td colspan="2" width="400px">';
	$s.='<h3>Адрес:</h3> ';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<h3>Услуга:</h3>';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<h3>Дата отключения:</h3>';
	$s.='</td>';
	$s.='<td width="200px">';
	$s.='<h3>План. дата включения:</h3>';
	$s.='</td>';
	$s.='</tr>';	
	$s.='</table>';
	return $s;
}

function select($caption,$name,$ms) { $s=""; $i=0; natsort($ms);
	//multiple="multiple"
	$s.='<div class="cols"><h3>'.$caption.':</h3>';
	$s.='  <select onchange="on_select(\''.$name.'-select\');" id="'.$name.'-select">';
	$s.='	<option value="0" selected>Все</option>';
	foreach ($ms as $key) { $i++;
		if (($key!="<Неизвестно>") && ($key!="")  && ($key!="-")) {
			$s.='<option '; 
			//if (($name=="sector") && ($i==2)) { $s.='selected '; }
			$s.='value="'.$i.'">'.$key.'</option>';
		}
	}
	$s.='  </select>';
	$s.='</div>';
	return $s;
}


function cross($q,$cr_ms,$cr_vals) { $s="";

	$s.='<div class="cross-inner">';
	$s.='<table cellpadding="3" cellspacing="0" border="1" width="1000px">';

	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-cap"></span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-cap">Индустриальный</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-cap">Ленинский</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-cap">Октябрьский</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-cap">Первомайский</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-cap">Устиновский</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-cap">Итого</span>';
	$s.='</td>';
	$s.='</tr>';

	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-col">Горячая вода</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[0][0].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[0][1].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[0][2].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[0][3].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[0][4].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[0][5].'</span>';
	$s.='</td>';
	$s.='</tr>';

	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-col">Холодная вода</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[1][0].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[1][1].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[1][2].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[1][3].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[1][4].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[1][5].'</span>';
	$s.='</td>';
	$s.='</tr>';

	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-col">Лифты</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[2][0].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[2][1].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[2][2].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[2][3].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[2][4].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[2][5].'</span>';
	$s.='</td>';
	$s.='</tr>';

	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-col">Электроэнерг.(авар.заяв)</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[3][0].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[3][1].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[3][2].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[3][3].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[3][4].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[3][5].'</span>';
	$s.='</td>';
	$s.='</tr>';

	$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-col">Элетроэнергия (071)</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[4][0].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[4][1].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[4][2].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[4][3].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[4][4].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[4][5].'</span>';
	$s.='</td>';
	$s.='</tr>';

	/*$s.='<tr valign="top">';
	$s.='<td>';
	$s.='<span class="ln-col">Итого</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[5][0].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[5][1].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[5][2].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[5][3].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[5][4].'</span>';
	$s.='</td>';
	$s.='<td>';
	$s.='<span class="ln-var">'.$cr_vals[5][5].'</span>';
	$s.='</td>';
	$s.='</tr>';*/

	$s.='</table>';
	$s.='</div>';
	return $s;
}


} ?>

