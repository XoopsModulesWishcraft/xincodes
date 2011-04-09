<?php

if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}

class XincodesXincodes extends XoopsObject
{

    function XincodesXincodes($id = null)
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('code', XOBJ_DTYPE_TXTBOX, null, false, 255);
		$this->initVar('email', XOBJ_DTYPE_TXTBOX, null, false, 255);
		$this->initVar('created_uid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('claimed_uid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('active', XOBJ_DTYPE_INT, null, false);
	}
}


/**
* XOOPS policies handler class.
* This class is responsible for providing data access mechanisms to the data source
* of XOOPS user class objects.
*
* @author  Simon Roberts <simon@chronolabs.coop>
* @package kernel
*/
class XincodesXincodesHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, 'xincodes', 'XincodesXincodes', "id", "code");
    }

		
}

?>