@extends('Front.Layout.layout')
@section('content')
    <div class="row">
            <h2>Ovoz berish jarayonida</h2>
                @if (@isset($votes))
                        @foreach ($votes as $model )
                            @if($model->status==1)
                            <div class="col-sm-4 col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$model->id}}-{{$model->theme}}</h5>
                                        <div class="card-subtitle text-muted mb-3">{{$model->username}}</div>
                                        <p class="card-text">
                                            <?=   date('d-m-Y', strtotime($model->date)); ?>
                                        </p>
                                    </div>
                                    @role('member')
                                    <div class="card-footer">
                                        <a href="{{route('himoya2',[$model->id,'status'=>2])}}" class="btn btn-success">Roziman</a>
                                        <a href="{{route('himoya2',[$model->id,'status'=>1])}}" class="btn btn-danger">Qarshiman</a>
                                        <a href="{{route('himoya2',[$model->id,'status'=>0])}}" class="btn btn-primary">Betaraf</a>
                                    </div>
                                    @endrole
                                </div>
                            </div>
                            @endif
                        @endforeach
                @endif
    </div>   
@endsection


