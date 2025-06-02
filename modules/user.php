<?php
function auth(&$request, $r) {
    session_name("Kaneki");
    if (isset($_COOKIE[session_name()])){
        session_start();
        return $_SESSION['user']??null;
    }
    return null;
    
  }
