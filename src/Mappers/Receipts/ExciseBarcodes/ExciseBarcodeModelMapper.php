<?php

namespace igorbunov\Checkbox\Mappers\Receipts\ExciseBarcodes;

use igorbunov\Checkbox\Models\Receipts\ExciseBarcodes\ExciseBarcodeItemModel;

class ExciseBarcodeModelMapper
{
    /**
     * @param mixed $json
     * @return ExciseBarcodeItemModel|null
     */
    public function jsonToObject(mixed $json): ?ExciseBarcodeItemModel
    {
        if (is_null($json)) {
            return null;
        }

        return new ExciseBarcodeItemModel(
            $json
        );
    }
}
