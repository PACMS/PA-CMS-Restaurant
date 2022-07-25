<?php

define('APP_URL', 'nom_de_domaine');
define('DBDRIVER', 'mysql');
define('DBUSER', 'utilisateur_de_la_bdd');
define('DBPWD', 'mot_de_passe_de_la_bdd');
define('DBHOST', 'localhost');
define('DBPORT', 'port_de_la_bdd');
define('DBNAME', 'nom_de_la_bdd');
define('DBPREFIXE', 'prefixe_de_la_bdd');

define('MHOST', 'host_mail');
define('MUSERNAME', 'username_mail');
define('MPASSWORD', 'password_mail');
define('MPORT', 'port_mail');



define('PUBLIC_KEY_GOOGLE', 'public_key_google');
define('PRIVATE_KEY_GOOGLE', 'private_key_google');
define('URL_API_OAUTH_GOOGLE', 'https://oauth2.googleapis.com/token');
define('URL_API_INFO_GOOGLE', 'https://openidconnect.googleapis.com/v1/userinfo');
define('REDIRECT_URI_GOOGLE', 'https://localhost/googleConnect');

define('PUBLIC_KEY_FACEBOOK', 'public_key_facebook');
define('PRIVATE_KEY_FACEBOOK', 'private_key_google');
define('URL_API_OAUTH_FACEBOOK', 'https://graph.facebook.com/v13.0/oauth/access_token');
define('URL_API_INFO_FACEBOOK', 'https://graph.facebook.com/v13.0/me?fields=email,last_name,first_name');
define('REDIRECT_URI_FACEBOOK', 'https://localhost/facebookConnect');

define('FONTS_KEY_API', 'font_key');
