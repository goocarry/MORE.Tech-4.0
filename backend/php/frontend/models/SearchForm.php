<?php

namespace frontend\models;

use ityakutia\blog\models\Article;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\db\Query;


class SearchForm extends Model
{
    public $word;

    public function rules()
    {
        return [
            [['word'], 'required'],
            ['word', 'string', 'min' => 2, 'max' => 255],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function attributeLabels()
    {
        return [
            'word' => 'Слово',
        ];
    }

    public function search($params)
    {
        $word = $params['SearchForm']['word'] ?? '';

        $article = new Expression("'article'");
        $page = new Expression("'page'");
        $navigation = new Expression("'navigation'");
        $content = new Expression("CONCAT(SUBSTRING_INDEX(content, ' ', 10), '...')");
        $description = new Expression("CONCAT(SUBSTRING_INDEX(description, ' ', 10), '...')");
        $navcontent = new Expression("CONCAT(SUBSTRING_INDEX(name, ' ', 10), '...')");
        $catalog = new Expression("'catalog'");

        $query = (new Query())
            ->select(['id as page', 'table' => $article, 'title', 'content' => $content])
            ->where(['LIKE', 'title', "$word"])
            ->andWhere(['is_publish' => 1])
            ->from('article');
        $subquery = (new Query())
            ->select(['slug as page', 'table' => $page, 'title', 'content' => $content])
            ->where(['LIKE', 'title', "$word"])
            ->andWhere(['is_publish' => 1])
            ->from('page');
        $navquery = (new Query())
            ->select(['link as page', 'table' => $navigation, 'title' => "name", 'name as content' => $navcontent])
            ->where(['LIKE', 'name', "$word"])
            ->andWhere(['is_publish' => 1])
            ->from('navigation');
        $catalogquery = (new Query())
            ->select(['id as page', 'table' => $catalog, 'title' => 'concat_ws(" ", genus_rus, spec_rus)', 'content' => $description])
            ->where(['LIKE', 'concat_ws(" ", genus_rus, spec_rus)', "$word"])
            ->orWhere(['LIKE', 'familia_lat', "$word"])
            ->orWhere(['LIKE', 'familia_author', "$word"])
            ->orWhere(['LIKE', 'genus_lat', "$word"])
            ->orWhere(['LIKE', 'spec_lat', "$word"])
            ->orWhere(['LIKE', 'spec_ykt', "$word"])
            ->orWhere(['LIKE', 'spec_author', "$word"])
            ->orWhere(['LIKE', 'variety', "$word"])
            ->orWhere(['LIKE', 'description', "$word"])
            ->orWhere(['LIKE', 'areal', "$word"])
            ->orWhere(['LIKE', 'ecology', "$word"])
            ->orWhere(['LIKE', '`usage`', "$word"])
            ->orWhere(['LIKE', 'rarity_ykt_cat', "$word"])
            ->orWhere(['LIKE', 'rarity_ykt_status', "$word"])
            ->orWhere(['LIKE', 'rarity_rus_cat', "$word"])
            ->orWhere(['LIKE', 'rarity_rus_status', "$word"])
            ->orWhere(['LIKE', 'comment', "$word"])
            ->orWhere(['LIKE', 'barcode_ean_13', "$word"])
            ->orWhere(['LIKE', 'qr', "$word"])
            ->from('catalog');

        $query->union($subquery, true);
        $query->union($navquery, true);
        $query->union($catalogquery, true);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
