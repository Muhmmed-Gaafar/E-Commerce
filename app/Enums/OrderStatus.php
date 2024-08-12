<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PROCESSING = 'processing';
    case INDELIVERY = 'indelivery';
    case COMPLETED = 'completed';
    case REFUSED = 'refused';
}
