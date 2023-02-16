<?php 
return [ 
    'client_id' => 'AdXYHE-sy8d2WrA9wROZxDEa5tB2F3syzd-eER0Ixe3bom8i453gsdaRoc7dZV2rqmggD0xRcseF9X4d',
	'secret' => 'EEmTKaoJdS8e0s95y_MiiI8tSznKzuiLwDX5sRyI4CTrY3KG8EJqQXHA-NLK1RCnpFOXIop9n9uuW3qi',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];