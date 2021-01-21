<?php
/**
 * The view for students. There will be no update buttons. 
* Homepage for html and javascript code, and for calling php methods in lib.php
*/
require_once('lib.php');

if(isset($_POST['update_diners'])) {
	update_dorm_num_diners($_POST['update_diners'], $_POST['increment']);
	die();
}
/**
* Retrieve a list from dorm_dining.
* Get data like so: $dorm_dining_list[dorm_id][col_name]
* e.g. $dorm_dining_list[2][num_seats] returns the number of seats available
* for the dorm with the id 2
*/
$dorm_dining_list = get_dorm_dining_data();
?>

<head>
	<link rel="stylesheet" href="./css/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">
</head>
<body>
<script>
	$(document).ready(function() {
		$('.update_diners_button').click(function(){
			var increment;
			if($(this).val() == '+') {
				increment = 1;
			}
			else {
				increment = 0;
			}
			var dorm_name = $(this).attr('name');
			$.ajax({
				url: window.location.href,
				data: {update_diners: dorm_name, increment: increment},
				type: 'post',
				success: function(output) {
					$('body').load(location.href);
				}
			});
		});
	});
</script>
<div class="header">
	<h1><img src="./assets/mx_shield.png" alt="Middlesex" class="mx_logo"> Dining Hall Tracker</h1>
</div>
<p>
<table align="center" class='dorm_dining_table'>
	<tr>
		<th>Dorm Id</th> <!--0-->
		<th>Dorm Name</th> <!--1-->
		<th>Total Seats</th> <!--2-->
		<th>Num Diners</th> <!--3-->
		<th>Seats Remaining</th> <!--4-->
	</tr>
<?php

// some constants that are used in the loop for color coding 
$num_diners_col_index = 3;
$seats_remaining_col_index = 4;
$seats_remain_green_cutoff = 4;
$seats_remain_yellow_cutoff = 2;
$num_seats_per_table = 10;

// example code. iterates through the entire table. can insert html in the middle of the loop
if($dorm_dining_list) {
	foreach($dorm_dining_list as $dorm) {
		echo '<tr>';
		$count = 0;
		foreach($dorm as $col) {
			// the following if-statements are for color coding
			if($count == $num_diners_col_index) {
				if($col.' '<= ($num_seats_per_table-$seats_remain_green_cutoff)){
					echo '<td class=\'green-background-td\'>';
				}
				elseif($col.' '<= ($num_seats_per_table-$seats_remain_yellow_cutoff)) {
					echo '<td class=\'yellow-background-td\'>';
				}
				else echo '<td class=\'red-background-td\'>';
			}
			else if($count == $seats_remaining_col_index) {
				if($col.' '>= $seats_remain_green_cutoff){
					echo '<td class=\'green-background-td\'>';
				}
				elseif($col.' '>= $seats_remain_yellow_cutoff) {
					echo '<td class=\'yellow-background-td\'>';
				}
				else echo '<td class=\'red-background-td\'>';
			}
			else echo '<td>';
			echo $col.' ';
			echo '</td>';
			$count = $count + 1;
		} ?>
		<?php
		echo '</tr>';
	}
}
else echo 'No dorm data found';
?>
</table>
</p>
<p class="footer"><i>Project written by: <br>
Cannon Caspar, Class of 2021 cpcaspar@mxschool.edu <br>
Shreya Jain, Class of 2021 sjain@mxschool.edu <br>
Charles J McDonald, Academic Technology Specialist cjmcdonald@mxschool.edu <br>
GitHub: <a href="https://github.com/mxschool/DiningHallTracker"> mxschool/DiningHallTracker </a></i></p>


</body>
