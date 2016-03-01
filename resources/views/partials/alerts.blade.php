@if(Session::has('alert'))

  <div class="alert alert-fixed alert-dismissible alert-{{ Session::get('alert')['type'] }}">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {!! Session::get('alert')['message'] !!}
  </div>

@endif