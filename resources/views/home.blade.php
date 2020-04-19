@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" align="center">
        <h3>Customer Count During COVID-19</h3>
    </div>
    <br><br>
    <div class="row">
        <p style="float: right;">{{ date('Y-m-d H:i:s') }}</p>
    </div>
    <div class="row">

       @foreach ($todaycount as $data)
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner" style="padding: 10px;">
              <h4>
                 @if($data->branch==1)
                    HO
                @elseif($data->branch==2)
                    Linn1
                @elseif($data->branch==3)
                    Linn2
                @endif
              </h4>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <p>Customers</p>
                </div>
                <div class="col-md-6" align="right">
                  <p><strong>{{ $data->count }}</strong></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
    </div>
    <br>
    <hr>
    <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Count</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($counts as $data)
                                    <tr>
                                        <td>

                                            @if($data->branch==1)
                                                HO
                                            @elseif($data->branch==2)
                                                Linn1
                                            @elseif($data->branch==3)
                                                Linn2
                                            @endif
                                        </td>
                                        <td>{{ $data->count}}</td>
                                        <td>{{ $data->created_at }}</td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                            
                        </div>
                        <!-- row / end -->
                        {!! $counts->render() !!}
                    </div>
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
