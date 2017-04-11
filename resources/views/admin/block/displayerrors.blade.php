{{--Display zone for: Insert messages --}}
@if(Session::has('message') && Session::has('level'))
    <div class="alert alert-block alert-{!! Session::get('level') !!} message-box">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        @if(Session::get('level')=='success')
            <i class="ace-icon fa fa-check green"></i>
            <strong class="green">
                {{Session::get('message')}}.
            </strong>
        @else
            <i class="ace-icon fa fa-times red"></i>
            <strong class="red">
                {{Session::get('message')}}.
            </strong>
        @endif
    </div>
@endif

{{--Display zone for: validate errors --}}
@if(count($errors)>0)
    @foreach($errors->get('catename') as $error)
        <div class="alert alert-block alert-danger message-box">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <i class="ace-icon fa fa-times red"></i>
            <strong class="red">
                {{$error}}
            </strong>
        </div>
    @endforeach
@endif