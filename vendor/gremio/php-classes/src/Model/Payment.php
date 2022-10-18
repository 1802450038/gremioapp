<?php

namespace gremio\Model;

use DateTime;
use DateTimeZone;
use \gremio\DB\Sql;
use \gremio\Model;

class Payment extends Model
{
    // OKK
    private function getPaymentModel(
        $partner_id,
        $partner_fullname,
        $payment_note,
        $payment_month_register,
        $payment_year_register,
        $payment_status
    ) {
        $paymentModel = [
            "payment_id" => "Dummy",
            "partner_id" => "{$partner_id}",
            "partner_fullname" => "{$partner_fullname}",
            "payment_payer" => "X",
            "payment_note" => "{$payment_note}",
            "payment_dtregister" => "X",
            "payment_month_register" => "{$payment_month_register}",
            "payment_year_register" => "{$payment_year_register}",
            "payment_duedate" => "X",
            "payment_date" => "X",
            "payment_value" => "X",
            "payment_method" => "X",
            "payment_status" => "{$payment_status}"
        ];

        return $paymentModel;
    }
    // OKK
    private function getFullYear($partner_id, $partner_fullname, $year)
    {

        $resultsForYear = array();

        for ($i = 1; $i <= 12; $i++) {
            if ($i < 10) {
                $paymentModel = $this->getPaymentModel($partner_id, $partner_fullname, "Pagamento não registrado", "0" . ((string)$i), $year, "INDISPONIVEL");
            } else {
                $paymentModel = $this->getPaymentModel($partner_id, $partner_fullname, "Pagamento não registrado", ((string)$i), $year, "INDISPONIVEL");
            }
            array_push($resultsForYear, $paymentModel);
        }

        return $resultsForYear;
    }
    // OKK
    public function listByPartnerId($partner_id, $partner_fullname, $year)
    {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_payment WHERE partner_id='{$partner_id}' AND payment_year_register='{$year}' ");

        $resultsForYear = $this->getFullYear($partner_id, $partner_fullname, $year);

        if ($results) {
            foreach ($results as $payment => $value) {
                $resultsForYear[((int)$value["payment_month_register"]) - 1] = $value;
            }
        }



        return $resultsForYear;
    }
    // OKK
    public  function get($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_payment WHERE payment_id='$id'");

        return $this->setData($result[0]);
    }

    // OKK
    public function getLastPayment($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT payment_id, payment_month_register, payment_year_register, payment_status FROM tb_payment
        WHERE partner_id = $id ORDER BY payment_id DESC LIMIT 1");



        if ($result) {
            return $result[0];
        } else {
            return "NÃO ENCONTRADO";
        }
    }

    public function createInvoicePayment($partner_id, $partner_fullname)
    {
        $sql = new Sql();
        $tz = 'America/Sao_Paulo';
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $value = Partner::getMonthlValueById($partner_id);

        $sql->query("INSERT INTO tb_payment (
                partner_id,
                partner_fullname,
                payment_note,
                payment_month_register,
                payment_year_register,
                paymenbt_date,
                payment_value,
                payment_status
            ) VALUES(
                '{$partner_id}',
                '{$partner_fullname}',
                'PAGAMENTO DO MES ATUAL',
                '{$dt->format('m')}',
                '{$dt->format('Y')}',
                '{$value}',
                'ABERTO'
            )",);

            
    }

    //  OKK
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

    // OKK
    public static function countOpenPayments($partner_id)
    {
        $sql = new Sql();

        $results =  $sql->select("
                                SELECT SQL_CALC_FOUND_ROWS * 
                                FROM tb_payment 
                                WHERE partner_id='{$partner_id}'AND payment_status='ABERTO'
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

    // OKK
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



    // OKK
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

    // OKK
    public function getDateForDatabase(string $date): string
    {
        $timestamp = strtotime($date);
        $date_formated = date('Y-m-d', $timestamp);
        return $date_formated;
    }

    // OKK
    public static function getMonthsDif($dateA, $dateB)
    {
        return (date('m', strtotime($dateB)) - date('m', strtotime($dateA)));
    }


    public static function checkPayments($partner_id, $partner_fullname)
    {
        Payment::printLine();
        var_dump($partner_id);

        Payment::printLine();
        $openPayments = Payment::countOpenPayments($partner_id);
        var_dump($openPayments);

        Payment::printLine();
        $delayedPayements = Payment::countNotPaydPayments($partner_id);
        var_dump($delayedPayements);

        Payment::printLine();
        $payment = new Payment();
        $lastPayment = $payment->getLastPayment($partner_id);
        var_dump($lastPayment);
        Payment::printLine();

        $tz = 'America/Sao_Paulo';
        // $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        // $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        // echo $dt->format('d.m.Y, H:i:s');
        // var_dump($dt->format('m'));


        if ($lastPayment["payment_month_register"] < $dt->format('m')) {
            Payment::printLine();
            echo "Nenhum pagamento registrado para o mes atual";
            $payment->createInvoicePayment($partner_id,$partner_fullname);
        } else {
            var_dump($lastPayment);
        }
        // $payment = new Payment();
        // $paymentMonthly = Partner::getMonthlValueById($partner_id);
        // $lastPayment = Payment::getLastPaymentStatus($partner_id);
        // var_dump($lastPayment);
        // if ($paymentMonthly != "ISENTO") {
        //     echo "tem q pagar";
        //     if (!$lastPayment) {
        //         $payment->createInvoicePayment($partner_id);
        //     } else {
        //         $diff = Payment::getMonthsDif($lastPayment["payment_duedate"], date("Y-m-d"));
        //         if ($diff > 0) {
        //             if ($lastPayment["payment_status"] != "PAGO") {
        //                 Payment::updatePaymentStatus($lastPayment["payment_id"], "ATRASADO");
        //                 $payment->createInvoicePayment($partner_id);
        //             } else if ($lastPayment["payment_status"] == "PAGO") {
        //                 $payment->createInvoicePayment($partner_id);
        //             }
        //         }
        //     }
        // } else {
        //     if ($lastPayment) {
        //         $diff = Payment::getMonthsDif($lastPayment["payment_duedate"], date("Y-m-d"));
        //         if ($diff == 0) {
        //             if ($lastPayment["payment_status"] == "ABERTO") {
        //                 Payment::updatePaymentStatus($lastPayment["payment_id"], "PAGO");
        //             }
        //         }
        //     }
        // }
        // Partner::updatePaymentStatus($partner_id);
    }

    public static function printLine()
    {
        echo "<br>";
        echo "<br>";
    }
}
