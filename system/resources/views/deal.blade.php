@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
	
			<div class="panel panel-warning">
			<div id="my-dash" class="panel-heading">
		        <div id="chart">
		        </div>
		        <div id="control">
		        </div>
		    </div>
		    </div>

		    <?= Lava::render('Dashboard', 'Donuts', 'my-dash'); ?>


            <div class="panel panel-warning">	
            	<div class="panel-heading">Deal</div>            	
                
				@foreach($title as $deal)
                <div class="panel-body">
					<table width="100%" height="227" >
						<tr>
						    <td width="250px" height="221" valign="top">
						    	<form action="{{ url('deal_list/'.$deal->id) }}" method="POST">
						    	<p><img src="http://localhost/SC5/public/uploads/logo/{{$deal->id}}.jpg" width="120" height="120" />

							    	@if (Auth::guest())

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

	                                @endif

									</p>
							    	<p><a href="http://localhost/SC5/public/uploads/logo/{{$deal->id}}.jpg">View Full Size Image</a></p>

									<input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    
                                </form>

						    	</td>
						    <td valign="top">
						    	<table cellpadding="10px">
						    		<tr>
						    			<td width="100px"><b>Title</b></td>
						    			<td>{{$deal->title}}</td>
						    		</tr>
						    		<tr>
						    			<td width="100px"><b>Price: </b></td>
						    			<td>RM {{$deal->original_price}}</td>
						    		</tr>
						    		<tr>
						    			<td><b>Store: </b></td>
						    			<td>{{$deal->store}}</td>
						    		</tr>
						    		<tr>
						    			<td><b>Category: </b></td>
						    			<td>{{$deal->category}}</td>
						    		</tr>
						    		<tr>
						    			<td valign="top"><b>Description: </b></td>
						    			<td>{!! nl2br($deal->description) !!}</td>
						    		</tr>
						    		@if ($deal->url != NULL)
						    		<tr>
						    			<td valign="top"><b>Url: </b></td>
						    			<td><a href="{{$deal->url}}" target="_blank" >{{$deal->url}}</a></td>
						    		</tr>
						    		@endif
						    		<tr>
						    			<td><b>Posted by: </b></td>
						    			<td>{{$deal->posted_by}} - {{$deal->updated_at}}</td>
						    		</tr>
						    	</table></td>
						    @endforeach
						</tr>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection