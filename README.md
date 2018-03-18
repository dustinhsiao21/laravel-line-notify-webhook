## Webhook notifications channel for Laravel 5.3

#### Requirement

- PHP 7.0+
- Laravel 5.3+

#### Installation

```bash
composer require dustinhsiao21/laravel-line-notify
```

#### Usage

Add the `routeNotificationForLine` method to your Notifiable model. This method needs to return your Line Notify OAuth2 token. [Read me Document](https://notify-bot.line.me/doc/en/)

```php
/**
* @return string Line Notify OAuth2 token
*/
public funtcion routeNotificationForLine()
{
    return 'ADD_YOUR_ACCESS_TOKEN_HERE';
}
```

Then you can use the channel in your `via()` method inside the notification. Also you can add the `toLine()` method.

```php
<?php

namespace App\Notifications;

use dustinhsiao21\LineNotify\LineChannel;
use dustinhsiao21\LineNotify\LineMessage;
use Illuminate\Notifications\Notification;

class LineNotify extends Notification
{
	private $message;
	
    public funtion __construct($message)
    {
    	$this->message = $message;    
    } 
    public funtcion via($notifiable)
    {
        return [LineChannel::class]
    }
    
    public funtcion toLine($notifiable)
    {
        return (new LineMessage())->message($message);
    }
}
```

Now you can use `notifiable->notify()` to send the Notify. For example, If you use `user` as the model.

```php
$user = User::find(1);
$user->notify(New LineNotify('Hello World'));
```

#### Testing

```bash
composer test
```

#### Security

If you discover any security issues, please email [dustinhsiao21@gmail.com](dustinhsiao21@gmail.com) instead of using the issue tracker.

#### License

The MIT License (MIT), Please see [License File](./LICENSE.md) for more information.