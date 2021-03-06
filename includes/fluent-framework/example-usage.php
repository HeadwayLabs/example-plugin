<?php
/**
 * Example usage of the framework classes.
 *
 * @package Fluent
 * @since 1.0.1
 * @version 1.0.2
 */

//sections are groups of fields, displayed as metaboxes or blocks depending on the usage case
$sections = array();

//each section has attributes like title and icon to be used, and has fields attached to it
//basic text fields
$sections['text'] = array(
    'dash_icon' => 'list-view',
    'title' =>  __('Text Fields', 'fluent'),
    'description' => __('These are the basic text field types found in the options framework','fluent'),
    'context' => 'normal',
    'priority' => 'high',
    'caps' => array(),
    'fields' => array(
        'text' => array(
            'type' => 'text',
            'title' => __('Text Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'required' => true,
            'description' => __('This is just a text field.', 'fluent'),
            'default' => '',
            'seperate' => true
        ),
        'text-regular' => array(
            'type' => 'text',
            'title' => __('Text Field', 'fluent'),
            'sub_title' => __('With Custom CSS Class', 'fluent'),
            'classes' => array('regular-text'),
            'description' => __('This text field has the <code>regular-text</code> class applied.', 'fluent'),
        ),
        'text-small' => array(
            'type' => 'text',
            'title' => __('Text Field', 'fluent'),
            'sub_title' => __('With Custom CSS Class', 'fluent'),
            'classes' => array('small-text'),
            'description' => __('This text field has the <code>small-text</code> class applied.', 'fluent'),
        ),
        'email' => array(
            'type' => 'email',
            'title' => __('Email Field', 'fluent'),
            'sub_title' => __('HTML5 email field', 'fluent'),
            'description' => __('This text field has the <code>type="email"</code> input attribute.', 'fluent'),
        ),
        'url' => array(
            'type' => 'url',
            'title' => __('Url Field', 'fluent'),
            'sub_title' => __('HTML5 url field', 'fluent'),
            'description' => __('This text field has the <code>type="url"</code> input attribute.', 'fluent'),
        ),
        'number' => array(
            'type' => 'number',
            'title' => __('Number Field', 'fluent'),
            'sub_title' => __('HTML5 Number Input', 'fluent'),
            'min' => 5,
            'max' => 50,
            'step' => 5,
            'description' => __('This is a simple HTML5 number field.', 'fluent'),
        ),
        'password' => array(
            'type' => 'password',
            'title' => __('Password Field', 'fluent'),
            'sub_title' => __('This is a password field', 'fluent'),
            'required_message' => __('Hey this is a custom required message!', 'fluent'),
            'description' => __('The value will be saved as plain text.', 'fluent'),
        ),
        'textarea' => array(
            'type' => 'textarea',
            'title' => __('Textarea Field', 'fluent'),
            'sub_title' => __('Multiline inputs', 'fluent'),
            'cols' => 60, //default
            'rows' => 6, //default
            'description' => __('This is just a textarea field.', 'fluent'),
        ),
    ),
); 
//choice fields 
$sections['choice'] = array(
    'dash_icon' => 'share',
    'title' =>  __('Choice Fields', 'fluent'),
    'description' => __('These are the basic HTML choice field types found in the options framework (radio, checkbox, select)','fluent'),
    'context' => 'normal',
    'priority' => 'high',
    'caps' => array(),
    'fields' => array(
        'radio' => array(
            'type' => 'radio',
            'title' => __('Radio Field', 'fluent'),
            'sub_title' => __('Choose a single answer', 'fluent'),
            'description' => __('This is a very basic yes/no field type, but it can have many more options.', 'fluent'),
            'options' => array(
                'yes' => __('Yes', 'fluent'),
                'no' => __('No', 'fluent')
            ),
            'default' => 'yes'
        ),
        'radio2' => array(
            'type' => 'radio',
            'title' => __('Radio Field', 'fluent'),
            'sub_title' => __('Block level radio inputs', 'fluent'),
            'description' => __('This is a very basic yes/no field type, but it can have many more options.', 'fluent'),
            'options' => array(
                'yes' => __('Yes', 'fluent'),
                'no' => __('No', 'fluent')
            ),
            'default' => 'no',
            'inline' => false//force block level options
        ),
        'checkbox' => array(
            'type' => 'checkbox',
            'title' => __('Checkbox Field', 'fluent'),
            'sub_title' => __('Choose a single answer', 'fluent'),
            'description' => __('This is a very basic checkbox field type, it can have a single or multiple checkboxes.', 'fluent'),
            'options' => array(
                'yes' => __('Yes', 'fluent'),
                'no' => __('No', 'fluent')
            ),
            'default' => array('yes' => true)
        ),
        'checkbox2' => array(
            'type' => 'checkbox',
            'title' => __('Checkbox Field', 'fluent'),
            'sub_title' => __('Block level radio inputs', 'fluent'),
            'description' => __('This is a very basic checkbox field type, it can have a single or multiple checkboxes.', 'fluent'),
            'options' => array(
                'yes' => __('Yes', 'fluent'),
                'no' => __('No', 'fluent')
            ),
            'inline' => false//force block level options
        ),
        'checkbox3' => array(
            'type' => 'checkbox',
            'title' => __('Checkbox Field', 'fluent'),
            'sub_title' => __('Single Checkbox', 'fluent'),
            'description' => __('This is a very basic checkbox field type, it can have a single or multiple checkboxes.', 'fluent'),
            'options' => array(
                'agree' => __('I Agree to terms of service', 'fluent')
            ),
            'default' => true
        ),
        'select' => array(
            'type' => 'select',
            'title' => __('Select Field', 'fluent'),
            'sub_title' => __('Simple Select Field', 'fluent'),
            'description' => __('This is a very basic select field type.', 'fluent'),
            'options' => array(
                'yes' => __('Yes', 'fluent'),
                'no' => __('No', 'fluent')
            ),
            'placeholder' => __('Please choose ..', 'fluent'),
            'default' => 'no',
        ),
        'select2' => array(
            'type' => 'select',
            'title' => __('Select Field', 'fluent'),
            'sub_title' => __('Multiple Select Field', 'fluent'),
            'description' => __('This is a very basic select field type with multiple options selectable.', 'fluent'),
            'options' => array(
                'yes' => __('Yes', 'fluent'),
                'maybe' => __('Maybe', 'fluent'),
                'no' => __('No', 'fluent')
            ),
            'multiple' => true,
            'default' => array(0 => 'yes',1 => 'no')
        ),
    ),
);
//advanced none standard field types
$sections['advanced'] = array(
    'dash_icon' => 'dashboard',
    'title' =>  __('Advanced Fields', 'fluent'),
    'description' => __('These are the advanced field types found in the options framework','fluent'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        'editor' => array(
            'type' => 'editor',
            'title' => __('Editor Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is just a default WordPress editor field.', 'fluent'),
        ),
        'color' => array(
            'type' => 'color',
            'title' => __('Color Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is just a default WordPress color picker field.', 'fluent'),
            'default' => '#000000'
        ),
        'date' => array(
            'type' => 'date',
            'title' => __('Date Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is just a default jQuery UI datepicker field.', 'fluent'),
            'default' => date(get_option('date_format'))
        ),
        'radio-img' => array(
            'type' => 'radio-img',
            'title' => __('Radio Image Field', 'fluent'),
            'sub_title' => __('Choose a single answer', 'fluent'),
            'description' => __('This is a simple radio field with images for selection instead.', 'fluent'),
            'options' => array(
                //data strings used for demo, this is where you would put the image url
                '1' => 'data:image/png;base64,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',
                '2' => 'data:image/png;base64,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',
                '3' => 'data:image/png;base64,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',
                '4' => 'data:image/png;base64,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',
                '5' => 'data:image/png;base64,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',
                '6' => 'data:image/png;base64,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'
            ),
            'default' => '2',
            'width' => '45px',//100px default
            'height' => 'auto'//auto default
        ),
        'media' => array(
            'type' => 'media',
            'title' => __('Media Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This opens up and allows you to select media items from the library.', 'fluent')
        ),
        'media2' => array(
            'type' => 'media',
            'title' => __('Media Field', 'fluent'),
            'sub_title' => __('With Custom Text parts', 'fluent'),
            'upload_title' => __('Hey custom upload button text!', 'fluent'),
            'media_title' => __('Hey a custom title!', 'fluent'),
            'media_select' => __('Hey a custom select button!', 'fluent'),
            'description' => __('This opens up and allows you to select media items from the library.', 'fluent')
        ),
        'gallery' => array(
            'type' => 'gallery',
            'title' => __('Gallery Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This opens up and allows you to create galleries from the library.', 'fluent')
        ),
        'background' => array(
            'type' => 'background',
            'title' => __('Background Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is a background field with all available options.', 'fluent')
        ),
        'switch' => array(
            'type' => 'switch',
            'title' => __('Switch Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This lets you select a yes/no value.', 'fluent')
        ),
        'font' => array(
            'type' => 'font',
            'title' => __('Font Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This allows you to select a font and styles.', 'fluent')
        ),
        'ace' => array(
            'type' => 'ace',
            'title' => __('Code Editor Field (css)', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This field is generated using the Ace code editor library. You can choose themes per instance.<br/>Modes available: <code>css|html|javascript|json|less|markdown|php|plain_text|sass|scss|text</code>', 'fluent'),
            'ace' => array(
                'theme' => 'monokai',//default - see all themes here: https://github.com/ajaxorg/ace/tree/master/lib/ace/theme
                'mode' => 'css'//default - available: css|html|javascript|json|less|markdown|php|plain_text|sass|scss|text
            )
        ),
        'ace2' => array(
            'type' => 'ace',
            'title' => __('Code Editor Field (js)', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This field is generated using the Ace code editor library. With the <code>chrome</code> theme set. See all themes here: <a href="https://github.com/ajaxorg/ace/tree/master/lib/ace/theme" target="_blank">https://github.com/ajaxorg/ace/tree/master/lib/ace/theme</a>', 'fluent'),
            'ace' => array(
                'theme' => 'chrome',
                'mode' => 'javascript'
            )
        ),
        'custom' => array(
            'type' => 'custom',
            'title' => __('Custom Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('Cool custom field.', 'fluent'),
            'callbacks' => array(
                'render' => function($data, $object){print_r($data);},
                'default' => function($default, $data){return 'a default value';},
                'enqueue' => function($data, $field_data){},
                'schema' => function($value, $data){}
            ),
        ),
        'custom-support' => array(
            'type' => 'custom',
            'title' => __('Support Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('Here we are using the custom field type to render an instance of the <code>Fluent_Support</code> class.', 'fluent'),
            'callbacks' => array(
                'render' => function($data, $object){
                    //fetch the support form and display it
                    $support = Fluent_Store::get('support');
                    $support->the_form();
                },
            ),
        ),
    ),
);
//this section is blocked by user role, you provide an array of user roles and if one matches the current user they can edit it  
$sections['blocked_role'] = array(
    'dash_icon' => 'lock',
    'title' =>  __('Section disabled by role', 'fluent'),
    'description' => __('These fields are in a blocked section by role','fluent'),
    'context' => 'normal',
    'priority' => 'high',
    'roles' => array('role_that_doesnt_exist', 'another_role_that_doesnt_exist'),
    'fields' => array(
        'blocked_role_editor' => array(
            'type' => 'editor',
            'title' => __('Editor Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is just a default WordPress editor field.', 'fluent'),
        ),
    ),
);
//this section is blocked by capabilities, the current user must have all listed capabilities to edit it
$sections['blocked_caps'] = array(
    'dash_icon' => 'lock',
    'title' =>  __('Section disabled by capability', 'fluent'),
    'description' => __('These fields are in a blocked section by capability','fluent'),
    'context' => 'normal',
    'priority' => 'high',
    'caps' => array('cap_that_doesnt_exist', 'another_cap_that_doesnt_exist'),
    'fields' => array(
        'blocked_caps_editor' => array(
            'type' => 'editor',
            'title' => __('Editor Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is just a default WordPress editor field.', 'fluent'),
        ),
    ),
); 
//this section contains fields which are blocked by roles and capabilties just like the above sections
$sections['blocked_fields'] = array(
    'dash_icon' => 'lock',
    'title' =>  __('Fields disabled by roles and capabilities', 'fluent'),
    'description' => __('These fields are blocked by roles and capabilities','fluent'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        'blocked_field_role_editor' => array(
            'type' => 'editor',
            'title' => __('Editor Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is just a default WordPress editor field.', 'fluent'),
            'roles' => array('role_that_doesnt_exist', 'another_role_that_doesnt_exist')
        ),
        'blocked_field_caps_editor' => array(
            'type' => 'text',
            'title' => __('Editor Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is just a default WordPress editor field.', 'fluent'),
            'caps' => array('cap_that_doesnt_exist', 'another_cap_that_doesnt_exist')
        ),
    ),
);
//this section contains conditional fields, which are only shown if the conditions are met, all possible condition types are listed in this array
$sections['conditonal_fields'] = array(
    'dash_icon' => 'lock',
    'title' =>  __('Fields disabled by other field values', 'fluent'),
    'description' => __('These fields are blocked by other field values','fluent'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        'blocked_field_text' => array(
            'type' => 'editor',
            'title' => __('Editor Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('Enter the word <code>match</code> anywhere to enable the next field.', 'fluent'),
        ),
        'blocked_field_checkbox' => array(
            'type' => 'checkbox',
            'title' => __('Checkbox Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('Check the box to enable the next field.', 'fluent'),
            'options' => array(
            	'enable' => __('Enable the next field.', 'fluent')
            ),
            'conditions' => array(
            	array(
            		array(
            			'id' => 'blocked_field_text',
            			'value' => 'match',
            			'type' => 'contains'//default is supplied == value
            		)
            	)
            )
        ),
        'blocked_field_multi_checkbox' => array(
            'type' => 'checkbox',
            'title' => __('Checkbox Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('Check the boxes <code>Yes</code> and <code>No</code> to enable the next field.', 'fluent'),
            'options' => array(
            	'yes' => __('Yes', 'fluent'),
            	'maybe' => __('Maybe', 'fluent'),
            	'no' => __('No', 'fluent')
            ),
            'conditions' => array(
            	array(
            		array(
            			'id' => 'blocked_field_checkbox',
            			'value' => '1'
            		)
            	)
            )
        ),
        'blocked_field_radio' => array(
            'type' => 'radio',
            'title' => __('Radio Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('Select <code>Yes</code> to enable the next field.', 'fluent'),
            'options' => array(
            	'yes' => __('Yes', 'fluent'),
            	'maybe' => __('Maybe', 'fluent'),
            	'no' => __('No', 'fluent')
            ),
            'default' => 'no',
            'conditions' => array(
            	array(
            		array(
            			'id' => 'blocked_field_multi_checkbox',
            			'value' => array('yes', 'no')
            		)
            	)
            )
        ),
        'blocked_field_select' => array(
            'type' => 'select',
            'title' => __('Select Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('You must select <code>Yes</code> here and <code>No</code> below or <code>Maybe</code> and <code>Maybe</code> to enable the next field.', 'fluent'),
            'options' => array(
            	'yes' => __('Yes', 'fluent'),
            	'maybe' => __('Maybe', 'fluent'),
            	'no' => __('No', 'fluent')
            ),
            'default' => 'no',
            'conditions' => array(
            	array(
            		array(
            			'id' => 'blocked_field_radio',
            			'value' => 'yes'
            		)
            	)
            )
        ),
        'blocked_field_select2' => array(
            'type' => 'select',
            'title' => __('Select Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('You must select <code>No</code> here and <code>Yes</code> above or <code>Maybe</code> and <code>Maybe</code> to enable the next field.', 'fluent'),
            'options' => array(
            	'yes' => __('Yes', 'fluent'),
            	'maybe' => __('Maybe', 'fluent'),
            	'no' => __('No', 'fluent')
            ),
            'default' => 'no',
            'conditions' => array(
            	array(
            		array(
            			'id' => 'blocked_field_radio',
            			'value' => 'yes'
            		)
            	)
            )
        ),
        'blocked_field_text2' => array(
            'type' => 'text',
            'title' => __('Text Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This field is only shown if the above two selects have <code>Yes</code> and <code>No</code> or <code>Maybe</code> and <code>Maybe</code> selected.<br/>To enable the next field this field must contain the word <code>WordPress</code>.', 'fluent'),
            'default' => 'no',
            'conditions' => array(
            	array(
            		array(
            			'id' => 'blocked_field_select',
            			'value' => 'yes'
            		),
            		array(
            			'id' => 'blocked_field_select2',
            			'value' => 'no'
            		)
            	),
            	array(
            		array(
            			'id' => 'blocked_field_select',
            			'value' => 'maybe'
            		),
            		array(
            			'id' => 'blocked_field_select2',
            			'value' => 'maybe'
            		)
            	)
            )
        ),
		'blocked_field_text3' => array(
            'type' => 'text',
            'title' => __('Text Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must start with <code>WordPress</code>', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_text2',
                		'value' => 'WordPress',
                		'type' => 'contains'
            		)
            	)
            )
        ),
        'blocked_field_text4' => array(
            'type' => 'text',
            'title' => __('Text Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must end with <code>WordPress</code>.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_text3',
                		'value' => 'WordPress',
                		'type' => 'starts_with'
            		)
            	)
            )
        ),
        'blocked_field_number' => array(
            'type' => 'number',
            'title' => __('Number Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must be less than 10.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_text4',
                		'value' => 'WordPress',
                		'type' => 'ends_with'
            		)
            	)
            )
        ),
        'blocked_field_number2' => array(
            'type' => 'number',
            'title' => __('Number Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must be less than or equal to 10.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_number',
                		'value' => '10',
                		'type' => '<'
            		)
            	)
            )
        ),
        'blocked_field_number3' => array(
            'type' => 'number',
            'title' => __('Number Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must be more than 10.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_number2',
                		'value' => '10',
                		'type' => '<='
            		)
            	)
            )
        ),
        'blocked_field_number4' => array(
            'type' => 'number',
            'title' => __('Number Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must be more than or equal to 10.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_number3',
                		'value' => '10',
                		'type' => '>'
            		)
            	)
            )
        ),
        'blocked_field_number5' => array(
            'type' => 'number',
            'title' => __('Number Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must be between 10 and 20.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_number4',
                		'value' => '10',
                		'type' => '>='
            		)
            	)
            )
        ),
        'blocked_field_number6' => array(
            'type' => 'number',
            'title' => __('Number Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must NOT be between 10 and 20.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_number5',
                		'value' => '10|20',
                		'type' => 'between'
            		)
            	)
            )
        ),
        'blocked_field_textarea' => array(
            'type' => 'textarea',
            'title' => __('Textarea Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must NOT contain the word <code>WordPress</code>.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_number6',
                		'value' => '10|20',
                		'type' => '!between'
            		)
            	)
            )
        ),
        'blocked_field_textarea2' => array(
            'type' => 'textarea',
            'title' => __('Textarea Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('To enable the next field this field must NOT be empty.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_textarea',
                		'value' => 'WordPress',
                		'type' => '!contains'
            		)
            	)
            )
        ),
        'blocked_field_textarea3' => array(
            'type' => 'textarea',
            'title' => __('Textarea Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is the last condition field in the list.', 'fluent'),
            'conditions' => array(
            	array(
            		array(
                		'id' => 'blocked_field_textarea2',
                		'value' => '',
                		'type' => 'required'
            		)
            	)
            )
        ),
    ),
);
//this section shows usage of the info field type, this can be used to display additional data before or after other fields
$sections['info'] = array(
    'dash_icon' => 'editor-help',
    'title' =>  __('Info Fields', 'fluent'),
    'description' => __('These are the information field types found in the options framework','fluent'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        'info' => array(
            'type' => 'info',
            'icon' => 'dashboard',
            'title' => __('Info Field', 'fluent'),
            'description' => __('This is a information field.', 'fluent')
        ),
        'info-notice' => array(
            'type' => 'info',
            'icon' => 'chart-line',
            'info_type' => 'notice',
            'show_title' => false,
            'title' => __('Info Field', 'fluent'),
            'description' => __('This is a information field with notice class applied and no title.', 'fluent')
        ),
        'info-warning' => array(
            'type' => 'info',
            'info_type' => 'warning',
            'title' => __('Info Field', 'fluent'),
            'description' => __('This is a information field with warning class applied and no icon.', 'fluent')
        ),
        'info-error' => array(
            'type' => 'info',
            'icon' => 'awards',
            'info_type' => 'error',
            'title' => __('Info Field', 'fluent'),
            'description' => __('This is a information field with error class applied.', 'fluent')
        ),
        'info-success' => array(
            'type' => 'info',
            'icon' => 'location-alt',
            'info_type' => 'success',
            'title' => __('Info Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is a information field with success class applied.', 'fluent')
        ),
    ),
);  
//this section contains the import/export field types. they can be put anywhere and be used on any instance type (page, metabox, user,taxonomy)
$sections['import_export'] = array(
    'dash_icon' => 'upload',
    'title' =>  __('Import/Export Fields', 'fluent'),
    'description' => __('These are the import/export field types found in the options framework','fluent'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        'import' => array(
            'type' => 'import',
            'title' => __('Import Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is the import field.', 'fluent')
        ),
        'export' => array(
            'type' => 'export',
            'title' => __('Export Field', 'fluent'),
            'sub_title' => __('This is a sub title', 'fluent'),
            'description' => __('This is the export field.', 'fluent')
        ),
    ),
);  
//this sections shows how you can section tabs feature and use the group field to nest and repeat fields, it can go as deep as you want it to (consider the implications on screen space though)
$sections['group'] = array(
    'dash_icon' => 'feedback',
    'title' => __('Group Fields', 'fluent'),
    'description' => __('Group Fields are one of the most important features of this framework. Groups allow to create nested, repeatable, sortable sub fields. You are simply limited by your imagination (and physical screensize, after 2 levels you run out of alot of space).','fluent'),
    'context' => 'advanced',
    'priority' => 'high',
    'tabs' => array(
        'tab1' => array(
            'title' => 'Tab 1',
            'description' => 'Simple Group Fields. This is a basic example of singular and repeatable groups.',
            'fields' => array(
                'group' => array(
                    'title' => 'Group Field',
                    'sub_title' => '',
                    'description' => '',
                    'multiple' => true,
                    'type' => 'group',
                    'fields' => array(
                        'title' => array(
                            'title' => 'title',
                            'width' => '15'
                        ),
                        'first_name' => array(
                            'title' => 'first name',
                            'width' => '75'
                        ),
                        'adult' => array(
                            'title' => 'adult',
                            'type' => 'checkbox',
                            'options' => array(
                                'adult' => '',
                            ),
                            'width' => '10'
                        ),
                    ),
                    'default' => array(
                        array(
                            'title' => 'mr',
                            'first_name' => 'lee',
                            'adult' => true,
                        ),
                    ),
                ),
                'group2' => array(
                    'title' => 'Group Field 2',
                    'sub_title' => '',
                    'description' => '',
                    'multiple' => true,
                    'type' => 'group',
                    'fields' => array(
                        'title' => array(
                            'title' => 'title',
                            'width' => '15',
                        ),
                        'names' => array(
                            'title' => 'names',
                            'width' => '85',
                            'type' => 'group',
                            'fields' => array(
                                'first' => array(
                                    'title' => 'firstname',
                                ),
                                'last' => array(
                                    'title' => 'lastname',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        ),
        'tab2' => array(
            'title' => 'Tab 2',
            'description' => 'This is an example of groups without headers and simple nested groups.',
            'fields' => array(
                'group3' => array(
                    'title' => 'Group Field 3',
                    'type' => 'group',
                    'show_headers' => false,
                    'fields' => array(
                        'title' => array(
                            'title' => 'title',
                            'default' => 'mr'
                        ),
                        'first' => array(
                            'title' => 'firstname',
                            'default' => 'lee'
                        ),
                        'last' => array(
                            'title' => 'lastname',
                            'default' => 'mason'
                        ),
                    ),
                ),
                'group4' => array(
                    'title' => 'Group Field 4',
                    'multiple' => true,
                    'type' => 'group',
                    'fields' => array(
                        'title' => array(
                            'title' => 'title',
                        ),
                        'names' => array(
                            'title' => 'names',
                            'type' => 'group',
                            'multiple' => true,
                            'fields' => array(
                                'first' => array(
                                    'title' => 'firstname',
                                ),
                                'last' => array(
                                    'title' => 'lastname',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'tab3' => array(
            'title' => 'Tab 3',
            'description' => 'This is an example of nested groups with nested groups.',
            'fields' => array(
                'group5' => array(
                    'title' => 'Group Field 5',
                    'multiple' => true,
                    'type' => 'group',
                    'fields' => array(
                        'title' => array(
                            'title' => 'title',
                        ),
                        'names' => array(
                            'title' => 'names',
                            'type' => 'group',
                            'multiple' => true,
                            'fields' => array(
                                'first' => array(
                                    'title' => 'firstname',
                                    'type' => 'group',
                                    'multiple' => true,
                                    'fields' => array(
                                        'title' => array(
                                            'title' => 'title',
                                        ),
                                    ),
                                ),
                                'last' => array(
                                    'title' => 'lastname',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'tab4' => array(
            'title' => 'Tab 4',
            'description' => 'This is an example of groups with advanced field types.',
            'fields' => array(
                'group6' => array(
                    'title' => 'Group Field 6',
                    'type' => 'group',
                    'multiple' => true,
                    'layout' => 'horizontal',
                    'fields' => array(
                        'date' => array(
                            'type' => 'date',
                            'title' => 'Date',
                            'default' => date(get_option('date_format'))
                        ),
                        'switch' => array(
                            'type' => 'switch',
                            'title' => 'Switch',
                        ),
                        'color' => array(
                            'type' => 'color',
                            'title' => 'Color'
                        ),
                    ),
                ),
            ),
        ),
        'tab5' => array(
            'title' => 'Tab 5',
            'description' => 'This is an example of groups with vertical layouts.',
            'fields' => array(
                'group7' => array(
                    'title' => 'Group Field 7',
                    'sub_title' => 'Vertical Layout',
                    'type' => 'group',
                    'multiple' => true,
                    'layout' => 'vertical',
                    'fields' => array(
                        'date' => array(
                            'type' => 'date',
                            'title' => 'Date',
                            'sub_title' => 'test sub title',
                            'default' => date(get_option('date_format'))
                        ),
                        'switch' => array(
                            'type' => 'switch',
                            'title' => 'Switch',
                        ),
                        'color' => array(
                            'type' => 'color',
                            'title' => 'Color'
                        ),
                    ),
                ),
                'group8' => array(
                    'title' => 'Group Field 8',
                    'sub_title' => 'Vertical Layout',
                    'type' => 'group',
                    'layout' => 'vertical',
                    'fields' => array(
                        'date' => array(
                            'type' => 'date',
                            'title' => 'Date',
                            'default' => date(get_option('date_format'))
                        ),
                        'switch' => array(
                            'type' => 'switch',
                            'title' => 'Switch',
                        ),
                        'color' => array(
                            'type' => 'color',
                            'title' => 'Color'
                        ),
                    ),
                ),
                'group9' => array(//this is an example of how to use it for a image slider
                    'title' => 'Image Slider',
                    'sub_title' => '',
                    'type' => 'group',
                    'multiple' => true,
                    'layout' => 'vertical',
                    'fields' => array(
                        'image' => array(
                            'type' => 'media',
                            'title' => 'Image',
                            'sub_title' => 'Select the slide image',
                        ),
                        'title' => array(
                            'title' => 'Title',
                        ),
                        'description' => array(
                            'type' => 'textarea',
                            'title' => 'Description'
                        ),
                    ),
                ),
            )
        ),
    ),
);



//load normal options page
$args = array(
    'dev_mode' => true,
    'option_name' => 'the_option_name',
    'page_args' => array(
        'slug' => 'options',//the unique slug of the page
        'menu_title' => __( 'Options', 'domain' ),//the title in the sidebar menu of the page
        'page_title' => __( 'Options', 'domain' ),//the page title when rendered
        'parent' => '',//a string referencing the parent menu item if any, e.g: 'admin.php?page=somepage'
        'cap' => 'manage_options',//the capability of users who can access this page
        'priority' => null,//the menu item priority
        'menu_icon' => '',//the dash icon or url to image icon for use in the menu (only for top level pages)
        'page_icon' => 'icon-themes',//the dash icon if any to use on the page when rendered
        'callback' => false//the page render callback
    ),
    'restore' => true,//false to disable the restore option
    'show_updated' => true,//false to disable the last updated time
    'messages' => array(//here you can provide custom messages which will overwrite the default ones used on different actions
        'save_button' => __('Custom Save', 'domain'),//displays in the settings save box
        'saved' => __('Custom Saved Message', 'domain'),//displays in the settings saved notice
        'restore' => __('Custom Restore Message', 'domain'),//displays in the settings saved notice
        'save_box' => __('custom message for the save box', 'domain'),//displays a message in the save box
    )
);
$panel = new Fluent_Options_Page( $args, $sections );

//optionall store the panel instance for later access
Fluent_Store::set('panel', $panel);

//load meta boxes
$args = array(
    'dev_mode' => true,
    'option_name' => 'the_option_name',
    'post_types' => array(
        'tl_loop'
    )
);
//you can create and store in one line too
Fluent_Store::set('metaboxes', new Fluent_Options_Meta( $args, $sections ));

//load user meta
$args = array(
    'dev_mode' => true,
    'option_name' => 'the_option_name'
);
//unset($sections['group']);//styling of groups doesnt work too well in the user page, it functions properly but its advised against
$user_meta = new Fluent_Options_User( $args, $sections );

//load taxonomy meta
$args = array(
    'dev_mode' => true,
    'option_name' => 'the_option_name',
    'taxonomies' => array(
        'fluent_taxonomy'
    )
);
//unset($sections['group']);//styling of groups doesnt work too well in the taxonomy page, it functions properly but its advised against
$tax_meta = new Fluent_Options_Taxonomy( $args, $sections );



//creating post types - all args are optional, added for documentation
$name = 'Fluent Post Type';//name will be converted to lowercase with underscores for spaces and dashes
new Fluent_Post_Type($name, array(
    //normal register_post_type() args, defaults used unless otherwise stated
    'labels'               => array(
        'name'               => sprintf(__('%ss', 'domain'), $name),
        'singular_name'      => $name,
        'menu_name'          => sprintf(__( '%ss', 'domain' ), $name),
        'name_admin_bar'     => sprintf(__( '%s', 'domain' ), $name),
        'add_new'            => __( 'Add New', 'domain' ),
        'add_new_item'       => sprintf(__( 'Add New %s', 'domain' ), $name),
        'new_item'           => sprintf(__( 'New %s', 'domain' ), $name),
        'edit_item'          => sprintf(__( 'Edit %s', 'domain' ), $name),
        'view_item'          => sprintf(__( 'View %s', 'domain' ), $name),
        'all_items'          => sprintf(__( 'All %ss', 'domain' ), $name),
        'search_items'       => sprintf(__( 'Search %ss', 'domain' ), $name),
        'parent_item_colon'  => sprintf(__( 'Parent %ss:', 'domain' ), $name),
        'not_found'          => sprintf(__( 'No %ss found.', 'domain' ), strtolower($name)),
        'not_found_in_trash' => sprintf(__( 'No %ss found in Trash.', 'domain' ), strtolower($name))
    ),
    'description'          => '',
    'public'               => true,
    'hierarchical'         => false,
    'exclude_from_search'  => null,
    'publicly_queryable'   => null,
    'show_ui'              => null,
    'show_in_menu'         => null,
    'show_in_nav_menus'    => null,
    'show_in_admin_bar'    => null,
    'menu_position'        => null,
    'menu_icon'            => null,
    'capability_type'      => 'post',
    'capabilities'         => array(),
    'map_meta_cap'         => null,
    'supports'             => array(),
    'register_meta_box_cb' => null,
    'taxonomies'           => array('post_tag'),//default is empty array, we have assigned the tag taxonomy for demostration purposes. Any taxonomies added here must be builtin or registered before the init priority 10. If you want to assign Fluent_Taxonomies you need to declare this post type when registering the taxonomy.
    'has_archive'          => true,//default = false but we have set to true so you can see the archive template overwrite
    'rewrite'              => true,
    'query_var'            => true,
    'can_export'           => true,
    'delete_with_user'     => null,
    '_edit_link'           => 'post.php?post=%d',
    //our custom messages array, defaults detailed below. this allows you to change the notices when posts are changed in some way without adding yet more filters
    'messages' => array(
        0  => '', // Unused. Messages start at index 1.
        1  => __( '%s updated.', 'domain' ),
        2  => __( 'Custom field updated.', 'domain' ),
        3  => __( 'Custom field deleted.', 'domain' ),
        4  => __( '%s updated.', 'domain' ),
        5  => __( '%s restored to revision from %s', 'domain' ),
        6  => __( '%s published.', 'domain' ),
        7  => __( '%s saved.', 'domain' ),
        8  => __( '%s submitted.', 'domain' ),
        9  => __( '%s scheduled for: <strong>%s</strong>.', 'domain' ),
        10 => __( '%s draft updated.', 'domain' )
    ),
    //want to disable people adding new posts?
    'disable_add_new' => false,
    //here you can set the template paths if creating the post type in a plugin, you can also set it to override the theme version with override = true. default behavior is to provide a fallback not to override.
    'templates' => array(
        'single' => array(//the single post page
            'override' => true,//default = false. set to true to force this to be used before the theme version
            'path' => dirname(FLUENT_FILE) . '/example-singular-template.php'//full path to file, default = false
        ),
        'archive' => array(//the archive/list page (if post type supports archives)
            'override' => true,//default = false. set to true to force this to be used before the theme version
            'path' => dirname(FLUENT_FILE) . '/example-archive-template.php'//full path to file, default = false
        )
    ),
));

//example of how simple it can be to create a post type
new Fluent_Post_Type('Simple Post Type');

//register some taxonomies - all args are optional, added for documentation
$name = 'Fluent Taxonomy';
new Fluent_Taxonomy($name, array(
    //normal register_taxonomy() args. all optional unless otherwise stated
    'labels'               => array(
        'name' => sprintf(__('%ss', 'domain'), $name),
        'singular_name' => $name,
        'search_items' => sprintf(__('Search %ss', 'domain'), $name),
        'popular_items' => sprintf(__('Popular %ss', 'domain'), $name),
        'all_items' => sprintf(__('All %ss', 'domain'), $name),
        'parent_item' => sprintf(__('Parent %ss', 'domain'), $name),
        'parent_item_colon' => sprintf(__('Parent %s:', 'domain'), $name),
        'edit_item' => sprintf(__('Edit %s', 'domain'), $name),
        'view_item' => sprintf(__('View %s', 'domain'), $name),
        'update_item' => sprintf(__('Update %s', 'domain'), $name),
        'add_new_item' => sprintf(__('Add New %s', 'domain'), $name),
        'new_item_name' => sprintf(__('Add New %s Name', 'domain'), $name),
        'separate_items_with_commas' => sprintf(__('Seperate %ss with commas', 'domain'), strtolower($name)),
        'add_or_remove_items' => sprintf(__('Add or remove %ss', 'domain'), strtolower($name)),
        'choose_from_most_used' => sprintf(__('Choose from the most used %ss', 'domain'), strtolower($name)),
        'not_found' => sprintf(__('No %ss found', 'domain'), strtolower($name)),
    ),
    'description'           => '',
    'public'                => true,
    'hierarchical'          => true,//default = false
    'show_ui'               => null,
    'show_in_menu'          => null,
    'show_in_nav_menus'     => null,
    'show_tagcloud'         => null,
    'meta_box_cb'           => null,
    'capabilities'          => array(),
    'rewrite'               => true,
    'query_var'             => true,
    'update_count_callback' => '',
    //here you can assign to post types right from the taxonomy register function.
    'post_types' => array('fluent_post_type'),//this is optional, but the taxonomy is useless without assigning it to a post type
    //here you can set the template paths if creating the taxonomy in a plugin, you can also set it to override the theme version with override = true. default behavior is to provide a fallback not to override.
    'templates' => array(
        'archive' => array(
            'override' => false,//default = false. set to true to force this to be used before the theme version
            'path' => false//dirname(FLUENT_FILE) . '/example-archive-template.php'//full path to file, default = false
        )
    ),
));
//this is how simple registering a taxonomy can be
new Fluent_Taxonomy('Simple Taxonomy', array('post_types' => array('simple_post_type')));


//create an instance of the support form and attach it to the store, this is used in a custom field type in the advanced section, but it can be put anywhere, in a help tab, dashboard widget, its really up to you.
$support = new Fluent_Support(array(
    'id' => 'fluent-framework',//must be unique, best to be the plugin/theme name from which you are using it
    'email' => 'your@emailaddress.com',//where to send the messages
    'subject' => __('Support Request', 'domain'),//the email subject sent to you
    'data' => array(//which data sets do you want checked on load - defaults are below
      'wordpress' => true,//version-multisite
      'plugins' => true,//active plugins and version
      'theme' => true,//active theme and version
      'php' => false,//phpinfo
      'server' => false//$_SERVER variable
    ),
    'success_message' => __('Your message has been sent successfully.', 'domain')//optionally provide a custom success message
));
//we need to store this so we can use it later on, make sure you use unique keys here too.
Fluent_Store::set('support', $support);

//heres an example adding the form as a dashboard widget
add_action('wp_dashboard_setup', function(){
    wp_add_dashboard_widget('example_fluent_support_form_widget', 'Example Fluent Support Form Widget', function(){
        //fetch the object from the store
        $support = Fluent_Store::get('support');
        //render the form
        $support->the_form();
        //you could also echo the form using the get_** function
        //echo $support->get_form();
    });
});

//heres another example adding it to a help tab
add_action('admin_head', function(){
    $screen = get_current_screen();
    $screen->add_help_tab( array( 
       'id' => 'fluent-demo-support-form-help-tab',
       'title' => __('Fluent Support Form', 'domain'),
       'callback' => function(){
            //fetch the object from the store
            $support = Fluent_Store::get('support');
            //render the form
            $support->the_form();
       }
    ) );
});
