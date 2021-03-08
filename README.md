# Install
```bash
composer require bermudaphp/eventor
```

# Usage
```php

$provider = new Provider\Provider();

$provider->listen(MyEvent::class, $firstListener);
$provider->listen(MyEvent::class, $secondListener);

$dispatcher = new EventDispatcher([$provider]);
$event = $dispatcher->dispatch(new MyEvent());
```
