<!-- @extends('layouts.app') -->

@section('content')

    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myFavModal">Open Modal</button>
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
                        <td width="250px" height="100" valign="top">
                            <p><img src="http://localhost/SC4/public/uploads/logo/{{$deal->id}}.jpg" width="120" height="120" /></p>
                            <p><a href="http://localhost/SC4/public/uploads/logo/{{$deal->id}}.jpg" target="_blank">View Full Size Image</a></p></td>
                        <td valign="top">
                            <p>{{$deal->id}}</p>
                            <p>{{$deal->title}}</p>
                            <p>RM {{$deal->original_price}}</p>
                            <p>{{$deal->description}}</p>
                            <a href="{{ url('#') }}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>

                            </td>
                        
                    </tr>
                </table>
                @empty 
                    <p>There is no Favourite Deal</p>
                @endforelse

          </div>
          <!-- <div class="panel-heading" align="right">Total: <b>RM {{$my_fav_deals_total}}</b></div> -->
        </div>
      </div>
    </div>



@endsection