<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login User</title>
    <link rel="stylesheet" href="{{asset('css/user/register.css')}}">

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    
    
</head>
<body oncontextmenu='return true' class='snippet-body'>
                <div class="container">
                    <div class="row">
                        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
                            @if (Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif

                            @if (Session::has('error'))
                            <div class="alert alert-danger">{{Session::get('error')}}</div>
                            @endif


                            <div class="panel border bg-white">
                                <div class="panel-heading">
                                    <h3 class="pt-3 font-weight-bold">Login</h3>
                                </div>
                                <div class="panel-body p-3">
                                    <form action="{{route('user.dologin')}}" method="POST">
										@csrf
                                       

                                        <div class="form-group py-2">
                                            <div class="input-field"> 
                                                <span class="far fa-user p-2"></span>
                                                 <input type="text" value="{{old('email')}}" placeholder="Enter you email address" name="email" id="email" required> 
                                                </div>

                                                {{-- <span class="text-danger">@error('email')
                                                    {{$message}}
                                                    @enderror
                                                    </span> --}}
                                        </div>
                                        
                                        <div class="form-group py-1 pb-2">
                                            <div class="input-field"> 
												<span class="fas fa-lock px-2">
												</span>

												 <input id="password"   name="password" type="password" placeholder="Enter your password"  required> 

                                                 <button class="btn bg-white text-muted"> 
													<span class="far fa-eye-slash">
													</span> 
												</button> 

											</div>
                                            {{--                                             
                                            <span class="text-danger">@error('password')
                                                {{$message}}
                                                @enderror
                                                </span> --}}
                                        </div>

										  
                                      

                                    <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>

                                    <div class="text-center pt-4 text-muted">Don't have an account? <a href="{{route('user.register')}}">Register</a> </div>
                                    </form>
                                </div>
                                <div class="mx-3 my-2 py-2 bordert">
                                     <div class="text-center py-3">
                                         <a href="https://wwww.facebook.com" target="_blank" class="px-2"> <img src="https://www.dpreview.com/files/p/articles/4698742202/facebook.jpeg" alt=""> </a> 
                                         

                                         {{-- <a href="https://www.google.com" target="_blank" class="px-2"> <img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-suite-everything-you-need-know-about-google-newest-0.png" alt=""> </a> 

                                         <a href="https://www.github.com" target="_blank" class="px-2"> <img src="https://www.freepnglogos.com/uploads/512x512-logo-png/512x512-logo-github-icon-35.png" alt="">
                                         </a>  --}}
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script type='text/javascript'></script>
    </body>
</html>