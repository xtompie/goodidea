# Auth

## CQ

```php
class RegisterUserCommand {
    public function __construct(string $email, string $pass) {}
    public function execut(): CommandResult{ }
}
```

## Model

```php
class ShopperModel {
    public function id(): string {}
    public function billing(): Address {}
    public function delivery(): Address {}
}
```
