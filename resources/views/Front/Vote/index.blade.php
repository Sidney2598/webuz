@extends('Front.Layout.layout')
@section('content')
<script>
    // JavaScript orqali sahifani har 5 sekundda bir yangilash
    setInterval(function() {
        location.reload();
    }, 10000);
</script>
    <div class="row">
        <div class="col-sm-4 col-12  pt-1">
            <h2>Ovoz berish jarayonini boshlash</h2>
                @if (@isset($votes))
                @foreach ($votes as $model )
                    @if ($model->status==0)
                        <div class="card mb-4">
                            <div class="card-body">
                            <h5 class="card-title">{{$model->theme}}</h5>
                            <div class="card-subtitle text-muted mb-3">{{$model->username}}</div>
                            <p class="card-text">
                                <?=   date('d-m-Y', strtotime($model->date)); ?>
                            </p>
                            <div class="text-center">
                              
                                <a href="{{route('vote.delete',$model->id)}}" class="btn btn-danger">O'chirish</a>
                                <a href="{{route('vote.delete',$model->id)}}" class="btn btn-warning">Bekor qilish</a>
                                <a href="{{route('vote.send',$model->id)}}" class="btn btn-success">Boshlash</a>
                            </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="col-3"><a href="{{route('vote.create')}}" class="btn btn-primary">Qo'shish</a></div>
    </div>
    <div class="row">
        <h2>Ovoz berish jarayonida</h2>
        @if (@isset($votes2))
        @for($i=0;$i<count($plus);$i++)
            <div class="col-sm-4 col-12">
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
    </div>
    <div class="row">
        <h2 >Yakunlangan ovoz berish jarayoni</h2>
        @if (@isset($votes))
            @foreach ($votes as $model )
                @if ($model->status==2)
                <div class="col-sm-4 col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{$model->theme}}</h5>
                            <div class="card-subtitle text-muted mb-3">{{$model->username}}</div>
                            <p class="card-text">
                                <?=   date('d-m-Y', strtotime($model->date)); ?>
                            </p>
                            <div class="text-center">
                                <a href="{{route('wordexport',$model->id)}}" class="btn btn-primary"><i class="bx bx-download"></i>Hisobot</a>
                                @hasrole('superadmin')
                                <a href="{{route('himoya.delete',$model->id)}}" class="btn btn-danger"><i class="bx bx-trash"></i>O'chirish</a>
                                @endhasrole
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection


