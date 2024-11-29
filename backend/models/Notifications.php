<?php

namespace backend\models;

use common\models\Ingenieria;
use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property int $ingenieria_id
 * @property string|null $title
 * @property string|null $content
 * @property string|null $created_at
 * @property int|null $is_read
 *
 * @property Ingenieria $ingenieria
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingenieria_id'], 'required'],
            [['ingenieria_id', 'is_read'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'content'], 'string', 'max' => 255],
            [['ingenieria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingenieria::class, 'targetAttribute' => ['ingenieria_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ingenieria_id' => 'Ingenieria ID',
            'title' => 'Title',
            'content' => 'Content',
            'created_at' => 'Created At',
            'is_read' => 'Is Read',
        ];
    }

    /**
     * Gets query for [[Ingenieria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngenieria()
    {
        return $this->hasOne(Ingenieria::class, ['id' => 'ingenieria_id']);
    }
    public function getTimeAgo()
    {
        $diff = time() - strtotime($this->created_at);
        if ($diff < 60) {
            return 'Just now';
        } elseif ($diff < 3600) {
            return floor($diff / 60) . ' minutes ago';
        } elseif ($diff < 86400) {
            return floor($diff / 3600) . ' hours ago';
        } else {
            return floor($diff / 86400) . ' days ago';
        }
    }
}
