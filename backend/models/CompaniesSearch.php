<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Companies;

/**
 * CompaniesSearch represents the model behind the search form of `backend\models\Companies`.
 */
class CompaniesSearch extends Companies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['company_name', 'company_email', 'company_address', 'company_created_date', 'company_start_date', 'logo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Companies::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'company_id' => $this->company_id,
            'company_created_date' => $this->company_created_date,
            'company_start_date' => $this->company_start_date,
        ]);

        $query->andFilterWhere(['ilike', 'company_name', $this->company_name])
            ->andFilterWhere(['ilike', 'company_email', $this->company_email])
            ->andFilterWhere(['ilike', 'company_address', $this->company_address])
            ->andFilterWhere(['ilike', 'logo', $this->logo]);

        return $dataProvider;
    }
}
