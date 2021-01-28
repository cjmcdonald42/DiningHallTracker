<?php
/**
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
		<th>Seats Remaining</th><!--4-->
		<th>Buttons</th> <!--5-->
	</tr>
<?php
// some constants that are used in the loop for color coding

$num_diners_col_index = 3;
$seats_remaining_col_index = 4;
$green_cutoff = 4;
$yellow_cutoff = 2;

// example code. iterates through the entire table. can insert html in the middle of the loop

if($dorm_dining_list) {
	foreach($dorm_dining_list as $dorm) {
		echo '<tr>';
		$count = 0;
		foreach($dorm as $col) {
			// the following if-statements are for color coding
			if($count == 2) { // the row of num seats
				$num_seats = $col.' ';
				echo '<td>';
			}
			elseif($count == 3) { // the num diners row
				if($col.' '<= ($num_seats-$green_cutoff)){
					echo '<td class=\'green-background-td\'>';
				}
				elseif($col.' '<= ($num_seats-$yellow_cutoff)) {
					echo '<td class=\'yellow-background-td\'>';
				}
				else {
					echo '<td class=\'red-background-td\'>';
				}
			}
			elseif($count == 4) { // the seats remaining row
				if($col.' '>= $green_cutoff){
					echo '<td class=\'green-background-td\'>';
				}
				elseif($col.' '>= $yellow_cutoff) {
					echo '<td class=\'yellow-background-td\'>';
				}
				else {
					echo '<td class=\'red-background-td\'>';
				}
			}
			else {
				echo '<td>';
			}
			echo $col.' ';
			echo '</td>';
			$count = $count + 1;
		} ?>
		<!-- buttons -->
		<td>
			<button class='update_diners_button add-button' value='+' name='<?php echo $dorm['dorm_name']?>' type='button'>+</button>
			<button class='update_diners_button subtract-button' value='-' name='<?php echo $dorm['dorm_name']?>' type='button'>-</button>
		</td>
		<?php
		echo '</tr>';
	}
}
else echo 'No dorm data found';
?>
</table>

<button class='reset_button'>Reset</button>

</p>
<p class="footer"><i>Project written by: <br>
Cannon Caspar, Class of 2021 cpcaspar@mxschool.edu <br>
Shreya Jain, Class of 2021 sjain@mxschool.edu <br>
Charles J McDonald, Academic Technology Specialist cjmcdonald@mxschool.edu <br>
GitHub: <a href="https://github.com/mxschool/DiningHallTracker"> mxschool/DiningHallTracker </a></i></p>


</body>
