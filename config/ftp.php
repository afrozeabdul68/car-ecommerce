<?php
return array(

    /*
	|--------------------------------------------------------------------------
	| Default FTP Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the FTP connections below you wish
	| to use as your default connection for all ftp work.
	|
	*/

    'default' => 'csv',

    /*
    |--------------------------------------------------------------------------
    | FTP Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the FTP connections setup for your application.
    |
    */

    'connections' => array(

        'csv' => array(
            'host'   => env('CSV_FTP_HOST', null),
            'port'  => env('CSV_FTP_PORT', null),
            'username' => env('CSV_FTP_USERNAME', null),
            'password'   => env('CSV_FTP_PASSWORD', null),
            'passive'   => true,
            'secure' => false
        ),
    ),
);
