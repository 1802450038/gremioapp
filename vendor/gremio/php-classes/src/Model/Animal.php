<?php

namespace prefeitura\Model;

use \prefeitura\DB\Sql;
use \prefeitura\Model;

class Animal extends Model
{




    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_animal");
    }



    public function listById($animal_id)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_animal WHERE animal_id='{$animal_id}'");



        if (sizeof($result) > 0) {
            return $this->setData($result[0]);
        } else {
            return false;
        }
    }

    public function getConductorIdById($animal_id)
    {
        $sql = new Sql();

        return  $sql->select("SELECT conductor_id FROM tb_animal WHERE animal_id='{$animal_id}'");
    }


    public static function listByConductorId($conductor_id)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_animal WHERE conductor_id='{$conductor_id}'");

        return $result;
    }


    public static function listByUniqueTag($animal_uniquetag)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_animal WHERE animal_uniquetag='{$animal_uniquetag}'");

        return $result;
    }
    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT animal_uniquetag  FROM tb_animal");

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
        $uniqueTag = $this->getUniqueTag();
        if ($uniqueTag != null) {
            $sql->query("INSERT INTO tb_animal (
                conductor_id,
                animal_uniquetag,
                animal_name,
                animal_species,
                animal_coat,
                animal_age,
                animal_markings,
                animal_note,
                animal_frontalpicture,
                animal_leftpicture,
                animal_rightpicture,
                animal_backpicture
                ) VALUES(
                    '{$conductor_id}',
                    '{$uniqueTag}',
                    '{$this->getanimal_name()}',
                    '{$this->getanimal_species()}',
                    '{$this->getanimal_coat()}',
                    '{$this->getanimal_age()}',
                    '{$this->getanimal_markings()}',
                    '{$this->getanimal_note()}',
                    '{$this->getanimal_frontalpicture()}',
                    '{$this->getanimal_leftpicture()}',
                    '{$this->getanimal_rightpicture()}',
                    '{$this->getanimal_backpicture()}'
                    )",);
        $results2 = $sql->select("SELECT animal_id FROM tb_animal
        WHERE animal_id = LAST_INSERT_ID()");
        return $results2[0];
        } else {
            return "Falaha ao adicionar Conflito de TAG";
        }
    }


    public function update($id)
    {
        $sql = new Sql();

        $results = $sql->query("UPDATE tb_animal SET 
            animal_name='{$this->getanimal_name()}',
            animal_species='{$this->getanimal_species()}',
            animal_coat='{$this->getanimal_coat()}',
            animal_age='{$this->getanimal_age()}',
            animal_markings='{$this->getanimal_markings()}',
            animal_note='{$this->getanimal_note()}',
            animal_frontalpicture='{$this->getanimal_frontalpicture()}',
            animal_rightpicture='{$this->getanimal_rightpicture()}',
            animal_leftpicture='{$this->getanimal_leftpicture()}',
            animal_backpicture='{$this->getanimal_backpicture()}'
            WHERE animal_id='{$id}'");
        return $results;
    }

    public function delete()
    {
        $sql = new Sql();

        $this->removePicture($this->getanimal_frontalpicture());
        $this->removePicture($this->getanimal_rightpicture());
        $this->removePicture($this->getanimal_backpicture());
        $this->removePicture($this->getanimal_leftpicture());

        $sql->query("DELETE FROM tb_animal  WHERE animal_id='{$this->getanimal_id()}'");
    }

    public function removePicture($picture)
    {
        if ($picture == "/res/_assets/_defaultimg/horse.jpg") {
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
            if ($tag === $allTags[$i]["animal_uniquetag"]) {
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
        $type = "AN";
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
                "_animalimg" . DIRECTORY_SEPARATOR .
                $direction .
                $this->getanimal_uniquetag() . ".jpg"
        )) {
            $url = "/res/_assets/_animalimg/" . $direction . $this->getanimal_uniquetag() . ".jpg";
        } else {
            $url = "/res/_assets/_defaultimg/horse.jpg";
        }
        switch ($direction) {
            case "frontal":
                return $this->setanimal_frontalpicture($url);
                break;
            case "left":
                return $this->setanimal_leftpicture($url);
                break;
            case "right":
                return $this->setanimal_rightpicture($url);
                break;
            case "back":
                return $this->setanimal_backpicture($url);
                break;
            default:
                $this->setanimal_frontalpicture("");
                $this->setanimal_leftpicture("");
                $this->setanimal_rightpicture("");
                $this->setanimal_backpicture("");
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
        }

        $dist =  $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
            "res" . DIRECTORY_SEPARATOR .
            "_assets" . DIRECTORY_SEPARATOR .
            "_animalimg" . DIRECTORY_SEPARATOR .
            $direction .
            $this->getanimal_uniquetag() .
            ".jpg";

        imagejpeg($image, $dist);

        imagedestroy($image);

        $this->checkphoto($direction);
    }
}
