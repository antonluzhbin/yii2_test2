#!/usr/bin/env php
<?php

/**
 * Получение данных и преобразование в массив.
 */
$str = file_get_contents("./json.txt");
$arr = json_decode($str, true);

/**
 * Подключение к БД.
 */
$con = mysqli_connect("localhost", "root", "1", "test");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

/**
 * Обработка данных.
 */
getCategories($arr, 0, $con);

mysqli_close($con);

/**
 * Получение категорий.
 * 
 * @param Array $ms Массив входных данных.
 * @param Integer $parent Категория родитель.
 * @param MySQL connection $con Подключение к БД.
 */
function getCategories($ms, $parent, $con)
{
    foreach ($ms as $key => $val)
    {
        /**
         * Сохранение категорй в БД.
         */
        saveCategories($val, $parent, $con);
        
        if (isset($val['subcategories']))
        {
            /**
             * Обработка подкатегорий.
             */
            getCategories($val['subcategories'], $val['id'], $con);
        }
        
        if (isset($val['news']))
        {
            /**
             * Обработка новостей.
             */
            getNews($val['news'], $val['id'], $con);
        }
    }
}

/**
 * Обработка новостей.
 * 
 * @param Array $ms Массив входных данных.
 * @param Integer $category Категория.
 * @param MySQL connection $con Подключение к БД.
 */
function getNews($ms, $category, $con)
{
    foreach ($ms as $key => $val)
    {
        saveNews($val, $category, $con);
    }    
}

/**
 * Сохранение категорий в БД.
 * 
 * @param Array $val Массив данных.
 * @param Integer $parent Категория родитель.
 * @param MySQL connection $con Подключение к БД.
 */
function saveCategories($val, $parent, $con)
{
    if ($val["active"])
    {
        mysqli_query($con, "INSERT INTO category (id, name, active, parent) VALUES (" .
            "'" . $val['id'] . "', '" . $val['name'] . "', '" . $val['active'] . "', '" . $parent . "')");  
    }
}

/**
 * Сохранение новостей в БД.
 * 
 * @param Array $val Массив данных.
 * @param Integer $category Категория.
 * @param MySQL connection $con Подключение к БД.
 */
function saveNews($val, $category, $con)
{
    if ($val["active"])
    {                
        mysqli_query($con, "INSERT INTO news (id, active, title, image, description, text, date, category) VALUES (" .
            "'" . $val['id'] . "', '" . $val['active'] . "', '" . $val['title'] . "', " .
            "'" . $val['image'] . "', '" . $val['description'] . "', '" . $val['text'] . "', " .  
            "'" . $val['date'] . "', '" . $category ."')");  
    }
}

?>

