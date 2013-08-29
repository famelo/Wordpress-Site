<?php
/*
Plugin Name: Famelo Installer
Description: Save and restore Wordpress content easily
Author: Marc Neuhaus <mneuhaus@famelo.com>
Version: 0.0.1
*/
class FameloInstaller {

	function __construct() {
		register_activation_hook(__FILE__, array($this, 'activate'));
		add_action('admin_menu', array($this, 'addBackend'));
	}

	public function addBackend() {
		add_management_page( __('Famelo Installer','menu-famelo-installer'), __('Famelo Installer','menu-famelo-installer'), 'manage_options', 'famelo-installer', array($this, 'backendPage'));
	}

	public function activate() {
		$src = __DIR__ . '/InstallerTemplate.php';
		$dst = __DIR__ . '/../../install.php';
		if (file_exists($dst)) {
			unlink($dst);
		}
		copy($src, $dst);
	}

	public function backendPage() {
		require_once('Backend.php');
		new FameloInstaller_Backend();
	}
}

new FameloInstaller();