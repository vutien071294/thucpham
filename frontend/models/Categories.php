<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property string $id
 * @property string $code
 * @property string $title
 * @property string $title_en
 * @property string $title_fr
 * @property string $description
 * @property string $body
 * @property string $parent_id
 * @property string $slug
 * @property boolean $publish
 * @property boolean $is_top
 * @property string $image_preset
 * @property string $image_url
 * @property string $image_title
 * @property string $image_alt
 * @property integer $orders
 * @property string $sorting_price
 * @property string $sorting_brand
 * @property string $sorting_res
 * @property string $sorting_channel
 * @property string $tags
 * @property string $create_time
 * @property string $create_by
 * @property string $update_time
 * @property string $update_by
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_description
 * @property integer $level
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'body', 'image_title', 'image_alt', 'sorting_price', 'sorting_brand', 'sorting_res', 'sorting_channel', 'tags', 'seo_description'], 'string'],
            [['parent_id', 'orders', 'create_by', 'update_by', 'level'], 'integer'],
            [['publish', 'is_top'], 'boolean'],
            [['code', 'title', 'title_en', 'title_fr', 'slug', 'image_preset'], 'string', 'max' => 255],
            [['image_url', 'seo_title', 'seo_keyword'], 'string', 'max' => 1000],
            [['create_time', 'update_time'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'title' => 'Title',
            'title_en' => 'Title En',
            'title_fr' => 'Title Fr',
            'description' => 'Description',
            'body' => 'Body',
            'parent_id' => 'Parent ID',
            'slug' => 'Slug',
            'publish' => 'Publish',
            'is_top' => 'Is Top',
            'image_preset' => 'Image Preset',
            'image_url' => 'Image Url',
            'image_title' => 'Image Title',
            'image_alt' => 'Image Alt',
            'orders' => 'Orders',
            'sorting_price' => 'Sorting Price',
            'sorting_brand' => 'Sorting Brand',
            'sorting_res' => 'Sorting Res',
            'sorting_channel' => 'Sorting Channel',
            'tags' => 'Tags',
            'create_time' => 'Create Time',
            'create_by' => 'Create By',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
            'seo_title' => 'Seo Title',
            'seo_keyword' => 'Seo Keyword',
            'seo_description' => 'Seo Description',
            'level' => 'Level',
        ];
    }
}
