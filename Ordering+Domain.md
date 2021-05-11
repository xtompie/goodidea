
## Domain

```php
class Cart {
    public function items(): Items {}
    public function sum(): Money {}
    public function toPay(): Money {
        return DiscountPolicy::instance()->calculate($this->sum());
    }
}
class Items implements Iterator {
}
class Item {
    public function productId(): string {}
    public function quantity(): int {}
}
class DiscountPolicy {
    public function __construct(protected Money $cost) {}
    public function calculate(): Money {
        if ($cost->greaterThanOrEqual(Money::new(20000))) {
            return $cost->subtract(Money::new(1000));
        }
        return $cost;
    }
}
```

## Events
```php
class OrderCreatedEvent implements EventPublicInteface {
    public function orderId(): string {}
}
```