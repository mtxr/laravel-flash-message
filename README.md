# Flash messages made easy. Based on laracasts/flash

## Installation

First, pull in the package through Composer.

Run `composer require mtxr/laravel-flash-message`

And then, if using Laravel 5, include the service provider within `config/app.php`.

```php
'providers' => [
    FlashMessage\FlashServiceProvider::class,
];
```

## Usage

Within your controllers, before you perform a redirect...

```php
public function store()
{
    flash('Welcome Aboard!');

    return home();
}
```

You may also do:

- `flash('Message', 'info')`
- `flash('Message', 'success')`
- `flash('Message', 'danger')`
- `flash('Message', 'warning')`
- `flash('Message')->important()`

If you need, you can flash two messages in the same request:

```php
public function welcome()
{
    flash('Welcome Aboard!', 'success');

    flash('Request Failed!', 'error');

    return home();
}
```

Behind the scenes, this will set a few keys in the session:

- 'flash_notification.messages' - The array of messages you have

With this message flashed to the session, you may now display it in your view(s). Maybe something like:

```html
@if (session()->has('flash_notification.messages'))
    @foreach(session('flash_notification.messages') as $messageData)
    <div class="alert alert-{{ $messageData['level'] }} {{ $messageData['important'] ? 'alert-important' : '' }}">
    @if(!$messageData['important'])
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @endif

        {!! trans($messageData['message']) !!}
    </div>
    @endforeach
@endif
```

> Note that this package is optimized for use with Twitter Bootstrap.

Because flash messages and overlays are so common, if you want, you may use (or modify) the views that are included with this package. Simply append to your layout view:

```html
@include('flash::message')
```

## Example

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    @include('flash::message')

    <p>Welcome to my website...</p>
</div>
</body>
</html>
```

If you need to modify the flash message partials, you can run:

```bash
php artisan vendor:publish
```

The package view will now be located in the `app/views/packages/mtxr/laravel-flash-message/` directory.

## Hiding Flash Messages

A common desire is to display a flash message for a few seconds, and then hide it. To handle this, write a simple bit of JavaScript. For example, using jQuery, you might add the following snippet just before the closing `</body>` tag.

```
<script>
$('.flash-message.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
```

This will find any alerts - excluding the important ones, which should remain until manually closed by the user - wait three seconds, and then fade them out.
