<?php
/** Config File
* Defines configurable data, such as DB connection info.
*/

session_start();

global $DB;
$DB = new stdClass();

$DB->server_name = '';
$DB->username = '';
$DB->password = '';
$DB->name = '';

$DB = new mysqli($DB->server_name, $DB->username, $DB->password, $DB->name);

date_default_timezone_set('America/New_York');
