@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Kengash azolari</h4>

<!-- Basic Bootstrap Table -->
<div class="row ">
    <div class="card pb-3">
        <h5 class="card-header"><a class="btn btn-primary" href="{{route('members.create')}}">Qo'shish</a></h5>
        <div class="card-body">
          <table class="table table-bordered ">
            <thead>
              <tr>
                <th>№</th>
                <th style="font-weight: bold">F.I.O</th>
                <th style="font-weight: bold">Lavozim</th>
                <th style="font-weight: bold">Yo'nalish</th>
                <th style="font-weight: bold">Ilmiy daraja</th>
                <th style="font-weight: bold">Login</th>
                <th style="font-weight: bold">Status</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
           @if(@isset($db))
           <?php $i=1; ?>
           @hasanyrole('superadmin|moderator')
              @foreach ($db as $model )
                @if($model->login!='admin' and $model->login!='superadmin')
                    <tr>
                      <td><?=  $i++; ?></td>
                        <td >
                          {{$model->name}}
                        </td>
                        <td style="background-color: " >
                            <a href="{{route('members.degre1',['degre_id'=>3,$model->id])}}" class="btn @if ($model->degre_id==3)
                              btn-primary
                            @endif border border-dark mt-1 mb-1">Rais o'rinbosari</a>
                            <a href="{{route('members.degre1',['degre_id'=>4,$model->id])}}" class="btn @if ($model->degre_id==4)
                            btn-primary
                            @endif border border-dark mt-1 mb-1">Rais</a>
                            <a href="{{route('members.degre1',['degre_id'=>1,$model->id])}}" class="btn  @if ($model->degre_id==1)
                              btn-primary
                              @endif  border border-dark">A'zo</a>
                            <a href="{{route('members.degre1',['degre_id'=>2,$model->id])}}" class="btn @if ($model->degre_id==2) btn-primary
                              @endif  border border-dark">Kotib</a>
                        </td>
                        <td style="">{{$model->category->shifr}}-{{$model->category->name}}</td>
                        <td style="">{{$model->ilmiy_daraja}}</td>
                        <td style="">{{$model->login}}</td>
                        <td style="">
                            <a href="{{route('members.edit',$model->id)}}"><i class="bx bx-pencil"></i></a>
                            <a href="{{route('members.delete',$model->id)}}"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                @endif   
              @endforeach
           @endhasanyrole
           @endisset
            </tbody>
          </table>
        </div>
      </div>
</div>

<!--/ Basic Bootstrap Table -->
@endsection
