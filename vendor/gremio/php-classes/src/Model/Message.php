<?php

namespace gremio\Model;


class Message  
{
    public static function throwMessage($tipo, $sucesso, $mensagem) {
        header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
        exit;
    }
}


?>