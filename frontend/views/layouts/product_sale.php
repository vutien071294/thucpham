<?php 
namespace frontend\views\layouts;

use frontend\models\Saleoff;
use frontend\components\ComponentBase;

$components = new ComponentBase();
$base_url = $components->Base_url();

$saleoff = new Saleoff();
$list_saleoff = $saleoff->getlistsale();
// var_dump($list_saleoff);die;
?>
 <!-- CLIENTS -->
    <div class="clients-wrap">
        <div class="container">
            <div class="row heading-wrap">
                <div class="span12 heading">
                    <h2>Các sản phẩm khuyến mãi  <span></span></h2>
                </div>
            </div>

            <div class="row">
                    <?php foreach ($list_saleoff as $key => $value) { ?>
                    <div class="span3 product">

                        <div>
                            <figure>
                                <a href="#"><img src="<?=$base_url.'public/images/image_products/'.$value['image_preset']?>" alt=""></a>
                                <div class="overlay">
                                    
                                    <div class="icon">
                                    <a href="javascript:;" class="fcybox-order" data-id="<?=$value['code'] ?>" title="Đặt Hàng Online">Mua ngay
                                    </a>
                                    </div>
                                </div>
                            </figure>
                            <div class="detail">
                                <span>Giá: <?php 
                                echo number_format($value['sell_price']) . ' đ'. "\n";
                                ?></span>
                                <a href="<?=$base_url.'product/products?prm='.$value['code'] ?>">
                                    <h4><?=$value['title'] ?></h4>
                                </a>
                            </div>
                        </div>

                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
    <!-- CLIENTS -->
<!-- PRODUCT-OFFER -->
