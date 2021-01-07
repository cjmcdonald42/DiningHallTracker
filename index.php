<?php
/**
* Homepage for html and javascript code, and for calling php methods in lib.php
*/
require_once('lib.php');

/**
* Retrieve a list from dorm_dining.
* Get data like so: $dorm_dining_list[dorm_id][col_name]
* e.g. $dorm_dining_list[2][num_seats] returns the number of seats available
* for the dorm with the id 2
*/
$dorm_dining_list = get_dorm_dining_data();
?>

<script>
	// Javascript goes in here.
</script>

<p>
<?php
// example code. iterates through the entire table. can insert html in the middle of the loop
if($dorm_dining_list) {
	foreach($dorm_dining_list as $dorm) {
		foreach($dorm as $col) {
			echo $col.' ';
		}
		echo '<br>';
	}
}
else echo 'No dorm data found';
?>
</p>
