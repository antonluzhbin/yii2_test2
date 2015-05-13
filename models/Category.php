<?php

namespace app\models;
use \yii\db\Expression;

class Category extends \yii\db\ActiveRecord
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
            [['id', 'name', 'active', 'parent'], 'required'],
            ['name', 'string'],
            [['id', 'active', 'parent'], 'integer']
        ];
    }
 
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'category';
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
            'name' => 'Название',
            'active' => 'Активность',
            'parent' => 'Категория родитель'
        );
    }
    
    public function path()
    {
        $res = static::getDb()->createCommand("select id, name, parent from category")->queryAll();
        
        $arr = Array();
        foreach ($res as $val)
        {
            $arr[$val['id']] = $val;
        }
        
        $path = Array();
        foreach ($arr as $key => $val)
        {
            $str = '';
            $parent = $val['parent'];
            while ($parent)
            {
                if (isset($arr[$parent]))
                {
                    $str = $arr[$parent]['name'] . " -> " . $str;
                    $parent = $arr[$parent]['parent'];
                }
            }
            $path[$key] = ($str === '' ? 'Нет' : $str);
        }
        
        return $path;
    }
    
    public function findName()
    {
        $res = static::getDb()->createCommand("select id, name from category")->queryAll();
        
        $arr = Array();
        foreach ($res as $val)
        {
            $arr[$val['id']] = $val['name'];
        }
                
        return $arr;
    }
}

