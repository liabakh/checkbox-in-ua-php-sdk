<?php

namespace igorbunov\Checkbox\Models\Receipts\Taxes;

class GoodTaxes
{
    /** @var array<GoodTax> $results */
    public $results;

    /**
     * Constructor
     *
     * @param array<GoodTax> $taxes
     *
     */
    public function __construct(array $taxes)
    {
        foreach ($taxes as $tax) {
            if (!is_a($tax, GoodTax::class)) {
                throw new \Exception('Tax has wrong class');
            }

            $this->results[] = $tax;
        }
    }

    public function getTaxByLabel(string $label): ?GoodTax
    {
        foreach ($this->results as $tax) {
            if ($tax->label == $label) {
                return $tax;
            }
        }

        return null;
    }

    public function getTaxesByLabel(string $label): ?GoodTaxes
    {
        $taxesArr = [];

        foreach ($this->results as $tax) {
            if ($tax->label == $label) {
                $taxesArr[] = $tax;
            }
        }

        return new GoodTaxes($taxesArr);
    }

    public function getTaxesByCode(string $code): ?GoodTaxes
    {
        $taxesArr = [];

        foreach ($this->results as $tax) {
            if ($tax->code == $code) {
                $taxesArr[] = $tax;
            }
        }

        return new GoodTaxes($taxesArr);
    }

}
