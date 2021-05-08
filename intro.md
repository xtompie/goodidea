- proza nie kodawanie
- nie trzeba dokumentacji, kod jest dokumentacja
- architektua cmd -> event


1.  Model
1. 1. geo/helio
1. 2. czy jest ciemno?
1. 3. lecimy na marsa
2. Typy zlozoności 
3. Wektor zmian  
```php
<?php

function generateDocumentId($date, $nextNumber, $isAuditor, $isDemo): string
{
    $id = "";
    $id .= $date . '/' . $nextNumber;
    if ($isDemo) {
        $id = 'DEMO/' . $id;
    }
    if ($isAuditor) {
        $id .= '/AUDIT';
    }
    return $id;
}
```
3. 1. 
    | Verification           | Approval   | ...
--- | ---------------------- | ---------- |   
ISO | has_number, has_author | has_date   |
QEP | has_date, has_author   | has_number |
...                                         has_...
4. Bounded context
  - catalog | product {cena}
  - ordering | product {cena}
  - storehouse | prduct {lokalizacja, rozmiar}
  - delivery | product {waga, rozmiar}
 
5. Struktury + Serwisy
6. Building blocks
6. 1. ValueObject
```php
<?php

class PaymentMethod 
{
    public static function sepa(): static {}
    public static function invoice(): static {}
    public static function fromValue(mixed $value): static|null {} 
    public function value(): string {}
    public function label(): string {}
    public function equals(PaymentMethod $method): bool {}
    protected function __construct($value) {}
}

$paymentMehtod = PaymentMethod::fromValue($_POST['payment_method']);
if ($paymentMehtod->equals(PaymentMethod::paypal())) {
    // redirect to paypal
}

```
6. 1. 1. compare, add

```php
<?php

class Currency 
{
    public function __construct(
        protected string $id,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function equals(Currency $currency): bool
    {
        return $this->id() == $currency->id();
    }    
}

class Money 
{
    public function __construct(
        protected int $amount,
        protected Currency $currency,
    ) {}

    public function amount(): int
    {
        return $this->amount;
    } 

    public function currency(): Currency
    {
        return $this->currency;
    } 

    public function equals(Money $money): bool 
    {
        if (!$this->currency()->equls($money->currency())) {
            throw new InvalidArgumentException();
        }
        return $this->amount() == $money->amount();
    }

    public function greaterThan(Money $money): bool
    {
        if (!$this->currency()->equls($money->currency())) {
            throw new InvalidArgumentException();
        }
        return $this->amount() > $money->amount();
    }

    public function add(Money $money): static
    {
        if (!$this->currency()->equls($money->currency())) {
            throw new InvalidArgumentException();
        }
        return new static($this->amount() + $money->amount(), $this->currency());
    }

}
```
6. 2. Entity 
6. 3. Repository
   - `findBy*(): Entity`
   - `findAllBy*(): array<Entity>`
   - `save(Entity): Entity`
6. 4. Event
```php
<?php

class UserRegistredEvent
{
    public function __construct(
        protected string $id,
    ) {}

    public function id(): string
    {
        return $this->id;
    }
}
```

## Building blocks
- Command
  - Command
  - Handler
  - ?Result 
- Query
  - Query
  - Handler
  - Response
- Event
- Bus
  - CommandBus
  - QueryBus
  - EventBus
- Event | Public/Private/Tech
- Listener
- Model
- VO
- Enum
- Repository
- Entity

## CQRS middlewares
Command
 - clear query cache
 - log time debugbar
 - events 
 - asyc job
 - throttle
Query
 - cache
 - log time debugbar

# Tree

- /category/$name-$id
  - breadcrumbs
  - children categories
- /article/$name-$id
  - show categories where product is
- /sitemap
  - all categories in t

## Read Model

- GetAllCategoriesQuery()
+ CategoryModel
  + children(): CategoryCollection
  + parent: CategoryModel|null
  + id()
  + name()
+ CategoryCollection
  - filterWhereParent(CategoryModel):
  - sort(): static
  + all(): array
+ CategoryRepository
  + findRoot(): CategoryModel
  + findById($nodeId)
  - findAllChildNodesForParent(CategoryModel)
  - findParentForNode(CategoryModel)

## Write Model

+ crud entity
+ save all tree 


## Feature: related categories

+ CategoryModel->related(): CategoryCollection

## Feature: 

  
