
<form  method="POST" role="search" action="{{ route('sinister.statment') }}">
    {{ csrf_field() }}
<div class="row form-group">
<div class="row">
</div>

<div class="form-group col-md-8">

        <div class="input-group" style=" margin-left:30%">
            <input type="text" class="form-control" name="folder"  id="folder" placeholder="rechercher le numéro dossier">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span>Rechercher</span>
                    </button>
                 </span>
        </div>

</div>

</form>
