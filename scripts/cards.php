<?php
function getCards(&$request){
	if (empty($request['user'])){
        $request['card']=empty($_COOKIE['card'])?[]:json_decode($_COOKIE['card']);
        return;
    }
	require_once('db.php');
	$info=db_query("SELECT oc.card_id, oc.card_gramm, ci.card_price,oc.size
		 FROM order_card oc JOIN card_info ci ON
		oc.card_id=ci.card_id AND oc.card_gramm= ci.card_gramm
		WHERE oc.order_id=?;",$request['user']);
	$cards=[];
	foreach($info as $i=>$row){
		$cards[$row[0]][$row[1]]=array($row[2],$row[3]);
	}
	$request['card']=$cards;
}

function getValues(&$request){
	if (empty($request['user'])){
		$request['values']=(empty($_COOKIE['values'])?
			array_fill(0,7,''):
			unserialize($_COOKIE['values'])
		);
	} else {
		require_once('db.php');
		$request['values']=db_get('orders','*',['order_id'=>$request['user']])[0];
		array_shift($request['values']);
	}
	$request['values']=array_map(
        fn ($value): string => strip_tags($value),
        $request['values']
    );
}
?>