<?php

// $Id: xoops_version.php 2712 2009-01-22 10:06:01Z phppp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

$modversion['name'] = 'Invite Codes';
$modversion['version'] = 1.02;
$modversion['description'] = 'Invite codes for Profile 1.61';
$modversion['author'] = "Wishcraft";
$modversion['credits'] = "AFS Espa�a";
$modversion['help'] = "xincodes.html";
$modversion['license'] = "GNU License";
$modversion['official'] = 0;
$modversion['image'] = "images/xincodes_slogo.png";
$modversion['dirname'] = "xincodes";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//$modversion['onUpdate'] = "include/update.php";
//$modversion['onInstall'] = "include/install.php";
//$modversion['onUninstall'] = "include/uninstall.php";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/xincodes.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "xincodes";


// Templates
$modversion['templates'][1]['file'] = 'xincodes_user_index.html';
$modversion['templates'][1]['description'] = 'Main Index Page (User)';
$modversion['templates'][2]['file'] = 'xincodes_user_create.html';
$modversion['templates'][2]['description'] = 'Main Index Page (User)';
$modversion['templates'][3]['file'] = 'xincodes_admin_index.html';
$modversion['templates'][3]['description'] = 'Main Details Page (Admin)';

// Menu
$modversion['sub'][1]['name'] = _XIN_CREATECODE;
$modversion['sub'][1]['url'] = "index.php?op=create";

$modversion['hasMain'] = 1;

$i=1;
$modversion['config'][$i]['name'] = 'number_codes';
$modversion['config'][$i]['title'] = '_XIN_NUMBEROFCODES';
$modversion['config'][$i]['description'] = '_XIN_NUMBEROFCODES_DESC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 5;

$i++;
$modversion['config'][$i]['name'] = 'codeparts';
$modversion['config'][$i]['title'] = '_XIN_CODEPARTS';
$modversion['config'][$i]['description'] = '_XIN_CODEPARTS_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'A|B|C|D|E|F|G|H|I|J|K|L|M|N|O|P|Q|R|S|T|U|V|W|X|Y|Z|1|2|3|4|5|6|7|8|9|0';

$i++;
$modversion['config'][$i]['name'] = 'codelen';
$modversion['config'][$i]['title'] = '_XIN_CODELEN';
$modversion['config'][$i]['description'] = '_XIN_CODELEN_DESC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '10';

?>
