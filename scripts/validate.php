<?php 
function validate(&$request){    
    require_once('cards.php');
    getCards($request);
    $cards=$request['card'];
    if (empty($cards))
            return not_found();
    $data=$request['data'];
    $errors=[];
    if (empty($data['company'])||
        !preg_match('/^([А-ЯЁа-яёa-zA-Z]|\s)+$/u', $data['company']))
    {
        $errors['company']='Название компании должно состоять из букв';
    } else if (strlen($data['company'])>50){
        $errors['company']='Слишком длинное название';
    }
    
    if (empty($data['FIO'])||
        !preg_match('/^([А-ЯЁа-яёa-zA-Z]|\s)+$/u', $data['FIO']))
    {
        $errors['FIO']='ФИО должно состоять из букв';
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
    require_once('db.php');
    foreach($cards as $id=>$obj){
        foreach($obj as $gr=>[$price,$count]){
            if(!db_get('card_info',['card_id'],[
                'card_id'=>$id,
                'card_gramm'=>$gr
            ])){
                $errors['card'.$id]="Неизвестная карта";
                break;
            }
        }
    }
    if (!empty($errors)){
        return bad_request(json_encode($errors));
    }
}
?>