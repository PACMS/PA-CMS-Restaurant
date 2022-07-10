<?php

define('DBDRIVER', 'mysql');
define('DBUSER', 'root');
define('DBPWD', 'password');
define('DBHOST', 'database');
define('DBNAME', 'mvcdocker2');
define('DBPORT', '3306');
define('DBPREFIXE', 'pacm_');

define("MHOST", "smtp.gmail.com");
define("MUSERNAME", "pa.cms.test@gmail.com");
define("MPASSWORD", "nsxktiyegnnvmlie");
define("MPORT", "465");


define('PUBLIC_KEY_GOOGLE', '592098083518-1ts92tmugsj1kn5b8f64f5vdti2gf0gl.apps.googleusercontent.com');
define('PRIVATE_KEY_GOOGLE', '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');
define('URL_API_OAUTH_GOOGLE', 'https://oauth2.googleapis.com/token');
define('URL_API_INFO_GOOGLE', 'https://openidconnect.googleapis.com/v1/userinfo');
define('REDIRECT_URI_GOOGLE', 'https://localhost/googleConnect');

define('PUBLIC_KEY_FACEBOOK', '1412626972532730');
define('PRIVATE_KEY_FACEBOOK', '03af7457fa2dd6afdb9a1a2bc788ac4f');
define('URL_API_OAUTH_FACEBOOK', 'https://graph.facebook.com/v13.0/oauth/access_token');
define('URL_API_INFO_FACEBOOK', 'https://graph.facebook.com/v13.0/me?fields=email,last_name,first_name');
define('REDIRECT_URI_FACEBOOK', 'https://localhost/facebookConnect');
