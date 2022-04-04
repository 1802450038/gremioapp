<?php

namespace prefeitura\Model;

use \prefeitura\DB\Sql;
use \prefeitura\Model;

class Conductor extends Model
{

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_conductor");
    }

    public function listConductorsPageSearch($type = "conductor_name", $term = "", $page = 1, $itemsPerPage = 10)
    {

        $start = ($page - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_conductor
			WHERE $type LIKE '%$term%'
            ORDER BY conductor_dtregister DESC
			LIMIT $start, $itemsPerPage;
		",);

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

        return [
            'conductors' => $results,
            'total' => (int)$resultTotal[0]["nrtotal"],
            'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        ];
    }

    public static function listByUniqueTag($conductor_uniquetag)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_conductor WHERE conductor_uniquetag='{$conductor_uniquetag}'");

        return $result;
    }
    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT conductor_uniquetag  FROM tb_conductor");

        return $result;
    }

    public function create()
    {
        $sql = new Sql();
        $uniqueTag = $this->getUniqueTag();
        if ($uniqueTag != null) {
            $sql->query("INSERT INTO tb_conductor (
            conductor_uniquetag,
            conductor_name,
            conductor_note,
            conductor_identity,
            conductor_phone,
            conductor_cpf,
            conductor_age,
            conductor_schooling,
            conductor_socialbenefit,
            conductor_familyincome,
            conductor_profilepicture,
            conductor_cppicture,
            conductor_frontidentitypicture,
            conductor_backidentitypicture
            ) VALUES(
                '{$uniqueTag}',
                '{$this->getconductor_name()}',
                '{$this->getconductor_note()}',
                '{$this->getconductor_identity()}',
                '{$this->getconductor_phone()}',
                '{$this->getconductor_cpf()}',
                '{$this->getconductor_age()}',
                '{$this->getconductor_schooling()}',
                '{$this->getconductor_socialbenefit()}',
                '{$this->getconductor_familyincome()}',
                '{$this->getconductor_profilepicture()}',
                '{$this->getconductor_cppicture()}',
                '{$this->getconductor_frontidentitypicture()}',
                '{$this->getconductor_backidentitypicture()}'
                )",);

            $results2 = $sql->select("SELECT conductor_id FROM tb_conductor
            WHERE conductor_id = LAST_INSERT_ID()");
            if (count($results2)){
                return $results2[0];
            } else {
                return "Falha ao adicionar";
            }
        } else {
            return "Falha ao adicionar Conflito de TAG";
        }
    }


    public  function get($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_conductor WHERE conductor_id='$id'");


        return $this->setData($result[0]);
    }

    public static function getConductorName($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT conductor_name FROM tb_conductor WHERE conductor_id='$id'");


        return $result;
    }

    public function update($id)
    {
        $sql = new Sql();

        $results = $sql->query("UPDATE tb_conductor SET 
            conductor_name='{$this->getconductor_name()}',
            conductor_note='{$this->getconductor_note()}',
            conductor_identity='{$this->getconductor_identity()}',
            conductor_phone='{$this->getconductor_phone()}',
            conductor_cpf='{$this->getconductor_cpf()}',
            conductor_age='{$this->getconductor_age()}',
            conductor_schooling='{$this->getconductor_schooling()}',
            conductor_socialbenefit='{$this->getconductor_socialbenefit()}',
            conductor_familyincome='{$this->getconductor_familyincome()}',
            conductor_profilepicture='{$this->getconductor_profilepicture()}',
            conductor_cppicture='{$this->getconductor_cppicture()}',
            conductor_frontidentitypicture='{$this->getconductor_frontidentitypicture()}',
            conductor_backidentitypicture='{$this->getconductor_backidentitypicture()}'
            WHERE conductor_id='{$id}'");

        return $results;
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
            if ($type === "C") {
                $sql = new Sql();
                $result = $sql->select("SELECT $field FROM tb_conductor WHERE $field = '$value'");
                if (count($result) > 0) {
                    $tipo = "Erro";
                    $sucesso = '0';
                    $mensagem = "$fieldName invalido";
                    header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
                    exit;
                } else {
                    return true;
                }
            } else if ($type === "U") {
                if ($value === $prev_value) {
                    return true;
                } else {
                    $sql = new Sql();
                    $result = $sql->select("SELECT $field FROM tb_user WHERE $field = '$value'");
                    if (count($result) > 0) {
                        $tipo = "Erro";
                        $sucesso = '0';
                        $mensagem = "$fieldName invalido";
                        header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
                        exit;
                    } else {
                        return true;
                    }
                }
            }
        }
    }

    public function delete()
    {
        $sql = new Sql();

        $this->removePicture($this->getconductor_profilepicture());
        $this->removePicture($this->getconductor_cppicture());
        $this->removePicture($this->getconductor_frontidentitypicture());
        $this->removePicture($this->getconductor_backidentitypicture());

        $sql->query("DELETE FROM tb_conductor  WHERE conductor_id='{$this->getconductor_id()}'");
    }

    public function removePicture($picture)
    {
        if ($picture == "/res/_assets/_defaultimg/user.jpg") {
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
            if ($tag === $allTags[$i]["conductor_uniquetag"]) {
                return false;
            }
        }
        return true;
    }

    public function getUniqueTag()
    {
        $prefix = "URU-";
        $ranNumber = rand(100, 9999);
        $today = getdate()["year"] - 2000;
        $type = "CD";
        $uniqueTag = $prefix . $today . $ranNumber . $type;
        if ($this->verifyTag($uniqueTag)) {
            return $uniqueTag;
        } else {
            $this->getUniqueTag();
        }
    }

    public function checkphoto($type)
    {
        if (file_exists(
            $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
                "res" . DIRECTORY_SEPARATOR .
                "_assets" . DIRECTORY_SEPARATOR .
                "_conductorimg" . DIRECTORY_SEPARATOR .
                $type .
                $this->getconductor_uniquetag() . ".jpg"
        )) {
            $url = "/res/_assets/_conductorimg/" . $type . $this->getconductor_uniquetag() . ".jpg";
        } else {
            $url = "/res/_assets/_defaultimg/user.jpg";
        }
        switch ($type) {
            case "profile":
                return $this->setconductor_profilepicture($url);
                break;
            case "cp":
                return $this->setconductor_cppicture($url);
                break;
            case "frontal":
                return $this->setconductor_frontidentitypicture($url);
                break;
            case "back":
                return $this->setconductor_backidentitypicture($url);
                break;
            default:
                $this->setconductor_profilepicture("");
                $this->setconductor_cpfpicture("");
                $this->setconductor_frontidentitypicture("");
                $this->setconductor_backidentitypicture("");
                return false;
                break;
        }
    }

    public function setPhoto($photo, $type)
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
            "_conductorimg" . DIRECTORY_SEPARATOR .
            $type .
            $this->getconductor_uniquetag() .
            ".jpg";

        imagejpeg($image, $dist);

        imagedestroy($image);

        $this->checkphoto($type);
    }
}
