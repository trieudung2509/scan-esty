<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function headings():array{
        return[
            'Category',
            'Brand',
            'Product Name',
            'Product Description',
            'Package Weight',
            'Package Length',
            'Package Width',
            'Package Height',
            'Delivery options',
            'Identifier Code Type',
            'Identifier Code',
            'Variation 1',
            'Variation 2',
            'Variant Image',
            'Retail Price',
            'Quantity Warehouse',
            'Seller SKU',
            'Main Product Image',
            'Product Image 2',
            'Product Image 3',
            'Product Image 4',
            'Product Image 5',
            'Product Image 6',
            'Product Image 7',
            'Product Image 8',
            'Product Image 9',
            'Size Chart',
            'Material',
            'Pattern',
            'Neckline',
            'Clothing Length',
            'Season',
            'Style',
            'Fit',
            'Stretch',
            'Care Instructions',
            'Waist Height'
        ];
    } 

    public function collection()
    {
        $colors = ["Black", "White", "Red", "Navy Blue", "Ash Grey", "Royal Blue", "Light Pink", "Military Green", "Orange", "Brown", "Creme"];
        $colors_unisex = ["Black", "White", "Red", "Navy Blue", "Heather Grey", "Royal Blue", "Light Pink", "Forest Green", "Orange"];
        $sizes = ["S", "M", "L", "XL", "2XL", "3XL", "4XL", "5XL"];
        $category = ["Short Sleeve Tee", "Unisex Crewneck Sweatshirt"];

        $arr_product = [];

        $product = Product::where('id', $this->id)->first();
        $list_image = explode(";", $product->image);

        foreach($category as $cate) {
            foreach ($sizes as $size) {
                $textCateSize = $cate. " " . $size;
                $list_colors = $cate == "Short Sleeve Tee" ? $colors : $colors_unisex;
                $type = $cate == "Short Sleeve Tee" ? "TSHIRT": "SWSHIRT";
                foreach($list_colors as $color) {
                    $item = [];
                    $item["category"] = "Men's Tops/T-shirts (601226)";
                    $item["brand"] = "";
                    $item["product_name"] = $product->name ." ".$product->prefix;
                    $item["product_description"] = "* 2 styles available: Unisex Short Sleeves, Crewneck Sweatshirt; High quality and reasonable price with various colors and sizes to choose, our shirt makes a perfect and timeless gift

                    * Sure to be one of your favorites, our T-Shirt with special and modern perspective stylish design will catch people's attention when you walk down the road
                    
                    * Bright, accurate color, soft material for outstanding finished garments, our shirt will make you more attractive, charming, fashionable and chic, make your shape look great
                    
                    * A great gift for yourself or your beloved ones on Birthday, Halloween, Christmas, New year, Father's day, Mother's day, Anniversary day, Valentine, St Patrick's Day
                    
                    * This shirt has the classic cotton look and feel. Casual elegance will make it an instant favorite in everyone's wardrobe.
                    
                    - PRINTED & SHIPPED from USA
                    
                    - Classic fit
                    
                    - Runs true to size
                    
                    We can customize all of our designs to your needs. Just message us with your request!
                    
                    Please Note:
                    
                    - There may be slight differences between the color displayed on the screen and the actual color.
                    
                    - This is a customizedly printed item produced just for you. For this reason, we only refund or replace items if they are defective or damaged.
                    
                    - Care instructions: Machine wash: warm (max 40C or 105F); Non-chlorine: bleach as needed; Tumble dry: medium; Do not iron ; Do not dryclean
                    
                    Don't hesitate, Click Add to Cart to take this amazing shirt today!";
                    $item["package_weight"] = 1;
                    $item["package_length"] = 2;
                    $item["package_width"] = 9;
                    $item["package_height"] = 14;
                    $item["delivery_options"] = "Default";
                    $item["identifier_code_type"] = "GTIN (1)";
                    $item["identifier_code"] = "";
                    $item["variation_1"] = $color;
                    $item["variation_2"] = $textCateSize;
                    $item["variant_image"] = "";
                    $item["retail_price"] = "";
                    $item["quantity_warehouse"] = 686;
                    $item["seller_SKU"] = $product->prefix."_".$type."_".$size."_".$color;
                    $item["main_product_image"] = isset($product->main_image) ? $product->main_image : "";
                    $item["product_image_2"] = isset($list_image[0]) ? $list_image[0] : "";
                    $item["product_image_3"] = isset($list_image[1]) ? $list_image[1] : "";
                    $item["product_image_4"] = isset($list_image[2]) ? $list_image[2] : "";
                    $item["product_image_5"] = isset($list_image[3]) ? $list_image[3] : "";
                    $item["product_image_6"] = isset($list_image[4]) ? $list_image[4] : "";
                    $item["product_image_7"] = isset($list_image[5]) ? $list_image[5] : "";
                    $item["product_image_8"] = isset($list_image[6]) ? $list_image[6] : "";
                    $item["product_image_9"] = isset($list_image[7]) ? $list_image[7] : "";
                    $item["size_chart"] = isset($product->size_chart_image) ? $product->size_chart_image : "";
                    $item["material"] = "Cotton";
                    $item["pattern"] = "Graphic";
                    $item["neckline"] = "Crew Neck";
                    $item["clothing_length"] = "Medium";
                    $item["sleeve_length"] = "Long Sleeve";
                    $item["season"] = "All Seasons";
                    $item["style"] = "Basic";
                    $item["fit"] = "";
                    $item["stretch"] = "";
                    $item["care_instructions"] = "Machine Washable";
                    $item["waist_height"] = "";
                   
                    array_push($arr_product, $item);
                }
            }
        }

        return collect($arr_product);
    }
}
