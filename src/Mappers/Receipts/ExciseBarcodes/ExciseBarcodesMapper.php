<?php

namespace igorbunov\Checkbox\Mappers\Receipts\ExciseBarcodes;

use igorbunov\Checkbox\Models\Receipts\ExciseBarcodes\ExciseBarcodes;

class ExciseBarcodesMapper
{
    /**
     * @param  mixed  $json
     *
     * @return ExciseBarcodes|null
     * @throws \Exception
     */
    public function jsonToObject(mixed $json): ?ExciseBarcodes
    {
        if (is_null($json)) {
            return null;
        }

        $result = [];

        foreach ($json as $row) {
            $excise_barcode = (new ExciseBarcodeModelMapper())->jsonToObject($row);

            if (!is_null($excise_barcode)) {
                $result[] = $excise_barcode;
            }
        }

        return new ExciseBarcodes($result);
    }
}
