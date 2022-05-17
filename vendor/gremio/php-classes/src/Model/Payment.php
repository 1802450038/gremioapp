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
    public static function listNotPaydByPartnerId($partner_id)
    {
        $sql = new Sql();

        return  $sql->select("
                                SELECT payment_status,payment_dtregister 
                                FROM tb_payment 
                                WHERE partner_id='{$partner_id}' 
                                AND payment_status = 'ATRASADO'
                                ORDER BY payment_dtregister 
                                ASC
                            ");
    }

    public static function getLastPaymentStatus($partner_id)
    {
        $sql = new Sql();

        $results =  $sql->select("
                                SELECT partner_id, partner_fullname,payment_id, payment_status, payment_dtregister, payment_duedate 
                                FROM tb_payment 
                                WHERE partner_id='{$partner_id}' 
                                ORDER BY payment_dtregister 
                                ASC
                            ");
        if ($results) {
            return array(
                "partner_id" => $results[0]['partner_id'],
                "partner_fullname" => $results[0]['partner_fullname'],
                "payment_id" => $results[0]['payment_id'],
                "payment_status" => $results[0]['payment_status'],
                "payment_dtregister" => $results[0]['payment_dtregister'],
                "payment_monthdiff" => (((int)date("m", strtotime($results[0]["payment_duedate"]))) - ((int)date("m"))) * -1
            );
        } else {
            return 0;
        }
    }

    public static function listByPartnerIdCount($partner_id)
    {
        $sql = new Sql();

        return  $sql->select("
        SELECT * 
        FROM tb_payment 
        WHERE partner_id='{$partner_id}' 
        ORDER BY payment_dtregister ASC LIMIT 0,12");
    }

    public function listPaymentsPageSearch($partner_id, $type = "payment_id", $term = "", $page = 1, $itemsPerPage = 10, $mode)
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
            'payments' => $results,
            'total' => (int)$resultTotal[0]["nrtotal"],
            'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        ];
    }

    public static function listAllUniqueTag()
    {

        $sql = new Sql();

        $result = $sql->select("SELECT payment_uniquetag  FROM tb_payment");

        return $result;
    }

    public function create($partner_id, $payment_status = "PAGO")
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
                    payment_method,
                    payment_status
                ) VALUES(
                    '{$partner_id}',
                    '{$this->getpartner_fullname()}',
                    '{$uniqueTag}',
                    '{$this->getpayment_payer()}',
                    '{$this->getpayment_note()}',
                    '{$this->getpayment_value()}',
                    '{$this->getpayment_method()}',
                    '{$payment_status}'
                    )",
            );

            //     $results2 = $sql->select("SELECT payment_id FROM tb_payment
            //     WHERE payment_id = LAST_INSERT_ID()");
            //     return $results2[0];
        } else {
            return 0;
        }
    }

    public function createInvoicePayment($partner_id, $partner_fullname)
    {
        $sql = new Sql();

        $payment_duedate = date("Y-m", strtotime("+1 months"));
        $payment_duedate = $payment_duedate . "-01";
        var_dump($this->getDateForDatabase($payment_duedate));
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
                    payment_method,
                    payment_status,
                    payment_duedate
                ) VALUES(
                    '{$partner_id}',
                    '{$partner_fullname}',
                    '{$uniqueTag}',
                    'Nenhum',
                    'Pagamento em aberto',
                    '0,00',
                    'Não pago',
                    'ABERTO',
                    '{$this->getDateForDatabase($payment_duedate)}'
                    )",
            );
            return 1;
        } else {
            return 0;
        }
    }


    public function createNotPaydPayment($partner_id, $partner_fullname, $payment_status = "ATRASADO")
    {
        $sql = new Sql();

        $payment_dtregister = date("Y-m-d", strtotime("-1 months"));

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
                    payment_method,
                    payment_status,
                    payment_dtregister
                ) VALUES(
                    '{$partner_id}',
                    '{$partner_fullname}',
                    '{$uniqueTag}',
                    'Nenhum',
                    'Pagamento atrasado',
                    '0,00',
                    'Não pago',
                    '{$payment_status}',
                    '{$payment_dtregister}'
                    )",
            );
            return 1;
        } else {
            return 0;
        }
    }

    public static function updatePaymentStatus($id, $status)
    {
        $sql = new Sql();

        $results = $sql->query("UPDATE tb_payment SET 
            payment_status='$status'
            WHERE payment_id= '{$id}'");
        return $results;
    }

    public static function checkPayments($partner_id, $partner_fullname)
    {
        $payments = Payment::getLastPaymentStatus($partner_id);
        $it = 0;

        var_dump($payments);
        echo "<br>";
        echo "<br>";

        if ($payments != 0) {
            foreach ($payments as $key => $value) {
                if (
                    $payments["payment_status"] != "PAGO" &&
                    $payments["payment_status"] != "ATRASADO" &&
                    $payments["payment_monthdiff"] > 0
                ) {
                    $payment = new Payment;
                    Payment::updatePaymentStatus($payments["payment_id"], "ATRASADO");
                    Partner::updatePaymentStatus($partner_id, "EM DÉBITO");
                    $payment->createInvoicePayment($partner_id, $partner_fullname);
                    return;
                }



                // if ($payments["payment_status"] == "PAGO") {
                //     Partner::updatePaymentStatus($partner_id, "EM DIA");
                //     return;
                // } elseif ($payments["payment_status"] == "ABERTO") {
                //     Partner::updatePaymentStatus($partner_id, "EM DIA");
                //     return;
                // } else {
                //     Partner::updatePaymentStatus($partner_id, "EM DÉBITO");
                //     return;
                // }

            }
        } else {
            $payment = new Payment;
            $payment->createInvoicePayment($partner_id, $partner_fullname);
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
