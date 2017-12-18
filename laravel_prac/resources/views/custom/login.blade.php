<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="UTF-8">
        <title>Custom Regestration</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6">
                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <p class="alert alert-danger display-error">{{$error}}</p>
                    @endforeach
                    @endif
                    <form  class="form-horizontal" action="{{ route('custom.login') }}" method="POST">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend>Custom Registration</legend>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" type="email" name="email" value="{{old('email')}}">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input class="form-control" id="exampleInputPassword1" placeholder="Password" type="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script type="text/javascript">$('.display-error').fadeIn().delay(3000).fadeOut();</script>
    </body>
</html>