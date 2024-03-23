@extends('Front.Layout.layout')
@section('content')
            <div class="row">
                <h2 >Yakunlangan ovoz berish jarayoni</h2>
                @if (@isset($votes))
                    @foreach ($votes as $model )
                        @if ($model->status==2)
                        <div class="col-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                <h5 class="card-title">{{$model->theme}}</h5>
                                <div class="card-subtitle text-muted mb-3">{{$model->username}}</div>
                                <p class="card-text">
                                    <?=   date('d-m-Y', strtotime($model->date)); ?>
                                </p>
                                <div class="text-center">
                                    <a href="{{route('vote.wordexport',$model->id)}}" class="btn btn-primary"><i class="bx bx-download"></i>Hisobot</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
    </div>   
@endsection


