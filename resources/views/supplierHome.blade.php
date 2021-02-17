@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as the supplier!') }}
                </div>
            </div>
        </div>
    </div><br>
    <!-- Table to send ordered products to user -->
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
                            <th>Total Orders</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $data)
                        <tr>
                            <td>{{$data->product}}</td>
                            <td>{{$data->quantity}}</td>
                            @if($data->ordered == 0)
                            <td>No Orders for now</td>
                            <td>No Actions Required</td>
                            @elseif($data->ordered == 1)
                            <td id="qty_{{$data->id}}">{{$data->demand}}</td>
                            <td><a data-toggle="modal" data-target=".bs-example-modal-center" id="{{$data->id}}_{{$data->product}}" class="order-btn btn btn-success">Send Product</a></td>
                            @endif
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
        $(".modal-body #quantity").val(qty);
    });
</script>
<!-- Modal -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Deliver Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="m-b-30">
                    <form method="POST" action="{{ route('deliver') }}">
                        @csrf
                       <div class="form-group">
                       <label>Are You sure you want to deliver?</label>
                        <input id="pName" type="hidden" readonly class="form-control" name="pName" value="">
                          <input id="quantity" type="hidden" class="form-control" name="quantity" value="">
                          <input id="pId" type="hidden" class="form-control" name="pId" value="">
                       </div>
                       <div class="form-group">
                          <button class="btn btn-success" type="submit">Yes</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                       </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
