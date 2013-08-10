<?php
/**
 * @copyright	Copyright 2006-2013, Miles Johnson - http://milesj.me
 * @license		http://opensource.org/licenses/mit-license.php - Licensed under the MIT License
 * @link		http://milesj.me/code/cakephp/admin
 */

/**
 * Plugin constants.
 */
define('ADMIN_PLUGIN', dirname(__DIR__) . '/');

// User model
if (!defined('USER_MODEL')) {
	define('USER_MODEL', 'User');
}

// Table prefix
if (!defined('ADMIN_PREFIX')) {
	define('ADMIN_PREFIX', 'admin_');
}

// Database config
if (!defined('ADMIN_DATABASE')) {
	define('ADMIN_DATABASE', Configure::read('Acl.database'));
}

/**
 * Current version.
 */
Configure::write('Admin.version', file_get_contents(ADMIN_PLUGIN . 'version.md'));

/**
 * Name of the application.
 */
Configure::write('Admin.appName', __d('admin', 'Admin'));

/**
 * Pseudo plugin name to wrap application models in.
 */
Configure::write('Admin.coreName', 'Core');

/**
 * Aliases for special AROs.
 *
 * @link http://milesj.me/code/cakephp/admin#acl-permissions
 */
Configure::write('Admin.aliases', array(
	'administrator' => 'Administrator',
	'superModerator' => 'SuperModerator'
));

/**
 * Ignore/restrict these models.
 */
Configure::write('Admin.ignoreModels', array());

/**
 * Enable logging of administrator actions.
 *
 * @link http://milesj.me/code/cakephp/admin#activity-logs
 */
Configure::write('Admin.logActions', true);

/**
 * Default settings for each model.
 *
 * @link http://milesj.me/code/cakephp/admin#model-settings
 */
Configure::write('Admin.modelDefaults', array(
	'imageFields' => array('image'),
	'fileFields' => array('file'),
	'hideFields' => array('lft', 'rght'),
	'editorFields' => array('content'),
	'editorElement' => '',
	'paginate' => array(),
	'associationLimit' => 75,
	'batchProcess' => true,
	'actionButtons' => true,
	'deletable' => true,
	'editable' => true,
	'iconClass' => ''
));

/**
 * Behavior methods to execute as process callbacks.
 * The titles are passed through localization and will also replace %s with the model name.
 *
 * @link http://milesj.me/code/cakephp/admin#model-and-behavior-callbacks
 */
Configure::write('Admin.behaviorCallbacks', array(
	'Tree' => array(
		'recover' => 'Recover Tree',
		'reorder' => 'Reorder Tree'
	),
	'Cacheable' => array(
		'clearCache' => 'Clear Cache'
	)
));

/**
 * Model methods to execute as process callbacks.
 * The callback method accepts a record ID as the 1st argument.
 * The titles are passed through localization and will also replace %s with the model name.
 *
 * @link http://milesj.me/code/cakephp/admin#model-and-behavior-callbacks
 */
Configure::write('Admin.modelCallbacks', array());

/**
 * Provide overrides for CRUD actions.
 * This allows one to hook into the system and provide their own controller action logic.
 *
 * @link http://milesj.me/code/cakephp/admin#action-overrides
 */
Configure::write('Admin.actionOverrides', array());

/**
 * Provide overrides for CRUD views.
 * This allows one to hook into the system and provide their own view template logic.
 *
 * @link http://milesj.me/code/cakephp/admin#view-overrides
 */
Configure::write('Admin.viewOverrides', array());

/**
 * Uploader.AttachmentBehavior image transformation settings.
 *
 * @link http://milesj.me/code/cakephp/uploader#transforming-images-resize-crop-etc
 */
Configure::write('Admin.uploads.transforms', array(
	'path_thumb' => array(
		'method' => 'crop',
		'nameCallback' => 'formatTransformName',
		'append' => '-thumb',
		'overwrite' => true,
		'width' => 250,
		'height' => 150
	),
	'path_large' => array(
		'method' => 'resize',
		'nameCallback' => 'formatTransformName',
		'append' => '-large',
		'overwrite' => true,
		'aspect' => true,
		'width' => 800,
		'height' => 600
	)
));

/**
 * Uploader.AttachmentBehavior remote transport settings.
 *
 * @link http://milesj.me/code/cakephp/uploader#transporting-to-the-cloud
 */
Configure::write('Admin.uploads.transport', array());

/**
 * Uploader FileValidationBehavior validation rules.
 *
 * @link http://milesj.me/code/cakephp/uploader#validating-an-upload
 */
Configure::write('Admin.uploads.validation', array('required' => true));

/**
 * Mapping of controllers to display as top-level menu items.
 */
Configure::write('Admin.menu', array(
	'acl' => array(
		'title' => __d('admin', 'ACL'),
		'url' => array('plugin' => 'admin', 'controller' => 'acl')
	),
	'logs' => array(
		'title' => __d('admin', 'Logs'),
		'url' => array('plugin' => 'admin', 'controller' => 'logs')
	),
	'reports' => array(
		'title' => __d('admin', 'Reports'),
		'url' => array('plugin' => 'admin', 'controller' => 'reports')
	),
	'upload' => array(
		'title' => __d('admin', 'Upload'),
		'url' => array('plugin' => 'admin', 'controller' => 'upload')
	)
));

/**
 * The user model for the application.
 *
 * @link http://milesj.me/code/cakephp/admin#user-customizing
 */
Configure::write('User.model', USER_MODEL);

/**
 * A map of user fields that are used within this plugin. If your users table has a different naming scheme
 * for the username, email, status, etc fields, you can define their replacement here.
 */
if (!Configure::check('User.fieldMap')) {
	Configure::write('User.fieldMap', array(
		'username'	=> 'display_name',
		'password'	=> 'password',
		'email'		=> 'username',
		'status'	=> 'status',
		'avatar'	=> 'profilepic',
		'locale'	=> 'locale',
		'timezone'	=> 'timezone',
		'lastLogin'	=> 'lastLogin'
	));
}

/**
 * A map of status values for the users "status" column.
 * This column determines if the user is pending, currently active, or banned.
 */
if (!Configure::check('User.statusMap')) {
	Configure::write('User.statusMap', array(
		'pending'	=> 0,
		'active'	=> 1,
		'banned'	=> 2
	));
}

/**
 * A map of external user management URLs.
 */
if (!Configure::check('User.routes')) {
	Configure::write('User.routes', array(
		'login' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'login'),
		'logout' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'logout'),
		'signup' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'signup'),
		'forgotPass' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'forgot_password'),
		'settings' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'settings'),
		'profile' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'profile', '{id}') // {slug}, {username}
	));
}