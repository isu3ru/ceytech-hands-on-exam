<?php

namespace App\Validators;

use App\Model;
use PDO;
use Rakit\Validation\Rule;

/**
 * Unique validation for Rakit\Validation\Validator
 * Code is based on the code from the following link: https://github.com/rakit/validation#registeroverride-rule
 * @see https://github.com/rakit/validation#registeroverride-rule
 * @author Rakit
 */
class UniqueRule extends Rule
{
    protected $message = ":attribute :value has been used";

    protected $fillableParams = ['table', 'column', 'except'];

    protected $pdo;

    public function __construct()
    {
        $this->pdo = Model::getInstance()->getConnection();
    }

    public function check($value): bool
    {
        // make sure required parameters exists
        $this->requireParameters(['table', 'column']);

        // getting parameters
        $column = $this->parameter('column');
        $table = $this->parameter('table');
        $except = $this->parameter('except');

        if ($except and $except == $value) {
            return true;
        }

        // do query
        $stmt = $this->pdo->prepare("select count(*) as count from `{$table}` where `{$column}` = :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // true for valid, false for invalid
        return intval($data['count']) === 0;
    }
}
