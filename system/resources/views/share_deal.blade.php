@extends('layouts.app')

@section('content')
<div class="container"> 
    <!-- @if(Session::has('success'))
    {!!Session::get('success')!!}
    @endif   -->  
    <div class="row">        
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-warning">
                <div class="panel-heading">Share a Deal</div>

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
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">

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
                                <input type="text" onkeypress="return isNumberKey(event,id)" class="form-control" name="original_price" id="txtChar" value="{{ old('original_price') }}"></div>

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
                                <input type="text" class="form-control" name="store" value="{{ old('store') }}">

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
                                    @if ( old('category') == $category->category )                              
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
                                <textarea name="description" cols="95" rows="4" class="form-control" >{{ old('description') }}</textarea>

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
                                <input type="text" class="form-control" name="location" value="{{ old('location') }}">

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
                                <input type="text" class="form-control" name="url" value="{{ old('url') }}">

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
                                <input type="file" name="image" id="image" value="{{ old('image') }}"/>

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
                                    Add This Deal Now
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
