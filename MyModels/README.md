# model
## MyModels
### namespace

- Abstract : classes abstraites (non instanciables) `MyModels\Abstract`
- Interface : interfaces `MyModels\Interface` -> donne le cadres pour les classes qui implémentent ces interfaces
- Trait : traits `MyModels\Trait` -> méthodes réutilisables dans les classes qui utilisent ces traits (pas d'instanciation possible, `use` dans une classe)
- Manager : classes qui gèrent les données de nos modèles de `Mapping`
- Mapping : classes qui représentent les données de nos tables de la base de données, elles vont héritées de la classe abstraite `MyModels/Abstract/AbstractMapping.php`