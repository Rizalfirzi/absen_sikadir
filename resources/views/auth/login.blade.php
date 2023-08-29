@extends('layouts.app')

@section('content')
<style>
    .eye-icon {
        cursor: pointer;
    }
	.password-input {
      position: relative;
    }

    .password-input .eye-icon {
      position: absolute;
      top: 50%;
      right: 30px;
      bottom: 35px;
      cursor: pointer;
	}
</style>
    <div class="col-lg-3" id='wraplogin'>
        <div class="" id='divlogin'>
            {{-- <form method="POST" action="{{ route('login') }}">

                <div class="col-lg-12" style='text-align:center;'>
                    <img src="incl/img/logo.jpg" class='imgbuled'>
                    <hr>
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <h5>USER </h5>
                    <input type='text' name='username' id='u' class="form-control well1 nostyle">
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <h5>PASSWORD </h5><input type='password' name='password' id='p'
                        class="form-control well1 nostyle">
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <h5>JENIS </h5><select name='tipe' id="tipe" class="form-control well1 nostyle">
                        <option value="kosong" selected>-- Pilih Jenis User --</option>
                        <option value='admin'>Admin</option>
                        <option value='eksekutif'>Eksekutif</option>
                        <option value='perorangan'>Perorangan</option>
                    </select>
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <input type='submit' name='MM_insert' id='MM_insert' class="form-control btn btn-primary well1  "
                        value='LOGIN'>
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <font color='#ff000' size='1' face='verdana'></font>
                </div>
            </form> --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-lg-12" style='text-align:center;'>
                    <img src="{{asset('assets/img/logo.jpg')}}" class='imgbuled'>
                    <hr>
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <h5>E-Mail </h5>
                    <input type='email' name='email' id='email'
                    class="form-control well1 nostyle @error('email') is-invalid @enderror"value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <h5>PASSWORD </h5>
                    <i class="fas fa-eye eye-icon" id="passwordToggle" onclick="togglePasswordVisibility()"></i>
                    <input type='password' name='password' id='password'
                        class="form-control well1 nostyle @error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <h5>JENIS </h5><select name='tipe' id="tipe" class="form-control well1 nostyle">
                        <option value="kosong" selected>-- Pilih Jenis User --</option>
                        <option value='admin'>Admin</option>
                        <option value='eksekutif'>Eksekutif</option>
                        <option value='perorangan'>Perorangan</option>
                    </select>
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <input type='submit' name='MM_insert' id='MM_insert' class="form-control btn btn-primary well1  "
                        value='LOGIN'>
                </div>
                <div class="col-lg-12" style='text-align:center;'>
                    <font color='#ff000' size='1' face='verdana'></font>
                </div>
            </form>
        </div>
    </div>

    <!-- /.col-lg-12 -->

    <!-- /.row -->

    <!-- /.container-fluid -->
    <!-- /#page-wrapper -->

    </div>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
