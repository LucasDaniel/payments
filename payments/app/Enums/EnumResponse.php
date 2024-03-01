<?php

namespace App\Enums;

/**
 * Possible external response enums
 *
 */
enum EnumResponse:string {
    case AVAILABLE = 'Available';
    case UNAVAILABLE = 'Unavailable';
    case UNSTABLE = 'Unstable';
    case AUTORIZED = 'Autorizado';
    case FAIL = 'Fail';
}