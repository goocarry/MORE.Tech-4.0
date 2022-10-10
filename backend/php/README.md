## Commands

### Migration
```
docker-compose exec php php yii migrate
```

### Gii
```
http://localhost:3030/gii
docker-compose exec php php yii gii/model --tableName=rarity --modelClass=Rarity --ns="common\modules\catalog\models"
docker-compose exec php php yii gii/model --tableName=familia --modelClass=Familia --ns="common\modules\catalog\models"
docker-compose exec php php yii gii/model --tableName=collection --modelClass=Collection --ns="common\modules\catalog\models"
docker-compose exec php php yii gii/model --tableName=familia_collection --modelClass=FamiliaCollection --ns="common\modules\catalog\models"
docker-compose exec php php yii gii/model --tableName=catalog --modelClass=Catalog --ns="common\modules\catalog\models"
```

### Faker
```
docker-compose exec php php yii faker/generate-all
```