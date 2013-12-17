<?php
/**
 * Template Name: Download
 */

if ( ! is_user_logged_in() or !current_user_can( 'manage_options' ) ){
	echo "denied";
	exit;
}
$filename ="questionnaire.xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
?><table id="userTable" class="widefat">
        	<thead>
            	<tr>
                	<th>Name</th>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Category</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Skip</th>
					 <th>Final Question</th>
					<th>Datetime</th>
                </tr>
            </thead>
            <tbody>
            <?php
				global $wpdb;
				$queryQuestion = "SELECT * FROM questionnaire";				
				$arrQuestion = $wpdb->get_results($queryQuestion);	
				if($arrQuestion!=null)
				foreach($arrQuestion as $question) {
			?>
            	<tr>
                    <td><?php echo $question->name; ?></td>
					<td><?php echo $question->title; ?></td>
					<td><?php echo $question->company; ?></td>
					<td><?php echo $question->q3; ?></td>
                    <td><?php echo $question->email; ?></td>
					<td><?php echo $question->phone; ?></td>
					<td><?php echo $question->skip; ?></td>
					<td><?php echo $question->q5; ?></td>
					<td><?php echo $question->datetimeRecord; ?></td>
                </tr>
            <?php
				}
			?>
            </tbody>
        </table> 
<?php
exit;
// block any attempt to the filesystem
if (isset($_GET['file'])) {
    $filename = $_GET['file'];
} else {
    $filename = NULL;
}

$err = '<p style="color:#990000">Sorry, the file you are requesting is unavailable.</p>';
if (!$filename) {
	// if variable $filename is NULL or false display the message
	echo $err;
} else {
	
	$url = wp_get_attachment_url( $filename );
	$path = get_attached_file($filename);
	// check that file exists and is readable
	if (file_exists($path) && is_readable($path)) {
		// get the file size and send the http headers
		$size = filesize($path);
		header('Content-Type: application/octet-stream');
		header('Content-Length: '.$size);
		header('Content-Disposition: attachment; filename='.$url);
		header('Content-Transfer-Encoding: binary');
		// open the file in binary read-only mode
		// display the error messages if the file can´t be opened
		$file = @ fopen($path, 'rb');
		if ($file) {
			// stream the file and exit the script when complete
			fpassthru($file);
			exit;
		} else {
			echo $err;
		}
	} else {
		echo $err;
	}
}
?>