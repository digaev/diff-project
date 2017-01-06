<!DOCTYPE html>
<html lang="en" ng-app="diffApp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Text Differ</title>
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
  <div class="container">
    <div class="row">
      {!! Form::open(array('action' => 'DiffController@diff', 'id' => 'diff-form')) !!}
        <div class="form-group">
          {!! Form::label('text-1', 'Text 1') !!}
          {!! Form::textarea('text1', '', ['required' => true]) !!}
        </div>
        <div class="form-group">
          {!! Form::label('text-2', 'Text 2') !!}
          {!! Form::textarea('text2', '', ['required' => true]) !!}
        </div>
        {!! Form::submit('Diff!', ['class' => 'btn btn-default']) !!}
      {!! Form::close() !!}
    </div>
    <div class="row">
      <div class="col-md-12">
        <br/>
        <label for="">Difference</label>
        <div id="difference"></div>
      </div>
    </div>
  </div>
  <script src="/js/app.js"></script>
</body>
</html>
