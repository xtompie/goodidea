
# Modelujemy kategorie

## Wymagania

1. `/category/$name-$id` pobrac kategorie wedlug id 
2. `/category/$name-$id` wyswietlic breadcrumbs
3. `/category/$name-$id` wyswietlic children categories
4. `/sitemap` all categories as tree
5. related categories
6. szukajka po wlasciwosciach

## db

```
category: id, parent, order
```

## write

- crud entity
- save all tree 


## read base

```php
class CategoryListQuery {
    public function ask(): CategoryCollection {}
}
class CategoryListQueryHandler implements RamCacheInterface {}
class CategoryCollection implements Iterator {
    public function all(): array {}
    public function collect(): Collection {}
}
```

## 1. `/category/$name-$id` pobrac kategorie wedlug id  

```php
class CategoryRepository {
    public function findById($categoryId): CategoryModel|null {}
}
class CategoryModel {
    public function id(): string {}
    public function title(): string {}
    public function uri(): string {}
}
class CategoryController {
    public function __invoke($name, $id) {
        $category = CategoryRepository::instance()->findById($id);
        abort_unless($category, 404);
        // ...
    } 
}
```

## 2. `/category/$name-$id` wyswietlic breadcrumbs

```php
class CategoryModel {
+   public function parent(): CategoryModel|null {
+       return CategoryRepository::instance()->findById($this->parent());
+   }
+   public function location(): CategoryCollection {
+       $location = [];
+       $child = $this;
+       while ($parent = $child->parent()) {
+           $location[] = $parent;
+           $child = $parent;
+       }
+       return new CategoryCollection(array_revese($location));
+   }
}
```

## 3. `/category/$name-$id` wyswietlic children categories

```php
class CategoryRepository {
+    public function findAllWhereParent(CategoryModel $category): CategoryCollection {}
}
class CategoryModel {
+   public function children(): CategoryCollection {}
}
```

## 4. `/sitemap` all categories as tree

```php
class CategoryRepository {
+    public function findRoot(): CategoryModel {
+        return new CategoryModel([
+            'id' => 0,
+            'title' => config('app.name'),
+            'parent' => '-1',
+            'order' => 0,
+            'uri' => '/',
+        ]);
+    }
}
```

## 5. related categories

```php
class CategoryModel {
+   public function related(): CategoryCollection {}
}
```

## 6. szukajka po wlasciwosciach


```
  db.articles {
-     properties LONGTEXT // eg. {"manufacturer":"dell", "color":"red"}
  }
+ db.articles_properties {
+     article_id
+     key VARCHAR
+     value VARCHAR
+ }
```

```php
// 1. 
class PropertyModel {
    public function key(): string {} // manufacturer, size, color
    public function hasOptions(): bool {} // marka ma opcje, waga nie ma opcji 
}
class PropertyCollection implements Iterator {}
class PropertyValueModel {
    public function property(): PropertyModel {}
    public function value(): string
}
class PropertyValueCollection implements Iterator {}
// 2.
class ArticleModel {
    public function properties(): PropertyValueCollection {}
}
// 3.
class CategoryModel {
    public function properties(): CategoryPropertyCollection {}
}
class CategoryPropertyCollection implements Iterator{}
class CategoryPropertyModel {
    public function property(): PropertyModel {}
    public function values(): PropertyValueCollection {}
    public function min(): PropertyValueModel|null {}
    public function max(): PropertyValueModel|null {}
}
// 4.
class ArticleListQuery {
    public function withProperties(PropertyValueCollection $properties):static {}
}
```
