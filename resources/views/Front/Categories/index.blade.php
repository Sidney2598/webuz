@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Yo'nalishlar</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header"><a   class="btn btn-primary" href="{{route('categories.create')}}">Qo'shish</a></h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Shifri</th>
          <th>Nomi</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @foreach ($db as $model )
        <tr>
            <td>
            <span class="fw-medium">{{$model->shifr}}</span>
            </td>
            <td>{{$model->name}}</td>
            <td>
            <a href="{{route('categories.edit',$model->id)}}"><i class="bx bx-pencil"></i></a>
            <a href="{{route('categories.delete',$model->id)}}"><i class="bx bx-trash"></i></a>
            </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection
