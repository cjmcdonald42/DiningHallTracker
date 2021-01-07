<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
/**
* Library page for general purpose php functions, such as database queries.
*/
require_once('config.php');

// Check if dorm_dining table exists, and if not, create table
$table_check = $DB->query("SHOW TABLES LIKE 'dorm_dining';");
if($table_check->num_rows < 1) {
	$sql = "CREATE TABLE dorm_dining (
		id INT NOT NULL AUTO_INCREMENT,
		dorm_name VARCHAR(30) NOT NULL,
		num_seats INT NOT NULL,
		num_diners INT NOT NULL DEFAULT 0,
		PRIMARY KEY (id)
	);";
	$DB->query($sql);
	echo $DB->error;
}

/**
* Gets all data from the table 'dorm_dining'
*
* @return array in the format dorm_dining_id => values
*			 values is an array in the format column_name => value
* @return false if there is no data in the table
*/
function get_dorm_dining_data() {
	global $DB;
	$query = $DB->query("SELECT * FROM dorm_dining;");
	if(!($query and $query->num_rows > 0)) return false;
	$dorm_dining_list = array();
	while ($dorm = $query->fetch_assoc()) {
		$dorm_dining_list[$dorm['id']] = $dorm;
	}
	return $dorm_dining_list;
}
