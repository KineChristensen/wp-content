<?php

namespace WPGMZA\CustomFieldFilterWidget;

class Text extends \WPGMZA\CustomFieldFilterWidget
{
	public function __construct($filter)
	{
		CustomFieldFilterWidget::__construct($filter);
	}
	
	public function html()
	{
		$attributes = $this->getAttributesString();
		
		return "<input 
			$attributes
			placeholder='" . htmlspecialchars($this->filter->getFieldData()->name) . "'
			/>";
	}
}