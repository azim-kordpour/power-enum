<?php

it(description: 'returns string after "is".', closure: function () {
    expect(value: getStringAfterIs(string: 'isActive'))
        ->toBeString()
        ->toBe(expected: 'Active');
});

it(description: 'returns null if the given string does not contain "is".', closure: function () {
    expect(value: getStringAfterIs(string: 'active'))
        ->toBeNull();
});