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
	
?>