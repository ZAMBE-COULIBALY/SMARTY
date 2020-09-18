
<form  method="GET" action="{{ route('statistics.show') }}">
                            @csrf
            <div class="row form-group">
                <div class="row">
                </div>

                <div class="form-group col-md-3">
                    <div class="form-group">
                    <label>PDV</label>
                    <select name="libellepdv" class="form-control select2bs4" style="width: 100%;">

                        <option value={{$Subscription['libellepdv']}}>{{$Subscription['libellepdv']}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="date_deb">DATE DEBUT</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="date" class="form-control" name="date_deb" id="date_deb" >
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="date_fin">DATE FIN</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="date" class="form-control" name="date_fin" id="date_fin" >
                    </div>
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="form-group col-md-8 " style="text-align: right">
                    <button type="submit" class="btn btn-primary" >valider</button>
                </div>
            </div>
</form>
