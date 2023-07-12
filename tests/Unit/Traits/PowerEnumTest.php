<?php

use AzimKordpour\PowerEnum\Traits\PowerEnum;

enum TestPost: string
{
    use PowerEnum;

    case Active = 'active';
    case Inactive = 'inactive';
}

enum TestComment: string
{
    use PowerEnum;

    case New = 'new';

    public static function setLabels(): array
    {
        return [
            'old' => 'new comment'
        ];
    }
}

test(description: 'The method of "values" works.', closure: function () {
    expect(value: TestPost::values())
        ->toBeArray()
        ->toBe(expected: [
            'active',
            'inactive'
        ]);
});

test(description: 'The method of "names" works.', closure: function () {
    expect(value: TestPost::names())
        ->toBeArray()
        ->toBe(expected: [
            'Active',
            'Inactive'
        ]);
});

test(description: 'The method of "list" works.', closure: function () {
    expect(value: TestPost::list())
        ->toBeArray()
        ->toBe(expected: [
            'Active' => 'active',
            'Inactive' => 'inactive'
        ]);
});

test(description: 'The method of "equals" works.', closure: function () {
    expect(value: TestPost::Active->equals(value: 'active'))
        ->toBeTrue()
        ->and(value: TestPost::Active->equals(value: TestPost::Active))
        ->toBeTrue()
        ->and(value: TestPost::Active->equals(value: 'inactive'))
        ->toBeFalse()
        ->and(value: TestPost::Active->equals(value: TestPost::Inactive))
        ->toBeFalse();
});

test(description: 'The method of "is" works.', closure: function () {
    expect(value: TestPost::Active->is(value: 'active'))
        ->toBeTrue()
        ->and(value: TestPost::Active->is(value: TestPost::Active))
        ->toBeTrue()
        ->and(value: TestPost::Active->is(value: 'inactive'))
        ->toBeFalse()
        ->and(value: TestPost::Active->is(value: TestPost::Inactive))
        ->toBeFalse();
});

test(description: 'The method of "setLabels" works.', closure: function () {
    expect(value: TestPost::setLabels())
        ->toBeArray()
        ->toBeEmpty();
});

test(description: 'The method of "getLabels" works.', closure: function () {
    expect(value: TestPost::getLabels())
        ->toBeArray()
        ->toBe(expected: [
            'active' => 'active',
            'inactive' => 'inactive'
        ]);
});

test(description: 'The method of "getLabels" t.', closure: function () {
    expect(value: TestComment::getLabels());
})->throws(exception: ErrorException::class, exceptionMessage: "old is an invalid value.");

test(description: 'The method of "label" works.', closure: function () {
    expect(value: TestPost::Active->label())
        ->toBe(expected: 'active')
        ->and(value: TestPost::Inactive->label())
        ->toBe(expected: 'inactive');
});

test(description: 'The method of "fromName" works.', closure: function () {
    expect(value: TestPost::fromName('Active'))
        ->toBe(expected: TestPost::Active);
});

test(description: 'The method of "fromName" throws exception.', closure: function () {
    TestPost::fromName('fake');
})->throws(exception: ErrorException::class, exceptionMessage: 'The given name does not exist.');

test(description: 'The method of "is+Value" works.', closure: function () {
    expect(value: TestPost::Active->isActive())
        ->toBeTrue()
        ->and(value: TestPost::Active->isInactive())
        ->toBeFalse();
});

test(description: 'the "__call" throws exception if the method does not exist', closure: function () {
    expect(value: TestPost::Active->exists());
})->throws(exception: BadMethodCallException::class, exceptionMessage: "Undefined method 'exists'");