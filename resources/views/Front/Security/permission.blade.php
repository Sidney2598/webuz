@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Perimissions</h4>

<!-- Basic Bootstrap Table -->
<div class="row ">
    <div class="card pb-3">
        <h5 class="card-header"><a class="btn btn-primary" href="{{route('permission.create')}}">Qo'shish</a></h5>
        <div class="card-body">
          <table class="table table-bordered ">
            <thead>
              <tr>
                <th>№</th>
                <th style="font-weight: bold">Name</th>
                <th style="font-weight: bold">Status</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
           @if(@isset($permissions))
           <?php $i=1; ?>
              @foreach ($permissions as $model )
                    <tr>
                      <td><?=  $i++; ?></td>
                        <td >
                          {{$model->name}}
                        </td>
                        <td style="">
                            <a href="{{route('permission.edit',$model->id)}}"><i class="bx bx-pencil"></i></a>
                            <a href="{{route('permission.delete',$model->id)}}"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>  
              @endforeach
           @endisset
            </tbody>
          </table>
        </div>
      </div>
</div>

<!--/ Basic Bootstrap Table -->
@endsection
