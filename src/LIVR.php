<?php

declare(strict_types=1);

namespace uMotif;

use Validator\LIVR as LIVRBase;

class LIVR extends LIVRBase
{
    private static $DEFAULT_RULES = array(
        'required'                  => 'Validator\LIVR\Rules\Common::required',
        'not_empty'                 => 'Validator\LIVR\Rules\Common::notEmpty',
        'not_empty_list'            => 'Validator\LIVR\Rules\Common::notEmptyList',
        'any_object'                => 'Validator\LIVR\Rules\Common::anyObject',

        'one_of'                    => 'Validator\LIVR\Rules\Text::oneOf',
        'eq'                        => 'Validator\LIVR\Rules\Text::eq',
        'string'                    => 'Validator\LIVR\Rules\Text::string',
        'min_length'                => 'Validator\LIVR\Rules\Text::minLength',
        'max_length'                => 'Validator\LIVR\Rules\Text::maxLength',
        'length_equal'              => 'Validator\LIVR\Rules\Text::lengthEqual',
        'length_between'            => 'Validator\LIVR\Rules\Text::lengthBetween',
        'like'                      => 'Validator\LIVR\Rules\Text::like',

        'integer'                   => 'Validator\LIVR\Rules\Numeric::integer',
        'positive_integer'          => 'Validator\LIVR\Rules\Numeric::positiveInteger',
        'decimal'                   => 'Validator\LIVR\Rules\Numeric::decimal',
        'positive_decimal'          => 'Validator\LIVR\Rules\Numeric::positiveDecimal',
        'min_number'                => 'Validator\LIVR\Rules\Numeric::minNumber',
        'max_number'                => 'Validator\LIVR\Rules\Numeric::maxNumber',
        'number_between'            => 'Validator\LIVR\Rules\Numeric::numberBetween',

        'email'                     => 'Validator\LIVR\Rules\Special::email',
        'equal_to_field'            => 'Validator\LIVR\Rules\Special::equalToField',
        'url'                       => 'Validator\LIVR\Rules\Special::url',
        'iso_date'                  => 'Validator\LIVR\Rules\Special::isoDate',

        'nested_object'             => 'Validator\LIVR\Rules\Meta::nestedObject',
        'list_of'                   => 'Validator\LIVR\Rules\Meta::listOf',
        'list_of_objects'           => 'Validator\LIVR\Rules\Meta::listOfObjects',
        'list_of_different_objects' => 'Validator\LIVR\Rules\Meta::listOfDifferentObjects',
        'variable_object'           => 'Validator\LIVR\Rules\Meta::variableObject',
        'or'                        => 'Validator\LIVR\Rules\Meta::__or',

        'default'                   => 'Validator\LIVR\Rules\Modifiers::defaultVal',
        'trim'                      => 'Validator\LIVR\Rules\Modifiers::trim',
        'to_lc'                     => 'Validator\LIVR\Rules\Modifiers::toLc',
        'to_uc'                     => 'Validator\LIVR\Rules\Modifiers::toUc',
        'remove'                    => 'Validator\LIVR\Rules\Modifiers::remove',
        'leave_only'                => 'Validator\LIVR\Rules\Modifiers::leaveOnly',
        'list_length'               => 'uMotif\Validator\LIVR\Rules\ListLength::listLength',
    );

    public function __construct($livrRules, $isAutoTrim = false)
    {
        parent::__construct($livrRules, $isAutoTrim);

        $this->registerRules(self::$DEFAULT_RULES);
    }
}
