<?php
function cart_get($request) {
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => theme('cart', $request),
    );
}

function cart_post($request) {
    include_once('validate.php');
    if($r=validate($request)){
        return $r;
    }
    $responce=[];
    if (empty($request['user'])){
        require_once('register.php');
        $responce['auth']=register();
        $request['user']=$responce['auth']['id'];
        unset($responce['auth']['id']);
    }
    $data=$request['data'];
    $responce['cost']=0;
    try{
        db_set('orders',[
            'order_id'=>$request['user'],
            'company'=>$data['company'],
            'FIO'=>$data['FIO'],
            'tel'=>$data['tel'],
            'email'=>$data['email'],
            'order_date'=>date('Y-m-d'),
            'descript'=>$data['descript'],
            ],
            ['order_id'=>$request['user']]
        );
        if (isset($responce['auth'])){
            foreach($request['card'] as $id=>$obj){
                foreach($obj as $gr=>[$price,$count]){
                    if ($count){
                        db_set('order_card',[
                            'order_id'=>$request['user'],
                            'card_id'=>$id,
                            'card_gramm'=>$gr,
                            'size'=>$count,
                        ],
                        [
                            'order_id'=>$request['user'],
                            'card_id'=>$id,
                            'card_gramm'=>$gr,
                        ]);
                        $responce['cost']+=db_get('card_info','card_price',[
                            'card_id'=>$id,
                            'card_gramm'=>$gr,
                        ])[0][0]*$count;
                    }
                }
            }
        }
        setcookie('card', '', strtotime("-1 day"));
    } 
    catch(PDOException $e){
        return bad_request(json_encode(['error'=>(conf('display_errors')?
        $e->getMessage():"Некоректные данные")]));
    }
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => json_encode($responce),
    );
}
?>