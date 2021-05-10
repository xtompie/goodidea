# Catalog

## CQ

```php
class ArticleQuery {
    public function __construct(protected string $id) {}
    public function id(): string {}
    public function ask(): ArticleModel|null {}
}
class ArticleQueryHandler implements CacheIntervalInterface {
    public function handle(ArticleQuery $query):  ArticleModel|null {}
}
class ArticleListQuery {
    public function withCategoryId(string $categoryId):static {}
    public function withPhrase(string $categoryId):static {}
    public function withPage($page):static {}
    public function ask(): ArticleListQueryResponse {}
}
class ArticleListQueryResponse {
    public function articles(): ArticleCollection {}
    public function count(): int {}
    public function limit(): int {}
    public function page(): int {}
}
class CategoryListQuery {
    public function ask(): CategoryCollection {}
}
```

## Model

```php
class ArticleRepository {
    public function findById($id): ArticleModel|null {}
    public function findByAll(ArticleQuery  $query): ArticleQueryResponse {}
}
class ArticleCollection implements Iterator {}
class ArticleModel {
    public function id():string {}
    public function price():Money {}
}
class CategoryRepository {
    public function findRoot(): CategoryModel|null {}
    public function findById($categoryId): CategoryModel|null {}
    public function findByUri($uri): CategoryModel|null {}
    public function findAllWhereParent(CategoryModel $category): CategoryCollection {}
}
class CategoryCollection implements Iterator {
    public function whereParent(CategoryModel $category): static {}
}
class CategoryModel {
    public function id(): string {}
    public function title(): string {}
    public function uri(): string {}
    public function children(): CategoryCollection {}
    public function parent(): CategoryModel|null {}
}
```