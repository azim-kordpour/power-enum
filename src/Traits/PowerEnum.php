<?php

namespace AzimKordpour\PowerEnum\Traits;

use BadMethodCallException;
use ErrorException;

trait PowerEnum
{
    /**
     * Get the values of the cases.
     */
    public static function values(): array
    {
        return array_column(array: self::cases(), column_key: 'value');
    }

    /**
     * Get the names of the cases.
     */
    public static function names(): array
    {
        return array_column(array: self::cases(), column_key: 'name');
    }

    /**
     * Get the names and the values of the cases.
     */
    public static function list(): array
    {
        return array_combine(keys: self::names(), values: self::values());
    }

    /**
     * Check the given value equals the value of the case.
     */
    public function equals(mixed $value): bool
    {
        if (is_object(value: $value) && property_exists(object_or_class: $value, property: 'value')) {
            $value = $value->value;
        }

        return $this->value == $value;
    }

    /**
     * This is another name for the method "equals".
     */
    public function is(mixed $value): bool
    {
        return $this->equals(value: $value);
    }

    /**
     * Set the labels of all the cases.
     */
    public static function setLabels(): array
    {
        return [
        ];
    }

    /**
     * Get the labels of the cases.
     *
     * @throws ErrorException
     */
    public static function getLabels(): array
    {
        $labels = self::setLabels();
        $values = self::values();

        if (empty($labels)) {
            return array_combine(keys: $values, values: $values);
        }

        foreach (array_keys(array: $labels) as $value) {
            if (!in_array(needle: $value, haystack: $values)) {
                throw new ErrorException(message: "$value is an invalid value.");
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
     */
    public function toUpper(): string
    {
        return strtoupper($this->label());
    }

    /**
     * Get the lowercase of the value.
     */
    public function toLower(): string
    {
        return strtolower($this->label());
    }

    /**
     * Get the value's first character uppercase.
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