<?php

namespace App\Http\Controllers;

use Auth;
use App\Model;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\View;
use Lava;
use Input;




class DealController extends Controller
{
    public function deal_list(){

        $order_by = Input::has('order_by') ? Input::get('order_by') : 'title';
        $search = Input::has('search_field') ? Input::get('search_field') : '';

        $deals = \App\Model\ShareDeal::where('is_active','=',1)->where(function($query){

            $min_price = Input::has('min_price') ? Input::get('min_price') : null;
            $max_price = Input::has('max_price') ? Input::get('max_price') : null;
            $categorys = Input::has('categorys') ? Input::get('categorys') : [];

            

            if(isset($min_price) && isset($max_price)){

                if(isset($categorys)){
                    foreach ($categorys as $category) {
                        $query->orWhere('original_price','>=',$min_price)
                                ->where('original_price','<=',$max_price)
                                ->where('category','=',$category);
                    }
                }
                $query->where('original_price','>=',$min_price)
                        ->where('original_price','<=',$max_price);
                
            }elseif(isset($categorys)){
                if(isset($categorys)){
                    foreach ($categorys as $category) {
                        $query->orWhere('category','=',$category);
                    }
                }
            }       


        })->select(\DB::raw('*'), \DB::raw('count(*) as count'), 
            \DB::raw('min(original_price) as min'), 
            \DB::raw('max(original_price) as max'))
            ->where('title','like','%'.$search.'%')
            ->orderBy($order_by, 'asc')->groupBy('title')->get();


        if (!Auth::guest()){
            $fav_deals = \App\Model\FavDeal::find(Auth::user()->name);
        }else{
            $fav_deals = "Please Login to view your favourite deal...";
        }

        $category = \DB::table('categorys')->get();
        
        return view('deal_list', compact(['category','deals','fav_deals']));
      
    }

    public function fav_deal($id){

        $fav_deals = \App\Model\FavDeal::find(Auth::user()->name);
        $fav_deal = $fav_deals->fav_deal;

        $fav = Input::has('fav') ? Input::get('fav') : null;

        if ($fav == "gray"){
            \DB::table('users')
                ->where('name', Auth::user()->name)
                ->update(['fav_deal' => $fav_deal. $id.',']);

        } elseif ($fav == "red") {
            \DB::table('users')
                ->where('name', Auth::user()->name)
                ->update(['fav_deal' => str_replace($id.',','',$fav_deal)]);
        }

        return redirect()->back(); 
    }

    public function deal($title){

        $deal = \App\Model\ShareDeal::where('is_active','=',1)->where('title', '=', $title)->where(function($query){     
        })->get();


        $count =$deal->count();

        $datatable = lava::DataTable();
        $datatable->addStringColumn('Store');
        $datatable->addNumberColumn('Price (RM)');

        // addNumberColumn( string $label = '', Format $format = null, string $role = '')

        $data = $deal->toArray();
        
        $deal_array = array();
        for ($i=0; $i<$count; $i++){

            $array = ['deals' => ['store' => $data[$i]['store'], 'price' => $data[$i]['original_price']]];
            $store = array_get($array, 'deals.store');
            $price = array_get($array, 'deals.price');

            $deal_array[$i][0] = $store;
            $deal_array[$i][1] = $price;
        }

        $datatable->addRows($deal_array);


        $lineChart = Lava::NumberFormat([
            'prefix'         => 'RM '
        ]);

        // echo $deal_array;

        $lineChart = lava::LineChart('Donuts', $datatable, [
            'title' => $data[0]['title'],
            'titleColor' => 'red',
            'titlePosition' => 'right',
            'axisTitlesPosition' => 'right',
            'prefix'         => 'RM ',
            // 'width' => 900,
            'pointSize' => 5,
            'legend' => [
                'position' => 'none'
            ],
            'hAxis' => [
                'title' => 'Store'
            ],
            'vAxis' => [
                'title' => 'Price (RM)'
            ],
            'titleTextStyle' => [
                'fontName' => 'Arial',
                'fontColor' => 'red',
                'fontSize' => 20,
                'fontPosition' => 'right',
            ],
            'events' => [
                'select' => 'selectCallback'
            ]

            // 'pieSliceText' => 'value'
        ]);
        $filter  = lava::NumberRangeFilter(1, 500);
        $control = lava::ControlWrapper($filter, 'control');
        $chart   = lava::ChartWrapper($lineChart, 'chart');
        lava::Dashboard('Donuts')->bind($control, $chart);



        if (!Auth::guest()){
            $fav_deals = \App\Model\FavDeal::find(Auth::user()->name);
        }else{
            $fav_deals = "Please Login to view your favourite deal...";
        }

        return view('deal',['title' => $deal, 'fav_deals' => $fav_deals]);   


        // return view('deal', compact(['title'=> $deal,'fav_deals']));   
        // return view('deal_list', compact(['category','deals','fav_deals']));   
    }

    public function share_deal_form(){

        $categorys = \DB::table('categorys')->get();
        return view('share_deal', ['categorys' => $categorys]);
   
    }

    public function share_deal_store(Request $data){
        
        $validation = Validator::make($data->all(), array(
            'title' => 'required',
            'original_price' => 'required',

            'store' => 'required',
            'category' => 'required',
            // 'category' => 'not_in:-- Select --',

            'description' => 'required',
            'location' => 'required',
            'url' => 'url',

            'image' => 'required|mimes:jpg,jpeg|Max:1000',

            ));

        if ($validation->fails()){
            
            return Redirect::to('share_deal')->withInput()->withErrors($validation);
        }else{

            // if($success){

                $table = new \App\Model\ShareDeal;
                
                $table->title = $data->Input('title');
                $table->original_price = $data->Input('original_price');

                $table->store = $data->Input('store');
                $table->category = $data->Input('category');

                $table->description = $data->Input('description');
                $table->location = $data->Input('location');
                
                if ($data->Input('url') != null){
                    $table->url = $data->Input('url');
                }

                $table->posted_by = Auth::user()->name;
                $table->save();


                $logo = $data->file('image');
                $upload = 'uploads/logo';
                $filename = $table->id.'.jpg';
                $success = $logo->move($upload, $filename);

                // return Redirect::to('share_deal')->with('success', 'Data Submitted');
                return Redirect::to('share_deal')->with('success', 'Data Submitted');

            // }            
        }
        

    }

    public function manage_deal(){

        $categorys = \DB::table('categorys')->get();
        

        $shared_deal = \App\Model\ShareDeal::where('is_active','=',1)->
            where('posted_by', '=', Auth::user()->name)->where(function($query){   
        })->get();

        return view('manage_deal', ['deal' => $shared_deal, 'categorys' => $categorys]);      
    }

    public function edit_deal($id){

        // $categorys = \DB::table('categorys')->get();
        

        // $shared_deal = \App\Model\ShareDeal::where('is_active','=',1)->
        //     where('posted_by', '=', Auth::user()->name)->where(function($query){   
        // })->get();

        // return view('manage_deal', ['deal' => $shared_deal, 'categorys' => $categorys]);  

        // \DB::table('deals')
        //     ->where('id', $id)
        //     ->update(['is_active' => 0]);

        // return redirect()->back(); 

    }

    public function delete_deal($id){

        // echo "delete: ". $id;
        \DB::table('deals')
            ->where('id', $id)
            ->update(['is_active' => 0]);

        return redirect()->back(); 

    }


    public function about_us(){

        
        return view('about_us');      
    }

}
