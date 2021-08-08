@extends('layouts.default')

@section('content')

    <div class="row">


        <div class="col-12">
            <div class="jumbotron">
                <h1 class="text-primary">Generate Onboard Process Chart</h1>
                <div class="mt-5 bt-5"></div>
                @if(isset($chartData))
                    <div id="high-chart"></div>
                @endif
                <div class="mt-5 bt-5"></div>



                <form class="form-signin" action="{{route('generate.chart')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @include('inc.flash-message')

                    <div class="form-row">
                        <div class="form-group col-6">

                            <input type="file" name="excel_file"/>

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-success btn-lg">Upload Excel Sheet (CSV)</button>
                        </div>
                    </div>


                </form>


            </div>
        </div>

    </div>

@endsection



