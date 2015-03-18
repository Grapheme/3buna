<?php

class ApplicationController extends BaseController {

    public static $name = 'application';
    public static $group = 'application';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {

        Route::group(array(), function() {

            Route::any('/ajax/send-message', array('as' => 'app.send-message', 'uses' => __CLASS__.'@postSendMessage'));
            Route::any('/ajax/order-billboard', array('as' => 'app.order-billboard', 'uses' => __CLASS__.'@postOrderBillboard'));
        });
    }


    /****************************************************************************/


	public function __construct(){
        #
	}


    public function postSendMessage() {

        #Helper::dd(Input::all());

        /*
        $name = Input::get('name');
        $email = Input::get('email');
        $text = Input::get('text');
        */

        $json_request = array('status' => FALSE, 'responseText' => '');

        /**
         * Более-менее стандартный функционал для отправки сообщения на e-mail
         */
        $data = Input::all();
        Mail::send('emails.feedback', $data, function ($message) use ($data) {

            #$message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));

            /**
             * Данные (адрес и имя) для отправки сообщения, берутся из словаря Опции
             */
            #/*
            $from_email = Dic::valueBySlugs('options', 'from_email');
            $from_email = is_object($from_email) && isset($from_email->name) ? $from_email->name : (Config::get('mail.from.address') ?: 'no@reply.ru');
            $from_name = Dic::valueBySlugs('options', 'from_name');
            $from_name = is_object($from_name) && isset($from_name->name) ? $from_name->name : (Config::get('mail.from.name') ?: 'No-reply');
            #*/

            /**
             * Адрес, на который будет отправлено письмо, берется из словаря Опции
             */
            $email = Dic::valueBySlugs('options', 'email');
            $email = is_object($email) && isset($email->name) ? $email->name : (Config::get('mail.feedback.address') ?: 'dev@null.ru');

            /**
             * Если в адресе есть запятая - значит нужно отправить копию на все адреса
             */
            $ccs = array();
            if (strpos($email, ',')) {
                $ccs = explode(',', $email);
                foreach ($ccs as $e => $email)
                    $ccs[$e] = trim($email);
                $email = array_shift($ccs);
            }

            $message->from($from_email, $from_name);
            $message->subject('Сообщение обратной связи - ' . @$data['name']);
            $message->to($email);

            if (isset($ccs) && is_array($ccs) && count($ccs))
                foreach ($ccs as $cc)
                    $message->cc($cc);
        });

        $json_request['status'] = TRUE;
        #$json_request['responseText'] = Input::all();

        return Response::json($json_request, 200);

        return '1';
    }



    public function postOrderBillboard() {

        #Helper::ta((array)Input::get('billboards'));

        $billboards = Dic::valuesBySlugAndIds('billboards', (array)Input::get('billboards'));

        #Helper::ta($billboards);
        #header('HTTP/1.0 404 Not Found');
        #die;


        $json_request = array('status' => FALSE, 'responseText' => '');

        /**
         * Более-менее стандартный функционал для отправки сообщения на e-mail
         */
        $data = Input::all();
        $data['billboards'] = $billboards;
        Mail::send('emails.order-billboard', $data, function ($message) use ($data) {

            #$message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));

            /**
             * Данные (адрес и имя) для отправки сообщения, берутся из словаря Опции
             */
            #/*
            $from_email = Dic::valueBySlugs('options', 'from_email');
            $from_email = is_object($from_email) && isset($from_email->name) ? $from_email->name : (Config::get('mail.from.address') ?: 'no@reply.ru');
            $from_name = Dic::valueBySlugs('options', 'from_name');
            $from_name = is_object($from_name) && isset($from_name->name) ? $from_name->name : (Config::get('mail.from.name') ?: 'No-reply');
            #*/

            /**
             * Адрес, на который будет отправлено письмо, берется из словаря Опции
             */
            $email = Dic::valueBySlugs('options', 'order_email');
            $email = is_object($email) && isset($email->name) ? $email->name : (Config::get('mail.feedback.address') ?: 'dev@null.ru');

            /**
             * Если в адресе есть запятая - значит нужно отправить копию на все адреса
             */
            $ccs = array();
            if (strpos($email, ',')) {
                $ccs = explode(',', $email);
                foreach ($ccs as $e => $email)
                    $ccs[$e] = trim($email);
                $email = array_shift($ccs);
            }

            $message->from($from_email, $from_name);
            $message->subject('Заявка на размещение - ' . @$data['org']);
            $message->to($email);

            if (isset($ccs) && is_array($ccs) && count($ccs))
                foreach ($ccs as $cc)
                    $message->cc($cc);
        });



        if (count($billboards)) {

            #Helper::ta($billboards);
            #header('HTTP/1.0 404 Not Found');
            #die;

            foreach ($billboards as $billboard) {

                if ($billboard->status == 'free') {

                    $carbon = \Carbon\Carbon::now();
                    $carbon->addDays(5);

                    $billboard->update_field('status', 'reserved');
                    $billboard->update_field('status_limit', $carbon->format('Y-m-d'));
                }

                $billboard->update_field('need_manual_check', 1);
            }
            #$billboards = Helper::arrayForSelect($billboards, 'name');
        }


        $json_request['status'] = TRUE;
        #$json_request['responseText'] = Input::all();

        return Response::json($json_request, 200);

        return '1';
    }

}