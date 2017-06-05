<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $room_id
 * @property string $type
 * @property integer $time_start
 * @property integer $time_end
 * @property integer $date
 *
 * @property Room $room
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'room_id', 'type', 'time_start', 'time_end', 'date'], 'required'],
            [['room_id', 'time_start', 'time_end', 'date'], 'integer'],
            [['name', 'description', 'type'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'room_id' => 'Room ID',
            'type' => 'Type',
            'time_start' => 'Time Start',
            'time_end' => 'Time End',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
}
