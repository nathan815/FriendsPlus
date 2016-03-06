<div id="new-post" class="white-box">
  <form action="{{ route('status.new') }}" method="post">
    {{ csrf_field() }}
    <textarea class="form-control" placeholder="Write a status..." name="body"></textarea>
    <br />
    <button class="btn btn-primary pull-right">Post</button>
    <div class="clearfix"></div>
  </form>
</div>