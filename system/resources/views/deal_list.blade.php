@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-13 col-md-offset-0">
            <div class="panel panel-warning pull-left" style="width: 17%" id="filter_deal">
                <div class="panel-heading">
                    <form action="{{URL::current()}}">
                        <div>
                            <label for="">Price Range</label><br>
                            RM <input type="text" onkeypress="return isNumberKey(event,id)" id="min_price" name="min_price" value="{{Input::get('min_price')}}" style="width:50px; height: 25px">
                            - RM <input type="text" onkeypress="return isNumberKey(event,id)" id="max_price" name="max_price" value="{{Input::get('max_price')}}" style="width:50px; height: 25px" ><br><br>
                            <button style="float: right">GO!</button><br><br>

                        </div>
                        <div>
                            <?php $order_by = Input::has('order_by') ? Input::get('order_by') : null; ?>
                            <label for="">Order by</label>
                            <br>

                            <input type="radio" name="order_by" value="title" checked="checked"
                                onclick="submit();" {{$order_by=="title"?'checked':''}}> Title<br>
                            <input type="radio" name="order_by" value="original_price" 
                                onclick="submit();" {{$order_by=="original_price"?'checked':''}}> Price<br>
                            <input type="radio" name="order_by" value="category"
                                onclick="submit();" {{$order_by=="category"?'checked':''}}> Category<br>
                        </div>
                        <div>                            
                            <?php $categorys = Input::has('categorys') ? Input::get('categorys') : []; ?>
                            <br>
                            <label for="">Category</label> 
                            <br>
                            @foreach($category as $category)
                            <input type="checkbox"  name="categorys[]" value="{{$category->category}}" onclick="submit();"{{in_array($category->category,$categorys)?'checked':''}}> {{$category->category}}
                            <br>
                            @endforeach                            
                        </div>                        
                    </form>
                </div>
            </div>
            <div class="panel panel-warning pull-right" style="width: 82%">
                <div class="panel-heading">Deal</div>

                <div class="panel-body">
                    @forelse($deals as $deal)
                        
                        <table cellpadding="6" style="float:left; margin-left:13px;position: relative;">                            
                            <tr>                              
                              <td>

                              <form action="{{ url('deal_list/'.$deal->id) }}" method="POST">
                                
                                <a href="{{ url('deal/'.$deal->title) }}" target="_blank">
                                <img style="border:#ffdab3 1px solid; position: relative" src="http://localhost/SC5/public/uploads/logo/{{$deal->id}}.jpg" width="140" height="121" /></a>
                                <!-- <a href="{{ url('deal/'.$deal->id) }}"> -->
                                <!-- <img style="position: relative;bottom: -42px;right: 38px;" src="http://localhost/SC5/resources/views/style/fav_gray.png" width="35" height="35" /> -->
                                <!-- <a href="/good_deal={{$deal->id}}"> -->

                                

                                
                                <!-- @if (Auth::guest())

                                    <a href="{{ url('/login')}}">
                                    <img style="position: relative; bottom: -42px; right: 38px; z-index: 998" 
                                    src="http://localhost/SC5/resources/views/style/fav_gray.png"           width="35" height="35" /></a>

                                @else

                                    @if (strpos($fav_deals, ','.$deal->id.','))
                                       
                                    <img style="position: relative; bottom: -42px; right: 38px; z-index: 997" 
                                    src="http://localhost/SC5/resources/views/style/fav_red.png" 
                                    onclick="fav_red({{$deal->id}}); submit();" id="fav_{{$deal->id}}" 
                                    width="35" height="35" />
                                    <input type="hidden" name="fav" value="red" />

                                    @else
                                    <img style="position: relative; bottom: -42px; right: 38px; z-index: 997" 
                                    src="http://localhost/SC5/resources/views/style/fav_gray.png" 
                                    onclick="fav_gray({{$deal->id}}); submit();" id="fav_{{$deal->id}}" 
                                    width="35" height="35" />
                                    <input type="hidden" name="fav" value="gray" />

                                    @endif

                                @endif -->

                                    
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    
                                </form>


    


                              </td>
                            <!--   <br/>                   
                                <a href="">
                                    <img onclick="" id="" src="http://localhost/SC/resources/views/style/good_gray.png" width="35px" height="35px" /></a>
                                <a href="">
                                    <img onclick="" id="" src="http://localhost/SC/resources/views/style/bad_gray.png" width="35px" height="35px" /></a>
                                <img src="http://localhost/SC/resources/views/style/comment_icon.png" width="40px" height="35px" /> -->
                            </tr>
                            <tr>
                              <td>
                                <p>                                   
                                <b><div style="color: brown; white-space: nowrap; width: 140px; 
                                    overflow: hidden; text-overflow: ellipsis; margin-bottom: -20px">{{$deal->title}}</div></b><br>
                                Deal: {{$deal->count}}<br>
                                @if ($deal->count != 1)
                                    Min price: RM {{$deal->min}}<br>
                                    Max price: RM {{$deal->max}}<br>
                                @else
                                    Price: RM {{$deal->min}}<br><br>
                                @endif
                             
                                <!-- <a href="{{ url('deal/'.$deal->title) }}">View More Details</a> -->
                                &nbsp;</p></td>                           
                            </tr>                            
                          </table>
                          
                    @empty 
                        <p>There is no Deal</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

