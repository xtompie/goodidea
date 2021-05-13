# ???

1. Modules
- own architecture
- own ambiguous language and model


## Query

```
+--------------+    +-----------------+    +----------------------+    +-------------+
| INPUT        | -> | RICH READ MODEL |    | QUERY                | -> | HANDLER     |
| ------------ |    | --------------- |    | -------------------- |    | ----------- |
| Controller   |    | CartRepository  |    |                      |    | Read data   |
| CLI          |    | - find()        | -> |  CartQuery           |    | - SQL query |
|              |    | CartModel       |    |                      |    | - ORM       |
|              |    | - items()       |    |                      |    | - APi       |
|              |    | - sum()         |    |                      |    |             |
|              |    | CartItem        |    |                      |    |             |
|              |    | - productId()   |    |                      |    |             |
|              |    | - quantity()    |    |                      |    |             |
|              |    | - product()     | -> | Catalog\ProductQuery |    |             |
+--------------+    +-----------------+    +----------------------+    +-------------+
```

## Command

```
+--------------+    +------------------+    +-----------------------+    +--------------+    +--------------+
| INPUT        | -> | RICH WRITE MODEL |    |  Command              | -> | HANDLER      |    | DOMAIN       |
| ------------ |    | ---------------- |    | --------------------- |    | ------------ |    | ------------ |
| Controller   |    | CartModel        |    |                       |    | Simple write |    | Private      |
| CLI          |    | - addItem()      | -> |  AddItemToCartCommand |    | ---- OR ---- |    | domain       |
|              |    |                  |    | - productId           |    | Process      | -> | model        |
|              |    |                  |    | - quantity            |    | Manager      |    | - validate   |
|              |    |                  |    |                       |    | / Saga       |    | - calculate  |
|              |    |                  |    |                       |    |              |    |   rabatt     |
|              |    |                  |    |                       |    |              |    | - write      |
|              |    |                  |    |                       |    |              |    | - call api   |
|              |    | (niepotrzebne)   |    |                       |    |              |    | - compensate |
+--------------+    +------------------+    +-----------------------+    +--------------+    +--------------+

```