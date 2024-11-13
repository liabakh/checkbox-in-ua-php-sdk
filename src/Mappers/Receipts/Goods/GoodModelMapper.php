<?php

namespace igorbunov\Checkbox\Mappers\Receipts\Goods;

use igorbunov\Checkbox\Mappers\Receipts\ExciseBarcodes\ExciseBarcodesMapper;
use igorbunov\Checkbox\Mappers\Receipts\Taxes\GoodTaxMapper;
use igorbunov\Checkbox\Mappers\Shifts\TaxesMapper;
use igorbunov\Checkbox\Models\Receipts\Goods\GoodModel;

class GoodModelMapper
{
    /**
     * @param  mixed  $json
     *
     * @return GoodModel|null
     * @throws \Exception
     */
    public function jsonToObject($json): ?GoodModel
    {
        if (is_null($json)) {
            return null;
        }

        $excise_barcodes = (new ExciseBarcodesMapper())->jsonToObject($json['excise_barcodes']);

        $goods = new GoodModel(
            $json['code'],
            $json['price'],
            $json['name'],
            $json['barcode'] ?? '',
            $json['header'] ?? '',
            $json['footer'] ?? '',
            $json['uktzed'] ?? '',
            $json['excise_barcode'] ?? '',
            $excise_barcodes,

        );

        return $goods;
    }

    /**
     * @param GoodModel $goodModel
     * @return array<string, mixed>
     */
    public function objectToJson(GoodModel $goodModel): array
    {
        $goodTaxeRatesArr = [];

        if (!is_null($goodModel->taxes)) {
            foreach ($goodModel->taxes->results as $tax) {
                $goodTaxeRatesArr[] = $tax->code;
            }
        }
        $exciseBarcodesArr = [];
        if (!is_null($goodModel->excise_barcodes)) {
            foreach ($goodModel->excise_barcodes->results as $barcode) {
                $exciseBarcodesArr[] = $barcode;
            }
        }


        return [
            'code' => $goodModel->code,
            'name' => $goodModel->name,
            'barcode' => $goodModel->barcode ?? '',
            'header' => $goodModel->header ?? '',
            'footer' => $goodModel->footer ?? '',
            'price' => $goodModel->price,
            'tax' => $goodTaxeRatesArr,
            'uktzed' => $goodModel->uktzed,
            'excise_barcode' => $goodModel->excise_barcode,
            'excise_barcodes' => $exciseBarcodesArr,
        ];
    }
}
