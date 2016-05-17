<?php

namespace app\models;

use Yii;
use app\models\DoperCyclists;

/**
 * This is the model class for table "Ban_types".
 *
 * @property integer $ban_type_id
 * @property string $ban_type_desc
 */
class BanTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ban_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ban_type_desc'], 'required'],
            [['ban_type_desc'], 'string', 'max' => 50],
            [['ban_type_desc'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ban_type_id' => 'Ban Type ID',
            'ban_type_desc' => 'Ban Type Desc',
        ];
    }
    /**
    * Relation with Doper Cyclists
    */
    public function getDoperCyclists() {
        return $this->hasOne(DoperCyclists::className(),['doper_cyclist_ban_type_id' => 'ban_type_id']);
    }
}
