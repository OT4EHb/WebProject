<?php
function cart_get($request) {
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => theme('cart', $request),
    );
}

function cart_post($request) {
    require_once('db.php');
    require_once('cards.php');
    getCards($request);
    include_once('validate.php');
    if($r=validate($request)){
        return $r;
    }
    $responce=[];
    if (empty($request['user'])){
        require_once('register.php');
        $responce['auth']=register();
        $request['user']=$responce['auth']['id'];
        reset($responce['auth']['id']);
    }
    $data=$request['data'];
    try{
        db_set('orders',[
            'order_id'=>$request['user'],
            'company'=>$data['company'],
            'FIO'=>$data['FIO'],
            'tel'=>$data['tel'],
            ],
            ['order_id'=>$request['user']]
        );
    } 
    catch(PDOException $e){
        return bad_request(json_encode(['cards'=>"Некоректные данные"]));
    }
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => json_encode($request['data']),
    );
}
?>