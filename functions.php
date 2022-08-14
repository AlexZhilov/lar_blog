<?php


if( !function_exists('d')){
    /**
     * Дебаг элементов
     * @param $elem
     * @param int $var_dump
     * @param int $die
     */
    function d($elem, $var_dump = 0, $die = 0){
        echo '<pre>';

        if((int)$var_dump)
            var_dump($elem);
        else
            print_r($elem);

        echo '</pre>';

        if((int)$die)
            die;
    }
}