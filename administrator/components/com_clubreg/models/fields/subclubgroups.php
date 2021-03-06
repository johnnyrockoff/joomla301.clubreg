<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class JFormFieldSubclubgroups extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'subclubgroups';

	protected function getInput()
	{
		$html = $options =  array();
		$attr = '';
		
		$value = "group_id";
		$text = "group_name";
		
		
		$group_id	= (int) $this->form->getValue('group');		
		
		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';
		
		$attr .= $this->element['multiple'] ? 'multiple="multiple"' : '';
		
		$options =  ClubRegHelper::get_subgroup_list($value,$text,$group_id);
		
		$tmp = JHtml::_('select.option', '-1',	'-Select '.JText::_('COM_CLUBREG_SUBGROUPSN_LABEL').' -', $value, $text);
		
		array_unshift($options,$tmp);		
	
		$html[] = JHtml::_('select.genericlist', $options,$this->name, trim($attr), $value,$text,$this->value);		

		return implode($html);
	}
}
