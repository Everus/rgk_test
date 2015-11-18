<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form about `app\models\Books`.
 */
class BooksSearch extends Books
{
    private $dateFrom;
    private $dateTo;

    /**
     * @return mixed
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @param mixed $dateFrom
     * @return BooksSearch
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @param mixed $dateTo
     * @return BooksSearch
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['name'], 'safe'],
            [['dateFrom', 'dateTo'], 'date', 'format' => 'yyyy-mm-dd']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $parent_labels = parent::attributeLabels();
        $my_labels = [
            'name' => 'Название',
            'dateFrom' => 'Дата выхода книги:',
            'dateTo' => 'До:',
            'fullName' => 'Автор',
        ];
        return array_merge($parent_labels, $my_labels);
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Books::find()
            ->Joinwith('author');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'date',
                'date_create',
                'author.fullName' => [
                    'asc' => ['authors.firstname' => SORT_ASC, 'authors.lastname' => SORT_ASC],
                    'desc' => ['authors.firstname' => SORT_DESC, 'authors.lastname' => SORT_DESC],
                    'label' => 'Full Name',
                    'default' => SORT_ASC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
        ]);
        $query->andFilterWhere(['>=', 'date', $this->dateFrom]);
        $query->andFilterWhere(['<=', 'date', $this->dateTo]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ;

        return $dataProvider;
    }
}
