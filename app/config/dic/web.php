<?php

return array(

    'fields' => function() {

        return array(
            'description' => array(
                'title' => 'Описание',
                'type' => 'textarea',
            ),
            'gallery' => array(
                'title' => 'Фотографии',
                'type' => 'gallery',
                'params' => array(
                    'maxfilesize' => 10, // MB
                    'acceptedfiles' => 'image/*',
                ),
                'handler' => function($array, $element) {
                    return ExtForm::process('gallery', array(
                        'module'  => 'DicValMeta',
                        'unit_id' => $element->id,
                        'gallery' => $array,
                        'single'  => true,
                    ));
                }
            ),
        );
    },

    'seo' => 0,

    'versions' => false,

);