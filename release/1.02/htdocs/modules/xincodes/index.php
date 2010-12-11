<?php

	include('header.php');
	
	if (!is_object($GLOBALS['xoopsUser'])) {
		redirect_header(XOOPS_URL, 6, _NOPERM);
		exit(0);
	}
	
	switch($_REQUEST['op']) {
		default:
			$xoopsOption['template_main'] = 'xincodes_user_index.html';
			include XOOPS_ROOT_PATH.'/header.php';
			
			$xincodes_handler =& xoops_getmodulehandler('xincodes', 'xincodes');
			
			$criteria = new CriteriaCompo(new Criteria('created_uid', $GLOBALS['xoopsUser']->getVar('uid')));
			
			$ttl = $xincodes_handler->getCount($criteria);
			
			$criteria->setStart((isset($_REQUEST['start'])?intval($_REQUEST['start']):0));
			$criteria->setLimit((isset($_REQUEST['num'])?intval($_REQUEST['num']):10));
			
			$xincodes = $xincodes_handler->getObjects($criteria, true);
			
			$nav = new XoopsPageNav($ttl, (isset($_REQUEST['num'])?intval($_REQUEST['num']):10), (isset($_REQUEST['start'])?intval($_REQUEST['start']):0), 'start' , 'limit='.(isset($_REQUEST['num'])?intval($_REQUEST['num']):10));
			$GLOBALS['xoopsTpl']->assign('pagenav', $nav->renderNav());
			$GLOBALS['xoopsTpl']->assign('youhave', sprintf(_XIN_MF_H2_YOUHAVE, ($GLOBALS['xoopsModuleConfig']['number_codes']-$ttl)));
			
			foreach($xincodes as $id => $code) {
				$GLOBALS['xoopsTpl']->append('codes', array('code'=>$code->getVar('code'), 'email'=>$code->getVar('email'), 'claimed' => ($code->getVar('active')==true?_NO:_YES)));
			}
			
			include XOOPS_ROOT_PATH.'/footer.php';
			exit(0);
			break;
		case 'create':
	
			$xincodes_handler =& xoops_getmodulehandler('xincodes', 'xincodes');
			$criteria = new CriteriaCompo(new Criteria('created_uid', $GLOBALS['xoopsUser']->getVar('uid')));
			$ttl = $xincodes_handler->getCount($criteria);
			
			if ($ttl>=$GLOBALS['xoopsModuleConfig']['number_codes']) {
				redirect_header(XOOPS_URL.'/modules/xincodes/index.php', 6, _XIN_MF_MAXIMUMCODES);
				exit(0);
			}
			
			$xoopsOption['template_main'] = 'xincodes_user_create.html';
			include XOOPS_ROOT_PATH.'/header.php';
	
			$code = xincodes_generatecode();
			$GLOBALS['xoopsTpl']->assign('form', xincodes_createcode($code));
			
			include XOOPS_ROOT_PATH.'/footer.php';
			exit(0);
			break;
		case 'save':
			
			$xincodes_handler =& xoops_getmodulehandler('xincodes', 'xincodes');
			$criteria = new CriteriaCompo(new Criteria('created_uid', $GLOBALS['xoopsUser']->getVar('uid')));
			$ttl = $xincodes_handler->getCount($criteria);
			
			if ($ttl>=$GLOBALS['xoopsModuleConfig']['number_codes']) {
				redirect_header(XOOPS_URL.'/modules/xincodes/index.php', 6, _XIN_MF_MAXIMUMCODES);
				exit(0);
			}
					
			$xincode = $xincodes_handler->create();
			
			$xincode->setVar('email', $_REQUEST['email']);
			$xincode->setVar('code', $_REQUEST['code']);
			$xincode->setVar('active', true);
			$xincode->setVar('created_uid', $GLOBALS['xoopsUser']->getVar('uid'));
			
			$xincodes_handler->insert($xincode);
			
			if( is_dir($GLOBALS['xoops']->path("/modules/xincodes/language/".$GLOBALS['xoopsConfig']['language']."/mail_template")) ){
				$template_dir = $GLOBALS['xoops']->path("/modules/xincodes/language/".$GLOBALS['xoopsConfig']['language']."/mail_template");
			}else{
				$template_dir = $GLOBALS['xoops']->path("/modules/xincodes/language/english/mail_template");
			}
			
			$xoopsMailer =& getMailer();
			$xoopsMailer->setTemplateDir($template_dir);
			$xoopsMailer->setTemplate('xincodes_invite.tpl');
			$xoopsMailer->setSubject(sprintf(_XINCODES_MSG_SUBJECT, $GLOBALS['xoopsUser']->getVar('uname'), $GLOBALS['xoopsUser']->getVar('name')));
			
			$xoopsMailer->setToEmails($_REQUEST['email']);
			
			$xoopsMailer->assign("CODE", $_REQUEST['code']);
			$xoopsMailer->assign("SITEURL", XOOPS_URL);
			$xoopsMailer->assign("SITENAME", $GLOBALS['xoopsConfig']['sitename']);
			
			if( !$xoopsMailer->send(true) ){
				$err = $xoopsMailer->getErrors();
				redirect_header(XOOPS_URL.'/modules/xincodes/index.php', 6, sprintf(_XIN_MF_ERROROCCURED, $err));
				exit(0);
			}
			
			redirect_header(XOOPS_URL.'/modules/xincodes/index.php', 6, _XIN_MF_CODECREATEDANDEMAILED);
			exit(0);
			break;
	}
	
?>