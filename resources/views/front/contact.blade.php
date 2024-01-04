@extends('front.layouts.master')

@section('title', 'İletişim')

@section('bg', 'https://startbootstrap.github.io/startbootstrap-clean-blog/assets/img/contact-bg.jpg')

@section('content')
<!-- Main Content-->


<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center ">

    <div class="col-md-10 col-lg-8 col-xl-7">
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}    
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ( $errors->all() as $error )

                <li>{{$error}}</li>
                    
                @endforeach
            </ul>   
        </div>
    @endif
            <p>Bizimle iletişime geçmek ister misiniz? Lütfen formu doldurun ve mesajınızı gönderin. En kısa zamanda dönüş yapmaya çalışacağım!</p>
            <div class="my-5">

                <form method="post" action="{{route('contact.post')}}">
                    @csrf
                    <div class="form-floating">
                        <input class="form-control" value="{{old('name')}}" name="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                        <label for="name">Ad Soyad</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" value = "{{old('email')}}" name="email" type="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                        <label for="email">Email Adresi</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <div class="form-floating">
                      
                        <label for="phone">Konu</label>
                        <br><br>
                        <select style="height: 40px; padding:0;" class="form-control" name="topic">

                            <option  @if(old('topic') == 'Bilgi') selected @endif >Bilgi</option>
                            <option @if(old('topic') == 'Destek') selected @endif >Destek</option>
                            <option @if(old('topic') == 'Genel') selected @endif >Genel</option>

                        </select>

                    </div>
                    <br>
                    <hr>
                    <div class="form-floating">
                        <textarea class="form-control" name="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required">{{old('message')}}</textarea>

                        <label for="message">Mesajınız</label>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                    </div>
                    <br />
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Gönder</button>
                </form>
            </div>
        </div>
        

    </div>

</div>



@endsection