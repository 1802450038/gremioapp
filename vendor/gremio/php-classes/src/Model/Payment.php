<?php

namespace gremio\Model;

use \gremio\DB\Sql;
use \gremio\Model;

class Payment extends Model
{


    public static function listByPartnerId($partner_id)
    {
        $sql = new Sql();

        return  $sql->select("SELECT * FROM tb_payment WHERE partner_id='{$partner_id}'");

    }
    public static function listByPartnerIdCount($partner_id)
    {
        $sql = new Sql();

        return  $sql->select("
        SELECT * 
        FROM tb_payment 
        WHERE partner_id='{$partner_id}' 
        ORDER BY payment_dtregister DESC LIMIT 0,12");

    }

    public function listPaymentsPageSearch($partner_id, $type="payment_id",$term = "", $page = 1, $itemsPerPage = 10,$mode)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

     

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_payment
			WHERE partner_id = $partner_id AND $type LIKE '%$term%'
            ORDER BY payment_dtregister $mode
			LIMIT $start, $itemsPerPage;
		",);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'payments'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

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
                    payment_method
                ) VALUES(
                    '{$partner_id}',
                    '{$this->getpartner_fullname()}',
                    '{$uniqueTag}',
                    '{$this->getpayment_payer()}',
                    '{$this->getpayment_note()}',
                    '{$this->getpayment_value()}',
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
                if ($tag === $allTags[$i]["payment_uniquetag"]) {
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

    public static function getPartnerValue($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT partner_monthlypayment FROM tb_partner WHERE partner_id='$id'");

        return $result[0]["partner_monthlypayment"];
    }

    
    public function getDateForDatabase(string $date): string
    {
        $timestamp = strtotime($date);
        $date_formated = date('Y-m-d', $timestamp);
        return $date_formated;
    }
}
