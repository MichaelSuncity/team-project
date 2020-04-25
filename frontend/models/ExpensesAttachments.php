<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "expenses_attachments".
 *
 * @property int $id
 * @property int|null $expenses_id
 * @property string|null $path
 *
 * @property Expenses $expenses
 */
class ExpensesAttachments extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expenses_attachments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expenses_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['expenses_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expenses::class, 'targetAttribute' => ['expenses_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expenses_id' => 'Expenses ID',
            'path' => 'Path',
        ];
    }

    /**
     * Gets query for [[Expenses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpenses()
    {
        return $this->hasOne(Expenses::class, ['id' => 'expenses_id']);
    }
}