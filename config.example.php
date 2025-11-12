<?php
//config.php
// Copy this file to config.php and update with your actual credentials
return[
    'db_host' => 'localhost',
    'db_user' =>'your_database_user',
    'db_pass' => 'your_database_password',
    'db_name' => 'your_database_name',
    'db_port' => 3306,
    'hubtel_sms_client_id' => 'your_hubtel_client_id',
    'hubtel_sms_api_secret' => 'your_hubtel_api_secret',
    'hubtel_sms_api_endpoint' => 'https://smsc.hubtel.com?',
    'mnotify_sms_api_endpoint' => 'https://apps.mnotify.net/smsapi',
    'mnotify_sms_api_endpoint_quick'   => 'https://api.mnotify.com/api/sms/quick',
    'mnotify_sms_api_key' => 'your_mnotify_api_key'
];

//Database Connection Constants
define('DB_HOST','localhost');
define('DB_USER','your_database_user');
define('DB_PASS','your_database_password');
define('DB_NAME','your_database_name');
define('DB_PORT',3306);

//SMS API Constants
define('Hubtel_SMS_CLIENT_ID','your_hubtel_client_id');
define('Hubtel_SMS_API_SECRET','your_hubtel_api_secret');
define('HUBBTEL_SMS_API_ENDPOINT','https://smsc.hubtel.com/v1/messages/send');
define('Mnotify_SMS_API_ENDPOINT','https://apps.mnotify.net/smsapi');
define('Mnotify_SMS_API_KEY', 'your_mnotify_api_key');

?>
