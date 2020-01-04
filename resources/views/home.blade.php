@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">QR Code Generator</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ url('qr-gallery') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">

                        {!! csrf_field() !!} @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <br>
                            <br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-5">
                                <strong>Title:</strong>
                                <input type="text" name="title" class="form-control" placeholder="Title">
                            </div>
                            <div class="col-md-5">
                                <strong>URL:</strong>
                                <input type="url" name="url" class="form-control" placeholder="URL">
                            </div>
                            <div class="col-md-2">
                                <br/>
                                <button type="submit" class="btn btn-success">Generate QR Code</button>
                            </div>
                        </div>

                    </form>

                    <div class="row">
                        <div class='list-group gallery'>

                            @if($images->count()) @foreach($images as $image)
                            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                <a class="thumbnail fancybox" rel="ligthbox" href="{{url('storage/img/qr-code/'.$image->image)}}">
                                            <img class="img-responsive" src="{{url('storage/img/qr-code/'.$image->image)}}" alt="{{$image->image}}">

                                            <div class='text-center'>
                                                <small class='text-muted'>{{ $image->title }}</small>
                                            </div> <!-- text-center / end -->
                                        </a>
                                <form action="{{ url('qr-gallery',$image->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="delete"> {!! csrf_field() !!}
                                    <button type="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                                </form>
                            </div>
                            <!-- col-6 / end -->
                            @endforeach @endif

                        </div>
                        <!-- list-group / end -->
                    </div>
                    <!-- row / end -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
</script>
@endsection
