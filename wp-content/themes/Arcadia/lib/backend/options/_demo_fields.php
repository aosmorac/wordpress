<?php



/* Option Page
============================================================ */


$page_data = array(
  'title'   => 'Demo: Fields',
  'id'      => 'demo-fields',
  'submenu' => true
);



/* Table Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Demo Options',
  'id'    => 'demo-option-table',
  'type'  => 'table_start'
);



/* Select
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'HTML',
  'desc'  => 'A HTML field for demonstration purpose.',
  'id'    => 'html',
  'type'  => 'html'
);



/* Select
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Select',
  'desc'  => 'A select field for demonstration purpose.',
  'id'    => 'select',
  'value' => '',
  'scope' => 'post', // page | post | portfolio | category 
  'type'  => 'select'
);



/* Select Link
------------------------------------------------------------ */

$fields[] = array(
  'title'  => 'Select Link',
	'desc'   => 'A select link for demonstration purpose.',
	'id'     => 'selectlink',
	'value'  => '',
	'size'   => '50', // For manually text field
	// 'remove' => array('category', 'manually'),
	'type'   => 'select_link'
);



/* Select Link without category and manual options
------------------------------------------------------------ */

$fields[] = array(
  'title'  => 'Select Link (removed options)',
	'desc'   => 'Select Link without category and manual options.',
	'id'     => 'selectlink2',
	'value'  => '',
	'size'   => '50', // For manually text field
	'remove' => array('category', 'manually'),
	'type'   => 'select_link'
);



/* Custom Select
------------------------------------------------------------ */

$options = array(
  'Option 1' => 'option_1',
  'Option 2' => 'option_2',
  'Option 3' => 'option_3'
);
$fields[] = array(
  'title'     => 'Custom Select',
  'desc'      => 'A custom select field for demonstration purpose.',
  'id'        => 'custom-select',
  'value'     => '',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select'
);



/* Custom Select with Option Groups
------------------------------------------------------------ */

$options = array(
  'Option 1' => 'option_1',
  'Option 2' => 'option_2',
  'Opton Group 1' => array(
                      'Grouped Option 1' => 'goption_1',
                      'Grouped Option 2' => 'goption_2',
                    ),
  'Option 3' => 'option_3',
  'Opton Group 2' => array(
                      'Grouped Option 3' => 'goption_2',
                      'Grouped Option 4' => 'goption_4',
                    ),
  'Option 4' => 'option_4'
);
$fields[] = array(
  'title' => 'Custom Select with Option Groups',
  'desc'  => 'A custom select field for demonstration purpose.',
  'id'    => 'custom-optgroup-select',
  'value' => '',
  'scope' => $options,
  'type'  => 'select'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text',
  'desc'  => 'A text field for demonstration purpose.',
  'id'    => 'text',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Textarea
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text Area',
  'desc'  => 'A textarea for demonstration purpose.',
  'id'    => 'textarea',
  'value' => '',
  'size'  => '6',
  'type'  => 'textarea'
);



/* Checkbox
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Checkbox',
  'desc'  => 'A checkbox for demonstration purpose.',
  'id'    => 'checkbox',
  'value' => '', // true | false
  'label' => 'This is a label',
  'type'  => 'checkbox'
);



/* Checkbox without description
----------------------------------------------------------- */

$fields[] = array(
  'title' => 'Checkbox without description',
  'desc'  => '',
  'id'    => 'checkbox2',
  'value' => '', // true | false
  'label' => 'This is a label',
  'type'  => 'checkbox'
);



/* Radio Buttons
------------------------------------------------------------ */

$options = array(
  'Button 1' => 'button_1',
  'Button 2' => 'button_2',
  'Button 3' => 'button_3'
);
$fields[] = array(
  'title'   => 'Radio Buttons',
  'desc'    => 'Some radio buttons for demonstration purpose.',
  'id'      => 'radiobuttons',
  'value'   => '',
  'options' => $options,
  'type'    => 'radio'
);



/* Color Picker
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Color Picker',
  'desc'  => 'A radio button for demonstration purpose.',
  'id'    => 'colorpicker',
  'value' => '', // #000000
  'size'  => '30',
	'label' => 'Set Color',
  'type'  => 'color_picker'
);



/* Color Picker
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Media Link',
  'desc'  => 'A media link for demonstration purpose.',
  'id'    => 'medialink',
  'value' => '',
  'size'  => '30',
	'label' => 'Set Image',
  'type'  => 'media_link'
);



/* Multi Select
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Multi Select',
  'desc'  => 'A multi select for demonstration purpose.',
  'id'    => 'multiselect',
  'value' => '',
  'max'   => '3',
  'type'  => 'multiselect',
  'scope' => 'post' // page | post | category | portfolio | portfolio_category
);



/* Preset Multi Select
------------------------------------------------------------ */

$options = array(
  'Date'       => 'date',
  'Categories' => 'categories',
  'Comments'   => 'comments'
);
$fields[] = array(
  'title'     => 'Preset Multi Select',
  'desc'      => 'A preset multi select for demonstration purpose.',
  'id'        => 'preset-multiselect',
  'value'     => 'date::categories::comments',
  'max'       => '3',
  'type'      => 'multiselect',
  'no_prompt' => 'true',
  'scope'     => $options
);



/* Infinitive Multi Select
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Infinitive Multi Select',
  'desc'  => 'Am infinitive multi select for demonstration purpose.',
  'id'    => 'multiselect2',
  'value' => '',
  'max'   => 'inf',
  'type'  => 'multiselect',
  'scope' => 'post' // page | post | category | portfolio | portfolio_category
);



/* Group Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'This is a group',
  'desc'  => 'A group for demonstration purpose.',
  'id'    => 'group',
  'type'  => 'group_start'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text',
  'desc'  => 'A text field for demonstration purpose 1.',
  'id'    => 'text2',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text',
  'desc'  => 'A text field for demonstration purpose.2',
  'id'    => 'text3',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text',
  'desc'  => 'A text field for demonstration purpose.',
  'id'    => 'text4',
  'value' => '',
  'size'  => '50',
  'type'  => 'text'
);



/* Group End
------------------------------------------------------------ */

$fields[] = array(
  'type'  => 'group_end'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array(
  'type'  => 'table_end'
);


  
new option_page($page_data, $fields);
$fields = array();



?>