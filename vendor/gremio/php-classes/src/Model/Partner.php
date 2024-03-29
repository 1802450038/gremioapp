<?php

namespace gremio\Model;

use \gremio\DB\Sql;
use \gremio\Model;

class Partner extends Model
{

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_partner");
    }

    public function listPertnersPageSearch($type = "partner_fullname", $term = "", $page = 1, $itemsPerPage = 10)
    {

        $start = ($page - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_partner
			WHERE $type LIKE '%$term%'
            ORDER BY partner_dtregister DESC
			LIMIT $start, $itemsPerPage;
		",);

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

        return [
            'partners' => $results,
            'total' => (int)$resultTotal[0]["nrtotal"],
            'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        ];
    }

    public static function listByUniqueTag($partner_uniquetag)
    {

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_partner WHERE partner_uniquetag='{$partner_uniquetag}'");

        return $result;
    }
    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT partner_uniquetag  FROM tb_partner");

        return $result;
    }

    public  function get($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_partner WHERE partner_id='$id'");


        return $this->setData($result[0]);
    }

    public static function getPartnerName($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT partner_fullname FROM tb_partner WHERE partner_id='$id'");

        return $result[0]["partner_fullname"];
    }

    public static function getAssocType($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT partner_assoctype FROM tb_partner WHERE partner_id='$id'");

        return $result[0]["partner_assoctype"];
    }



    public function calcAge($date)
    {
        return date_diff(date_create($date), date_create('now'))->y;
    }

    public static function getMonthlValueById($id)
    {
        $assoctype = Partner::getAssocType($id);
        switch ($assoctype) {

            case "CIVIL":
                return "60,00";
                break;
            case "MILITAR SEM DESCONTO EM FOLHA":
                return "60,00";
                break;
            default:
                return "ISENTO";
                break;
        }
    }

    public static function getMonthlValue($assoctype)
    {
        switch ($assoctype) {

            case "CIVIL":
                return "60,00";
                break;
            case "MILITAR SEM DESCONTO EM FOLHA":
                return "60,00";
                break;
            default:
                return "ISENTO";
                break;
        }
    }

    public function getPaymentStatus($id)
    {
        $payments = Payment::listByPartnerId($id);

        foreach ($payments as $key => $value) {
            if ($value["payment_status"] == "ATRASADO") {
                return "ATRASADO ";
            }
        }
        return "EM DIA";
    }

    public function create()
    {
        $sql = new Sql();
        $uniqueTag = $this->getUniqueTag();
        if ($uniqueTag != null) {
            $sql->query("INSERT INTO tb_partner (
                    partner_uniquetag,
                    partner_fullname,
                    partner_cpf,
                    partner_identity,
                    partner_dtnasc,
                    partner_resphone,
                    partner_mobphone,
                    partner_age,
                    partner_email,
                    partner_milorganization,
                    partner_assoctype,
                    partner_dtassoc,
                    partner_paymentday,
                    partner_monthlypayment
                    ) VALUES(
                        '{$uniqueTag}',
                        '{$this->getpartner_fullname()}',
                        '{$this->getpartner_cpf()}',
                        '{$this->getpartner_identity()}',
                        '{$this->getDateForDatabase($this->getpartner_dtnasc())}',
                        '{$this->getpartner_resphone()}',
                        '{$this->getpartner_mobphone()}',
                        '{$this->calcAge($this->getpartner_dtnasc())}',
                        '{$this->getpartner_email()}',
                        '{$this->getpartner_milorganization()}',
                        '{$this->getpartner_assoctype()}',
                        '{$this->getDateForDatabase($this->getpartner_dtassoc())}',
                        '{$this->getDateForDatabase("2021-01-30")}',
                        '{$this->getMonthlValue($this->getpartner_assoctype())}'
                    )",);
            $result = $sql->select("SELECT partner_id FROM tb_partner
                WHERE partner_id = LAST_INSERT_ID()");
            return $result[0]['partner_id'];
        }
    }

    public function update($id, $values)
    {
        $sql = new Sql();

        if (Partner::getMonthlValueById($id) != Partner::getMonthlValue($values["partner_assoctype"])) {
            if (Payment::countNotPaydPayments($id) > 0) {
                Message::throwMessage("Erro", "0", "Existem pendencias em aberto");
                return false;
            } else {
                $sql->query("UPDATE tb_partner SET 
                partner_fullname='{$this->getpartner_fullname()}',
                partner_cpf='{$this->getpartner_cpf()}',
                partner_identity='{$this->getpartner_identity()}',
                partner_dtnasc='{$this->getDateForDatabase($this->getpartner_dtnasc())}',
                partner_resphone='{$this->getpartner_resphone()}',
                partner_mobphone='{$this->getpartner_mobphone()}',
                partner_age='{$this->calcAge($this->getpartner_dtnasc())}',
                partner_email='{$this->getpartner_email()}',
                partner_milorganization='{$this->getpartner_milorganization()}',
                partner_assoctype='{$this->getpartner_assoctype()}',
                partner_dtassoc='{$this->getDateForDatabase($this->getpartner_dtassoc())}',
                partner_monthlypayment='{$this->getMonthlValue($this->getpartner_assoctype())}'
                WHERE partner_id= '{$id}'");
                return true;
            }
        } else {
            $sql->query("UPDATE tb_partner SET 
            partner_fullname='{$this->getpartner_fullname()}',
            partner_cpf='{$this->getpartner_cpf()}',
            partner_identity='{$this->getpartner_identity()}',
            partner_dtnasc='{$this->getDateForDatabase($this->getpartner_dtnasc())}',
            partner_resphone='{$this->getpartner_resphone()}',
            partner_mobphone='{$this->getpartner_mobphone()}',
            partner_age='{$this->calcAge($this->getpartner_dtnasc())}',
            partner_email='{$this->getpartner_email()}',
            partner_milorganization='{$this->getpartner_milorganization()}',
            partner_assoctype='{$this->getpartner_assoctype()}',
            partner_dtassoc='{$this->getDateForDatabase($this->getpartner_dtassoc())}',
            partner_monthlypayment='{$this->getMonthlValue($this->getpartner_assoctype())}'
            WHERE partner_id= '{$id}'");
            return true;
        }
    }

    public static function updatePaymentStatus($id)
    {

        $total = Payment::countNotPaydPayments($id);

        if ($total > 0) {
            $sql = new Sql();
            $sql->query("UPDATE tb_partner SET 
                partner_status='EM DÉBITO'
                WHERE partner_id= '{$id}'");
        } else {
            $sql = new Sql();
            $sql->query("UPDATE tb_partner SET 
                partner_status='EM DIA'
                WHERE partner_id= '{$id}'");
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
                $result = $sql->select("SELECT $field FROM tb_partner WHERE $field = '$value'");
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
                    $result = $sql->select("SELECT $field FROM tb_partner WHERE $field = '$value'");
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

        $id = $this->getpartner_id();
        $sql = new Sql();

        $address = Address::listByPartnerId($id);
        $dependents = Dependent::listByPartnerId($id);

        if ($address) {
            Address::deleteById($address["address_id"]);
        }

        if ($dependents) {
            foreach ($dependents as $key => $value) {
                Dependent::deleteById($value["dependent_id"]);
            }
        }

        $sql->query("DELETE FROM tb_partner  WHERE partner_id='{$this->getpartner_id()}'");
    }

    public function verifyTag($tag)
    {
        $allTags = $this->listAllUniqueTag();
        for ($i = 0; $i < sizeof($allTags); $i++) {
            if ($tag === $allTags[$i]["partner_uniquetag"]) {
                return false;
            }
        }
        return true;
    }

    public function getUniqueTag()
    {
        $prefix = "GRE-";
        $ranNumber = rand(100, 9999);
        $today = getdate()["year"] - 2000;
        $type = "SOC";
        $uniqueTag = $prefix . $today . $ranNumber . $type;
        if ($this->verifyTag($uniqueTag)) {
            return $uniqueTag;
        } else {
            $this->getUniqueTag();
        }
    }

    public function getDateForDatabase(string $date): string
    {
        $timestamp = strtotime($date);
        $date_formated = date('Y-m-d', $timestamp);
        return $date_formated;
    }
}
