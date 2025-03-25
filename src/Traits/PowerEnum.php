<?php

namespace AzimKordpour\PowerEnum\Traits;

use BackedEnum;
use BadMethodCallException;
use ErrorException;

trait PowerEnum
{
    /**
     * Get the values of the cases.
     *
     * @return array<int, string|int>
     */
    public static function values(): array
    {
        return array_column(array: self::cases(), column_key: 'value');
    }

    /**
     * Get the names of the cases.
     *
     * @return array<int, string>
     */
    public static function names(): array
    {
        return array_column(array: self::cases(), column_key: 'name');
    }

    /**
     * Get the names and the values of the cases.
     *
     * @return array<string, string|int>
     */
    public static function list(): array
    {
        return array_combine(keys: self::names(), values: self::values());
    }

    /**
     * Check the given value equals the value of the case.
     */
    public function equals(BackedEnum $value): bool
    {
        return $this->value === $value->value;
    }

    /**
     * This is another name for the method "equals".
     */
    public function is(BackedEnum $value): bool
    {
        return $this->equals(value: $value);
    }

    /**
     * Set the labels of all the cases.
     *
     * Keys are the values of the cases and the values are the labels.
     *
     * @return array<string, string>
     */
    protected static function setLabels(): array
    {
        return [
        ];
    }

    /**
     * Get the labels of the cases.
     *
     * @return array<string, string>
     *
     * @throws ErrorException
     */
    public static function getLabels(): array
    {
        $labels = static::setLabels();
        $values = self::values();

        if ($labels === []) {
            $stringValues = array_map(fn (int|string $value): string => strval($value), $values);

            return array_combine(keys: $stringValues, values: $stringValues);
        }

        foreach ($labels as $label => $value) {
            if (! in_array(needle: $label, haystack: $values)) {
                throw new ErrorException(message: "$label is not a value of the Enum's case.");
            }

            if (! is_string(value: $value)) {
                throw new ErrorException(message: 'The value of the label must be a string.');
            }
        }

        return $labels;
    }

    /**
     * Return the label of the case.
     *
     * @throws ErrorException
     */
    public function label(): string
    {
        return self::getLabels()[$this->value];
    }

    /**
     * Get the uppercase of the value.
     *
     * @throws ErrorException
     */
    public function toUpper(): string
    {
        return strtoupper($this->label());
    }

    /**
     * Get the lowercase of the value.
     *
     * @throws ErrorException
     */
    public function toLower(): string
    {
        return strtolower($this->label());
    }

    /**
     * Get the value's first character uppercase.
     *
     * @throws ErrorException
     */
    public function toUcFirst(): string
    {
        return ucfirst($this->label());
    }

    /**
     * Get the case from the given name.
     *
     * @throws ErrorException
     */
    public static function fromName(string $name): self
    {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }

        throw new ErrorException(message: 'The given name does not exist.');
    }

    /**
     * Define a dynamic method to check the current case.
     * Example: the name of a case is "Active",
     * so isActive() return if the case is either "Active" or not.
     *
     * @param  array<int, string>  $arguments
     *
     * @throws ErrorException
     */
    public function __call(string $name, array $arguments): bool
    {
        $caseName = getStringAfterIsForEnumName(string: $name);

        if (is_null($caseName)) {
            throw new BadMethodCallException("Undefined method '$name'");
        }

        return self::fromName(name: $caseName)->value === $this->value;
    }
}
