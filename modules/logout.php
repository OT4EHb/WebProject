<?php
function logout_get($request) {
    session_name('Kaneki');
    setcookie(session_name(),'',strtotime("-1 day"));
    session_destroy();
    return redirect('/');
}
?>