<?php

return array(

    'fields' => function($dicval) {

        /**
         * Предзагружаем нужные словари с данными, по системному имени словаря, для дальнейшего использования.
         * Делается это одним SQL-запросом, для снижения нагрузки на сервер БД.
         */
        $dics_slugs = array(
            'areas',
        );
        $dics = Dic::whereIn('slug', $dics_slugs)->with('values')->get();
        $dics = Dic::modifyKeys($dics, 'slug');
        #Helper::tad($dics);
        $lists = Dic::makeLists($dics, 'values', 'name', 'id');
        $lists_ids = Dic::makeLists($dics, null, 'id', 'slug');
        #Helper::dd($lists);

        return array(
            'area_id' => array(
                'title' => 'Район',
                'type' => 'select',
                'values' => $lists['areas'], ## Используется предзагруженный словарь
                'default' => Input::get('filter.fields.area_id') ?: null,
            ),

            'address' => array(
                'title' => 'Адрес',
                'type' => 'text',
            ),
            'map' => array(
                'type' => 'custom',
                'content' => View::make('system.views.map_google_block', [
                    'element' => $dicval,

                    #'map_id' => 'map',
                    #'map_style' => 'height:300px;',
                ])->render(),
                'scripts' => View::make('system.views.map_google_script', [
                    'element' => $dicval,

                    #'map_id' => 'map',
                    #'map_type' => 'google.maps.MapTypeId.ROADMAP',
                    #'field_address' => 'address',
                    #'field_lat' => 'lat',
                    #'field_lng' => 'lng',
                    #'keyup_timer' => 1200,

                    'geo_prefix' => 'Россия, Ростов-на-Дону, ',
                    'default_lat' => '47.25221300',
                    'default_lng' => '39.69359700',
                    'default_zoom' => '11',
                ])->render(),
            ),
            'lat' => array(
                'title' => 'Широта',
                'type' => 'text',
            ),
            'lng' => array(
                'title' => 'Долгота',
                'type' => 'text',
            ),

            'price' => array(
                'title' => 'Цена за месяц размещения, в рублях (целое число)',
                'type' => 'text',
            ),
            'photo' => array(
                'title' => 'Фотография',
                'type' => 'image',
                'params' => array(
                    'maxFilesize' => 4, // MB
                    'acceptedFiles' => 'image/*',
                ),
            ),

            'status' => array(
                'title' => 'Статус щита',
                'type' => 'select',
                'values' => Config::get('site.billboard_statuses'),
            ),
            'status_limit' => array(
                'title' => 'Резерв/занят до',
                'type' => 'date',
                'others' => array(
                    'class' => 'text-center',
                    'style' => 'width: 221px',
                    'placeholder' => 'Нажмите для выбора'
                ),
                'handler' => function($value) {
                    return $value ? @date('Y-m-d', strtotime($value)) : $value;
                },
                'value_modifier' => function($value) {
                    return $value ? date('d.m.Y', strtotime($value)) : date('d.m.Y');
                },
            ),
            'need_manual_check' => array(
                'no_label' => true,
                'title' => 'Статус был изменен, требуется ручная проверка',
                'type' => 'checkbox',
                'label_class' => 'normal_checkbox',
            ),


        );
    },

    'seo' => 0,

    'versions' => false,

);