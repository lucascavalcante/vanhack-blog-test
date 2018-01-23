<div class="row form-search">
    {!! Form::open(['method' => 'GET', 'role' => 'form']) !!}
            <div class="col-md-10">
                {!! Form::text('search', request()->get('search'), ['class' => 'form-control', 'placeholder' => 'Type the term here...']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::submit('Search Now', ['class' => 'btn btn-block btn-default']) !!}
            </div>
    {!! Form::close() !!}
</div>
