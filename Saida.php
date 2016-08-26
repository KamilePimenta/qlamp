<?php

class Saida
{
    static public function json($msg, $erro = false)
    {
        die(json_encode([
            'erro' => $erro,
            'msg'  => $msg
        ]));
    }
}