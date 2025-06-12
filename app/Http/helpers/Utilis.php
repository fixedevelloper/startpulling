<?php


namespace App\Http\helpers;


class Utilis
{

    public function getCountries(){
        return [
            [
                'name'=>'Cameroun',
                'iso'=>'cm',
                'sims'=>[
                    [
                        'name'=>'MTN cameroun',
                        'position'=>1,
                        'code_court'=>'*126*78525*phone*amount#'
                    ],
                    [
                        'name'=>'Orange cameroun',
                        'position'=>2,
                        'code_court'=>'#150*78525*phone*amount#'
                    ]
                ]
            ],
            [
                'name'=>'Cote d ivoire',
                'iso'=>'ci',
                'sims'=>[
                    [
                        'name'=>'MTN CI',
                        'position'=>1,
                        'code_court'=>'*126*78525*phone*amount#'
                    ],
                    [
                        'name'=>'Wave CI',
                        'position'=>2,
                        'code_court'=>'#150*78525*phone*amount#'
                    ]
                ]
            ]
        ];
    }
}
