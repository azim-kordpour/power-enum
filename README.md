# Power Enum Classes in PHP
This lightweight package provides a `Trait` that allows you to fully utilize Enum classes in your PHP projects, particularly in modern PHP frameworks like `Laravel`.

## Installation
> **NOTE:** As Enum was introduced in PHP 8.1, this package requires a minimum PHP version of 8.1.

You can install the package via composer:
  ```sh
  composer require azimkordpour/power-enum
  ```
<br>

## Usage Instructions
To use the `PowerEnum` trait in your Enum class, simply import it like this:

```php
<?php

use AzimKordpour\PowerEnum\Traits\PowerEnum;

enum PostStatus: string
{
    use PowerEnum;

    case Active = 'active';
    case Inactive = 'inactive';
}
```
Now, let's take a closer look at the methods.

<br>

## In Laravel
[Eloquent allows you to cast your attribute values to PHP Enums](https://laravel.com/docs/10.x/eloquent-mutators#enum-casting).

```php
 <?php
 
namespace App\Models;

use App\Enums\PostStatus; 
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => PostStatus::class,
    ];
}
```
Then, you can use it like the below examples.

#### Check if the status of the model is `active`:
```php
$post = Post::find(1);

// The status is active.
$post->status->isActive();
```
Returns boolean:
```php
true
```
<br>

#### Check if the status of the model equals the given value:
```php
$post = Post::find(1);

// The status is active.
$post->status->equals(PostStatus::Active);
```
Returns boolean:
```php
false
```
<br>

#### This method works like `equals`:
```php
$post = Post::find(1);

// The status is active.
$post->status->is(PostStatus::Active);
```
Returns boolean:
```php
false
```
<br>

#### Get the label of the status:
```php
$post = Post::find(1);

// The status is active.
$post->status->label();
```
Returns the value of the case if you have not set labels:
```php
"active"
```
For setting custom labels and Seeing all methods in PHP projects, take a look at the next section.

<br>

## All Methods

#### Get the values of `PostStatus` statically:
```php
PostStatus::values();
```
Returns an array:
```php
[
    'active',
    'inactive'
]
```
<br>

#### Get the names of `PostStatus` statically:
```php
PostStatus::names();
```
Returns an array:
```php
[
    'Active',
    'Inactive'
]
```
<br>

#### Get the names and values of `PostStatus` statically:
```php
PostStatus::list();
```
Returns an array:
```php
[
    'Active' => 'active',
    'Inactive' => 'inactive'
]
```
<br>

#### Check if the case is the active one:
```php
PostStatus::from('active')->isActive();
```
Returns boolean:
```php
true
```
<br>

#### Check if the case equals the given value:
```php
PostStatus::Active->equals(AnotherEnum::Example);
```
Returns boolean:
```php
false
```
<br>

#### This method works like `equals`:
```php
PostStatus::Active->is(AnotherEnum::Example);
```
Returns boolean:
```php
false
```
<br>

#### Initiate the class from name:
```php
PostStatus::fromName('Active');
```
Returns the Enum object:
```php
PostStatus::Active
```
<br>

#### Get the label of the case:
```php
PostStatus::Active->label();
```
Returns the value of the case if you have not set labels:
```php
"active"
```
<br>

#### Get the labels of the cases:
```php
PostStatus::Active->getLabels();
```
Returns the values of the cases if you have not set labels:
```php
[
    'active' => 'active',
    'inactive' => 'inactive'
]
```
<br>

#### You can write custom label for the cases in your Enum class:
```php
/**
 * Set the labels of all the cases.
 */
 public static function setLabels(): array
 {
    return [
        self::Active->value => 'published post',
        self::Inactive->value => 'draft post',
    ];
 }
```
Then, the method of `label`:
```php
PostStatus::Active->label();
```
Returns:
```php
"published post"
```
And the method of `getLabels`:
```php
PostStatus::Active->getLables();
```
Returns:
```php
[
    'active' => 'published post',
    'inactive' => 'draft post'
]
```
<br>

### Testing
```sh
composer test
```