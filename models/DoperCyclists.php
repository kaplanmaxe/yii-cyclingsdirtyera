<?php

namespace app\models;

use Yii;
use app\models\BanTypes;

/**
 * This is the model class for table "Doper_cyclists".
 *
 * @property integer $doper_cyclist_id
 * @property integer $doper_cyclist_ban_type_id
 * @property integer $doper_cyclist_ban_length
 */
class DoperCyclists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Doper_cyclists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doper_cyclist_id', 'doper_cyclist_ban_type_id', 'doper_cyclist_ban_length'], 'required'],
            [['doper_cyclist_id', 'doper_cyclist_ban_type_id', 'doper_cyclist_ban_length'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doper_cyclist_id' => 'Doper Cyclist ID',
            'doper_cyclist_ban_type_id' => 'Doper Cyclist Ban Type ID',
            'doper_cyclist_ban_length' => 'Doper Cyclist Ban Length',
        ];
    }

    /**
    * Relationship with Cyclists table
    */
    public function getCyclists() {
        return $this->hasOne(Cyclists::className(), ['cyclist_id' => 'doper_cyclist_id']);
    }

    /**
    * Relationship with Ban_types table
    */
    public function getBanTypes() {
        return $this->hasOne(BanTypes::className(),  ['ban_type_id' => 'doper_cyclist_ban_type_id']);
    }

    public function getDopingDetails($cyclist_id) {
        return DoperCyclists::find()
            ->joinWith('banTypes')
            ->where(['doper_cyclist_id'=>$cyclist_id])
            ->asArray()
            ->all();
    }
}
