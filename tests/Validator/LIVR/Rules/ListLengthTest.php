<?php

declare(strict_types=1);

namespace Validator\LIVR\Rules;

use PHPUnit\Framework\TestCase;
use uMotif\LIVR;

final class ListLengthTest extends TestCase
{
    private const TEST_DATA_KEY = 'my_rule_list';
    private const FORMAT_ERROR = 'FORMAT_ERROR';
    private const REQUIRED = 'REQUIRED';

    /**
     * @dataProvider dataProvider
     * @param $data
     * @param array|null $ruleLength
     * @param string|null $errorMessage
     */
    public function testItWorks($data, ?array $ruleLength, ?string $errorMessage = null): void
    {
        $rules = [
            self::TEST_DATA_KEY => [
                'required', [
                    'list_length' => $ruleLength
                ]
            ],
        ];

        $input = [self::TEST_DATA_KEY => $data];

        $validator = new LIVR($rules, true);
        $cleanData = $validator->validate($input);

        if ($errorMessage) {
            $this->assertEquals($errorMessage, $validator->getErrors()[self::TEST_DATA_KEY]);
        } else {
            $this->assertEquals($input, $cleanData);
        }
    }

    public function dataProvider(): array
    {
        return [
            [
                //valid
                'data' => [1, 2 ,3 ,4],
                'rule_length' => [4],
                'error_message' => null,
            ],
            [
                //no data
                'data' => null,
                'rule_length' => [1],
                'error_message' => self::REQUIRED,
            ],
            [
                //no data and no rules
                'data' => null,
                'rule_length' => null,
                'error_message' => self::REQUIRED,
            ],
            [
                //data is not a valid list
                'data' => 'foobar',
                'rule_length' => [1],
                'error_message' => self::FORMAT_ERROR,
            ],
            [
                //data has too few items (lower rule parameter specified)
                'data' => [1, 2],
                'rule_length' => [3],
                'error_message' => 'TOO_FEW_ITEMS',
            ],
            [
                //data has too few items (lower and upper rule parameters specified)
                'data' => [1, 2],
                'rule_length' => [3, 5],
                'error_message' => 'TOO_FEW_ITEMS',
            ],
            [
                //data has too many items (lower rule parameter specified)
                'data' => [1, 2, 4, 5],
                'rule_length' => [3],
                'error_message' => 'TOO_MANY_ITEMS',
            ],
            [
                //data has too many items (lower and upper rule parameters specified)
                'data' => [1, 2, 4, 5],
                'rule_length' => [1, 3],
                'error_message' => 'TOO_MANY_ITEMS',
            ],
            [
                //rule parameters' order incorrect
                'data' => [1, 2, 4, 5],
                'rule_length' => [3, 1],
                'error_message' => self::FORMAT_ERROR,
            ],
            [
                //rule parameter/s missing
                'data' => [1, 2, 4, 5],
                'rule_length' => null,
                'error_message' => self::FORMAT_ERROR,
            ]
        ];
    }
}