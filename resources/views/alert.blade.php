@if (session()->has('msg'))
<div class="alert alert-danger alert-block">
    <strong>{{session()->get('msg')}}</strong>
</div>
@endif
