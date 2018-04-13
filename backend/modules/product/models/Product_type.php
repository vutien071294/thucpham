<?php

namespace backend\modules\product\models;

use Yii;

/**
 * This is the model class for table "categoriesproducts".
 *
 * @property string $id
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
 */
class Product_type extends \yii\db\ActiveRecord
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
            [['title'], 'required','message' => 'Tiêu đề không được trống'],
            [['title'], 'string','max' => 255, 'min'=>3, 'tooShort'=>'{attribute} tối thiểu phải có 6 ký tự', 'tooLong'=> '{attribute} không quá 255 ký tự'],
            ['title', 'unique', 'message' => '{attribute} đã tồn tại.'],
            [['description', 'body', 'image_title', 'image_alt', 'sorting_price', 'sorting_brand', 'sorting_res', 'sorting_channel', 'tags', 'seo_description', 'code'], 'string'],
            [['parent_id', 'orders', 'create_by', 'update_by'], 'integer', 'message' => '{attribute} phải là số'],
            [['publish', 'is_top'], 'boolean'],
            [['title', 'title_en', 'title_fr', 'slug', 'image_preset'], 'string', 'max' => 255],
            [['image_url', 'seo_title', 'seo_keyword'], 'string', 'max' => 1000],
            [['create_time', 'update_time'], 'string', 'max' => 20],
            ['code', 'unique', 'message' => 'Mã chuyên mục đã tồn tại.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tiêu đề',
            'title_en' => 'Tiêu đề (en)',
            'title_fr' => 'Tiêu đề (fr)',
            'description' => 'Mô tả',
            'body' => 'Body',
            'code' => 'Mã loại',
            'parent_id' => 'Parent ID',
            'slug' => 'Slug',
            'publish' => 'Hiển thị',
            'is_top' => 'Tiêu biểu',
            'image_preset' => 'Ảnh đại diện',
            'image_url' => 'Image Url',
            'image_title' => 'Ảnh tiêu đề',
            'image_alt' => 'Image Alt',
            'orders' => 'Thứ tự hiển thị',
            'sorting_price' => 'Sorting Price',
            'sorting_brand' => 'Sorting Brand',
            'sorting_res' => 'Sorting Res',
            'sorting_channel' => 'Sorting Channel',
            'tags' => 'Tags',
            'create_time' => 'Thời gian tạo',
            'create_by' => 'Người tạo',
            'update_time' => 'Thời gian cập nhật',
            'update_by' => 'Người cập nhật',
            'seo_title' => 'Seo Title',
            'seo_keyword' => 'Seo Keyword',
            'seo_description' => 'Seo Description',
        ];
    }
    public function get_list_cate($id = '')
    {

        if (!$id) {
            $list_product_type = Product_type::find()->orderBy(['orders'=>SORT_ASC])->all();
        }else{
            // var_dump($id);die;
            $list_product_type = Product_type::find()->where(['!=','id', $id])->orderBy(['orders'=>SORT_ASC])->all();
            // echo "<pre>";
            // print_r($list_product_type);die;
        }

        $arr = array();
        $level_max = 1;
        foreach ($list_product_type as $key => $value) {
            $arr_temp = array();
            $level = (int)$value['level'];
            array_push($arr_temp, $value['id']);

            $before_tit;
            if ($level) {
                switch ($level) {
                    case 1:
                        $before_tit = '|-----';
                        break;
                    case 2:
                        $before_tit = '|-----|-----';
                        break;
                    case 3:
                        $before_tit = '|-----|-----|-----';
                        break;
                    case 4:
                        $before_tit = '|-----|-----|-----|-----';
                        break;
                    case 5:
                        $before_tit = '|-----|-----|-----|-----|-----';
                        break;
                    default:
                        $before_tit = '|-----';
                        break;
                }
            }
            array_push($arr_temp, $before_tit.' '.$value['title']);//1
            array_push($arr_temp, $value['parent_id']);//2
            array_push($arr_temp, $value['level']);//3
            array_push($arr_temp, $value['description']);//4
            array_push($arr , $arr_temp);
            
            if ($level) {
                $level_max = (int)$level;
            }
        }
        
        $arr_cate = array();
        foreach ($arr as $key => $value) {
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
        }
        return $arr_cate;
    }
    public function  get_list_cate_form()
    {
        // return   $list_product_type = Product_type::find()->where(['=','level', '1'])->orderBy(['orders'=>SORT_ASC])->all();
        return   $list_product_type = Product_type::find()->where(['=','publish', '1'])->andwhere(['=','level', '1'])->orderBy(['orders'=>SORT_ASC])->all();
    }
    public function  get_level_cate($id = '')
    {
        return   $level = Product_type::find()->where(['id' => $id])->orderBy(['orders'=>SORT_ASC])->one()['level'];
    }
}
