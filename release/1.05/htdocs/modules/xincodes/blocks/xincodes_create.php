<?php

include_once $GLOBALS['xoops']->path('/modules/xincodes/include/xincodes.objects.php');
include_once $GLOBALS['xoops']->path('/modules/xincodes/include/xincodes.functions.php');
include_once $GLOBALS['xoops']->path('/modules/xincodes/include/xincodes.forms.php');

function xincodes_block_create_show($options) {
	
	if (is_object($GLOBALS['xoopsUser'])) 
	{
		$module_handler =& xoops_gethandler('module');
		$config_handler =& xoops_gethandler('config');
		$xoModule = $module_handler->getByDirname('xincodes');
		$xoModConfig = $config_handler->getConfigList($xoModule->getVar('mid'));
		
		$xincodes_handler =& xoops_getmodulehandler('xincodes', 'xincodes');
		$criteria = new CriteriaCompo(new Criteria('created_uid', $GLOBALS['xoopsUser']->getVar('uid')));
		$ttl = $xincodes_handler->getCount($criteria);
	
		if ($ttl<$xoModConfig['number_codes']) {
						
			$code = xincodes_generatecode();
			return  xincodes_createcode_block($code, $options[0]);

		}
		return '';
	}
	return '';
}

function xincodes_block_create_edit($options) {
	
	$opt[0] = new XoopsFormText(_XIN_BK_TXTLENGTH, "options[]", $txtlen, 255, $options[0]);
	
	foreach($opt as $id => $option)
		$html = constant('_XIN_BK_OPTIONS'.$id) . $option->render() . ((sizeof($opt)!=$id)?'<br />':'');
	
	return $html;
}

?>