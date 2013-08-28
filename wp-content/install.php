<?php
if (isset($_REQUEST['plugin'])) {
	return;
}
display_header();
// die( '<h1>' . __( 'Already Installed' ) . '</h1><p>' . __( 'You appear to have already installed WordPress. To reinstall please clear your old database tables first.' ) . '</p><p class="step"><a href="../wp-login.php" class="button button-large">' . __( 'Log In' ) . '</a></p></body></html>' );
?>
<style type="text/css">
	body {
  		*zoom: 1;
  	}
	body:before,
	body:after {
    	display: table;
    	content: "";
    	// Fixes Opera/contenteditable bug:
    	// http://nicolasgallagher.com/micro-clearfix-hack/#comment-36952
    	line-height: 0;
  	}
  	body:after {
    	clear: both;
  	}

  	.contents {
  		margin-right: -20px;
  	}

	.content {
		background: #fff;
		color: #333;
		font-family: sans-serif;
		font-size: 14px;
		padding: 20px;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		border: 1px solid #dfdfdf;
		width: 178px;
		height: 100px;
		float: left;
		margin-right: 20px;
	}

	.content .button {
		display: block;
		width: 60px;
		margin: 20px auto 0;
	}
</style>
<?php
if (!isset($_REQUEST['import'])) {
	echo '<div class="contents">';
	$directories = new DirectoryIterator(__DIR__ . '/contents/');
	foreach ($directories as $directory) {
	    if ($directory->isDot() || !$directory->isDir()) {
	    	continue;
	    }
	    $info = file_get_contents($directory->getPathName() . '/Info.json');
	    $info = json_decode($info);
	    echo '<div class="content">';
	    echo '<strong>' . $info->name . '</strong>';
	    echo '<a href="?import=' . $directory->getFilename() . '"  class="button button-large">Import</a>';
	    echo '</div>';
	}
	echo '</div>';
} else {
	$contentPath = __DIR__ . '/contents/' . $_REQUEST['import'];
    $info = file_get_contents($contentPath . '/Info.json');
    $info = json_decode($info);

	if (!file_exists($contentPath)) {
		die('Contents not found: ' . $contentPath);
	}
	if (is_dir($contentPath . '/media')) {
		if (is_dir(__DIR__ . '/../media')) {
			echo 'Renamed existing media directory to: media.' . time() . '<br />';
			rename(__DIR__ . '/../media', __DIR__ . '/../media.' . time());
		}
		$cmd = 'cp -r "' . $contentPath . '/media" "' . __DIR__ . '/../media"';
		shell_Exec($cmd);
		echo 'Imported <strong>media</strong> directory <br />';
	}

	$dump = $contentPath . '/Content.sql';
	if (file_exists($dump)) {
		echo 'Imported <strong>Content.sql</strong> <br />';

		mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Error connecting to MySQL server: ' . mysql_error());
		mysql_select_db(DB_NAME) or die('Error selecting MySQL database: ' . mysql_error());
		$templine = '';
		$lines = file($dump);
		foreach ($lines as $line) {
		    if (substr($line, 0, 2) == '--' || $line == ''){
		        continue;
		    }

		    $templine .= $line;
		    if (substr(trim($line), -1, 1) == ';')
		    {
		        mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
		        $templine = '';
		    }
		}
	}

	?>
	<h1><?php _e( 'Success!' ); ?></h1>
	<p>You can now log in :)</p>

	<table class="form-table install-success">
		<tr>
			<th><?php _e( 'Username' ); ?></th>
			<td><?php echo esc_html( sanitize_user( $info->username, true ) ); ?></td>
		</tr>
		<tr>
			<th><?php _e( 'Password' ); ?></th>
			<td><?php echo esc_html($info->password); ?></td>
		</tr>
	</table>

	<p class="step"><a href="../wp-login.php" class="button button-large"><?php _e( 'Log In' ); ?></a></p>

	<?php
}

echo '<div class="clearfix"></div>';
die('');
?>