<?php

namespace frontend\modules\danhmuc\models;

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
class Danhmuc extends \yii\db\ActiveRecord
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
    public function get_cate_all(){
        $list_product_type = Danhmuc::find()->where(['=','publish', '1'])->orderBy(['orders'=>SORT_ASC])->all();
        $arr = array();
        $level_max = 1;
        foreach ($list_product_type as $key => $value) {
            $arr_temp = array();
            $level = (int)$value['level'];
            array_push($arr_temp, $value['id']);

            // $before_tit;
            // if ($level) {
            //     switch ($level) {
            //         case 1:
            //             $before_tit = '|-----';
            //             break;
            //         case 2:
            //             $before_tit = '|-----|-----';
            //             break;
            //         case 3:
            //             $before_tit = '|-----|-----|-----';
            //             break;
            //         case 4:
            //             $before_tit = '|-----|-----|-----|-----';
            //             break;
            //         case 5:
            //             $before_tit = '|-----|-----|-----|-----|-----';
            //             break;
            //         default:
            //             $before_tit = '|-----';
            //             break;
            //     }
            // }
            // array_push($arr_temp, $before_tit.' '.$value['title']);//1
            array_push($arr_temp, $value['title']);//1
            array_push($arr_temp, $value['parent_id']);//2
            array_push($arr_temp, $value['level']);//3
            array_push($arr_temp, $value['description']);//4
            array_push($arr_temp, $value['publish']);//5
            array_push($arr_temp, $value['is_top']);//6
            array_push($arr_temp, $value['orders']);//7
            array_push($arr_temp, $value['code']);//8
            array_push($arr , $arr_temp);
            
            if ($level) {
                $level_max = (int)$level;
            }
        }
        
        $foo = array();
        foreach ($arr as $key => $value) {
            $arr_cate = array();
            
            if ($value[3] == '1' ) {
                array_push($arr_cate, $value);
                $parent_id1 = $value[0];
                foreach ($arr as $key2 => $value2) {
                    if ($parent_id1 == $value2[2]) {
                        array_push($arr_cate, $value2);
                        $parent_id2 = $value2[0];
                        foreach ($arr as $key3 => $value3) {
                            if ($parent_id2 == $value3[2]) {
                                array_push($arr_cate, $value3);
                                $parent_id3 = $value3[0];
                                foreach ($arr as $key4 => $value4) {
                                    if ($parent_id3 == $value4[2]) {
                                        array_push($arr_cate, $value4);
                                        $parent_id4 = $value4[0];
                                        foreach ($arr as $key5 => $value5) {
                                            if ($parent_id4 == $value5[2]) {
                                                array_push($arr_cate, $value5);
                                                $parent_id5 = $value5[0];
                                                foreach ($arr as $key6 => $value6) {
                                                    if ($parent_id5 == $value6[2]) {
                                                        array_push($arr_cate, $value6);
                                                        $parent_id6 = $value6[0];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($arr_cate) {
                array_push($foo , $arr_cate);
                unset($arr_cate);
            }
        }
        return $foo;
    }
}
