<?php
/*
* 2007-2010 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author Prestashop SA <contact@prestashop.com>
*  @copyright  2007-2010 Prestashop SA
*  @version  Release: $Revision: 1.4 $
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registred Trademark & Property of PrestaShop SA
*/

class SitemapControllerCore extends FrontController
{
	public function __construct()
	{
		$this->php_self = 'sitemap.php';
	
		parent::__construct();
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS(_THEME_CSS_DIR_.'sitemap.css');
		Tools::addJS(_THEME_JS_DIR_.'tools/treeManagement.js');
	}
	
	public function process()
	{
		parent::process();
		
		$this->smarty->assign('categoriesTree', Category::getRootCategory()->recurseLiteCategTree(0));
		$this->smarty->assign('categoriescmsTree', CMSCategory::getRecurseCategory(_USER_ID_LANG_, 1, 1, 1));
		$this->smarty->assign('voucherAllowed', (int)(Configuration::get('PS_VOUCHERS')));
		$blockmanufacturer = Module::getInstanceByName('blockmanufacturer');
		$blocksupplier = Module::getInstanceByName('blocksupplier');
		$this->smarty->assign('display_manufacturer_link', (((int)$blockmanufacturer->id AND Configuration::get('PS_DISPLAY_SUPPLIERS')) ? true : false));
		$this->smarty->assign('display_supplier_link', (((int)$blocksupplier->id AND Configuration::get('PS_DISPLAY_SUPPLIERS')) ? true : false));
		$this->smarty->assign('PS_DISPLAY_SUPPLIERS', Configuration::get('PS_DISPLAY_SUPPLIERS'));
		$this->smarty->assign('display_store', Configuration::get('PS_STORES_DISPLAY_SITEMAP'));
	}
	
	public function displayContent()
	{
		parent::displayContent();
		$this->smarty->display(_PS_THEME_DIR_.'sitemap.tpl');
	}
}
