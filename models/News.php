<?php

namespace app\models;
use \yii\db\Expression;

class News extends \yii\db\ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comments the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function rules()
    {
        return [
            [['id', 'active', 'title', 'image', 'description', 'text', 'date', 'category'], 'required'],
            [['title', 'image', 'description', 'text'], 'string'],
            [['id', 'active', 'category'], 'integer'],
            ['date', 'date', 'format' => 'yyyy-MM-dd']
        ];
    }
 
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'news';
    }
 
    /**
     * @return array primary key of the table
     **/
    public static function primaryKey()
    {
        return array('id');
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'active' => 'Активность',
            'title' => 'Заголовок',
            'image' => 'Картинка',
            'description' => 'Описание',
            'text' => 'Текст',
            'date' => 'Дата',
            'category' => 'Категория'
        );
    }
}

