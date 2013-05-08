<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Form Field class for the Joomla Platform.
 * Supports a generic list of options.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldAddress extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Address';

	/**
	 * Method to get the field input markup for a generic list.
	 * Use the multiple attribute to enable multiselect.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		  // Load modal behavior
          JHtml::_('behavior.modal', 'a.modal');
 
          // Build the script
          $script = array();
          $script[] = '    function customizeAddress_'.$this->id.'() {';
		  $script[] = '  	var county=document.getElementById("'.$this->id.'+country")';
          $script[] = '     var street=document.getElementById("'.$this->id.'+country+"_street")';
		  $script[] = ' 	if(street.value=1) {$(#"'.$this->id.'_street").attr("readonly","true")}';
		  $script[] = '		else{$(#"'.$this->id.'_street").attr("readonly","false")}';
		  $script[] = '     var no=document.getElementById("'.$this->id.'+country+"_no")';
		  $script[] = ' 	if(no.value=1) {$(#"'.$this->id.'_no").attr("readonly","true")}';
		  $script[] = '		else{$(#"'.$this->id.'_no").attr("readonly","false")}';
		  $script[] = '     var postalcode =document.getElementById("'.$this->id.'+country+"_postalcode")';
		  $script[] = ' 	if(postalcode.value=1) {$(#"'.$this->id.'_postalcode").attr("readonly","true")}';
		  $script[] = '		else{$(#"'.$this->id.'_postalcode").attr("readonly","false")}';
		  $script[] = '     var city=document.getElementById("'.$this->id.'+country+"_city")';
		  $script[] = ' 	if(city.value=1) {$(#"'.$this->id.'_city").attr("readonly","true")}';
		  $script[] = '		else{$(#"'.$this->id.'_city").attr("readonly","false")}';
		  $script[] = '     var postoffice=document.getElementById("'.$this->id.'+country+"_postoffice")';
		  $script[] = ' 	if(postoffice.value=1) {$(#"'.$this->id.'_postoffice").attr("readonly","true")}';
		  $script[] = '		else{$(#"'.$this->id.'_postoffice").attr("readonly","false")}';
          $script[] = '    }';
 
          // Add to document head
          JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
 
          // Setup variables for display
          $html = array();
          
 
          $db = JFactory::getDbo();
          $query = $db->getQuery(true);
          $query->select('*');
          $query->from('#__country');
          $db->setQuery($query);
          if (!$rows = $db->loadResult()) {
                  JError::raiseWarning(500, $db->getErrorMsg());
          }
          
		  $html[]='<select id="'.$this->id.'country" name="countryList" onchange="customizeAddress_'.$this->id.'()>';
		 foreach ($rows as $row)
			{
				$html[]= '<option value="'.$row->country.'" >'.$row->country.'</option>';

			
			}
			$html[]='</select>';
			
			
			$html[] = 'Street  <input type="text" id="'.$this->id.'_street" size="35" />';
			$html[] = 'Building NO  <input type="text" id="'.$this->id.'_no" size="35" />';
			$html[] = 'Postal code  <input type="text" id="'.$this->id.'_postalcode" size="35" />';
			$html[] = 'City/Town  <input type="text" id="'.$this->id.'_city" size="35" />';
			$html[] = 'Post Office  <input type="text" id="'.$this->id.'_postoffice" size="35" />';
			foreach ($rows as $row)
			{
				$html[]= '<input type="hidden" id="'.$this-id.$row->country.'_street_bul value="'.$row->street.'" ></input>';
				$html[]= '<input type="hidden" id="'.$this-id.$row->country.'_no_bul value="'.$row->no.'" ></input>';
				$html[]= '<input type="hidden" id="'.$this-id.$row->country.'_postalcode_bul value="'.$row->postalcode.'" ></input>';
				$html[]= '<input type="hidden" id="'.$this-id.$row->country.'_city_bul value="'.$row->city.'" ></input>';
				$html[]= '<input type="hidden" id="'.$this-id.$row->country.'_postoffice_bul value="'.$row->postoffice.'" ></input>';

			
			}
			        
 
          return implode("\n", $html);
	}

	
}
