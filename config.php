<?php
/** Config File
* Defines configurable data, such as DB connection info.
*/

session_start();

global $DB;
$DB = new stdClass();

// Enter DB connection data below
$DB->server_name = 'localhost';
$DB->username = 'dininghall_tracker';
$DB->password = 'root';
$DB->name = 'root';
$DB->port = 3306;

$DB = new mysqli($DB->server_name, $DB->username, $DB->password, $DB->name, $DB->port);

date_default_timezone_set('America/New_York');
