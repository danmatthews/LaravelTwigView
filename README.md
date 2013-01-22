LaravelTwig - View replacement for Laravel 4.
------

Allows you to add [Twig](http://twig.sensiolabs.org) parsing to Laravel 4, i much prefer twig to blade for many reasons, and now you can use it too.

The package itself is really simple, it takes the template you provide, and parses it, simple!

There's also two handy little helper functions in there:

```twig
// Get a URL to a route.
{{ url('route/id') }}

// Get the URL to an asset file.
{{ asset('assets/style.css') }}
```

And that's it!

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

Then add this line to `app/config/app.php`, to the `providers` key:

```php
'providers' => array(
		'Danmatthews\LaravelTwigview\LaravelTwigviewServiceProvider',
```

Then that should be it! Enjoy.

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
