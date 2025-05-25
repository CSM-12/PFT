<?php

namespace App\Enums\TransactionCategory;

enum Period:string
{
    case Undefined = 'undefined';
    case Daily = 'daily';
    case Weekly = 'weekly';
    case Monthly = 'monthly';
    case Quarterly = 'quarterly';
    case Yearly = 'yearly';
}
