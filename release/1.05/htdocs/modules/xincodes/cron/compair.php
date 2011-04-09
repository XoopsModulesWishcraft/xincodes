<?php

	/*
	 * Cron command: /usr/bin/php -q /home/yoursite/public_html/modules/xincodes/cron/compair.php
	 */

	// NAME OF FIELD FOR PROFILE VALIDATION - PROFILE VERSION 1.61
	define('PROFILE_FIELD', 'invitecode');
	
	// NAME OF FIELD FOR XINCODES VALIDATION - XINCODES VERSION 1.00
	define('XINCODES_FIELD', 'code');
	
	include ('../../../mainfile.php');
	
	$sql = 'SELECT a.id as id, b.profile_id as uid FROM '. $GLOBALS['xoopsDB']->prefix('xincodes').' a INNER JOIN '. $GLOBALS['xoopsDB']->prefix('profile_profile').' b on b.'.PROFILE_FIELD . ' = a.'.XINCODES_FIELD . ' WHERE a.active = 1';
	
	$result = $GLOBALS['xoopsDB']->queryF($sql);
	
	$xincodes_handler =& xoops_getmodulehandler('xincodes', 'xincodes');
	
	while($row = $GLOBALS['xoopsDB']->fetchArray($result)) {
		$xincodes = $xincodes_handler->get($row['id']);
		
		$xincodes->setVar('claimed_uid', $row['uid']);
		$xincodes->setVar('active', false);
		
		$xincodes_handler->insert($xincodes);
	}
	
?>