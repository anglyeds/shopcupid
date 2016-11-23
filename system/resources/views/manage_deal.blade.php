@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-warning">
            	
                <div class="panel-heading">My Shared Deal</div>

                <div class="panel-body">
					<table width="100%" height="227" >
						@foreach($deal as $deal)
						<tr>
						    <td width="250px" height="221" valign="top">
						    	<p><img src="http://localhost/SC5/public/uploads/logo/{{$deal->id}}.jpg" width="120" height="120" /></p>
						    	<p><a href="http://localhost/SC5/public/uploads/logo/{{$deal->id}}.jpg">View Full Size Image</a></p></td>
						    <td valign="top">
						    	<table cellpadding="10px">
						    		<tr>
						    			<td width="100px" valign="top"><b>Title</b></td>
						    			<td>{{$deal->title}}</td>
						    		</tr>
						    		<tr>
						    			<td><b>Price: </b></td>
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
						    		<tr>
						    			<td><b>Posted by: </b></td>
						    			<td>{{$deal->posted_by}}</td>
						    		</tr>
						    	</table>

						    	
						    </td>
						    <td>
						    	<!-- <form action="{{ url('manage_deal/edit/'.$deal->id) }}" method="POST"> -->
						    		<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditDealModel"><span class="glyphicon glyphicon-edit"></span > Edit</button>
						    	<!-- <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                </form> -->

						    	
						    	<!-- <label>{{$deal->id}}</label> -->
						    	<form action="{{ url('manage_deal/delete/'.$deal->id) }}" method="POST">
						    	<!-- <form action="{{ url('manage_deal/'.$deal->id) }}" method="POST"> -->
									<!-- <label>{{$deal->id}}</label> -->
						    		<button onclick="submit();" class="btn btn-danger btn-sm" id="{{$deal->id}}"><span class="glyphicon glyphicon-trash"></span > Delete</button>

						    	<input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                </form>
						    </td>
						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>

		<div id="myEditDealModel" class="modal fade" role="dialog">
		<div class="modal-dialog">
            <div class="panel panel-warning">
                <div class="panel-heading">Edit My Shared Deal</div>

                <div class="panel-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success">                         
                            <strong>Success! Thank you for your contribution.</strong>                   
                        </div>
                    @endif  

                    

                    <form class="form-horizontal" enctype = "multipart/form-data" role="form" method="POST" action="{{ url('/share_deal/post') }}">

                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ $deal->title }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('original_price') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                              <div class="input-group"> 
                                <span class="input-group-addon">RM</span>
                                <input type="text" onkeypress="return isNumberKey(event,id)" class="form-control" name="original_price" id="txtChar" value="{{ $deal->original_price }}"></div>

                                @if ($errors->has('original_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('original_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('store') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Store</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="store" value="{{ $deal->store }}">

                                @if ($errors->has('store'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('store') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
  
                                <select name='category' id='category' class="form-control" >
                                  <option disabled selected>-- Select --</option>  
                                  @foreach($categorys as $category)    
<!-- 
                                  <option value="{{ $category->category }}" @if (Input::old('category') == $category->category) selected="selected" @endif>{{ $category->category }}</option> -->
                                    @if ( $deal->category == $category->category )                              
                                      <option value="{{ $category->category }}" selected="selected">{{$category->category}}</option>  
                                    @else 
                                      <option value="{{ $category->category }}">{{$category->category}}</option>  
                                    @endif     
  
                                   <!--  <option value="{{$category->category}}" 
                                        @if(old('category') == $category->category) {{ 'selected' }}
                                        @endif>{{ $category->category }}</option>    -->    
                                  @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea name="description" cols="95" rows="4" class="form-control" >{{ $deal->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Location</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="location" value="{{ $deal->location }}">

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Url</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="url" value="{{ $deal->url }}">

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input type="file" name="image" id="image" value="{{ $deal->image }}"/>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-warning">
                                    <!-- <i class="fa fa-btn fa-sign-in"></i> -->
                                    Edit This Deal Now
                                </button>

                            </div>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
        </div>











    </div>
</div>





@endsection