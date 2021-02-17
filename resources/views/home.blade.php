@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!--<div class="card-header"></div>-->

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as an user!') }}
                </div>
            </div>
        </div>
    </div><br>
    <!-- Table to order and to see which products are there -->
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Products Available</h4>
                    <p class="text-muted m-b-30 font-14">
                        
                    </p>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Available</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $data)
                        <tr>
                            <td>{{$data->product}}</td>
                            <td id="qty_{{$data->id}}">{{$data->quantity}}</td>
                            @if($data->ordered == 1)
                            <td>Order Placed</td>
                            @elseif($data->ordered == 0)
                            <td>
                            <a data-toggle="modal" data-target=".bs-example-modal-center" id="{{$data->id}}_{{$data->product}}" class="order-btn btn btn-success">Order Product</a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div><br>
    <!-- Table to the received Products -->
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Received Products</h4>
                    <p class="text-muted m-b-30 font-14">
                        
                    </p>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Total Received</th>
                            <th>Receive Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($received as $key)
                        <tr>
                            <td>{{$key->product}}</td>
                            <td id="qty_{{$data->id}}">{{$key->quantity}}</td>
                            <td>{{$key->updated_at}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", ".order-btn", function () {
        var str = $(this).attr('id');
        var data = str.split("_");
        var qty = $("#qty_"+data[0]).html();
        $(".modal-body #pName").val(data[1]);
        $(".modal-body #pId").val(data[0]);
        $(".modal-body #avail_qty").text(qty);
    });
</script>
  <!-- Modal -->
  <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Order Detalis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="m-b-30">
                    <form method="POST" action="{{ route('order') }}">
                        @csrf
                       <div class="form-group">
                       <label>Product Name</label>
                        <input id="pName" type="text" readonly class="form-control" name="pName" value="">
                          <label>How many do you want? ( <span id="avail_qty"></span> Available)</label>
                          <input id="quantity" type="text" class="form-control" name="quantity" required autofocus>
                          <input id="pId" type="hidden" class="form-control" name="pId" value="{{Auth::user()->email}}">
                       </div>
                       <div class="form-group">
                          <button class="btn btn-dark" type="submit">Order</button>
                       </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
