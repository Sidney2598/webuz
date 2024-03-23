@extends('Front.Layout.layout')
@section('content')

<h4 class="py-3 mb-4">Xisob komissiyasi / Raisni tanlash</h4>

<!-- Basic Bootstrap Table -->
<div class="row ">
    <div class="card pb-3">
        <div class="card-body">
          <table class="table table-bordered ">
            <thead>
              <tr>
                <th>№</th>
                <th style="font-weight: bold">F.I.O</th>
                <th style="font-weight: bold">Lavozim</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
           @if(@isset($users) and @isset($vote))
           <?php $i=1; ?>
              @foreach ($users as $model)
             
                    <tr>

                      <td><?=  $i++; ?></td>
                        <td >
                          {{$model->name}}
                        </td>
                   
                        <td style="background-color: " >
        
                            <a href="{{route('members.degre2',['degre_id'=>2,$model->id])}}" class="btn @if ($model->degre_id==2)
                              btn-primary
                              @endif border border-dark mt-1 mb-1">Rais</a>
                            <a href="{{route('members.degre2',['degre_id'=>1,$model->id])}}" class="btn  @if ($model->degre_id==1)
                              btn-primary
                              @endif  border border-dark">A'zo</a>
                            <a href="{{route('members.degre2',['degre_id'=>0,$model->id])}}" class="btn btn-danger ">X</a>
                        </td>
                  
                    </tr>
             
              @endforeach
           @endisset
            </tbody>
          </table>
        </div>
        <div class="text-center">
          <a href="{{route('vote.send3',$vote->id)}}" class="btn btn-primary">Boshlash</a>
        </div>
    </div>

</div>

<!--/ Basic Bootstrap Table -->
@endsection