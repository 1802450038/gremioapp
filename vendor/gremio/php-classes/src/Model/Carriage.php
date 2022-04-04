<?php

namespace prefeitura\Model;

use \prefeitura\DB\Sql;
use \prefeitura\Model;

class Carriage extends Model
{

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_carriage");
    }



    public function listById($carriage_id)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_carriage WHERE carriage_id='{$carriage_id}'");

        if (sizeof($result) > 0) {
            return $this->setData($result[0]);
        } else {
            return false;
        }
    }



    public static  function listByConductorId($conductor_id)
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_carriage WHERE conductor_id='{$conductor_id}'");
    }

    public function getConductorIdById($carriage_id)
    {
        $sql = new Sql();

        return  $sql->select("SELECT conductor_id FROM tb_carriage WHERE carriage_id='{$carriage_id}'");
    }


    public static function listByUniqueTag($carriage_uniquetag)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_carriage WHERE carriage_uniquetag='{$carriage_uniquetag}'");

        return $result;
    }
    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT carriage_uniquetag  FROM tb_carriage");

        return $result;
    }

    public function verifyField($field, $fieldName, $fieldLen, $value, $extra, $type, $prev_value = "")
    {
        if (strlen($value) < $fieldLen) {
            $tipo = "Erro";
            $sucesso = '0';
            $mensagem = "O Campo $fieldName devem ter pelo menos $extra caracteres";
            header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
            exit;
        } else {
            return true;
        }
    }

    public function create($conductor_id)
    {
        $sql = new Sql();
        $uniqueTag = $this->getcarriage_uniquetag();
        if ($uniqueTag != null) {
            $sql->query("INSERT INTO tb_carriage (
                conductor_id,
                carriage_uniquetag,
                carriage_type,
                carriage_color,
                carriage_numberofaxes,
                carriage_width,
                carriage_length,
                carriage_height,
                carriage_note,
                carriage_leftpicture,
                carriage_frontalpicture,
                carriage_rightpicture,
                carriage_backpicture
                ) VALUES(
                    '{$conductor_id}',
                    '{$uniqueTag}',
                    '{$this->getcarriage_type()}',
                    '{$this->getcarriage_color()}',
                    '{$this->getcarriage_numberofaxes()}',
                    '{$this->getcarriage_width()}',
                    '{$this->getcarriage_length()}',
                    '{$this->getcarriage_height()}',
                    '{$this->getcarriage_note()}',
                    '{$this->getcarriage_leftpicture()}',
                    '{$this->getcarriage_frontalpicture()}',
                    '{$this->getcarriage_rightpicture()}',
                    '{$this->getcarriage_backpicture()}'
                    )",);
            $results2 = $sql->select("SELECT carriage_id FROM tb_carriage
            WHERE carriage_id = LAST_INSERT_ID()");
            return $results2[0];
        } else {
            return "Falha ao adicionar Conflito de TAG";
        }
    }


    public function update($id)
    {
        $sql = new Sql();

        $results = $sql->query("UPDATE tb_carriage SET 
            carriage_type='{$this->getcarriage_type()}',
            carriage_color='{$this->getcarriage_color()}',
            carriage_numberofaxes='{$this->getcarriage_numberofaxes()}',
            carriage_width='{$this->getcarriage_width()}',
            carriage_length='{$this->getcarriage_length()}',
            carriage_height='{$this->getcarriage_height()}',
            carriage_note='{$this->getcarriage_note()}',
            carriage_frontalpicture = '{$this->getcarriage_frontalpicture()}',
            carriage_rightpicture = '{$this->getcarriage_rightpicture()}',
            carriage_backpicture = '{$this->getcarriage_backpicture()}',
            carriage_leftpicture = '{$this->getcarriage_leftpicture()}'
            WHERE carriage_id='{$id}'");

        return $results;
    }

    public function delete()
    {
        $sql = new Sql();

        $this->removePicture($this->getcarriage_frontalpicture());
        $this->removePicture($this->getcarriage_rightpicture());
        $this->removePicture($this->getcarriage_backpicture());
        $this->removePicture($this->getcarriage_leftpicture());

        $sql->query("DELETE FROM tb_carriage  WHERE carriage_id='{$this->getcarriage_id()}'");
    }


    public function removePicture($picture)
    {
        if ($picture == "/res/_assets/_defaultimg/carriage.jpg") {
            echo "IMAGEM PADRÃO";
        } else {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $picture)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $picture);
                echo "File Successfully Delete.";
            } else {
                echo "File does not exists or default picture";
            }
        }
    }


    public function verifyTag($tag)
    {
        $allTags = $this->listAllUniqueTag();
        for ($i = 0; $i < sizeof($allTags); $i++) {
            if ($tag === $allTags[$i]["carriage_uniquetag"]) {
                return false;
            }
        }
        return true;
    }

    public function getUniqueTag()
    {
        $prefix = "URU-";
        $ranNumber = rand(100, 999);
        $today = getdate()["year"] - 2000;
        $type = "VH";
        $uniqueTag = $prefix . $today . $ranNumber . $type;
        if ($this->verifyTag($uniqueTag)) {
            return $uniqueTag;
        } else {
            $this->getUniqueTag();
        }
    }

    public function checkphoto($direction)
    {
        if (file_exists(
            $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
                "res" . DIRECTORY_SEPARATOR .
                "_assets" . DIRECTORY_SEPARATOR .
                "_carriageimg" . DIRECTORY_SEPARATOR .
                $direction .
                $this->getcarriage_uniquetag() . ".jpg"
        )) {
            $url = "/res/_assets/_carriageimg/" . $direction . $this->getcarriage_uniquetag() . ".jpg";
        } else {
            $url = "/res/_assets/_defaultimg/carriage.jpg";
        }
        switch ($direction) {
            case "frontal":
                return $this->setcarriage_frontalpicture($url);
                break;
            case "left":
                return $this->setcarriage_leftpicture($url);
                break;
            case "right":
                return $this->setcarriage_rightpicture($url);
                break;
            case "back":
                return $this->setcarriage_backpicture($url);
                break;
            default:
                $this->setcarriage_frontalpicture("");
                $this->setcarriage_leftpicture("");
                $this->setcarriage_rightpicture("");
                $this->setcarriage_backpicture("");
                return false;
                break;
        }
    }

    public function setPhoto($photo, $direction)
    {

        $extension = explode('.', $photo['name']);
        $extension = end($extension);

        switch ($extension) {

            case "jpg":
            case "jpeg":
                $image = imagecreatefromjpeg($photo["tmp_name"]);
                break;

            case "gif":
                $image = imagecreatefromgif($photo["tmp_name"]);
                break;

            case "png":
                $image = imagecreatefrompng($photo["tmp_name"]);
                break;
            case "webp":
                $image = imagecreatefromwebp($photo["tmp_name"]);
                break;
        }

        $dist =  $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
            "res" . DIRECTORY_SEPARATOR .
            "_assets" . DIRECTORY_SEPARATOR .
            "_carriageimg" . DIRECTORY_SEPARATOR .
            $direction .
            $this->getcarriage_uniquetag() .
            ".jpg";

        imagejpeg($image, $dist);

        imagedestroy($image);

        $this->checkphoto($direction);
    }
}
