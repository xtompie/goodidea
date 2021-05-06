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
- Builder np. SearchProductQueryBuilder::instance()->tite('xd')->color('red')->build()->ask()
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

## Tree Model
- GetFlatTreeNodesQuery()
- TreeNodeModel
  - childNodes(): TreeNodeCollection
  - parent: TreeNodeModel|null
- TreeNodeCollection
  - filterWhereParent($id)
  - sort() 
- TreeNodeRepository
  - findRoot(): TreeNodeModel
  - findAllChildNodesForParent($nodeId)
  - findParentForNode($nodeId)



  
