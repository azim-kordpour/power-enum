<?php

it(description: 'returns string after "is".', closure: function () {
    expect(value: getStringAfterIsForEnumName(string: 'isActive'))
        ->toBeString()
        ->toBe(expected: 'Active');
});

it(description: 'returns null if the given string does not contain "is".', closure: function () {
    expect(value: getStringAfterIsForEnumName(string: 'active'))
        ->toBeNull();
});

it(description: 'throws the exception if "is" not lower case.', closure: function (string $value) {
    expect(value: getStringAfterIsForEnumName(string: $value));
})
    ->throws(exception: BadMethodCallException::class, exceptionMessage: "'is' should be lower case.")
    ->with([
        'Is',
        'iS'
    ]);