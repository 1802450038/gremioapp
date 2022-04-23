<?php

namespace gremio\Model;

use \gremio\DB\Sql;
use \gremio\Model;

class Payment extends Model
{


    public static function listByPartnerId($partner_id)
    {
        $sql = new Sql();

        return  $sql->select("SELECT * FROM tb_payment WHERE payment_id='{$partner_id}'");

  
    }

    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT payment_uniquetag  FROM tb_payment");

        return $result;
    }

    public function create($partner_id)
    {
        $sql = new Sql();
        $uniqueTag = $this->getUniqueTag();
        if ($uniqueTag != null) {
            $sql->query(
                "INSERT INTO tb_payment (
                    partner_id,
                    partner_fullname,
                    payment_uniquetag,
                    payment_payer,
                    payment_note,
                    payment_value,
                    payment_dtregister,
                    payment_method
                ) VALUES(
                    '{$partner_id}',
                    '{$this->getpartner_fullname()}',
                    '{$uniqueTag}',
                    '{$this->getpayment_payer()}',
                    '{$this->getpayment_note()}',
                    '{$this->getpayment_value()}',
                    '{$this->getDateForDatabase($this->getpayment_dtregister())}',
                    '{$this->getpayment_method()}'
                    )",);

        //     $results2 = $sql->select("SELECT payment_id FROM tb_payment
        //     WHERE payment_id = LAST_INSERT_ID()");
        //     return $results2[0];
        // } else {
        //     return 0;
        }
    }

    public  function get($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_payment WHERE payment_id='$id'");


        return $this->setData($result[0]);
    }

    public function verifyTag($tag)
    {
        $allTags = $this->listAllUniqueTag();
        
            for ($i = 0; $i < sizeof($allTags); $i++) {
                if ($tag === $allTags[$i]["log_uniquetag"]) {
                    return false;
                }
            }
        return true;
    }

    public function getUniqueTag()
    {
        $prefix = "GRE-";
        $ranNumber = rand(100, 99999999);
        $today = getdate()["year"] - 2000;
        $type = "PG";
        $uniqueTag = $prefix . $today . $ranNumber . $type;
        if ($this->verifyTag($uniqueTag)) {
            return $uniqueTag;
        } else {
            $this->getUniqueTag();
        }
    }


    public static function getPartnerName($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT partner_fullname FROM tb_partner WHERE partner_id='$id'");

        return $result[0]['partner_fullname'];
    }


    
    public function getDateForDatabase(string $date): string
    {
        $timestamp = strtotime($date);
        $date_formated = date('Y-m-d', $timestamp);
        return $date_formated;
    }
}
