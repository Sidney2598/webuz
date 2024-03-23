@extends('Front.Layout.layout')
@section('content')
    <div class="row">
            <h2>Ovoz berish jarayonini boshlash</h2>
                @if (@isset($votes))
                @foreach ($votes as $model )
                    @if ($model->status==0)
                    <div class="col-12 col-sm-4 pt-1">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{$model->theme}}</h5>
                                <div class="card-subtitle text-muted mb-3">{{$model->username}}</div>
                                <p class="card-text">
                                    <?=   date('d-m-Y', strtotime($model->date)); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif         
            <h2>Ovoz berish jarayonida</h2>
            @if (@isset($k_rais) and count($k_rais)==1)
                @for($i=0;$i<count($plus);$i++)
                    <div class="col-12 col-sm-4">
                        <div class="card mb-4">
                            <div class="card-body">
                            <h5 class="card-title">{{$votes2[$i]->theme}}</h5>
                            <div class="card-subtitle text-muted mb-3">{{$votes2[$i]->username}}</div>
                            <p class="card-text">
                            <?=   date('d-m-Y', strtotime($votes2[$i]->date)); ?>
                            </p> 
                            <div class="text-center">
                                <p style="margin-bottom: 0;padding-bottom:0">Kengash-{{$usercount}}</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="bg-success border border-light rounded-circle  px-2"> </a><span> Ovoz berganlar-<?= $plus[$i]?></span>
                                <a href="" class="bg-danger border border-light rounded-circle  px-2"> </a><span> Ovoz bermaganlar-<?=$usercount-$plus[$i]?></span>
                            </div>
                            <div class="text-center pt-1">
                                <a href="{{route('yakunlash',$votes2[$i]->id)}}" class="btn btn-primary " style="color: white">Yakunlash</a>
                            </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
                <h2 >Yakunlangan ovoz berish jarayoni</h2>
                @if (@isset($k_rais) and count($k_rais)==1)
                    @if (@isset($votes))
                        @foreach ($votes as $model )
                            @if ($model->status==2)
                            <div class="col-12 col-sm-4">
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
                @endif        
    </div>  

@endsection


