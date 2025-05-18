<?php
function front_get($request) {
    require_once('db.php');
    $c=db_query("SELECT c.*,
        GROUP_CONCAT(DISTINCT a.animal_name SEPARATOR ', ') AS `animals`,
        GROUP_CONCAT(DISTINCT CONCAT(ci.card_gramm,':',ci.card_price)
        SEPARATOR ', ') AS grice
        FROM cards c JOIN card_animal ca ON 
	    c.card_id=ca.card_id JOIN animals a ON
	    a.animal_id=ca.animal_id JOIN card_info ci ON
	    ci.card_id=c.card_id
        GROUP BY c.card_id;"
    );
    return array(
    'headers' => array('HTTP/1.1 200 OK'),
    'entity' => theme('index',$c),
  );
}

function front_post($request) {
    return access_denied();
}
?>