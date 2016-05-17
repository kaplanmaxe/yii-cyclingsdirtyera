<?php

namespace app\models;

use Yii;
use app\models\Results;
use app\models\DoperCyclists;

/**
 * This is the model class for table "Cyclists".
 *
 * @property integer $cyclist_id
 * @property string $cyclist_name
 * @property integer $cyclist_doper
 * @property integer $cyclist_banned
 */
class Cyclists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Cyclists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cyclist_name'], 'required'],
            [['cyclist_doper', 'cyclist_banned'], 'integer'],
            [['cyclist_name'], 'string', 'max' => 50],
            [['cyclist_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cyclist_id' => 'Cyclist ID',
            'cyclist_name' => 'Cyclist Name',
            'cyclist_doper' => 'Cyclist Doper',
            'cyclist_banned' => 'Cyclist Banned',
        ];
    }
    /**
    * Relationship with Results table
    */ 
    public function getResults() {
        return $this->hasMany(Results::className(), ['result_cyclist_id' => 'cyclist_id']);
    }

    /**
    * Relationship with Doper_cyclists table
    */
    public function getDoperCyclists() {
        return $this->hasMany(DoperCyclists::className(), ['doper_cyclist_id' => 'cyclist_id']);
    }

    public function getCyclistName($cyclist_id) {
        return Cyclists::findOne($cyclist_id)->cyclist_name;
    }

    public function getCyclistDoper($cyclist_id) {
        $status = Cyclists::findOne($cyclist_id)->cyclist_doper;
        switch ($status) {
            case 0:
                $message = "No";
                break;
            case 1:
                $message = "Yes";
                break;
            case 2:
                $message = "Highly Suspected";
                break;
            default:
                $message = "";
        }
        return $message;
    }
}
