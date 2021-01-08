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

<p>
<table class='dorm_dining_table'>
<?php
// example code. iterates through the entire table. can insert html in the middle of the loop
if($dorm_dining_list) {
	foreach($dorm_dining_list as $dorm) {
		echo '<tr>';
		foreach($dorm as $col) {
			echo '<td>';
			echo $col.' ';
			echo '</td>';
		} ?>
		<td>
			<button class='update_diners_button' value='-' name='<?php echo $dorm['dorm_name']?>' type='button'>-</button>
			<button class='update_diners_button' value='+' name='<?php echo $dorm['dorm_name']?>' type='button'>+</button>
		</td>
		<?php
		echo '</tr>';
	}
}
else echo 'No dorm data found';
?>
</table>
</p>
</body>
