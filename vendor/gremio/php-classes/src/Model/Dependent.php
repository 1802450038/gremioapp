<?php

namespace prefeitura\Model;

use \prefeitura\DB\Sql;
use \prefeitura\Model;

class Dependent extends Model
{




    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_dependent");
    }

    public function listById($dependent_id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_dependent WHERE dependent_id='{$dependent_id}'");

        if (sizeof($result) > 0) {
            return $this->setData($result[0]);
        } else {
            return false;
        }
    }

    public static function listByConductorId($conductor_id)
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_dependent WHERE conductor_id='{$conductor_id}'");
    }

    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT dependent_uniquetag  FROM tb_dependent");

        return $result;
    }

    public function create($conductor_id)
    {
        $sql = new Sql();
        $uniqueTag = $this->getUniqueTag();
        if ($uniqueTag != null) {
            $result =  $sql->query("INSERT INTO tb_dependent (
            conductor_id,
            dependent_uniquetag,
            dependent_name,
            dependent_identity,
            dependent_cpf,
            dependent_age,
            dependent_phone,
            dependent_note,
            dependent_schooling,
            dependent_familiarity
            ) VALUES(
                '{$conductor_id}',
                '{$uniqueTag}',
                '{$this->getdependent_name()}',
                '{$this->getdependent_identity()}',
                '{$this->getdependent_cpf()}',
                '{$this->getdependent_age()}',
                '{$this->getdependent_phone()}',
                '{$this->getdependent_note()}',
                '{$this->getdependent_schooling()}',
                '{$this->getdependent_familiarity()}'
                )",);

            $results2 = $sql->select("SELECT dependent_id FROM tb_dependent
            WHERE dependent_id = LAST_INSERT_ID()");
            return $results2[0];
        } else {
            return 0;
        }
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
                $result = $sql->select("SELECT $field FROM tb_dependent WHERE $field = '$value'");
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
                    $result = $sql->select("SELECT $field FROM tb_dependent WHERE $field = '$value'");
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

    public function update($id)
    {
        $sql = new Sql();

        $results = $sql->query("UPDATE tb_dependent SET 
            dependent_name='{$this->getdependent_name()}',
            dependent_identity='{$this->getdependent_identity()}',
            dependent_cpf='{$this->getdependent_cpf()}',
            dependent_age='{$this->getdependent_age()}',
            dependent_phone='{$this->getdependent_phone()}',
            dependent_note='{$this->getdependent_note()}',
            dependent_schooling='{$this->getdependent_schooling()}',
            dependent_familiarity='{$this->getdependent_familiarity()}'
            WHERE dependent_id='{$id}'");

        return $results;
    }

    public function delete()
    {
        $sql = new Sql();

        $sql->query("DELETE FROM tb_dependent  WHERE dependent_id='{$this->getdependent_id()}'");
    }


    public function verifyTag($tag)
    {
        $allTags = $this->listAllUniqueTag();

        for ($i = 0; $i < sizeof($allTags); $i++) {
            if ($tag === $allTags[$i]["dependent_uniquetag"]) {
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
        $type = "DP";
        $uniqueTag = $prefix . $today . $ranNumber . $type;
        if ($this->verifyTag($uniqueTag)) {
            return $uniqueTag;
        } else {
            $this->getUniqueTag();
        }
    }
}
