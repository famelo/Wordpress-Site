<?php
$installerPathAndFilename = __DIR__ . '/plugins/famelo-installer/Installer.php';
if (file_exists($installerPathAndFilename)) {
	require_once($installerPathAndFilename);
}
?>