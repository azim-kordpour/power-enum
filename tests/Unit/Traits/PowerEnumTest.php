<?php

use Tests\Unit\Examples\TestComment;
use Tests\Unit\Examples\TestPost;
use Tests\Unit\Examples\TestRole;

test(description: 'The method of "values" works.', closure: function (): void {
    expect(value: TestPost::values())
        ->toBeArray()
        ->toBe(expected: [
            'active',
            'inactive',
        ]);
});

test(description: 'The method of "names" works.', closure: function (): void {
    expect(value: TestPost::names())
        ->toBeArray()
        ->toBe(expected: [
            'Active',
            'Inactive',
        ]);
});

test(description: 'The method of "list" works.', closure: function (): void {
    expect(value: TestPost::list())
        ->toBeArray()
        ->toBe(expected: [
            'Active' => 'active',
            'Inactive' => 'inactive',
        ]);
});

test(description: 'The method of "equals" works.', closure: function (): void {
    expect(value: TestPost::Active->equals(value: TestPost::Active))
        ->toBeTrue()
        ->and(value: TestPost::Active->equals(value: TestPost::Active))
        ->toBeTrue()
        ->and(value: TestPost::Active->equals(value: TestPost::Inactive))
        ->toBeFalse()
        ->and(value: TestPost::Active->equals(value: TestPost::Inactive))
        ->toBeFalse();
});

test(description: 'The method of "is" works.', closure: function (): void {
    expect(value: TestPost::Active->is(value: TestPost::Active))
        ->toBeTrue()
        ->and(value: TestPost::Active->is(value: TestPost::Active))
        ->toBeTrue()
        ->and(value: TestPost::Active->is(value: TestPost::Inactive))
        ->toBeFalse()
        ->and(value: TestPost::Active->is(value: TestPost::Inactive))
        ->toBeFalse();
});

test(description: 'The method of "setLabels" works.', closure: function (): void {
    expect(value: TestRole::getLabels())
        ->toBeArray()
        ->toBe(expected: [
            TestRole::Admin->value => 'Administrator',
        ]);
});

test(description: 'The method of "getLabels" works.', closure: function (): void {
    expect(value: TestPost::getLabels())
        ->toBeArray()
        ->toBe(expected: [
            'active' => 'active',
            'inactive' => 'inactive',
        ]);
});

test(description: 'The method of "getLabels" t.', closure: function (): void {
    expect(fn (): array => TestComment::getLabels())
        ->toThrow(exception: ErrorException::class, exceptionMessage: "old is not a value of the Enum's case.");
});

test(description: 'The method of "label" works.', closure: function (): void {
    expect(value: TestPost::Active->label())
        ->toBe(expected: 'active')
        ->and(value: TestPost::Inactive->label())
        ->toBe(expected: 'inactive');
});

test(description: 'The method of "toUpper" works.', closure: function (): void {
    expect(value: TestPost::Active->toUpper())
        ->toBe(expected: 'ACTIVE')
        ->and(value: TestPost::Inactive->toUpper())
        ->toBe(expected: 'INACTIVE');
});

test(description: 'The method of "toLower" works.', closure: function (): void {
    expect(value: TestPost::Active->toLower())
        ->toBe(expected: 'active')
        ->and(value: TestPost::Inactive->toLower())
        ->toBe(expected: 'inactive');
});

test(description: 'The method of "toUcFirst" works.', closure: function (): void {
    expect(value: TestPost::Active->toUcFirst())
        ->toBe(expected: 'Active')
        ->and(value: TestPost::Inactive->toUcFirst())
        ->toBe(expected: 'Inactive');
});

test(description: 'The method of "fromName" works.', closure: function (): void {
    expect(value: TestPost::fromName('Active'))
        ->toBe(expected: TestPost::Active);
});

test(description: 'The method of "fromName" throws exception.', closure: function (): void {
    expect(fn (): TestPost => TestPost::fromName('fake'))
        ->toThrow(exception: ErrorException::class, exceptionMessage: 'The given name does not exist.');
});

test(description: 'The method of "is+Value" works.', closure: function (): void {
    expect(value: TestPost::Active->isActive())
        ->toBeTrue()
        ->and(value: TestPost::Active->isInactive())
        ->toBeFalse();
});

test(description: 'the "__call" throws exception if the method does not exist', closure: function (): void {
    // @phpstan-ignore-next-line
    expect(fn () => TestPost::Active->exists())
        ->toThrow(exception: BadMethodCallException::class, exceptionMessage: "Undefined method 'exists'");
});
