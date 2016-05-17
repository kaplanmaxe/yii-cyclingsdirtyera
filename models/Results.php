<?php

namespace app\models;

use Yii;
use app\models\Cyclists;

/**
 * This is the model class for table "Results".
 *
 * @property integer $result_year
 * @property integer $result_place
 * @property integer $result_cyclist_id
 * @property integer $result_cyclist_dq
 */
class Results extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Results';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['result_year', 'result_place', 'result_cyclist_id'], 'required'],
            [['result_year', 'result_place', 'result_cyclist_id', 'result_cyclist_dq'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'result_year' => 'Result Year',
            'result_place' => 'Result Place',
            'result_cyclist_id' => 'Result Cyclist ID',
            'result_cyclist_dq' => 'Result Cyclist Dq',
        ];
    }

    public function getCyclists() {
        return $this->hasOne(Cyclists::className(), ['result_cyclist_id' => 'cyclist_id']);
    }

    public function getTourResults($year) {
        return Results::find()
            ->where(['result_year'=>$year])
            ->asArray()
            ->all();
    }
    public function resultDQ($cyclist_id,$year) {
        $status = Results::find()
            ->select('result_cyclist_dq')
            ->where([
                'result_cyclist_id' => $cyclist_id,
                'result_year'       => $year
            ])
            ->one()
            ->result_cyclist_dq;
        $message = ($status!=0) ? "Yes" : "";
        return $message;
    }
}
