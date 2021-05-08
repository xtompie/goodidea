# Catalog+properties

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
    public function properties(): PropertyValueCollection {} // => [PropertyValueModel{property:PropertyModel{key:'manufacturer'}, value:'dell'}, ... ]
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

## Presist

```
  db.articles {
-     properties LONGTEXT // eg. [{"manufacturer":"dell", "color":"red"}]
  }
+ db.articles_properties {
+     article_id
+     key VARCHAR
+     value VARCHAR
+ }
```