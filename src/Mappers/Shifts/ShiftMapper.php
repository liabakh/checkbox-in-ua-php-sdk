<?php

namespace Checkbox\Mappers\Shifts;

use Checkbox\Models\Shifts\Shift;

class ShiftMapper
{
    public function jsonToObject($json): ?Shift
    {
        if (is_null($json)) {
            return null;
        }

        $zReport = (new ZReportMapper())->jsonToObject($json['z_report']);
        $balance = (new BalanceMapper())->jsonToObject($json['balance']);
        $initialTransaction = (new InitialTransactionMapper())->jsonToObject($json['initial_transaction']);
        $closingTransaction = (new ClosingTransactionMapper())->jsonToObject($json['closing_transaction']);
        $cashRegister = (new CashRegisterMapper())->jsonToObject($json['cash_register']);
        $taxes = (new TaxesMapper())->jsonToObject($json['taxes']);

        $shift = new Shift(
            $json['id'],
            $json['serial'],
            $json['status'],
            $zReport,
            $json['opened_at'],
            $json['closed_at'],
            $initialTransaction,
            $closingTransaction,
            $json['created_at'],
            $json['updated_at'],
            $balance,
            $taxes,
            $cashRegister
        );

        return $shift;
    }

    public function objectToJson(Shift $obj)
    {
        pre('objectToJson', $obj);
    }
}