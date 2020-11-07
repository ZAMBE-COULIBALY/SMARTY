@extends('shared.layout')
@section('dashboardm')
menu-open active
@endsection
@section('dashboard')
active
@endsection
@section('style')
<style>

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #160f55;
        padding: 0 25px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
@endsection
@section('content')
    @if (Auth::user()->hasAnyRole(['administrator','super_administrator']))
        
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>
            TABLEAU DE BORD
            <small></small>
        </h1>
        </div>
       
    </div>
    </div><!-- /.container-fluid -->
</section>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="card card-primary  shadow-sm ">
                        <div class="card-header  p-0 pt-1">
                            <strong><h5>PREVISIONNEL</h5></strong> 
                        </div>
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-md-3 col-sm-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h4 id="subscription100"></h4>

                                            <h7>INDEMNISATION 100%</h7>
                                        </div>
                                        {{--  <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>  --}}
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                    <!-- ./col -->
                                    <div class="col-md-3 col-sm-6">
                                        <!-- small box -->
                                        <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h4 id="subscription70"></h4>

                                            <h7>INDEMNISATION 70%</h7>
                                        </div>
                                        {{--  <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>  --}}
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-md-3 col-sm-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                        <div class="inner">
                                            <h4 id="subscription50"></h4>

                                            <h7>INDEMNISATION 50%</h7>
                                        </div>
                                        {{--  <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>  --}}
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-md-3 col-sm-6">
                                        <!-- small box -->
                                        <div class="small-box bg-secondary">
                                            <div class="inner">
                                                <h4 id="subscriptionFull"></h4>

                                                <h7>TOTAL</h7>
                                            </div>
                                            {{--  <div class="icon"> 
                                                <i class="ion ion-pie-graph"></i>
                                            </div>  --}}
                                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                                        <div class="card card-primary  shadow-sm ">
                                            <div class="card-header  p-0 pt-1">
                                               <STrong><h5>REEL</h5></STrong> 
                                            </div>

                                            <div class="card-body">
                                                <div class="row"> 
                                    <div class="col-md-6 col-sm-6">
                                        <!-- small box -->
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h4 id="subscriptionWin"></h4>

                                                <h7>GAIN SMARTY</h7>
                                            </div>
                                            {{--  <div class="icon"> 
                                                <i class="ion ion-pie-graph"></i>
                                            </div>  --}}
                                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                 <!-- ./col --> 
                                 <div class="col-md-6 col-sm-6">
                                    <!-- small box -->
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h4 id="subscriptionLost"></h4>

                                            <h7>INDEMNISATIONS</h7>
                                        </div>
                                        {{--  <div class="icon"> 
                                            <i class="ion ion-pie-graph"></i>
                                        </div>  --}}
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                             <!-- ./col -->
                                 
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header border-0">
                          <div class="d-flex justify-content-between">
                            <h3 class="card-title">Nombre de souscription mensuel
                            </h3>
                            {{--  <a href="javascript:void(0);">View Report</a>  --}}
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="d-flex">
                            {{--  <p class="d-flex flex-column">
                              <span class="text-bold text-lg">820</span>
                              <span>Visitors Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                              <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 12.5%
                              </span>
                              <span class="text-muted">Since last week</span>
                            </p>  --}}
                          </div>
                          <!-- /.d-flex -->
          
                          <div class="position-relative mb-4">
                            <canvas id="globalMonthlySubscription-chart" height="200"></canvas>
                          </div>
          
                          <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                              <i class="fas fa-square text-primary"></i> Cette Année
                            </span>
          
                            {{--  <span>
                              <i class="fas fa-square text-gray"></i> Last Week
                            </span>  --}}
                          </div>
                        </div>
                      </div>
                      <!-- /.card -->
          
                </div>
            </div>

            <!-- /.row -->
        </div>
    </section> 
    @else
    <div class="content flex-center">
        <div class="title m-b-md links">
            <a href="" > <strong>NSIA ASSURANCE SMARTY</strong></a>
        </div>
    </div>
    @endif
@endsection


@section('script')
    <script>
        $(function () {

            separateur = function (val)
            {
             var i, j, chaine, c, deb, fin, mantisse,valeur;
             
             //on formate la chaine
             chaine = "";

            valeur = val.toString();
             for (i=valeur.length-1, j=0; i>=0; i--, j++)
             {
                c = valeur.charAt(i);
                

                if (j%3==0 && j!=0)           //on ajoute un espace tous les 3 caracteres
                    chaine = c + " " +chaine;
                else
                    chaine = c + chaine;
             }
             
             
            console.log(chaine);
             return chaine;
            }
           

            getdata = function () {
                var j = [];

                $.get("../api/dashboardData/",function(data,j){
                    // console.log(data);
                    
                     $("#subscription50").text(separateur(data.general.subscription50));
                     $("#subscription70").text(separateur(data.general.subscription70));
                     $("#subscription100").text(separateur(data.general.subscription100));
                     $("#subscriptionFull").text(separateur(data.general.subscriptionFull));
                     $("#subscriptionWin").text(separateur(data.general.subscriptionWin));
                     $("#subscriptionLost").text(separateur(data.general.subscriptionLost));
                      j = data.globalMonthlySubCount;
                      j = Object.values(j);
                    console.log(Math.max(...j));
                    const array = [10, 2, 33, 4, 5];

                    console.log(
                      Math.max(...array)
                    )
                    var ticksStyle = {
                        fontColor: '#495057',
                        fontStyle: 'bold'
                      }
                    
                      var mode = 'index'
                      var intersect = true
                                var $globalMonthlySubscriptionChart = $('#globalMonthlySubscription-chart')
                                // eslint-disable-next-line no-unused-vars
                                var globalMonthlySubscriptionChart = new Chart($globalMonthlySubscriptionChart, {
                                  data: {
                                    labels: ['janvier', 'fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
                                    datasets: [{
                                      type: 'line',
                                      data: Object.values(j),
                                      backgroundColor: 'transparent',
                                      borderColor: '#007bff',
                                      pointBorderColor: '#007bff',
                                      pointBackgroundColor: '#007bff',
                                      fill: false
                                      // pointHoverBackgroundColor: '#007bff',
                                      // pointHoverBorderColor    : '#007bff'
                                    },
                                    ]
                                  },
                                  options: {
                                    maintainAspectRatio: false,
                                    tooltips: {
                                      mode: mode,
                                      intersect: intersect
                                    },
                                    hover: {
                                      mode: mode,
                                      intersect: intersect
                                    },
                                    legend: {
                                      display: false
                                    },
                                    scales: {
                                      yAxes: [{
                                        // display: false,
                                        gridLines: {
                                          display: true,
                                          lineWidth: '4px',
                                          color: 'rgba(0, 0, 0, .2)',
                                          zeroLineColor: 'transparent'
                                        },
                                        ticks: $.extend({
                                          beginAtZero: true,
                                          suggestedMax: Math.max(...j)+10
                                        }, ticksStyle)
                                      }],
                                      xAxes: [{
                                        display: true,
                                        gridLines: {
                                          display: false
                                        },
                                        ticks: ticksStyle
                                      }]
                                    }
                                  }
                                })
                         
                    
                    
    
                 });


     
            }
            getdata();

     
                        })
                    </script>
                

@endsection

