# Shopper

## CQ

```php
class ShopperQuery {
    public function ask(): ShopperModel {}
}
class SetBillingAddress {
    public function __construct(Address $address) {}
    public function execute():CommandResult {}
}
class SetShippingAddress {
    public function __construct(Address $address) {}
    public function execute():CommandResult {}
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
