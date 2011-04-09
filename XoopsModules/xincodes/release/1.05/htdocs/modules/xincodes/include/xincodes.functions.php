<?php

	function xincodes_generatecode(){
		
		$module_handler =& xoops_gethandler('module');
		$config_handler =& xoops_gethandler('config');
		$xoModule = $module_handler->getByDirname('xincodes');
		$xoModConfig = $config_handler->getConfigList($xoModule->getVar('mid'));
		
		srand((((float)('0' . substr(microtime(), strpos(microtime(), ' ') + 1, strlen(microtime()) - strpos(microtime(), ' ') + 1))) * mt_rand(30, 99999)));
		srand((((float)('0' . substr(microtime(), strpos(microtime(), ' ') + 1, strlen(microtime()) - strpos(microtime(), ' ') + 1))) * mt_rand(30, 99999)));
	
		$codes = explode('|', $xoModConfig['codeparts']);
		while( strlen($ret) < $xoModConfig['codelen'] )
		{
			$ret .= $codes[mt_rand(0, sizeof($codes))];
		}
		return $ret;
	}
?>