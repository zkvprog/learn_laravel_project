@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Список обращений
        </h3>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Message</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
            <tr>
                <th scope="row">{{$row->id}}</th>
                <td>{{$row->email}}</td>
                <td>{{$row->text}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
