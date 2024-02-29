<?php

namespace App\Enums;
 
enum EnumStateTransfer:string {
    case PENDING = 'PENDING';
    case FINISHED = 'FINISHED';
    case ERROR = 'ERROR';
    case RETURNED = 'RETURNED';
}