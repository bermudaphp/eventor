# Install
```bash
composer require bermudaphp/eventor
```

# Usage
```php

$provider = new Provider\Provider;

$provider->listen(MyEvent::class, $firstListener);
$provider->listen(MyEvent::class, $secondListener);

$event = (new EventDispatcher($provider))->dispatch(new MyEvent);
```
