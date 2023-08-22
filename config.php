<?php
//config.php
return[
    'db_host' => 'localhost',
    'db_user' =>'root',
    'db_pass' => '',
    'db_name' => 'crud',
    'db_port' => 3307,
    'hubtel_sms_client_id' => 'kcaliqtv',
    'hubtel_sms_api_secret' => 'rmiumzxp',
    'hubtel_sms_api_endpoint' => 'https://smsc.hubtel.com?',
    'mnotify_sms_api_endpoint' => 'https://apps.mnotify.net/smsapi',
    'mnotify_sms_api_endpoint_quick'   => 'https://api.mnotify.com/api/sms/quick',
    'mnotify_sms_api_key' => 'fo0K4z1VizxW9Ie4oE3zxVmKY'
];

//Database Connection Constants
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','crud');
define('DB_PORT',3307);

//SMS API Constants
define('Hubtel_SMS_CLIENT_ID','kcaliqtv');
define('Hubtel_SMS_API_SECRET','rmiumzxp');
define('HUBBTEL_SMS_API_ENDPOINT','https://smsc.hubtel.com/v1/messages/send');
define('Mnotify_SMS_API_ENDPOINT','https://apps.mnotify.net/smsapi');
define('Mnotify_SMS_API_KEY', 'fo0K4z1VizxW9Ie4oE3zxVmKY');

?>