<?php
namespace App\Services;

class InvoiceService
{
    public static function calculateTax($price)
    {
        //an hypothetical tax calculation formula
        return 0.005 * $price;
    }
}
