<?php
function add_get($request) {
    require_once('db.php');
    $c=db_get('card_info','*',['card_id'=>$_GET['id']]);
    if (empty($c)){
        return redirect('/');
    }
    [$id,$gramm,$price]=$c[0];
    $data=[];
    $cards=isset($_COOKIE['card'])?$_COOKIE['card']:[];
    if (!empty($cards))
        $data=json_decode($cards, true);
    if (isset($data[$id])&&isset($data[$id][$gramm])){
        $data[$id][$gramm][1]+=100;
    } else {
        $data[$id][$gramm]=array($price,100);
    }
    setcookie('card',json_encode($data));
    return redirect('/');
    return 0;
}
?>