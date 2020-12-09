<?php

declare(strict_types=1);

namespace Validator\LIVR\Rules;

use PHPUnit\Framework\TestCase;
use uMotif\LIVR;

final class ListLengthTest extends TestCase
{
    private const TEST_DATA_KEY = 'my_rule_list';
    private const FORMAT_ERROR = 'FORMAT_ERROR';

    /**
     * @dataProvider providerForValidData
     * @param $data
     * @param array|null $ruleLength
     */
    public function testValidData($data, ?array $ruleLength): void
    {
        $validator = self::prepareValidator($ruleLength, $data);
        $input = [self::TEST_DATA_KEY => $data];
        $cleanData = $validator->validate($input);

        $this->assertEquals($input, $cleanData);
    }

    /**
     * @dataProvider providerForInvalidData
     * @param $data
     * @param array|null $ruleLength
     * @param string $errorMessage
     */
    public function testInvalidData($data, ?array $ruleLength, string $errorMessage): void
    {
        $validator = self::prepareValidator($ruleLength, $data);
        $input = [self::TEST_DATA_KEY => $data];
        $validator->validate($input);

        $this->assertEquals($errorMessage, $validator->getErrors()[self::TEST_DATA_KEY]);
    }

    public function providerForValidData(): array
    {
        return [
            [
                //valid
                'data' => [1, 2 ,3 ,4],
                'rule_length' => [4],
            ],
            [
                //no data present
                'data' => null,
                'rule_length' => [1],
            ],
        ];
    }

    public function providerForInvalidData(): array
    {
        return [
            [
                //no data and no rules
                'data' => null,
                'rule_length' => null,
                'error_message' => self::FORMAT_ERROR,
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

    private static function prepareValidator(?array $ruleLength, $data): LIVR
    {
        $rules = [
            self::TEST_DATA_KEY => [
                'list_length' => $ruleLength
            ],
        ];

        return new LIVR($rules, true);
    }
}