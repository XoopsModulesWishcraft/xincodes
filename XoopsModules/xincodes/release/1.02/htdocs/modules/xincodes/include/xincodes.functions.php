<?php

	function xincodes_generatecode(){
		$codes = explode('|', $GLOBALS['xoopsModuleConfig']['codeparts']);
		for($y=0;$y<$GLOBALS['xoopsModuleConfig']['codelen'];$y++){
			$ret .= $codes[mt_rand(0, sizeof($codes))];
		}
		return $ret;
	}
?>