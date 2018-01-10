@extends('layouts.layout') 
@section('content')

<!-- Error message -->
<div data-alert class="alert-box warning" tabindex="0" aria-live="assertive" role="alertdialog">
    {{$message['error'] or ''}}
  <button tabindex="0" class="close" aria-label="Close Alert">&times;</button>
</div>

<!-- Sucess message -->
<div data-alert class="alert-box success" tabindex="0" aria-live="assertive" role="alertdialog">
    <!-- {{$message['error'] or ''}} -->
  <button tabindex="0" class="close" aria-label="Close Alert">&times;</button>
</div>


