
                                <form  method="POST" action="{{ route('subscription.postequipment') }}">
                                    @csrf
                            <div class="row form-group">
                                <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
                                    <div class="card ">

                                        <div class="card-body row">
                                            <div class="form-group col-xs-6 col-sm-6 col-lg-6 col-md-6">
                                                <label for="code">Selectionnez votre équipement</label>
                                                <select name="equipment" id="equipment" class="form-control @error('equipment') is-invalid @enderror select2bs4NE" style="width: 100%;">
                                                    @foreach ($types as $item)
                                                        <option value={{$item->id}}  >{{$item->label}}</option>
                                                    @endforeach
                                                        </select>
                                                        @error('equipment')
                                                            <span class="invalid-tooltip" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                            </div>
                                            <div class="form-group col-xs-6 col-sm-6 col-lg-6 col-md-6">
                                                <label for="picture">Photo équipement</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input form-control-sm form-control @error('picture') is-invalid @enderror"  name="picture" id="picture" >
                                                    <label class="custom-file-label" for="picture">CHARGER LA PHOTO</label>
                                                    @error('picture')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group col-xs-6 col-sm-6 col-lg-6 col-md-6">
                                                <label for="mark">Marque</label>
                                                <select name="mark" id="mark" class="form-control  @error('mark') is-invalid @enderror select2bs4NE" style="width: 100%;">
                                                </select>
                                                @error('mark')
                                                    <span class="invalid-tooltip" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-xs-6 col-sm-6 col-lg-6 col-md-6">
                                                <label for="model">Modèle</label>
                                                <select name="model" id="model" class="form-control @error('model') is-invalid @enderror select2bs4NE" style="width: 100%;">
                                                </select>
                                                @error('model')
                                                    <span class="invalid-tooltip" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-xs-6 col-sm-6 col-lg-6 col-md-6">
                                                <label for="numberIMEI">Numéro Identifiant (IMEI) </label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control @error('numberIMEI') is-invalid @enderror" name="numberIMEI" id="numberIMEI" value="" placeholder="Saisir le numéro identifiant (IMEI)" required autocomplete="numberIMEI" >
                                                </div>
                                                @error('numberIMEI')
                                                    <span class="invalid-tooltip" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-xs-6 col-sm-6 col-lg-6 col-md-6">
                                                <label for="price">Prix Achat </label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="" placeholder="Saisir le prix d'achat" required autocomplete="price" >
                                                </div>
                                                @error('price')
                                                <span class="invalid-tooltip" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>



                                        </div>
                                        <!-- /.card -->
                                        </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
                                    <div class="card">

                                        <div class="card-body row">
                                            <div class="form-group col-xs-12 col-sm-12 col-lg-12 col-md-12">
                                                <label for="date_subscription">Date effet de la garantie</label>
                                                    <div class="input-group">

                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user"></span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $date= date_format(date_create(now()),'Y-m-d');

                                                        echo     "<input type='text' class='form-control @error('date_subscription') is-invalid @enderror' name='date_subscription' id='date_subscription' value=$date style='color: red'  readonly/>" ;

                                                        ?>

                                                    </div>
                                                    @error('date_subscription')
                                                    <span class="invalid-tooltip" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                            </div>


                                            <div class="form-group col-xs-12 col-sm-12 col-lg-12 col-md-12">
                                                <label for="subscription_enddate">Date fin de la garantie</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $subscription_enddate=now()->addYears(1)->addDays(-1);
                                                    $subscription_enddate= date_format(date_create($subscription_enddate),'Y-m-d');
                                                    echo     "<input type='text' class='form-control' name='subscription_enddate' id='subscription_enddate' value=$subscription_enddate style='color: red'  readonly/>" ;

                                                    ?>
                                                </div>
                                            </div>


                                        <div class="form-group col-xs-12 col-sm-12 col-lg-12 col-md-12">
                                            <label>FORMULE</label>
                                            <div >
                                                <div class="icheck-danger icheck-inline">
                                                    <input class="checkbox"  onchange="unchecked2_3()"  type="checkbox"  value=1 name="formula" id="formula">
                                                    <label for="formula">
                                                        ECO
                                                    </label>
                                                </div>
                                                <div class="icheck-danger icheck-inline">
                                                    <input class="checkbox" checked onchange="unchecked1_3()" type="checkbox" value=2 name="formula" id="formula2" >
                                                    <label for="formula2">
                                                        STANDARD
                                                    </label>
                                                </div>
                                                    <div class="icheck-danger icheck-inline">
                                                        <input class="checkbox" onchange="unchecked1_2()" type="checkbox"  value=3 name="formula" id="formula3" >
                                                        <label for="formula3">
                                                            PREMIUM
                                                        </label>
                                                    </div>

                                            </div>


                                            @error('formula')
                                                    <span class="invalid-tooltip" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror



                                            </div>
                                            </div>



                                    </div>



                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>








                            <div class="form-group col-md-12">

                                <div class="form-group">


                                    <label style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Prime à payer  :  </label>

                                    <label name="price" id="output" style="color: red">   </label> <label for="FCFA">FCFA</label>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                <div class="form-group col-6 " style="text-align: left">
                                    <a class="btn btn-warning text-white"  href="{{ route('subscription.precedent') }}"><b>PRECEDENT </b></a>

                                </div>

                            <div class="form-group col-6 " style="text-align: right">
                                <button type="submit" class="btn btn-warning text-white" ><b>SUIVANT </b></button>
                            </div>
                        </div>
                        </div>
                        </div>
                                </form>
