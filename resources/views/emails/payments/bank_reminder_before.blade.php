@extends('layouts.email')


@section('header')
    @parent
@endsection

@section('content')
<tr><td style="color: #747474">
<p>Hola {{$firstName}},</p>
<p>Tu membresía expira el {{$endDate}}.</p>
<p>Fitemos Corp.</p>
<p>Renueva con anticipación y evita que se pause tu entrenamiento. Los días serán acreditados posterior al vencimiento del plan actual.</p>
<p>Para extenderla haz click en el botón.</p>
<a href="{{$url}}"
style="
  width:330px;
  margin: 23px auto;
  display: block;
  padding: 12px;
  color: #e4e4e4;
  font-weight: 500;
  font-size: 23px;
  border-radius: 7px;
  background: -webkit-gradient(linear,left top,right top,from(#028fb4),to(#bfd734));
  background: linear-gradient(90deg,#028fb4,#bfd734);
  background-color:#028fb4;
  border: 0;
  font-style: normal;
  white-space: normal;
  align-items: center;
  justify-content: center;
  word-break: break-word;
  -webkit-align-items: center;
  -webkit-justify-content: center;
  text-decoration:none;
  text-align:center;
  " target="_blank">EXTENDER MEMBRESÍA</a>
<p>Team Fitemos</p>
</td></tr>    
@endsection    

@section('footer')
    @parent
@endsection