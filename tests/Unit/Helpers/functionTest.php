<?php

it(description: 'returns string after "is".', closure: function (): void {
    expect(value: getStringAfterIsForEnumName(string: 'isActive'))
        ->toBeString()
        ->toBe(expected: 'Active');
});

it(description: 'returns null if the given string does not contain "is".', closure: function (): void {
    expect(value: getStringAfterIsForEnumName(string: 'active'))
        ->toBeNull();
});
