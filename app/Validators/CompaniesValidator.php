<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CompaniesValidator.
 *
 * @package namespace App\Validators;
 */
class CompaniesValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
        "get" => [
            "idInstance" => 'required|integer|min:1'
        ]
    ];
}
