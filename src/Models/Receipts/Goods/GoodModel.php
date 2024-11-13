<?php

namespace igorbunov\Checkbox\Models\Receipts\Goods;

use igorbunov\Checkbox\Models\Receipts\ExciseBarcodes\ExciseBarcodes;
use igorbunov\Checkbox\Models\Receipts\Taxes\GoodTaxes;

class GoodModel
{
    /** @var string $code */
    public $code;
    /** @var string $barcode */
    public $barcode;
    /** @var string $name */
    public $name;
    /** @var string $header */
    public $header;
    /** @var string $footer */
    public $footer;
    /** @var string $uktzed */
    public $uktzed;
    /** @var float $price */
    /** @var string $excise_barcode */
    public $excise_barcode;

    public $price;
    /** @var GoodTaxes|null $taxes */
    public $taxes;
    /** @var ExciseBarcodes|null $excise_barcodes */
    public ?ExciseBarcodes $excise_barcodes;


    public function __construct(
        string $code,
        float $price,
        string $name,
        string $barcode = '',
        string $header = '',
        string $footer = '',
        string $uktzed = '',
        string $excise_barcode = '',
        ?ExciseBarcodes $excise_barcodes = null,
        ?GoodTaxes $taxes = null
    ) {
        $this->code = $code;
        $this->price = round($price);
        $this->name = $name;
        $this->barcode = $barcode;
        $this->header = $header;
        $this->footer = $footer;
        $this->uktzed = $uktzed;
        $this->excise_barcode = $excise_barcode;
        $this->excise_barcodes = $excise_barcodes;
        $this->taxes = $taxes;
    }
}
