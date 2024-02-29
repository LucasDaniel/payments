<?php

namespace App\Dictionary;

trait Dictionary {

    public $dictionary = [
        'error' => [
            'getUserPayer' => [
                'msg' => 'Error on get user payer!',
                'code' => 502
            ],
            'getTransfer' => [
                'msg' => 'Error on get transfer!',
                'code' => 503
            ],
            'sendMessage' => [
                'msg' => 'Error on send message to payer and payee!',
                'code' => 504
            ],
            'finishTransfer' => [
                'msg' => 'Error on finish transfer!',
                'code' => 505
            ],
            'dontHaveMoney' => [
                'msg' => "Don't have money!",
                'code' => 506
            ],
            'storeNoSendMoney' => [
                'msg' => "STORE don't send money to anyone!",
                'code' => 507
            ], 
            'getTransferToReturnValues' => [
                'msg' => "Error on get transfer to return values!",
                'code' => 508
            ], 
            'transferNotFinishedToReturnValues' => [
                'msg' => "Tranfer is not finished to return values!",
                'code' => 509
            ],
            'getUserPayee' => [
                'msg' => 'Error on get user payee!',
                'code' => 510
            ], 
        ]
    ];

}
