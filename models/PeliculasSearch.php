<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Peliculas;

/**
 * PeliculasSearch represents the model behind the search form about `app\models\Peliculas`.
 */
class PeliculasSearch extends Peliculas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'duracion', 'genero_id'], 'integer'],
            [['titulo', 'sinopsis'], 'safe'],
            [['anyo'], 'number'],
        ];
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
        $query = Peliculas::find();

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
            'id' => $this->id,
            'anyo' => $this->anyo,
            'duracion' => $this->duracion,
            'genero_id' => $this->genero_id,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'sinopsis', $this->sinopsis]);

        return $dataProvider;
    }
}
