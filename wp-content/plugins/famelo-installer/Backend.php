<?php

require_once('Components/MySQLDump.php');

/**
*
*/
class FameloInstaller_Backend {
	function __construct() {
		if (!current_user_can('manage_options')) {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
    	echo '<div class="wrap">';
		echo "<h2>" . __( 'Famelo Installer', 'menu-famelo-installer' ) . "</h2>";
		switch ($_REQUEST['action']) {
			case 'edit':
				$this->editAction();
				break;
			case 'saveEnv':
				$this->saveEnvAction();
				break;
			case 'list':
			default:
				$this->listAction();
		}
    	echo '</div>';
	}

	public function listAction() {
		?><table class="wp-list-table widefat plugins" cellspacing="0">
			<thead>
			<tr>
				<th scope="col" id="name" class="manage-column" style="">Plugin</th>
				<th scope="col" id="description" class="manage-column" style="">Beschreibung</th>
				</tr>
			</thead>

			<tbody id="the-list"><?php
		$directories = new DirectoryIterator(__DIR__ . '/../../contents/');
		foreach ($directories as $directory) {
			if ($directory->isDot() || !$directory->isDir()) {
				continue;
			}
			$info = file_get_contents($directory->getPathName() . '/Info.json');
			$info = json_decode($info);
			echo '<tr>';
			echo '<td class="plugin-title">';
			echo '<strong>' . $info->name . '</strong>';
			echo '<div class="row-actions-visible">';
			// echo '<span><a href="' . $this->link(array('action' => 'edit', 'content' => $directory->getFilename())) . '" title="Edit">Bearbeiten</a> | </span>';
			echo '<span><a href="' . $this->link(array('action' => 'saveEnv', 'content' => $directory->getFilename())) . '" title="Save To">Umgebung sichern</a></span>';
			echo '</div>';
			echo '</td>';
			echo '<td class="column-description desc">';
			echo '<div class="plugin-description"><p>' . $info->description . '</p></div>';
			// echo '<div class="active second plugin-version-author-uri">Version 4.2.2 | Von <a href="http://www.elliotcondon.com/" title="Besuche die Homepage des Autors">Elliot Condon</a> | <a href="http://www.advancedcustomfields.com/" title="Besuch die Plugin-Seite">Besuch die Plugin-Seite</a></div>';
			echo '</td>';
			echo '</tr>';
		}
		?>	</tbody>
		</table><?php
	}

	public function saveEnvAction() {
		$directory = realpath(__DIR__ . '/../../contents/' . $_REQUEST['content']);
		if (is_dir($directory)) {
			$mediaDirectory = $directory . '/media';
			if (is_dir($mediaDirectory)) {
				$this->removeDirectory($mediaDirectory);
			}
			@mkdir($mediaDirectory);
			$this->copyDirectory(realpath(__DIR__ . '/../../../media'), $mediaDirectory);

			$contentFile = $directory . '/Content.sql';
			if (file_exists($contentFile)) {
				unlink($contentFile);
			}

			$dumpSettings = array(
				'compress' => CompressMethod::NONE,
				'no-data' => false,
				'add-drop-table' => true,
				'single-transaction' => true,
				'lock-tables' => false,
				'add-locks' => true,
				'extended-insert' => true
			);

			$dump = new MySQLDump(DB_NAME, DB_USER, DB_PASSWORD, DB_HOST, $dumpSettings);
			$dump->start($contentFile);

			echo '<div class="updated"><p>';
			echo 'Updated <strong>' . $directory . ' successfully</strong> <br /><br />';
			echo '<strong><a href="' . $this->link(array('action' => 'list')) . '">Return to list</a></strong>';
			echo '</p></div>';
		}
	}

	public function editAction() {
		?>
		<form method="post" action="<?php echo $this->link(array('action' => 'save')); ?>">
			<input type="hidden" name="option_page" value="general"><input type="hidden" name="action" value="update"><input type="hidden" id="_wpnonce" name="_wpnonce" value="03affced80"><input type="hidden" name="_wp_http_referer" value="/Templates/Wordpress-Shop/wp-admin/options-general.php">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="name">Name</label>
						</th>
						<td>
							<input name="name" type="text" id="blogname" value="Template" class="regular-text">
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Änderungen speichern"></p></form>
		<?php
	}

	public function link($params) {
		return 'tools.php?page=famelo-installer&' . http_build_query($params);
	}

	public function removeDirectory($dir) {
   		$files = array_diff(scandir($dir), array('.','..'));
    	foreach ($files as $file) {
      		(is_dir("$dir/$file")) ? $this->removeDirectory("$dir/$file") : unlink("$dir/$file");
    	}
    	return rmdir($dir);
  	}

  	public function copyDirectory($source, $dest){
  		$iterator = new RecursiveIteratorIterator(
  			new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
  			RecursiveIteratorIterator::SELF_FIRST);
    	foreach ( $iterator as $item ) {
  			if ($item->isDir()) {
    			mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
  			} else {
    			copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
  			}
		}
    }
}