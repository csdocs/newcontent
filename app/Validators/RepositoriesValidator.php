<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class RepositoriesValidator.
 *
 * @package namespace App\Validators;
 */
class RepositoriesValidator extends LaravelValidator
{
    const RULE_DELETE = "delete";
    const RULE_GET = "get";
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
        "delete" => [],
        "get" => [
            "idCompany" => "integer|required|min:1",
            "idInstance" => "integer|required|min:1",
        ],
    ];
}
