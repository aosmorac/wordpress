<?php



/* Option Page
============================================================ */


$page_data = array(
  'title'         => 'Demo: Toggle Fields',
  'id'            => 'demo-toggle',
  'submenu'       => true
);



/* Table Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Trigger Hide Fields',
  'id'    => 'demo-trigger-hide-fields',
  'type'  => 'table_start'
);



/* Checkbox without description
----------------------------------------------------------- */

$fields[] = array(
  'title' => 'Trigger Checkbox',
  'desc'  => '',
  'id'    => 'checkbox-trigger-hide',
  'value' => '', // true | false
  'label' => 'Click to hide target textfield',
  'type'  => 'checkbox',
  'hide'  => array('text-hide-by-checkbox-tr') // Array
);



/* Checkbox without description
----------------------------------------------------------- */

$fields[] = array(
  'title' => 'Trigger Checkbox (hide all)',
  'desc'  => '',
  'id'    => 'checkbox-trigger-hide-all',
  'value' => '', // true | false
  'label' => 'Click to hide all target text fields',
  'type'  => 'checkbox',
  'hide'  => array('text-hide-by-checkbox-tr',
                   'text-hide-by-select-tr',
                   'text-hide-by-radio-tr') // Array
);



/* Custom Select
------------------------------------------------------------ */

$options = array(
  'option_1' => 'Option 1',
  'option_2' => 'Option 2',
  'option_3' => 'Option 3 (hide all)'
);
$fields[] = array(
  'title'     => 'Trigger Select',
  'desc'      => 'Select option 2 to hide text field of option 3 to hide all text fields',
  'id'        => 'custom-select-trigger-hide',
  'value'     => '',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select',
  'hide'      => array('option_2' => 'text-hide-by-select-tr',
                       'option_3' => 'text-hide-by-checkbox-tr, text-hide-by-select-tr, text-hide-by-radio-tr') // Array
);



/* Radio Buttons
------------------------------------------------------------ */

$options = array(
  'Button 1' => 'button_1',
  'Button 2' => 'button_2',
  'Button 3 (hide all)' => 'button_3'
);
$fields[] = array(
  'title'   => 'Trigger Radio Buttons',
  'desc'    => 'Click button 2 to hide text field.',
  'id'      => 'radiobuttons-trigger-hide',
  'value'   => '',
  'options' => $options,
  'type'    => 'radio',
  'hide'    => array('button_2' => 'text-hide-by-radio-tr',
                     'button_3' => 'text-hide-by-checkbox-tr, text-hide-by-select-tr, text-hide-by-radio-tr') // Array
);



/* Table End
------------------------------------------------------------ */

$fields[] = array(
  'type'  => 'table_end'
);










/* Table Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Target Hide Fields',
  'id'    => 'demo-target-hide-fields',
  'type'  => 'table_start'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text (hide by checkbox)',
  'desc'  => 'This textfield can be hidden by clicking the trigger checkbox.',
  'id'    => 'text-hide-by-checkbox',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text (hide by select)',
  'desc'  => 'This textfield can be hidden by selecting option 2.',
  'id'    => 'text-hide-by-select',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text (hide by radio)',
  'desc'  => 'This textfield can be hidden by radio button 2.',
  'id'    => 'text-hide-by-radio',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array(
  'type'  => 'table_end'
);










/* Table Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Trigger Show Fields',
  'id'    => 'demo-trigger-hide-fields',
  'type'  => 'table_start'
);



/* Checkbox without description
----------------------------------------------------------- */

$fields[] = array(
  'title' => 'Trigger Checkbox',
  'desc'  => '',
  'id'    => 'checkbox-trigger-show',
  'value' => '', // true | false
  'label' => 'Click to show target textfield',
  'type'  => 'checkbox',
  'show'  => array('text-show-by-checkbox-tr') // Array
);



/* Checkbox without description
----------------------------------------------------------- */

$fields[] = array(
  'title' => 'Trigger Checkbox (show all)',
  'desc'  => '',
  'id'    => 'checkbox-trigger-show-all',
  'value' => '', // true | false
  'label' => 'Click to show all target text fields',
  'type'  => 'checkbox',
  'show'  => array('text-show-by-checkbox-tr',
                   'text-show-by-select-tr',
                   'text-show-by-radio-tr') // Array
);



/* Custom Select
------------------------------------------------------------ */

$options = array(
  'option_1' => 'Option 1',
  'option_2' => 'Option 2',
  'option_3' => 'Option 3 (show all)'
);
$fields[] = array(
  'title'     => 'Trigger Select',
  'desc'      => 'Select option 2 to show text field or option 3 to show all text fields',
  'id'        => 'custom-select-trigger-show',
  'value'     => '',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select',
  'show'      => array('option_2' => 'text-show-by-select-tr',
                       'option_3' => 'text-show-by-checkbox-tr, text-show-by-select-tr, text-show-by-radio-tr') // Array
);



/* Radio Buttons
------------------------------------------------------------ */

$options = array(
  'Button 1' => 'button_1',
  'Button 2' => 'button_2',
  'Button 3 (show all)' => 'button_3'
);
$fields[] = array(
  'title'   => 'Trigger Radio Buttons',
  'desc'    => 'Click button 2 to show text field.',
  'id'      => 'radiobuttons-trigger-show',
  'value'   => '',
  'options' => $options,
  'type'    => 'radio',
  'show'    => array('button_2' => 'text-show-by-radio-tr',
                     'button_3' => 'text-show-by-checkbox-tr, text-show-by-select-tr, text-show-by-radio-tr') // Array
);



/* Table End
------------------------------------------------------------ */

$fields[] = array(
  'type'  => 'table_end'
);










/* Table Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Target Show Fields',
  'id'    => 'demo-target-show-fields',
  'type'  => 'table_start'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text (show by checkbox)',
  'desc'  => 'This textfield can be shown by clicking the trigger checkbox.',
  'id'    => 'text-show-by-checkbox',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text (show by select)',
  'desc'  => 'This textfield can be shown by selecting option 2.',
  'id'    => 'text-show-by-select',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text (show by radio)',
  'desc'  => 'This textfield can be shown by radio button 2.',
  'id'    => 'text-show-by-radio',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array(
  'type'  => 'table_end'
);


  
new option_page($page_data, $fields);
$fields = array();



?>