@extends('layouts.admin')

@section('content')
 
<div class="card">
    <div class="card-header">
        Menu Configuration
    </div>

    <div class="card-body">
          {!! Menu::render() !!}
    </div> 
</div>

@endsection


@section('scripts')
@parent
 {!! Menu::scripts() !!}

 <script>
     $('.custom-select').change(function(){
        var url=$('option:selected', this).attr('url');
        var label=$('option:selected', this).attr('label');
        $(this).siblings("input[name='url']").val(url);
        $(this).siblings("input[name='label']").val(label);
     });
 </script>
@endsection