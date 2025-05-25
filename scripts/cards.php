<?php
function getCards(&$request){
	if (empty($request['user'])){
        $request['card']=empty($_COOKIE['card'])?'':json_decode($_COOKIE['card']);
        return;
    }
	require_once('db.php');
	$info=db_query("SELECT oc.card_id, oc.card_gramm, ci.card_price,oc.size
		 FROM order_card oc JOIN card_info ci ON
		oc.card_id=ci.card_id AND oc.card_gramm= ci.card_gramm;");
	$cards=[];
	foreach($info as $i=>$row){
		$cards[$row[0]][$row[1]]=array($row[2],$row[3]);
	}
	$request['card']=$cards;
}
?>