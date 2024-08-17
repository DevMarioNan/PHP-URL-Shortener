<?php

return [
    'db_host' => 'localhost',
    'db_name' => 'url_shortener',
    'db_user' => 'root',
    'db_pass' => '',
];

session_regenerate_id(true);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // Use only if your site is running over HTTPS
ini_set('session.cookie_samesite', 'Strict');