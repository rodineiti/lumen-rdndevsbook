<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    const LIMIT = 10;

    public function success($msg = 'Arquivo excluido com sucesso', $time = 1200) 
    {
        return response()->json(['status' => 200, 'success' => $msg, 'time' => $time], 200);
    }

    public function error($msg = 'Erro ao excluir arquivo', $time = 1200)
    {
        return response()->json(['status' => 400, 'error' => $msg, 'time' => $time], 200);
    }

    public function validateUrl($string)
    {
        $Format = array();
        $Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'´<>°ºª';
        $Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                  ';
        $Data = strtr(utf8_decode($string), utf8_decode($Format['a']), $Format['b']);
        $Data = strip_tags(trim($Data));
        $Data = str_replace(' ', '-', $Data);
        $Data = str_replace(array('-----', '----', '---', '--'), '-', $Data);
        return strtolower(utf8_encode($Data));
    }
}
