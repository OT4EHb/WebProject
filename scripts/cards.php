<?php
function getCards(&$request){
	if (empty($request['user'])){
        $request['card']=json_decode($_COOKIE['card']);
        return;
    }
	require_once('db.php');
	$cards=db_get('order_card','*',['order_id'=>$request['user']]);
	print_r($cards);
}
?>