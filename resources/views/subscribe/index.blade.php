@extends('layouts.app')

@section('content')

    
<div class="hero">
    <div class="hero-content">
        <h1>You're Joining</h1>
        <h2>HOORAY!</h2>
    </div>
</div>


<section class="container">
    <div class="card card-padded">

        <form action="/subscribe" method="post" id="subscribeForm">
            @csrf
            <!-- user info ( only show if not logged in ) -->
            @if(Auth::guest())
            <div class="section-header">
                <h2>User Info</h2>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            @endif
            
            <!-- subscription info -->
            <div class="section-header">
                <h2>Subscription Info</h2>

                <div class="form-group row">
                    <div class="col-sm-4">

                        <div class="subscription-option">
                            <input type="radio" id="planBronze" name="plan" value="price_1HYbWbKgW18lL4fGrSCQs1RH" checked>
                            <label for="planBronze">
                                <span class="plan-price"> $5 <small>/mo</small></span>
                                <span class="plan-name">Bronze</span>
                            </label>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="subscription-option">
                            <input type="radio" id="planSilver" name="plan" value="price_1HYbYAKgW18lL4fGPlsTLIuS">
                            <label for="planSilver">
                                <span class="plan-price"> $10 <small>/mo</small></span>
                                <span class="plan-name">Silver</span>
                            </label>
                        </div>
    
                    </div>
                    <div class="col-sm-4">

                        <div class="subscription-option">
                            <input type="radio" id="planGold" name="plan" value="price_1HYbYtKgW18lL4fGMTf7gcO0">
                            <label for="planGold">
                                <span class="plan-price"> $15 <small>/mo</small></span>
                                <span class="plan-name">Gold</span>
                            </label>
                        </div>

                    </div>
                </div>

            </div>

            <!-- credit card info -->
            <div class="section-header">
                <h2>Credit Card Info</h2>
            </div>

           

            <div class="stripe-errors"></div>

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
                </div>
            @endif

            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg btn-block">Join</button>
            </div>
        
        </form>

        <!-- updated -->
        <div class="form-group">
            <input id="card-holder-name" type="text">

            <!-- Stripe Elements Placeholder -->
            <div id="card-element"></div>

            <button id="card-button" data-secret="{{ $intent->client_secret }}">
                Subscribe
            </button>
        </div>

    </div>
</section>

    

@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe("{{ config('site.stripe_key') }}");

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
                $('.stripe-errors').text(error.message);

            } else {
                // The card has been verified successfully...
                console.log(setupIntent.payment_method);

                axios.post('/subscribe', {
                    payment_method: setupIntent.payment_method,
                    plan: $('input[name="plan"]:checked').val()
                }).then(({data}) => {
                    
                });
            }
        });

    </script>

@endpush