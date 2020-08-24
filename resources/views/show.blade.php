<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <h2>Please agree to our updated Terms of Service.</h2>
            <div id="terms">
                {!! $terms->terms !!}
            </div>
            <form action="{{ route('terms.store') }}" method="post">
                @csrf

                <div class="form-check">
                    <input name="terms" type="checkbox" class="form-check-input" id="terms_and_conditions" required>
                    <label class="form-check-label" for="terms_and_conditions">{{ __('terms::terms.label') }}</label>
                    @error('terms')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
