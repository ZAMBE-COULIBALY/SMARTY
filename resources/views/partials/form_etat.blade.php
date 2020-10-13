
<form  method="POST" action="{{ route('statistics.show') }}">
                            @csrf
                            <div class="row form-row">
                                <div class="form-group col-md-2">
                                    <div class="form-group">
                                        <label>Agences</label>
                                        <select name="agency" id="agency" class="form-control select2bs4" style="width: 100%;">
                                          @foreach ($agencies as $item)
                                            <option value="{{$item->id}}">{{$item->partner->label ." || ". $item->label}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                            
                            
                                <div class="form-group col-md-3">
                                    <label for="startdate" class="form-control-label">DEBUT</label>
                                    <div class="input-group date" id="startdate" name="startdate" data-target-input="nearest">
                            
                                        <input name="startdate" id="startdate" type="text" class="form-control datetimepicker-input" data-target="#startdate"/>
                                        <div class="input-group-append" placeholder="DATE DEBUT" data-target="#startdate" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                            
                                </div>
                                <div class="form-group col-md-3">
                            
                                    <label for="enddate">FIN</label>
                                    <div class="input-group date" id="enddate" name="enddate" data-target-input="nearest">
                            
                                        <input name="enddate" id="enddate" type="text" class="form-control datetimepicker-input" data-target="#enddate"/>
                                <div class="input-group-append" placeholder="DATE FIN" data-target="#enddate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                            
                                        <button id="search" name="search" class="btn btn-default">RECHERCHER</button>
                                    </div>
                                </div>
                            
                                <hr>
                            </form>
                        
