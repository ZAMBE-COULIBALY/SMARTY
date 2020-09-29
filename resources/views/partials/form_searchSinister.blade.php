<form  method="POST" class="form" role="search" action="{{ route('sinister.statment') }}">
@csrf

<div class="row">


        <div class="col-md-8">

                <div class="input-group" >
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control @error('folder') is-invalid @enderror" name="folder" id="folder" value="{{ old('subscription') }}" placeholder="Rechercher la souscription" required autofocus>
                    @error('folder')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>


                </div>
        </div>
            <div class="col-md-4">

                <button type="submit" class="btn btn-default">
                    <span>Rechercher</span>
                </button>

            </div>
        </div>


</form>
