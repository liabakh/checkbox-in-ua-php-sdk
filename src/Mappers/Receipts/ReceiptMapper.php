<?php

namespace Checkbox\Mappers\Receipts;

use Checkbox\Mappers\Receipts\Discounts\DiscountsMapper;
use Checkbox\Mappers\Receipts\Goods\GoodsMapper;
use Checkbox\Mappers\Receipts\Payments\PaymentsMapper;
use Checkbox\Mappers\Receipts\Taxes\GoodTaxesMapper;
use Checkbox\Mappers\Shifts\ShiftMapper;
use Checkbox\Mappers\TransactionMapper;
use Checkbox\Models\Receipts\Receipt;

class ReceiptMapper
{
    public function jsonToObject($json): ?Receipt
    {
        if (is_null($json)) {
            return null;
        }

        $transaction = (new TransactionMapper())->jsonToObject($json['transaction']);
        $receiptType = (new ReceiptTypeMapper())->jsonToObject($json['type']);
        $receiptStatus = (new ReceiptStatusMapper())->jsonToObject($json['status']);
        $goods = (new GoodsMapper())->jsonToObject($json['goods']);

        $payments = (new PaymentsMapper())->jsonToObject($json['payments']);
        $taxes = (new GoodTaxesMapper())->jsonToObject($json['taxes']);
        $discounts = (new DiscountsMapper())->jsonToObject($json['discounts']);
        $shift = (new ShiftMapper())->jsonToObject($json['shift']);

//        pre($json);

        $receipt = new Receipt(
            $json['id'],
            $receiptType,
            $transaction,
            $json['serial'],
            $receiptStatus,
            $goods,
            $payments,
            $json['total_sum'],
            $json['total_payment'],
            $json['total_rest'],
            $json['fiscal_code'],
            $json['fiscal_date'],
            $json['delivered_at'],
            $json['created_at'],
            $json['updated_at'],
            $taxes,
            $discounts ?? [],
            $json['header'] ?? '',
            $json['footer'] ?? '',
            $json['barcode'],
            $json['is_created_offline'],
            $json['is_sent_dps'],
            $json['sent_dps_at'] ?? '',
            $shift
        );

        return $receipt;
    }

    public function objectToJson(Receipt $obj)
    {
        pre('objectToJson', $obj);
    }
}