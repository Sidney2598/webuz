@extends('Front.Layout.layout')
@section('content')
   <div class="row">
       <script>
    // JavaScript orqali sahifani har 5 sekundda bir yangilash
    setInterval(function() {
        location.reload();
    }, 10000);
</script>
    @if(isset($vote))
        <div class="card col-4">
            <div class="card-body">
            <h5 class="card-title">{{$vote->theme}}</h5>
            <div class="card-subtitle text-muted mb-3">{{$vote->username}}</div>
            <p class="card-text">
            
            </p>
            <div class="text-center">
                <a href="">Kengash a'zolari</a>
                <p><i class="bg-success border border-light rounded-circle  px-2"></i>-{{$active}}/ <i class="bg-dark border border-light rounded-circle  px-2"></i>-{{$inactive}}</p>
            </div>
            <div class="text-center pt-1">
                <a href="{{route('vote.send2',$vote->id)}}" class="btn btn-primary " style="color: white">Boshlash</a>
            </div>
            </div>
        </div>
        <div class="card col-4">
            <h3 class="pt-3">Yonalish Azolari</h3>
            <ul class="list-group">
                @if(isset($user_yonalish))
                    @foreach($user_yonalish as $model)
                    
                        <li class="list-group-item">
                            <a href="">
                                <i class="btn @if($model->status==1)btn-success  @elseif($model->status==0)btn-dark @endif rounded-circle" style="padding-left:13px; padding-right:0px" ></i>
                            </a>
                            {{$model->name}}
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="card col-4">
            <h3 class="pt-3">Kengash Azolari</h3>
            <ul class="list-group">
                @if(isset($users))
                    @foreach($users as $model)
                    
                        <li class="list-group-item">
                            <a href="">
                                <i class="btn @if($model->status==1)btn-success  @elseif($model->status==0)btn-dark @endif rounded-circle" style="padding-left:13px; padding-right:0px" ></i>
                            </a>
                            {{$model->name}}
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    @endif
   </div>
@endsection


