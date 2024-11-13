<?php

namespace igorbunov\Checkbox\Models\Receipts\ExciseBarcodes;

class ExciseBarcodes
{
    /** @var array<ExciseBarcodeItemModel> $results */
    public array $results;

    /**
     * Constructor
     *
     * @param  array<ExciseBarcodeItemModel>  $excise_barcodes
     *
     * @throws \Exception
     */
    public function __construct(array $excise_barcodes)
    {
        foreach ($excise_barcodes as $excise_barcode) {
            if (!is_a($excise_barcode, ExciseBarcodeItemModel::class)) {
                throw new \Exception('Excise barcode has wrong class');
            }

            $this->results[] = $excise_barcode->excise_barcode;
        }
    }
}
