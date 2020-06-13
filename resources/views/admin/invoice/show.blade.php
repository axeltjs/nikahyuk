@extends('admin.layouts.app')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3 class="title">Invoice {{ $invoice->transaction->number }}</h3>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Detail Invoice</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <table></table>
    </div>
</div>