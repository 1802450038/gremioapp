<?php

namespace gremio\Model;

use DateTime;
use DateTimeZone;
use \gremio\DB\Sql;
use \gremio\Model;

class Payment extends Model
{


    public static function listByPartnerId($partner_id)
    {
        $sql = new Sql();

        return  $sql->select("SELECT * FROM tb_payment WHERE partner_id='{$partner_id}'");
    }


    public static function getLastPaymentStatus($partner_id)
    {
        $sql = new Sql();

        $results =  $sql->select("
                                SELECT * 
                                FROM tb_payment 
                                WHERE partner_id='{$partner_id}' 
                                ORDER BY payment_duedate 
                                DESC LIMIT 0,1
                            ");
        if ($results) {
            return $results[0];
        } else {
            return 0;
        }
    }

    public static function countNotPaydPayments($partner_id)
    {
        $sql = new Sql();

        $results =  $sql->select("
                                SELECT SQL_CALC_FOUND_ROWS * 
                                FROM tb_payment 
                                WHERE partner_id='{$partner_id}'AND payment_status='ATRASADO'
                                ORDER BY payment_duedate 
                                DESC
                            ");

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
                            
        if ($results) {
            return (int)$resultTotal[0]['nrtotal'];
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

    public function create($partner_id, $payment_status)
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
        } else {
            return 0;
        }
    }

    public function createInvoicePayment($partner_id)
    {
        // $payment_duedate = date("Y-m-t", strtotime("+1 months"));
        $sql = new Sql();
        $payment_duedate = date("Y-m-t");
        $paymentValue = Partner::getMonthlValue($partner_id);
        $partner_fullname = Partner::getPartnerName($partner_id);

        $sql->query(
            "INSERT INTO tb_payment (
                    partner_id,
                    partner_fullname,
                    payment_payer,
                    payment_note,
                    payment_value,
                    payment_method,
                    payment_status,
                    payment_duedate
                ) VALUES(
                    '{$partner_id}',
                    '{$partner_fullname}',
                    'Nenhum',
                    'Pagamento em aberto',
                    '{$paymentValue}',
                    'Não pago',
                    'ABERTO',
                    '{$this->getDateForDatabase($payment_duedate)}'
                    )",
        );
        return 1;
    }

    public static function updatePaymentStatus($id, $status)
    {
        $sql = new Sql();
        $results = $sql->query("UPDATE tb_payment SET 
            payment_status='$status'
            WHERE payment_id= '{$id}'");
        return $results;
    }


    public static function checkPayments($partner_id)
    {
        $payment = new Payment();
        $lastPayment = Payment::getLastPaymentStatus($partner_id);
        if (!$lastPayment) {
            $payment->createInvoicePayment($partner_id); 
        } else {
            $diff = Payment::getMonthsDif($lastPayment["payment_duedate"], date("Y-m-d"));
            if ($diff > 0 && $lastPayment["payment_status"] != "PAGO") {
                $payment->createInvoicePayment($partner_id);
                Payment::updatePaymentStatus($lastPayment["payment_id"], "ATRASADO");
            } else if ($diff > 0 && $lastPayment["payment_status"] == "PAGO") {
                $payment->createInvoicePayment($partner_id);
            }
        }
    }



    public  function get($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_payment WHERE payment_id='$id'");

        return $this->setData($result[0]);
    }

    public function pay($payment_id)
    {
        $sql = new Sql();
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/Sao_Paulo'));

        $date = date_format($date, 'Y-m-d');

        $results = $sql->query("UPDATE tb_payment SET
        payment_payer = '{$this->getpayment_payer()}',
        payment_note = '{$this->getpayment_note()}',
        payment_date ='{$date}',
        payment_method = '{$this->getpayment_method()}',
        payment_status = 'PAGO'
        WHERE payment_id ='{$payment_id}'");

        return $results;
    }

    public function getDateForDatabase(string $date): string
    {
        $timestamp = strtotime($date);
        $date_formated = date('Y-m-d', $timestamp);
        return $date_formated;
    }


    public static function getMonthsDif($dateA, $dateB)
    {
        return (date('m', strtotime($dateB)) - date('m', strtotime($dateA)));
    }
}
