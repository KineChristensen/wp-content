<?php

namespace WPGMZA\CustomFieldFilterWidget;

class Checkboxes extends \WPGMZA\CustomFieldFilterWidget
{
	public function __construct($filter)
	{
		CustomFieldFilterWidget::__construct($filter);
	}
	
	public function html()
	{
		$attributes = $this->getAttributesString();
		
		$html = '
			<div class="wpgmza-custom-field-filter-widget-checkboxes wpgmza-dropdown" 
				data-field-name="' . htmlspecialchars($this->filter->getFieldData()->name) . '"
				' . $attributes . '
				>
				<div class="wpgmza-placeholder-label">
					' . htmlspecialchars($this->filter->getFieldData()->name) . '
					<ul class="wpgmza-checkboxes wpgmza-modern-shadow">
		';
		
		foreach($this->filter->getFieldValues() as $value)
			$html .= '<li><input type="checkbox" value="' . htmlspecialchars($value) . '"/> ' . htmlspecialchars($value) . '</li>';
		
		$html .= '
					</ul>
				</div>
			</div>';
		
		return $html;
	}
}
