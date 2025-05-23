<?php
function cart_get($request) {
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => theme('cart'),
    );
}

function cart_post($request) {
    if (empty($_COOKIE['card']))
        return not_found();
    $data=$request['data'];
    $errors=[];
    if (empty($data['company'])||
        !preg_match('/^([А-ЯЁ]|[а-яё]|[a-z]|[A-Z]|\s)+$/', $data['company']))
    {
        $errors['company']='Название компании должно состоять из букв';
    } else if (strlen($data['company'])>50){
        $errors['company']='Слишком длинное название';
    }

    if (empty($data['FIO'])||
        !preg_match('/^([А-ЯЁ]|[а-яё]|\s)+$/', $data['FIO']))
    {
        $errors['FIO']='ФИО должно состоять из русских символов';
    } else if (strlen($data['FIO'])>100){
        $errors['FIO']='Слишком длинное ФИО';
    }

    if (empty($data['tel'])||!preg_match('/^(\+7|8)[0-9]{10}$/',$data['tel'])){
        $errors['tel']='Телефон должен начинаться с +7/8 и еще 10 цифр';
    }

    if (empty($data['email'])||!preg_match('/^\w+@\w+\.\w+$/',$data['email'])){
        $errors['email']='Email должен иметь вид example@example.example';
    } else if(strlen($data['email'])>30){
        $errors['email']='Email слишком длинное';
    }

    if (strlen($data['descript'])>200){
        $errors['descript']='Слишком много желаете';
    }

    if (!empty($errors)){
        return bad_request(json_encode($errors));
    }
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => json_encode($data),
    );
}
?>