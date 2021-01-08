<?php
/** Config File
* Defines configurable data, such as DB connection info.
*/

session_start();

global $DB;
$DB = new stdClass();

// Enter DB connection data below
$DB->server_name = 'localhost';
$DB->username = 'dhtracker';
$DB->password = 'dhtracker';
$DB->name = 'dhtracker';
$DB->db_port = 8889;

$DB = new mysqli($DB->server_name, $DB->username, $DB->password, $DB->name, $DB->db_port);

date_default_timezone_set('America/New_York');
