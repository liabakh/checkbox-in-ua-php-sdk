<?php

namespace igorbunov\Checkbox\Models\Receipts\ExciseBarcodes;

class ExciseBarcodeItemModel
{
    public string $excise_barcode;

    public function __construct(string $excise_barcode)
    {
        $this->excise_barcode = $excise_barcode;
    }
}
