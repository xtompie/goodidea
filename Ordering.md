    # Ordering

    ## CQ

    ```php
    class CartQuery {
        public function ask(): CartModel {}
    }
    class AddItemToCartCommand {
        public function __construct(string $productId, int $quantity) {}
        public function execute(): void {}
    }
    class IncreaseCartItemQuantityCommand {
        public function __construct(string $productId)
        public function execute(): void {}
    }
    class DecreaseCartItemQuantityCommand {
        public function __construct(string $productId)
        public function execute(): void {}
    }
    class RemoveCartItemCommand {
        public function __construct(string $productId)
        public function execute(): void {}
    }
    class CreateOrderCommand {
        public function __construct(
            Address $billing,
            Address $shipping,
            PaymentMethod $paymentMethod
        ){}
        public function execute(): CreateOrderCommandResult {}
    }
    class CreateOrderCommandResult implements CommandPublishesEvents {
        public function success(): bool {}
        public function errors(): ErrorCollection {}
        public function events(): array {}
    }
    ```

    ## Model

    ```php
    class CartModel implements NativeInteface {
        public function __construct(
            protected object $native,
        ) {}
        public function items(): CartItemCollection {
            return collect($native->items)->mapInto(CartItem::class)->into(CartItemCollection::class);
        }
        public function sum(): Money { Money::new($this->native->sum); }
        public function toPay(): Money { Money::new($this->native->toPay); }
    }
    class CartItemCollection implements Iterator {
    }
    class CartItemModel {
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


    ## Mixin modules?

    ```php
    class CartItemModel {
        public function __construct(string $productId, int $quantity, CartItemCollection $collection) {} 
        public function product(): ArticleModel|null {
            return $this->collection->productForItem($this);
        }
    }
    class CartItemCollection implements Iterator {
        protected ArticleCollection $products;
        public function productForItem(CartItemModel $item) {
            if ($this->products === null) {
                $this->products = (new ArticleListQuery())->withProductIds(
                    $this->collect()->map(function(CartItem $item) {
                        return $item->productId();
                    })->ask()->articles();
                );
            }
            return $this->products->findById($item->productId());
        }
    }
    class ArticleListQuery {
        public function withProductIds(array $productIds): static {}
    }

    ```