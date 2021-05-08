- model
  - geo/helio
  - czy jest ciemno?
  - lot na marsa
- struktury danych + service
- flexible
- wektor zmian  
- bounded context
- building blocks


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
  - all(): array
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

  
