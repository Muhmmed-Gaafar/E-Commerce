<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateRange implements Rule
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function passes($attribute, $value)
    {
        $startDate = $this->startDate;
        $endDate = $this->endDate;

        return $startDate <= $endDate;
    }

    public function message()
    {
        return 'The start date must be before the end date.';
    }
}
