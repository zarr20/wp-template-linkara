<?php
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group(array(
        'key' => 'group_faq_section',
        'title' => 'FAQ Section',
        'fields' => array(
            array(
                'key' => 'field_faq_section_title',
                'label' => 'Section Title',
                'name' => 'faq_section_title',
                'type' => 'text',
                'instructions' => 'Judul untuk section FAQ',
                'required' => 0,
                'wrapper' => array(
                    'width' => '',
                ),
            ),
            array(
                'key' => 'field_faq_section_description',
                'label' => 'Section Description',
                'name' => 'faq_section_description',
                'type' => 'textarea',
                'instructions' => 'Deskripsi singkat untuk section FAQ',
                'rows' => 3,
                'required' => 0,
                'wrapper' => array(
                    'width' => '',
                ),
            ),
            array(
                'key' => 'field_faq_section',
                'label' => 'FAQ Section',
                'name' => 'faq_section',
                'type' => 'repeater',
                'instructions' => 'Add FAQ items',
                'min' => 0,
                'layout' => 'block',
                'button_label' => 'Add FAQ',
                'sub_fields' => array(
                    array(
                        'key' => 'field_faq_question',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_faq_answer',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'textarea',
                        'required' => 1,
                        'rows' => 4,
                        'wrapper' => array(
                            'width' => '',
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'data-page',
                ),
            ),
        ),
        'menu_order' => 2,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
        'description' => '',
    ));

endif;
