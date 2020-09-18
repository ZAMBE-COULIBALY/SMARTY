
                                <form  method="POST" action="{{ route('subscription.postequipment') }}">
                                    @csrf
                            <div class="row form-group">
                                <div class="row">
                                </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                           <label>Selectionnez votre équipement</label>
                                           <select name="equipment" class="form-control select2bs4" style="width: 100%;">
                                            @foreach ($categories as $item)
                                            <option value={{$item->id}} {{ (isset($product) && $product->category->id == $item->id)? 'selected' : '' }}>{{$item->label}}</option>
                                          @endforeach
                                            </select>
                                        </div>
                                    </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                       <label>Marque</label>
                                       <select name="mark" class="form-control select2bs4" style="width: 100%;">
                                        @foreach ($labels as $item)
                                        <option value="{{$item->id}}" {{ (isset($product) && $product->label->id == $item->id)? 'selected' : '' }}>{{$item->label}}</option>
                                      @endforeach
                                        </select>
                                    </div>
                                </div>

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                   <label>Modèle</label>
                                   <select name="model" class="form-control select2bs4" style="width: 100%;">
                                    @foreach ($models as $item)
                                    <option value="{{$item->id}}" {{ (isset($product) && $product->model->id == $item->id)? 'selected' : '' }}>{{$item->label}}</option>
                                  @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="numberIMEI">Numéro Identifiant (IMEI) </label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control " name="numberIMEI" id="numberIMEI" value="" placeholder="Saisir le numéro identifiant (IMEI)" required autocomplete="numberIMEI" >
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="price">Prix Achat </label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control " name="price" id="price" value="" placeholder="Saisir le prix d'achat" required autocomplete="price" >
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="date_subscription">Date effet de la garantie</label>
                                <div class="input-group">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <?php
                                    $date= date_format(date_create(now()),'Y-m-d');

                                    echo     "<input type='text' class='form-control' name='date_subscription' id='date_subscription' value=$date style='color: red'  readonly/>" ;

                                    ?>

                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="subscription_enddate">Date fin de la garantie</label>
                                <div class="input-group">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <?php
                                    $date= date_format(date_create(now()),'Y-m-d');
                                    $madate=  $date;

                                    list($annee,$mois,$jour)=sscanf($madate,"%d-%d-%d");
                                    $annee+=1;
                                    if (strlen($mois)===1) {
                                        $mois ='0'.$mois;
                                    }else {
                                        $mois =$mois;
                                    }
                                    if (strlen($jour)===1){
                                        $jour ='0'.$jour;
                                    }else {
                                        $jour =$jour;
                                    }
                                    $subscription_enddate=$annee.'-'.$mois.'-'.$jour;

                                    echo     "<input type='text' class='form-control' name='subscription_enddate' id='subscription_enddate' value=$subscription_enddate style='color: red'  readonly/>" ;

                                    ?>

                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="picture">Photo équipement</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-edit"></span>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control " name="picture" id="picture">
                                </div>
                            </div>

                            <div class="form-group col-md-9"></div>
                            <div class="form-group col-md-12">
                                <hr>
                                <div class="form-group">


                                    <label style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Prime à payer  :  </label>

                                    <label name="price" id="output" style="color: red">   </label> <label for="FCFA">FCFA</label>

                                </div>
                            </div>
                        </div>
                        <div class="row">

                                <div class="form-group col-md-6 ">
                                    <a class="btn btn-primary" href="{{ route('subscription.precedent') }}">PRECEDENT</a>

                                </div>

                            <div class="form-group col-md-6 ">
                                <button type="submit" class="btn btn-primary" >SUIVANT</button>
                            </div>
                        </div>


                                </P>
                                </form>
