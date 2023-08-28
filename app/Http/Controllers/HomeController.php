<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;

class HomeController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function index()
    {
        $products = Product::orderby('created_at', 'desc')->paginate(10);
        return view('welcome', compact('products'));
    }

    public function insert(Request $request) {
        $url = $request->url;
        $prefix = $request->prefix;

        $html = file_get_html($url);

        $articles = $html->find("ul.carousel-pane-list li");

        $arr_images = [];
        $title = $html->find("#listing-page-cart .wt-mb-xs-1 h1.wt-line-height-tight", 0)->plaintext;
        
        foreach($articles as $index => $article) {
            $image = $article->find('img.wt-rounded', 0)->getAttribute("data-src-zoom-image");
        
            if ($image != null) {
                $image_after = $image;
            } else {
                $image1 = $article->find('img.wt-rounded', 0)->getAttribute("data-src");
                $image_after = $image1;
            }
            if ($index == 0) {
                $main_image = $image_after;
                continue;
            }

            if ($index == count($articles) - 1) {
                continue;
            }
            array_push($arr_images, $image_after); 
        }
        
        Product::create([
            'name' => $title,
            'category_name' => "",
            'link' => $url,
            'prefix' => $prefix,
            'size_image' => '',
            'replace_size_image' => '',
            'main_image' => $main_image,
            'size_chart_image' => 'https://trello.com/1/cards/64e6da189f75955e3a5f31f3/attachments/64e6da1a92cb2cae89820306/download/z4629148262160_e054408f43d36fc88f936e60b7c9257f.jpg?fbclid=IwAR1Quz0ZuDywg33IjHwkQiP_LgxPcsdLbQ-jViyoUQVwktZ8j_t-jScp0PY',
            'image' => implode(";",$arr_images),
        ]);

        return response()->json([
            'status' => 'success', 
            'message' => 'Get data successfully!'
        ], 200);
    }

    public function export(Request $request) {
        $id = $request->id;
        return Excel::download(new ProductExport($id), 'product.xlsx');
    }
}