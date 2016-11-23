<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shop Cupid</title>

    <!-- Fonts -->
    <link rel="icon" href="http://localhost/SC5/resources/views/style/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="http://localhost/SC5/resources/views/style/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="http://localhost/SC5/resources/views/style/animate.min.css"> -->

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        .container{
            margin-top: 100px;
            margin-bottom: 100px;
        }

        
    </style>    
</head>
<body onunload="unloadP('UniquePageNameHereScroll')" onload="loadP('UniquePageNameHereScroll')"> 
    <h1>
        <img src="http://localhost/SC5/resources/views/style/logo.png" />
    
        <!-- Authentication Links -->
        @if (Auth::guest())
            <ul id="h1_ul" class="login">            
                <li><a href="{{ url('/login') }}" class="login_button">Login</a></li>
                <li><a href="{{ url('/register') }}" class="register_button">Register</a></li>       
            </ul>
        @else
            <ul id="h1_ul" class="logout">
                <li><a href="{{ url('/logout') }}" class="logout_button">Logout</a></li>
                <li><a href="#">{{ Auth::user()->name }}</a></li>                   
            </ul>
        @endif
    </h1>

    <ul id="ul">
        <li><a href="{{ url('/deal_list') }}">Deal</a></li>
        <li><a href="{{ url('/share_deal') }}">Share A Deal</a></li>
        <!-- <li><a href="{{ url('/manage_deal') }}">Manage Shared Deal</a></li> -->
        <li><a href="{{ url('/about_us') }}">About Us</a></li>

        <!-- <li style="float:right">
          <button class="button" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </li>
        <li style="float:right"><input type="text" placeholder="Search Deal..." required class="search"></li>  -->



        <form action="{{ url('/deal_list') }}">
          <li style="float:right"><input type="button" value="Search" class="button" name="search_btn" onclick="submit();" ></li>
          <li style="float:right"><input type="text" placeholder="Search Deal..." name="search_field" required class="search" value="{{Input::get('search_field')}}"></li> 
        </form> 

    </ul>

    


    @yield('content')

    @if (Auth::check())
    <div id="myFavModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="panel panel-warning">
          <div class="panel-heading">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">&hearts;&nbsp; My Favourite Deal &nbsp;&hearts;</h4>
          </div>
          <div class="panel-body">
                @forelse($my_fav_deals as $deal)
                <table width="100%" height="227" >
                    <tr>
                      <td width="150px" height="100" valign="top">                         

                          <p><img src="http://localhost/SC5/public/uploads/logo/{{$deal->id}}.jpg" width="120" height="120" /></p>
                          <p><a href="http://localhost/SC5/public/uploads/logo/{{$deal->id}}.jpg" target="_blank">View Full Size Image</a></p></td>

                      <td valign="top">
                          <form action="{{ url('deal_list/'.$deal->id) }}" method="POST">
                          <!-- <p>{{$deal->id}}</p>
                          <p>{{$deal->title}}</p>
                          <p>RM {{$deal->original_price}}</p>
                          <p>{{$deal->description}}</p> -->

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
                              <td><a href="{{$deal->url}}" target="_blank" >Click Me</a></td>
                            </tr>
                            @endif
                            <tr>
                              <td><b>Posted by: </b></td>
                              <td>{{$deal->posted_by}} - {{$deal->updated_at}}</td>
                            </tr>
                          </table>


                          <button onclick="submit();" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span > Delete</button>


                          <input type="hidden" name="fav" value="red" />
                          <input type="hidden" name="_method" value="PUT">
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  
                          </form>

                          </td>


                        
                    </tr>
                </table>
                @empty 
                    <p>There is no Favourite Deal</p>
                @endforelse

          </div>
          <div class="panel-heading" align="right">Total: <b>RM {{$my_fav_deals_total}}</b></div>
        </div>
      </div>
    </div>
    @endif


    <a class="tooltips" @if (Auth::check()) data-toggle="modal" data-target="#myFavModal"
      @else href="{{ url('/login')}}" @endif >
      <!-- href="(Auth::check())? {{ url('/login')}}:{{ url(Request::url()) }}"> -->
        <img style="position: fixed; bottom: 13px; right: 0px; z-index: 999;" 
        src="http://localhost/SC5/resources/views/style/fav_cartoon.png" />
        <span>&hearts;&nbsp;  My Favourite Deal &nbsp;&hearts;</span>

    </a>


    <footer>Copyright © 2016 ShopCupid. All Rights Reserved.</footer>
    
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://localhost/SC5/resources/views/scrollfix.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://localhost/SC5/resources/views/script.js"></script>       
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>