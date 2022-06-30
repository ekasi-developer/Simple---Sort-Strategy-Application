<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>String Sorting - Strategy.</title>
    <link rel="stylesheet" href="{{ url('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('assets/css/argon.css') }}" type="text/css">
    <style>
        body
        {
            width: 100%;
            min-height: 100vh;
        }
        pre
        {
            border: #e0e0e0;
            padding: 15px;
            background: #242628;
            color: #39e15f;
            border-radius: 5px;
        }
        .main
        {
            width: 100%;
            min-height: 100vh;
        }
    </style>
</head>
<body>


<div class="main container">
    @if(isset($sorted))
    <div class="row justify-content-center mt-2">
        <div class="col-lg-8">
            <div class="card-wrapper">
                <!-- HTML5 inputs -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Sorted String</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <pre>{{ $sorted }}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center mt-2">
        <div class="col-lg-8">
            <div class="card-wrapper">
                <!-- HTML5 inputs -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Sort String</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form method="POST" action="{{ url('') }}">
                            <div class="form-group row">
                                <label for="value" class="col-md-3 col-form-label form-control-label">
                                    Value
                                </label>
                                <div class="col-md-9">
                                    <textarea type="text"
                                              name="value"
                                              id="value"
                                              class="form-control @error('value') is-invalid @enderror"
                                              rows="4">{{ old('value') }}</textarea>
                                    <p class="invalid-feedback mb-0">@error('value') {{ $message }} @enderror</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="strategy" class="col-md-3 col-form-label form-control-label">
                                    Sorting Strategy
                                </label>
                                <div class="col-md-9">
                                    <div class="custom-control custom-radio mb-3 @error('strategy') is-invalid @enderror">
                                        <input name="strategy"
                                               class="custom-control-input"
                                               id="quick-sort"
                                               type="radio"
                                               value="Quick" {{ old('strategy') == 'Quick' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="quick-sort">QuickSort</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="strategy"
                                               class="custom-control-input"
                                               id="merge-sort"
                                               type="radio"
                                               value="Merge" {{ old('strategy') == 'Merge' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="merge-sort">MergeSort</label>
                                    </div>
                                    <p class="invalid-feedback mb-0">@error('strategy') {{ $message }} @enderror</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
                                    <button class="btn btn-icon btn-primary" type="submit">
                                        <span class="btn-inner--icon"><i class="ni ni-bullet-list-67"></i></span>
                                        <span class="btn-inner--text">Sort</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>