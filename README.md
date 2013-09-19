LaravelTwig - View replacement for Laravel 4.
------

Allows you to add [Twig](http://twig.sensiolabs.org) parsing to Laravel 4, i much prefer twig to blade for many reasons, and now you can use it too.

The package provides:

- Twig templates, in all their glory, including inheritance.
- Automatic template caching.
- `url()`, and `asset()` helper methods for quickly routing resources and links.
- A full set of form helpers.
- A `call()` method that allows you to call any Laravel 4 static method within a template (use it wisely!).

## Installation

All you need to do to install it, is add the package to your composer.json file:

```json
{
	"require": "danmatthews/laraveltwigview"
}
```

Then run:

```bash
php composer.phar update
```

Then add this line to `app/config/app.php`, to the `providers` list:

```php
'providers' => array(
		'Danmatthews\LaravelTwigview\LaravelTwigviewServiceProvider',
```

Then that should be it! Enjoy.

## Quick Helpers

There's also two handy little helper functions in there:

```twig
// Get a URL to a route.
{{ url('route/id') }}

// Get the URL to an asset file (works relative to the public directory).
{{ asset('assets/style.css') }}
```

## Form Helpers:

See the [Forms & HTML](http://laravel.com/docs/html) documentation on how these work.

```twig
{{ formOpen() }} {# Laravel Form::open() function #}

{{ formClose() }} {# Laravel Form::close() function #}

{{ formText() }} {# Laravel Form::text() function #}

{{ formToken() }} {# Laravel Form::token() function #}

{{ formLabel() }} {# Laravel Form::label() function #}

{{ formPassword() }} {# Laravel Form::password() function #}

{{ formFile() }} {# Laravel Form::file() function #}

{{ formSelect() }} {# Laravel Form::select() function #}

{{ formSubmit() }} {# Laravel Form::submit() function #}

{{ formHidden() }} {# Laravel Form::hidden() function #}
```
## The `call()` function.

This allows you to call any static method or any one of Laravel's Facade's through a template, and get the result returned. <strong style="color:red;">Use this with caution!</strong>

The first argument passed to the `call()` function would be the classname and method name as a string, such as `URL::to` or `Form::hidden`.

Any further arguments that are passed to the function are passed along to the method being called.

```twig
{# Call the Laravel Cache::has function to check for a value. #}

{% if (call('Cache::has', 'my.key')) %}
Put the cached values here.
{% else %}
Tell them that there's nothing stored.
{% endif %}
```

## Validation errors

Laravel does this great thing where it passes the `$errors` variable through to all views, all the time. It however assumes that you're using Blade syntax, so you can do things like:

```
{{ $errors->first('email') }}
```

But with twig, we can't call methods, so this packages translates the Laravel errors into something a little more useful, where `{{ errors }}` is still an array, but you can do things like:

```twig
{# Errors array - printing this directly will throw an exception #}
{{ errors }}

{# Get a list of the errors for the email field #}
{% for error in errors.email %} {{ error }} {% endfor %}

{# Get a list of all the errors returned, by field #}
{% for error in errors %}

  {# Print the first error for this field #}
  {% for fieldError in error %}
     {{ fieldError }}
  {% endfor %}

  {# Loop through all the errors for this field


{% endfor %}

```
