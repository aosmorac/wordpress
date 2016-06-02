<?php



/* Option Page
============================================================ */


$page_data = array(
  'title'         => 'Demo: Multitable',
  'id'            => 'demo-multitable',
  'submenu'       => true
);



/* Multitable Fields
------------------------------------------------------------ */



/* Checkbox
------------------------------------------------------------ */

$multi_fields[] = array(
  'title' => 'Checkbox',
  'desc'  => 'Click to hide the textfield.',
  'id'    => 'checkbox',
  'value' => '', // true | false
  'label' => 'This is a label',
  'type'  => 'checkbox',
  'hide'  => array('multi-text-hide_$i-tr')
);



/* Custom Select
------------------------------------------------------------ */

$options = array(
  'option_1' => 'Option 1',
  'option_2' => 'Option 2',
  'option_3' => 'Option 3'
);
$multi_fields[] = array(
  'title'     => 'Custom Select',
  'desc'      => 'Select option 2 to hide the text field.',
  'id'        => 'custom-select',
  'value'     => '',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select',
  'hide'      => array('option_2' => 'multi-text-hide_$i-tr')
);



/* Text
------------------------------------------------------------ */

$multi_fields[] = array(
  'title' => 'Text (hide by checkbox or select)',
  'desc'  => 'This text field can be hidden by option 2 of the select field or by clicking the checkbox.',
  'id'    => 'multi-text-hide',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Multitable
------------------------------------------------------------ */

$fields[] = array(
  'title'  => 'Team Page',
  'id'     => 'demo-multitable-team-page',
  'value'  => '',
  'type'   => 'multitable',
  'fields' => $multi_fields
);


  
new option_page($page_data, $fields);
$fields = array();



?>