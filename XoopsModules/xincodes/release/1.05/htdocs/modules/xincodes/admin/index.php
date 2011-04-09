<?php

	require('header.php');
	
	if (!is_object($GLOBALS['xoopsUser'])) {
		redirect_header(XOOPS_URL, 6, _NOPERM);
		exit(0);
	}
	
	xoops_cp_header();
	
	echo loadModuleAdminMenu(1, "");	
				
	$GLOBALS['xinTpl'] = new XoopsTpl;	
	
	$xincodes_handler =& xoops_getmodulehandler('xincodes', 'xincodes');
	$member_handler =& xoops_gethandler('member');
	
	$criteria = new CriteriaCompo();
	$criteria->setSort('created_uid, claimed_uid');
	
	$ttl = $xincodes_handler->getCount($criteria);
	
	$criteria->setStart((isset($_REQUEST['start'])?intval($_REQUEST['start']):0));
	$criteria->setLimit((isset($_REQUEST['num'])?intval($_REQUEST['num']):10));
	
	$xincodes = $xincodes_handler->getObjects($criteria, true);
	
	$nav = new XoopsPageNav($ttl, (isset($_REQUEST['num'])?intval($_REQUEST['num']):10), (isset($_REQUEST['start'])?intval($_REQUEST['start']):0), 'start' , 'limit='.(isset($_REQUEST['num'])?intval($_REQUEST['num']):10));
	$GLOBALS['xinTpl']->assign('pagenav', $nav->renderNav());
	
	foreach($xincodes as $id => $code) {
		$xoUser = $member_handler->getUser($code->getVar('created_uid'));	
		$GLOBALS['xinTpl']->append('codes', array('user'=>'<a href="'.XOOPS_URL.'/userinfo.php?uid='.$xoUser->getVar('uid').'">'.$xoUser->getVar('uname').'</a>', 
													'code'=>$code->getVar('code'), 
													'email'=>$code->getVar('email'), 
													'claimed' => ($code->getVar('active')==true?_NO:_YES)));
	}
	
	
	echo $GLOBALS['xinTpl']->display('db:xincodes_admin_index.html');				
	xoops_cp_footer();
		
	
?>