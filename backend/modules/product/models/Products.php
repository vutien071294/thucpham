<?php

namespace backend\modules\product\models;

use Yii;
use yii\db\Query;
use backend\modules\product\models\Products_involve;
use backend\modules\product\models\Products_images;
use backend\modules\product\models\Products_properties;
use backend\modules\product\models\Product_type;
use backend\modules\categorys\models\Maker;

/**
 * This is the model class for table "products".
 *
 * @property string $id
 * @property string $code
 * @property string $titele
 * @property string $title_en
 * @property string $title_fr
 * @property string $description
 * @property string $description_en
 * @property string $description_fr
 * @property string $desc
 * @property string $desc_en
 * @property string $desc_fr
 * @property string $body
 * @property string $body_en
 * @property string $body_fr
 * @property string $body2
 * @property string $body2_en
 * @property string $body2_fr
 * @property string $body3
 * @property string $body3_en
 * @property string $body3_fr
 * @property string $image_preset
 * @property string $image_url
 * @property string $image_title
 * @property string $image_alt
 * @property integer $is_new
 * @property integer $is_promotion
 * @property integer $is_seller
 * @property integer $is_hot
 * @property integer $is_stock
 * @property double $list_price
 * @property double $input_price
 * @property double $sell_price
 * @property string $warranty
 * @property double $orders
 * @property boolean $publish
 * @property boolean $show_price
 * @property string $slug
 * @property string $tags
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_description
 * @property string $categories_id
 * @property string $sub_categories_id
 * @property string $create_time
 * @property string $create_by
 * @property string $update_time
 * @property string $update_by
 * @property string $hightlight
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $search_text;
    public $products_list_involve = array();
    public $properties = array();
    public $image_roducts_list_involve;

    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required','message' => 'Tiêu đề sản phẩm không được trống'],
            [['code'], 'required','message' => 'Mã sản phẩm không được trống'],
            [['categories_id'], 'required','message' => 'Loại sản phẩm không được trống'],
            [['input_price'], 'required','message' => 'Giá sản phẩm không được trống'],
            [['description'], 'string'],
            [['categories_id', 'create_by', 'update_time'], 'integer'],
            [['orders'], 'number','message' => '{attribute} phải là số'],
            [['publish', 'is_new', 'is_promotion', 'is_seller', 'is_stock'], 'boolean'],
            [['code', 'title', 'title_en', 'title_fr', 'image_preset', 'slug'], 'string', 'max' => 255],
            [['create_time', 'update_by'], 'string', 'max' => 20],
            [['products_list_involve'], 'safe'],
            [['image_roducts_list_involve'], 'safe'],
            [['properties'], 'safe'],
            [['input_price','list_price', 'sell_price'], 'validateNumber'],
            [['so_luong',], 'number', 'message' => 'Số lượng sản phẩm phải là một số'],
            [['provider_id',], 'integer', 'message' => 'Chọn nhà cung cấp'],
             [['xuat_xu', 'bao_hanh', 'mau_sac', 'chat_lieu', 'kich_thuoc',], 'string', 'max' => 255],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Mã sản phẩm',
            'title' => 'Tiêu đề',
            'title_en' => 'Title En',
            'title_fr' => 'Title Fr',
            'description' => 'Mô tả',
            'description_en' => 'Description En',
            'description_fr' => 'Description Fr',
            'desc' => 'Desc',
            'desc_en' => 'Desc En',
            'desc_fr' => 'Desc Fr',
            'body' => 'Body',
            'body_en' => 'Body En',
            'body_fr' => 'Body Fr',
            'body2' => 'Body2',
            'body2_en' => 'Body2 En',
            'body2_fr' => 'Body2 Fr',
            'body3' => 'Body3',
            'body3_en' => 'Body3 En',
            'body3_fr' => 'Body3 Fr',
            'image_preset' => 'Imag Preset',
            'image_url' => 'Image Url',
            'image_title' => 'Image Title',
            'image_alt' => 'Image Alt',
            'is_new' => 'Sản phẩm mới',
            'is_promotion' => 'Sản phẩm nổi bật',
            'is_seller' => 'Sản phẩm bán chạy',
            'is_hot' => 'Is Hot',
            'is_stock' => 'Còn hàng',
            'list_price' => 'List Price',
            'input_price' => 'Input Price',
            'sell_price' => 'Sell Price',
            'warranty' => 'Warranty',
            'orders' => 'Thứ tự sản phẩm',
            'publish' => 'Hiển thị',
            'show_price' => 'Show Price',
            'slug' => 'Slug',
            'tags' => 'Tags',
            'seo_title' => 'Seo Title',
            'seo_keyword' => 'Seo Keyword',
            'seo_description' => 'Seo Description',
            'categories_id' => 'Chuyên mục',
            'sub_categories_id' => 'Sub Categories ID',
            'create_time' => 'Create Time',
            'create_by' => 'Create By',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
            'provider_id' => 'Nhà cung cấp',
        ];
    }

    public function validateNumber()
    {
        $check_int = "/^[0-9|\,]+$/";
        if ($this->input_price) 
        {
            if ($this->input_price == '0') {
                $this->addError('input_price','Giá nhập phải có giá trị !');
            }
            if (!preg_match($check_int, $this->input_price)) 
                {
                    $this->addError('input_price','Giá nhập là một số !');
                }
            
        }
        if ($this->list_price) 
        {
            if (!preg_match($check_int, $this->list_price)) 
                {
                    $this->addError('list_price','Giá cũ là một số !');
                }
        }
        if ($this->sell_price) 
        {
            if ((string)$this->sell_price == '0') {
                $this->addError('input_price','Giá bán phải có giá trị !');
            }
            if (!preg_match($check_int, $this->sell_price)) 
                {
                    $this->addError('sell_price','Giá bán là một số !');
                }
        }
    }

    public function save_products_involve($list, $code_pro)
    {
        $id_user = Yii::$app->user->id;
        $create_time = time();
        if ($list) {
            foreach ($list as $key => $value) {
                $obj = new Products_involve();
                $obj->involve_product_code = (string)$value;
                $obj->product_code = (string)$code_pro;
                $obj->create_time = (int)$create_time;
                $obj->create_by = (int)$id_user;
                $obj->update_time = (int)$create_time;
                $obj->update_by = (int)$id_user;
                $obj->save(false);
            }
        }
    }
    public function save_products_images($list, $code_pro)
    {
        $id_user = Yii::$app->user->id;
        $create_time = time();
        $status = 1;
        if ($list) {
            foreach ($list as $key => $value) {
                $obj = new Products_images();
                $obj->link_image = (string)$value;
                $obj->product_code = (string)$code_pro;
                $obj->status = (int)$status;
                $obj->create_time = (int)$create_time;
                $obj->create_by = (int)$id_user;
                $obj->update_time = (int)$create_time;
                $obj->update_by = (int)$id_user;
                $obj->save(false);
            }
        }
    }

    public function get_list_property($id='')
    {
        $sql = "SELECT *
            FROM cate_properties 
            WHERE cate_id = ".$id;
        $list = Yii::$app->db->createCommand($sql)->queryAll();
        return $list;
    }
    public function save_products_property($list, $code_pro)
    {
        $id_user = Yii::$app->user->id;
        $create_time = time();
        $status = 1;
        if ($list) {
            foreach ($list as $key => $value) {
                if ($value) {
                    $obj = new Products_properties();
                    $obj->product_code = (string)$code_pro;
                    $obj->name_cate_property = (string)$key;
                    $obj->value = (string)$value;
                    $obj->create_time = (int)$create_time;
                    $obj->create_by = (int)$id_user;
                    $obj->update_time = (int)$create_time;
                    $obj->update_by = (int)$id_user;
                    $obj->save(false);
                }
            }
        }
    }


    public function getCategory()
    {
        return $this->hasOne(Product_type::className(), ['id' => 'categories_id']);
    }
    public function getMaker()
    {
        return $this->hasOne(Maker::className(), ['id' => 'provider_id']);
    }

    public function get_list_product_sale($code = '')
    {
        $sql = "SELECT DISTINCT  prd.* , ctp.title as cate_title, ps.id as ps_sale
                    FROM products prd
                    JOIN product_sale prs ON prd.code = prs.product
                    JOIN sale_off so ON prs.sale_off_id = so.code
                    JOIN categoriesproducts ctp ON prd.categories_id = ctp.id
                    right JOIN product_sale ps ON prd.code = ps.product
                    WHERE prs.sale_off_id = '".$code."' AND prd.publish = 1";
        $query = new Query();
        $list_data = Yii::$app->db->createCommand($sql)->queryAll();
        return $list_data;
    }

}
