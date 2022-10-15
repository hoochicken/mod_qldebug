<?php
/**
 * @package		mod_qldebug
 * @copyright	Copyright (C) 2017 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class modQldebugDatabase
{

    /**
     * Method for getting database fields
     *
     * @param   string  $database  database name
     * @param   string  $table      Name of table to save data in
     *
     * @return  bool true on success, false on failure
     *
     */
    function getDatabase()
    {
       return JFactory::getDBO();
    }

	/**
	 * Method for getting database fields 
	 *
	 * @param   string  $database  database name 
	 * @param   string  $table      Name of table to save data in
	 *
	 * @return  bool true on success, false on failure
	 *
	 */	
	function getDatabaseFields($database,$table)
	{
        $db=$this->getDatabase();
		$db->setQuery('SHOW COLUMNS FROM `'.$table.'` FROM `'.$database.'` ');
		$db->query(); 
		return $db->loadObjectList();
	}
	/**
	 * Method for checking if table exists 
	 *
	 * @param   string  $database  database name 
	 * @param   string   $table      Name of table to save data in
	 *
	 * @return  string insert query
	 *
	 */	
	function tableExists($database,$table)
	{
        $db=$this->getDatabase();
		$db->setQuery('SHOW TABLES FROM `'.$database.'`');
		$db->query(); 
		foreach ($db->loadObjectList() as $k=>$v) foreach ($v as $v2) $arr[$k]=$v2;
        if (is_array($arr) AND in_array($table,$arr)) return true;
		else return false;
	}
	/**
	 * Method for getting Joomla! table name  
	 *
	 * @return  string table name
	 *
	 */	
	function getTableName($table)
	{
		if (preg_match('/#__/',$table)) $table=$this->getPrefix().substr($table,3);
		return $table;
	}
	/**
	 * Method for getting Joomla! database name  
	 *
	 * @return  string database name
	 *
	 */	
	function getDatabaseName()
	{
		$config=JFactory::getConfig();
        return $config->get('db');
	}
	/**
	 * Method for getting Joomla! prefix name  
	 *
	 * @return  string database name
	 *
	 */	
	function getPrefix()
	{
		$config=JFactory::getConfig();
		return $config->get('dbprefix');
	}
    /**
     * Method for getting database fields
     *
     * @param   string  $database  database name
     * @param   string  $table      Name of table to save data in
     *
     * @return  bool true on success, false on failure
     *
     */
    function getTableData($table,$selector='*',$query='')
    {
        $db=$this->getDatabase();
        if(''==$query)
        {
            $query=$db->getQuery(true);
            $query->select($selector);
            $query->from($table);
        }
        $db->setQuery($query);
        return $db->loadObjectList();
    }
}