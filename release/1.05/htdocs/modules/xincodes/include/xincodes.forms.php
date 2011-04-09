<?php

	function xincodes_createcode ($code) {
		
		$form = new XoopsThemeForm(_XIN_FRM_CREATECODE, "createcode", "", "post");

		$formobj['mycode'] = new XoopsFormText(_XIN_MF_CODE, "mycode", 45, 255, $code);
		$formobj['mycode']->setDescription(_XIN_MF_CODE_DESC);
		$formobj['mycode']->setExtra('disabled="disabled"');
		
		$formobj['email'] = new XoopsFormText(_XIN_MF_EMAIL, "email", 45, 255, '');
		$formobj['email']->setDescription(_XIN_MF_EMAIL_DESC);
		
		$formobj['code'] = new XoopsFormHidden("code", $code);
		$formobj['sendinvite'] = new XoopsFormHidden("op", "save");		
		$formobj['codeemail'] = new XoopsFormButton('', 'codeemail', _SUBMIT, "submit");
		
		$required = array('email');
				
		foreach($formobj as $key => $frmobj)
			if (!in_array($key, $required))
				$form->addElement($formobj[$key], false);
			else 
				$form->addElement($formobj[$key], true);

		return $form->render();
	}

	function xincodes_createcode_block ($code, $txtlen = 15) {
		
		$form = new XoopsThemeForm(_XIN_BK_FRM_CREATECODE, "createcode", XOOPS_URL.'/modules/xincodes/index.php', "post");

		$formobj['mycode'] = new XoopsFormText(_XIN_BK_CODE, "mycode", $txtlen, 255, $code);
		$formobj['mycode']->setDescription(_XIN_BK_CODE_DESC);
		$formobj['mycode']->setExtra('disabled="disabled"');
		
		$formobj['email'] = new XoopsFormText(_XIN_BK_EMAIL, "email", $txtlen, 255, '');
		$formobj['email']->setDescription(_XIN_BK_EMAIL_DESC);
		
		$formobj['code'] = new XoopsFormHidden("code", $code);
		$formobj['sendinvite'] = new XoopsFormHidden("op", "save");		
		$formobj['codeemail'] = new XoopsFormButton('', 'codeemail', _SUBMIT, "submit");
		
		$required = array('email');
				
		foreach($formobj as $key => $frmobj) {
			if (!in_array($key, $required))
				$form->addElement($formobj[$key], false);
			else 
				$form->addElement($formobj[$key], true);
			$ret[$key] = $formobj[$key]->render();
		}
		
		$ret['form'] = $form->render();
		
		return $ret; 
	}
?>