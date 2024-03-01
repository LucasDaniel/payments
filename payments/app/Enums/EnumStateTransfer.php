<?php

namespace App\Enums;

/**
 * Transfer states
 */
enum EnumStateTransfer:string {
    case PENDING = 'PENDING';
    case FINISHED = 'FINISHED';
    case ERROR = 'ERROR';
    case RETURNED = 'RETURNED';
}