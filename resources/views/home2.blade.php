@extends('layouts.app')

@section('content')
<s-home :questions="{{$questions}}"></s-home>
@endsection
