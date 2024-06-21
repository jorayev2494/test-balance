<?php

declare(strict_types=1);

namespace App\Repositories\Filters;

/**
 * @see https://docs.guidewire.com/cloud/pc/202402/cloudapibf/cloudAPI/topics/101-Fund/03-query-parameters/c_the-filter-query-parameter.html
 */
class FiltersOperatorMapper
{
    private const CONDITIONS = [
        'eq' => '=',
        'ne' => '!=',
        'lt' => '<',
        'gt' => '>',
        'le' => '<=',
        'ge' => '>=',
    ];

    private static array $result = [];

    public static function parse(array $filters = [], array $filterColumns = []): array
    {
        foreach ($filters as $column => $humanConditions) {
            if (! empty($filterColumns) && ! in_array($column, $filterColumns)) {
                continue;
            }

            foreach ($humanConditions as $humanCondition => $value) {
                self::makeBuilder($column, $humanCondition, $value);
            }
        }

        return self::$result;
    }

    private static function makeBuilder(string $column, string $humanCondition, array|string $value): void
    {
        $operator = self::humanConditionToOperator($humanCondition);

        if ($operator === null) {
            return;
        }

        if (is_array($value)) {
            foreach ($value as $v) {
                self::makeBuilder($column, $humanCondition, $v);
            }
        } else {
            self::$result[$column] = compact('column', 'operator', 'value');
        }
    }

    private static function humanConditionToOperator(string $humanCondition): ?string
    {
        return self::CONDITIONS[$humanCondition] ?? null;
    }
}
