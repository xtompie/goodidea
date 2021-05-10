# Kilka rzeczy o kodzie

## Poziomy abstrakcji

### 1
```php
function category_controller() {
    $id = ctype_digit($id) ? $id : 0;
    if (cache_exists('category/'. $id)) {
        $articles = cache_get('category/' . $id);
    }
    else {
        db_connect('mysql://user:pass@localhost/project?encoding=ut8&mode=');
        $articles = $id 
            ? db_get("SELECT * FROM articles WHERE active = 1 AND category = '%s'", $id)
            : []
        ;
    }
    if (!$articles) {
        return json_encode(['error' => __('Brak danych')]);
    }
    foreach ($articles as $index => $article) {
        $article['uri'] = '/article/' . $article['id'];
    }
    return json_encode(['data' => $articles]);
}
```

### 2

```php
public function category_controller() {
    $articles = articles_from_category($_GET['id']);
    if (!$articles) {
        return result_no_data();
    }
    return articles_result($articles);
}
```

## Nie koduj, pisz prozę

### 1
```php
// obliczanie prawdopodobienstwa
$p1 = 80;
$p2 = 20
$mode = 'percent'; // bo user podaje w procentach
if (is_int($p1) && $p1 >= 0 && $p1 <= 100 && is_int($p2) && $p2 >= 0 && $p1 <= 100) {
    $p = $p1 * $p2
    if ($mode != 'precent') {
        $p = $p / 100;
    }
}
$result = $p;
```

Wyglada jak program o liczbach

### 2
```php
$p1 = Probability::fromPercent(80);
$p1 = Probability::fromPercent(10);
$result = $p1->and($p2);
```

## Wektor zmian

### 1
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

### 2
```
    | Verification           | Approval   |  ... (A) 🡪
--- | ---------------------- | ---------- |   
ISO | has_number, has_author | has_date   |
QEP | has_date, has_author   | has_number |
...                                     
(B) 🡫                                   has_... (C) 🡮 
                                            
```

## Typy złożoności

### 1. Esencyjna

### 2. Przypadkowa

# Buildding blocks

## Entity + Service

### Obiekty jako struktura danych
```php
// 1.
$animal->getDigestionSystem()->getStomach()->add(new Sausage());
// 2.
$animal->eat(new Sausage());
```

## Entity

- ma tozsamosc

## Collection

- kolekcja danego entity np. CategoryCollection

## Repository

- pobiera, aktualizuje, usuwa, tworzy entity
- `findBy*(): Entity`
- `findAllBy*(): array<Entity>` my bedziemy zwraca kolekcje
- `save(Entity): Entity`

## Value Object

- nie ma tozsamosci
- niemutowalny

```php
<?php
// 1.
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
    
}
// 2.
$p1 = Probability::fromPercent(80);
$p1 = Probability::fromPercent(10);
$result = $p1->and($p2);
```

## Event
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

## Listener

```php
<?php

class SendRegistrationEmailListener
{
    public function __invoke(UserRegistredEvent $event)
    {
        (new SendRegistrationMailCommand($event->id()))->execute();
    }
}

```

## Validator

## Filter

## Policy

# CQRS

## Query

```php
class UserQuery
{
    public function __construct(
        protected string $id,
    ) {}
    public function id(): string {}
    public function ask(): UserQueryResponse
    {
        return QueryBus::instance()->ask($this);
    }
}

class UserQueryResponse
{
    public function success(): bool {}
    public function user(): UserModel {}
    public function attributes(): array {}
}

```
- zwracan jeden obiekt, w srodku proste typy danych - zeby dalo sie serializowac i cachowac
- Query
- Handler
- Response

## Command

```php
class RegisterUserCommand
{
    public function __construct(
        protected string $email,
        protected string $pass
    ) {}

    public function email()
    {
        return $this->email;
    }

    public function pass()
    {
        return $this->pass;
    }

    public function execute(): CommandResult
    {
        return CommandBus::instance()->execute($this);
    }
}

class CommandResult implements CommandPublishesEvents
{
    public function success(): bool {}
    public function resource(): string {}
    public function errors(): ErrorCollection {}
    public function events(): array {}
}

```
- nie zwraca danych
- im mniej robi tym lepiej, reszta przez eventy 
- Command
- Handler
- ?Result 

## Event

- czas przeszly

```php
class UserRegistredEvent
{
    public function __construct(
        protected string $id
    ) {}

    public function id(): string
    {
        return $this->id;
    }
}
```

# Model

## Czym jest model
- geo/helio
- czy jest ciemno?
- lecimy na marsa

## Jezyk wszechobecny i bounded context

- product w kontekstach
  - catalog - cena, ilosc
  - ordering - cena
  - storehouse - lokalizacja, rozmiar
  - delivery - waga, rozmiar, nr seryjny
- user, ten sam id, correlation id ale inna nazwa
  - shopping - shopper
  - ordering - orderer
  - payment - payer
  - recommandations - customer
  - authorisation - subject
  - delivery - reciever

## Jak modelowac?

- pytanie nie o being, tylko o behaving
- nie trzeba dokumentacji, kod jest dokumentacja
- Money to Entity czy VO?
