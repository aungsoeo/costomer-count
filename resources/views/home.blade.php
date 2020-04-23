@extends('layouts.app')

@section('content')
<style>
    .col-lg-3,.col-md-2, .col-md-1{
        margin-top: 5px !important;
    }
   
</style>
<div class="container">
    <div class="row" align="center">
        <h3>Customer Count During COVID-19</h3>
    </div>
    <br><br>
    <div class="row">
        <h4>Today Customer Count</h4>
        <p style="float: right;">{{  date('d-m-Y H:i:s A') }}</p>
    </div>
    <div class="row">

       @foreach ($todaycount as $data)
        <div class="col-lg-3 col-6">
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
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner" style="padding: 10px;">
              <h4>
                Total
              </h4>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <p>Customers</p>
                </div>
                <div class="col-md-6" align="right">
                  <p>
                    <?php 
                        $total = 0;
                        foreach ($todaycount as $key => $data) {
                            $total = $total + $data->count;
                        }
                     ?>
                    <strong>
                       {{ $total }}
                    </strong>
                </p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4>Total Customer  Count  ( {{ date('d-m-Y', strtotime( $min_date[0]->min_date)) }}  ~  {{  date('d-m-Y') }} )</h4>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner" style="padding: 10px;">
              <h4>
                HO
              </h4>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <p>Customers</p>
                </div>
                <div class="col-md-6" align="right">
                  <p><strong>{{ number_format($hototal) }}</strong></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner" style="padding: 10px;">
              <h4>
                Linn 1
              </h4>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <p>Customers</p>
                </div>
                <div class="col-md-6" align="right">
                  <p><strong>{{ number_format($l1total) }}</strong></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner" style="padding: 10px;">
              <h4>
                Linn 2
              </h4>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <p>Customers</p>
                </div>
                <div class="col-md-6" align="right">
                  <p><strong>{{ number_format($l2total) }}</strong></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner" style="padding: 10px;">
              <h4>
                Total Summary
              </h4>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <p>Customers</p>
                </div>
                <div class="col-md-6" align="right">
                  <p>
                   
                    <strong>
                       {{ number_format($summarytotal) }}
                    </strong>
                </p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="container">
        <?php 

          $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:'';
          $date = isset($_GET['date'])?$_GET['date']:'';
      ?>
        <form action="{{ url('home') }}" method="GET">
            <div class="row">
                <div class="col-md-2">
                    <select name="branch_id" id="" class="form-control">
                        <option value="">Select Branch</option>
                        <option value="1" {{ ($branch_id==1)?'selected':'' }} >Head Office</option>
                        <option value="2" {{ ($branch_id==2)?'selected':'' }}>Linn 1</option>
                        <option value="3" {{ ($branch_id==3)?'selected':'' }}>Linn 2</option>
                    </select>
                </div>

              <div class="col-md-2 text-center"> 
                <input type="text" class="date form-control" placeholder="dd-mm-yyyy" name="date" value="{{ $date }}" />
              </div>
              <div class="col-md-1">
                <input type="submit" class="btn btn-primary" value="Search">
              </div>

              <script type="text/javascript">  
                   $('.date').datepicker({  
                       format: 'dd-mm-yyyy'  
                     }); 
              </script> 
            </div>
        </form>

        <br>
         <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Branch</th>
                                        <th>Count</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($counts as $data)
                                    <tr>
                                        <td>{{ ++$i }}</td>
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
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                             <?php 
                                    $totalcustomer = 0;
                                    foreach ($totalcount as $key => $data) {
                                        $totalcustomer = $totalcustomer + $data->count;
                                    }
                                ?>
                               <strong> Total Customer:  {{ number_format($totalcustomer) }} </strong>
                            </div>
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
