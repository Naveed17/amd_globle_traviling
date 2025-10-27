@extends('common.layout')
@section('content')

<style>
    body {
        background-color: #fafafa;
    }

    .booking-page-return {
        border-top: 2px solid lightgray;
        margin-top: 30px;
        padding-top: 30px;
    }

    /* Custom dropdown scroll for month field */
    select.month-select option {
        height: 35px !important;
        /* Optional: control item height */
    }

    /* Optional: modern browsers will scroll by default when too many options */
    select.month-select {
        overflow-y: auto;
        max-height: 140px !important;
        /* Approx height for 4 items if needed */
    }
    .booking-page-right-col-sticky{
        position: sticky;
        top: 20px;
        bottom: 20px;
    }
</style>

<div class="container">
    <div class="MSF-main-hd">My booking</div>
    <div class="row mb-5">
        <!-- left colmun -->
        <div class="col-lg-8 col-12">


            <!-- multi step form -->
                <form method="post" id="MSF-multiStepForm" action="{{ route('flight_booking') }}">
                    @csrf
                    <input type="hidden" name="flight_segment" value="{{ encrypt(json_encode($routes))}}">
                    <input type="hidden" name="booking_data" value="{{ encrypt(json_encode($booking_data)) }}">
                    <input type="hidden" name="currency" value="{{ encrypt($routes->segments[0][0]->currency)}}">
                    <input type="hidden" name="price" value="{{ encrypt($routes->segments[0][0]->price)}}">
                    <input type="hidden" name="partner_name" value="{{ encrypt($routes->segments[0][0]->supplier)}}">
                <!-- Step 1: Booking -->
                <div class="MSF-step active" id="MSF-step-1">
                    <!-- fligth information -->
                    <div class="MSD-booking-fm-hd">Flight Information</div>
                    <div class="tab-pane fade show active" id="flight" role="tabpanel">
                        @if(isset($session_data['trip_type']) && $session_data['trip_type'] == "oneway")
                        @foreach($routes->segments as $rout)
                                @foreach($rout as $route)
                            <div class="row mb-5 d-flex align-items-center">
                                <div class="col-md-3 col-12 BP-logo-main">
                                    <div>
                                        <img src="https://assets.duffel.com/img/airlines/for-light-background/full-color-logo/<?= htmlspecialchars($route->carrier->operating) ?>.svg" width="89px" height="89px">
                                    </div>
                                    <div class="BP-logo-sec">
                                        <span>
                                            <span class="text-primary">{{$route->airline_name}}</span><br>{{$route->flight_number}}<br>{{ isset($session_data['flight_type']) && $session_data['flight_type'] ? strtoupper($session_data['flight_type']) : '' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-9 col-12">
                                    <div class="BP-time-sec">
                                        <div class="BP-city-adjust">{{$route->departure->airport}} - {{$route->departure->time}}</div>
                                        {{--<div class="BP-city-adjust text-center text-dark">23h 30m</div>--}}
                                        <div class="BP-city-adjust" style="width: 30%;"><span>{{ $route->arrival->time }} - {{ $route->arrival->airport }}</span></div>
                                    </div>
                                    <div class="BP-airport-loc fw-bold mt-2">
                                        <div style="width: 30%;">{{$route->departure->city_name}},{{$route->departure->airport_name}}</div>
                                        <div class="text-center" style="width: 40%;">
                                            <img src="{{url('public/assets/images/direction.png')}}" class="mb-1" width="140px" height="9px">
                                        </div>
                                        <div style="width: 30%;">{{$route->arrival->airport_name}},{{$route->arrival->city_name}}</div>
                                        <img src="{{url('public/assets/images/BP-circle.png')}}" class="BP-circle-img" width="38px"
                                             height="34px">
                                        <img src="{{url('public/assets/images/list-plane.png')}}" class="BP-plane-icon" width="30px"
                                             height="30px">
                                    </div>
                                    <div class="BP-time-sec mt-2">
                                        <div class="BP-city-adjust">{{$route->departure->date_convert}} <br> Terminal {{$route->departure->terminal}}</div>
                                        <div class="BP-city-adjust text-center  text-dark">Non-Stop</div>
                                        <div class="BP-city-adjust" style="width: 30%;">
                                            <span class="">{{$route->arrival->date_convert}} <br>Terminal {{$route->arrival->terminal}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            @endforeach
                        @endif


                            @if(isset($session_data['trip_type']) && $session_data['trip_type'] == 'round')
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-3 col-12 BP-logo-main">
                                        <div>
                                            <img src="https://assets.duffel.com/img/airlines/for-light-background/full-color-logo/<?= htmlspecialchars($routes->segments[0][0]->carrier->operating) ?>.svg" width="89px" height="89px">
                                        </div>
                                        <div class="BP-logo-sec">
                                        <span>
                                            <span class="text-primary">{{$routes->segments[0][0]->airline_name}}</span><br>{{$routes->segments[0][0]->flight_number}}<br>{{ isset($session_data['flight_type']) && $session_data['flight_type'] ? strtoupper($session_data['flight_type']) : '' }}
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <div class="BP-time-sec">
                                            <div class="BP-city-adjust">{{$routes->segments[0][0]->departure->airport}} - {{$routes->segments[0][0]->departure->time}}</div>
                                            <div class="BP-city-adjust text-center text-dark"></div>
                                            <div class="BP-city-adjust" style="width: 30%;"><span>{{ end($routes->segments[0])->arrival->time }} - {{ end($routes->segments[0])->arrival->airport }}</span></div>
                                        </div>
                                        <div class="BP-airport-loc fw-bold mt2">
                                            <div style="width: 30%;">{{$routes->segments[0][0]->departure->city_name}},{{$routes->segments[0][0]->departure->airport_name}}</div>
                                            <div class="text-center" style="width: 40%;">
                                                <img src="{{url('public/assets/images/direction.png')}}" class="mb-1" width="140px" height="9px">
                                            </div>
                                            <div style="width: 30%;">{{end($routes->segments[0])->arrival->airport_name}},{{end($routes->segments[0])->arrival->city_name}}</div>
                                            <img src="{{url('public/assets/images/BP-circle.png')}}" class="BP-circle-img" width="38px"
                                                 height="34px">
                                            <img src="{{url('public/assets/images/list-plane.png')}}" class="BP-plane-icon" width="30px"
                                                 height="30px">
                                        </div>
                                        <div class="BP-time-sec mt-2">
                                            <div class="BP-city-adjust">{{$routes->segments[0][0]->departure->date_convert}} <br> Terminal {{$routes->segments[0][0]->departure->terminal}}</div>
                                            <div class="BP-city-adjust text-center  text-dark">
                                                @php
                                                    if( count($routes->segments[0]) - 1 == 0){
                                                        echo "<span>Direct</span>";
                                                    }else{
                                                        echo "Stops ".count($routes->segments) - 1;
                                                    }
                                                @endphp
                                            </div>
                                            <div class="BP-city-adjust" style="width: 30%;">
                                                <span class="">{{end($routes->segments[0])->arrival->date_convert}} <br>Terminal {{end($routes->segments[0])->arrival->terminal}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <br />
                                <!-- return -->
                                <div class="row booking-page-return d-flex align-items-center">
                                    <div class="col-md-3 col-12 BP-logo-main">
                                        <div>
                                            <img src="https://assets.duffel.com/img/airlines/for-light-background/full-color-logo/<?= htmlspecialchars($routes->segments[1][0]->carrier->operating) ?>.svg" width="100px" height="100px">
                                        </div>
                                        <div class="BP-logo-sec">
                                        <span>
                                      <span class="text-primary">{{$routes->segments[1][0]->airline_name}}</span><br>{{$routes->segments[1][0]->flight_number}}<br>{{ isset($session_data['flight_type']) && $session_data['flight_type'] ? strtoupper($session_data['flight_type']) : '' }}
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <div class="BP-time-sec">
                                            <div class="BP-city-adjust">{{$routes->segments[1][0]->departure->airport}} - {{$routes->segments[1][0]->departure->time}}</div>
                                            <div class="BP-city-adjust text-center text-dark"></div>
                                            <div class="BP-city-adjust" style="width: 30%;"><span>{{ end($routes->segments[1])->arrival->time }} - {{ end($routes->segments[1])->arrival->airport }}</span></div>
                                        </div>
                                        <div class="BP-airport-loc fw-bold mt-2">
                                            <div style="width: 30%;">{{$routes->segments[1][0]->departure->city_name}},{{$routes->segments[1][0]->departure->airport_name}}</div>
                                            <div class="text-center" style="width: 40%;">
                                                <img src="{{url('public/assets/images/direction-return.png')}}" class="mb-1" width="140px" height="9px">
                                            </div>
                                            <div style="width: 30%;">{{end($routes->segments[1])->arrival->airport_name}},{{end($routes->segments[1])->arrival->city_name}}</div>
                                            <img src="{{url('public/assets/images/BP-circle.png')}}" class="BP-circle-img" width="38px"
                                                 height="34px">
                                            <img src="{{url('public/assets/images/return-list-plane.png')}}" class="BP-plane-icon" width="30px"
                                                 height="30px">
                                        </div>
                                        <div class="BP-time-sec mt-2">
                                            <div class="BP-city-adjust">{{$routes->segments[1][0]->departure->date_convert}} <br> Terminal {{$routes->segments[1][0]->departure->terminal}}</div>
                                            <div class="BP-city-adjust text-center  text-dark">
                                                @php
                                                    if( count($routes->segments[1]) - 1 == 0){
                                                        echo "<span>Direct</span>";
                                                    }else{
                                                        echo "Stops ".count($routes->segments) - 1;
                                                    }
                                                @endphp
                                            </div>
                                            <div class="BP-city-adjust" style="width: 30%;">
                                                <span class="">{{end($routes->segments[1])->arrival->date_convert}} <br>Terminal {{end($routes->segments[1])->arrival->terminal}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                    </div>


<br>
                    <!-- User Information Card -->
                    <div class="card p-3 shadow-sm border  mb-4">
                        <div class="card-header text-white" style="background-color: #2752FE;">Your Contact Information</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label class="form-label required">First Name *</label>
                                    <input type="text" class="form-control" name="user_fname" placeholder="First name" required maxlength="12">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label required">Last Name *</label>
                                    <input type="text" class="form-control" name="user_lname" placeholder="Last name" required maxlength="12">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label required">Email *</label>
                                    <input type="email" class="form-control" name="user_email" placeholder="Email" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label required">Phone *</label>
                                    <input type="tel" class="form-control" name="user_phone"  placeholder="Phone Number" required>
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="form-label required">Address *</label>
                                    <textarea class="form-control" name="user_address" placeholder="Address" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Passenger details -->
                    <div class="MSD-booking-fm-hd mb-0">
                        <img src="{{url('public/assets/images/p-info.png')}}" width="25px" height="25px" class="mb-1">
                        Passenger details
                    </div>
                    <small class="text-secondary">Name as on ID card/passport without title and punctuation</small>

                    <!-- Loop for multiple passengers -->
                    @for($i=1; $i<=$session_data['adults']; $i++)
                        <div class="card mb-4 p-3 shadow-sm border ">
                            <div class="card-header bg-primary text-white">
                                Passenger {{$i}} Details
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="traveller_type_{{$i}}" value="adults"/>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Select Title <span class="text-danger">*</span></label>
                                        <div class="BF-title-box-container">
                                            <!-- Radio buttons for title -->
                                            @foreach(['MR', 'MSTR', 'MRS', 'MISS'] as $title)
                                                <label class="BF-title-box {{ $title === 'MR' ? 'BF-selected' : '' }}">
                                                    <input type="radio" class="BF-title-radio" name="traveller_title_{{$i}}" {{ $title === 'MR' ? 'checked' : '' }}>
                                                    {{ $title }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mt-3">
                                        <label for="firstName" class="form-label required">First Name *</label>
                                        <input type="text" class="form-control" id="firstName"   name="first_name_{{$i}}" placeholder="First Name"  required maxlength="12">
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label for="lastName" class="form-label required">Last Name *</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name_{{$i}}" placeholder="Last Name" required maxlength="12">
                                    </div>
                                    <div class="col-2 mt-3">
                                        <label for="BF-dob" class="form-label required">DOB</label>
                                        <select class="form-select form-select" name="dob_month_{{$i}}">
                                            <option value="1">01 Jan </option>
                                            <option value="2">02 Feb </option>
                                            <option value="3">03 Mar </option>
                                            <option value="4">04 Apr </option>
                                            <option value="5">05 May </option>
                                            <option value="6">06 Jun </option>
                                            <option value="7">07 Jul </option>
                                            <option value="8">08 Aug </option>
                                            <option value="9">09 Sep </option>
                                            <option value="10">10 Oct</option>
                                            <option value="11">11 Nov</option>
                                            <option value="12">12 Dec</option>
                                        </select>
                                    </div>
                                    <div class="col-2 mt-5">
                                        <select name="dob_day_{{$i}}" class="form-select form-select">
                                            <option value="01">01 </option>
                                            <option value="02">02 </option>
                                            <option value="03">03 </option>
                                            <option value="04">04 </option>
                                            <option value="05">05 </option>
                                            <option value="06">06 </option>
                                            <option value="07">07 </option>
                                            <option value="08">08 </option>
                                            <option value="09">09 </option>
                                            <option value="10">10 </option>
                                            <option value="11">11 </option>
                                            <option value="12">12 </option>
                                            <option value="13">13 </option>
                                            <option value="14">14 </option>
                                            <option value="15">15 </option>
                                            <option value="16">16 </option>
                                            <option value="17">17 </option>
                                            <option value="18">18 </option>
                                            <option value="19">19 </option>
                                            <option value="20">20 </option>
                                            <option value="21">21 </option>
                                            <option value="22">22 </option>
                                            <option value="23">23 </option>
                                            <option value="24">24 </option>
                                            <option value="25">25 </option>
                                            <option value="26">26 </option>
                                            <option value="27">27 </option>
                                            <option value="28">28 </option>
                                            <option value="29">29 </option>
                                            <option value="30">30 </option>
                                            <option value="31">31 </option>
                                        </select>
                                    </div>

                                    <div class="col-2 mt-5">
                                        <select class="form-select form-select" name="dob_year_{{$i}}">
                                            <option value="2023"> 2023</option>
                                            <option value="2022"> 2022</option>
                                            <option value="2021"> 2021</option>
                                            <option value="2020"> 2020</option>
                                            <option value="2019"> 2019</option>
                                            <option value="2018"> 2018</option>
                                            <option value="2017"> 2017</option>
                                            <option value="2016"> 2016</option>
                                            <option value="2015"> 2015</option>
                                            <option value="2014"> 2014</option>
                                            <option value="2013"> 2013</option>
                                            <option value="2012"> 2012</option>
                                            <option value="2011"> 2011</option>
                                            <option value="2010"> 2010</option>
                                            <option value="2009"> 2009</option>
                                            <option value="2008"> 2008</option>
                                            <option value="2007"> 2007</option>
                                            <option value="2006"> 2006</option>
                                            <option value="2005"> 2005</option>
                                            <option value="2004"> 2004</option>
                                            <option value="2003"> 2003</option>
                                            <option value="2002"> 2002</option>
                                            <option value="2001"> 2001</option>
                                            <option value="2000"> 2000</option>
                                            <option value="1999"> 1999</option>
                                            <option value="1998"> 1998</option>
                                            <option value="1997"> 1997</option>
                                            <option value="1996"> 1996</option>
                                            <option value="1995"> 1995</option>
                                            <option value="1994"> 1994</option>
                                            <option value="1993"> 1993</option>
                                            <option value="1992"> 1992</option>
                                            <option value="1991"> 1991</option>
                                            <option value="1990"> 1990</option>
                                            <option value="1989"> 1989</option>
                                            <option value="1988"> 1988</option>
                                            <option value="1987"> 1987</option>
                                            <option value="1986"> 1986</option>
                                            <option value="1985"> 1985</option>
                                            <option value="1984" selected="selected"> 1984</option>
                                            <option value="1983"> 1983</option>
                                            <option value="1982"> 1982</option>
                                            <option value="1981"> 1981</option>
                                            <option value="1980"> 1980</option>
                                            <option value="1979"> 1979</option>
                                            <option value="1978"> 1978</option>
                                            <option value="1977"> 1977</option>
                                            <option value="1976"> 1976</option>
                                            <option value="1975"> 1975</option>
                                            <option value="1974"> 1974</option>
                                            <option value="1973"> 1973</option>
                                            <option value="1972"> 1972</option>
                                            <option value="1971"> 1971</option>
                                            <option value="1970"> 1970</option>
                                            <option value="1969"> 1969</option>
                                            <option value="1968"> 1968</option>
                                            <option value="1967"> 1967</option>
                                            <option value="1966"> 1966</option>
                                            <option value="1965"> 1965</option>
                                            <option value="1964"> 1964</option>
                                            <option value="1963"> 1963</option>
                                            <option value="1962"> 1962</option>
                                            <option value="1961"> 1961</option>
                                            <option value="1960"> 1960</option>
                                            <option value="1959"> 1959</option>
                                            <option value="1958"> 1958</option>
                                            <option value="1957"> 1957</option>
                                            <option value="1956"> 1956</option>
                                            <option value="1955"> 1955</option>
                                            <option value="1954"> 1954</option>
                                            <option value="1953"> 1953</option>
                                            <option value="1952"> 1952</option>
                                            <option value="1951"> 1951</option>
                                            <option value="1950"> 1950</option>
                                            <option value="1949"> 1949</option>
                                            <option value="1948"> 1948</option>
                                            <option value="1947"> 1947</option>
                                            <option value="1946"> 1946</option>
                                            <option value="1945"> 1945</option>
                                            <option value="1944"> 1944</option>
                                            <option value="1943"> 1943</option>
                                            <option value="1942"> 1942</option>
                                            <option value="1941"> 1941</option>
                                            <option value="1940"> 1940</option>
                                            <option value="1939"> 1939</option>
                                            <option value="1938"> 1938</option>
                                            <option value="1937"> 1937</option>
                                            <option value="1936"> 1936</option>
                                            <option value="1935"> 1935</option>
                                            <option value="1934"> 1934</option>
                                            <option value="1933"> 1933</option>
                                            <option value="1932"> 1932</option>
                                            <option value="1931"> 1931</option>
                                            <option value="1930"> 1930</option>
                                            <option value="1929"> 1929</option>
                                            <option value="1928"> 1928</option>
                                            <option value="1927"> 1927</option>
                                            <option value="1926"> 1926</option>
                                            <option value="1925"> 1925</option>
                                            <option value="1924"> 1924</option>
                                            <option value="1923"> 1923</option>
                                            <option value="1922"> 1922</option>
                                            <option value="1921"> 1921</option>
                                            <option value="1920"> 1920</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label class="form-label required">Gender *</label>
                                        <div class="radio-group d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" checked name="gender_{{$i}}" id="male">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check ms-3">
                                                <input class="form-check-input" type="radio" name="gender_{{$i}}" id="female">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <label for="PassportNO" class="form-label required">Passport number *</label>
                                        <input type="text" class="form-control" id="PassportNO" name="passport_{{$i}}" placeholder="6-15 Numbers" required>
                                    </div>
                                    <div class="col-4 mt-3">
                                        <label for="Countryissue" class="form-label required">Passport Issuance Date *</label>
                                        <select class="form-select form-select" name="passport_issuance_month_{{$i}}">
                                            <option value="1">01 Jan </option>
                                            <option value="2">02 Feb </option>
                                            <option value="3">03 Mar </option>
                                            <option value="4">04 Apr </option>
                                            <option value="5">05 May </option>
                                            <option value="6">06 Jun </option>
                                            <option value="7">07 Jul </option>
                                            <option value="8">08 Aug </option>
                                            <option value="9">09 Sep </option>
                                            <option value="10">10 Oct</option>
                                            <option value="11">11 Nov</option>
                                            <option value="12">12 Dec</option>
                                        </select>
                                    </div>

                                    <div class="col-4 mt-5">
                                        <select class="form-select form-select" name="passport_issuance_day_{{$i}}">
                                            <option value="01">01 </option>
                                            <option value="02">02 </option>
                                            <option value="03">03 </option>
                                            <option value="04">04 </option>
                                            <option value="05">05 </option>
                                            <option value="06">06 </option>
                                            <option value="07">07 </option>
                                            <option value="08">08 </option>
                                            <option value="09">09 </option>
                                            <option value="10">10 </option>
                                            <option value="11">11 </option>
                                            <option value="12">12 </option>
                                            <option value="13">13 </option>
                                            <option value="14">14 </option>
                                            <option value="15">15 </option>
                                            <option value="16">16 </option>
                                            <option value="17">17 </option>
                                            <option value="18">18 </option>
                                            <option value="19">19 </option>
                                            <option value="20">20 </option>
                                            <option value="21">21 </option>
                                            <option value="22">22 </option>
                                            <option value="23">23 </option>
                                            <option value="24">24 </option>
                                            <option value="25">25 </option>
                                            <option value="26">26 </option>
                                            <option value="27">27 </option>
                                            <option value="28">28 </option>
                                            <option value="29">29 </option>
                                            <option value="30">30 </option>
                                            <option value="31">31 </option>
                                        </select>
                                    </div>

                                    <div class="col-4 mt-5">
                                        <select class="form-select form-select" name="passport_issuance_year_{{$i}}">
                                            <option value="2023"> 2023</option>
                                            <option value="2022"> 2022</option>
                                            <option value="2021"> 2021</option>
                                            <option value="2020" selected="selected"> 2020</option>
                                            <option value="2019"> 2019</option>
                                            <option value="2018"> 2018</option>
                                            <option value="2017"> 2017</option>
                                            <option value="2016"> 2016</option>
                                            <option value="2015"> 2015</option>
                                            <option value="2014"> 2014</option>
                                            <option value="2013"> 2013</option>
                                            <option value="2012"> 2012</option>
                                            <option value="2011"> 2011</option>
                                            <option value="2010"> 2010</option>
                                            <option value="2009"> 2009</option>
                                            <option value="2008"> 2008</option>
                                            <option value="2007"> 2007</option>
                                            <option value="2006"> 2006</option>
                                            <option value="2005"> 2005</option>
                                            <option value="2004"> 2004</option>
                                            <option value="2003"> 2003</option>
                                            <option value="2002"> 2002</option>
                                            <option value="2001"> 2001</option>
                                            <option value="2000"> 2000</option>
                                            <option value="1999"> 1999</option>
                                            <option value="1998"> 1998</option>
                                            <option value="1997"> 1997</option>
                                            <option value="1996"> 1996</option>
                                            <option value="1995"> 1995</option>
                                            <option value="1994"> 1994</option>
                                            <option value="1993"> 1993</option>
                                            <option value="1992"> 1992</option>
                                            <option value="1991"> 1991</option>
                                            <option value="1990"> 1990</option>
                                            <option value="1989"> 1989</option>
                                            <option value="1988"> 1988</option>
                                            <option value="1987"> 1987</option>
                                            <option value="1986"> 1986</option>
                                            <option value="1985"> 1985</option>
                                            <option value="1984"> 1984</option>
                                            <option value="1983"> 1983</option>
                                            <option value="1982"> 1982</option>
                                            <option value="1981"> 1981</option>
                                            <option value="1980"> 1980</option>
                                            <option value="1979"> 1979</option>
                                            <option value="1978"> 1978</option>
                                            <option value="1977"> 1977</option>
                                            <option value="1976"> 1976</option>
                                            <option value="1975"> 1975</option>
                                            <option value="1974"> 1974</option>
                                            <option value="1973"> 1973</option>
                                            <option value="1972"> 1972</option>
                                            <option value="1971"> 1971</option>
                                            <option value="1970"> 1970</option>
                                            <option value="1969"> 1969</option>
                                            <option value="1968"> 1968</option>
                                            <option value="1967"> 1967</option>
                                            <option value="1966"> 1966</option>
                                            <option value="1965"> 1965</option>
                                            <option value="1964"> 1964</option>
                                            <option value="1963"> 1963</option>
                                            <option value="1962"> 1962</option>
                                            <option value="1961"> 1961</option>
                                            <option value="1960"> 1960</option>
                                            <option value="1959"> 1959</option>
                                            <option value="1958"> 1958</option>
                                            <option value="1957"> 1957</option>
                                            <option value="1956"> 1956</option>
                                            <option value="1955"> 1955</option>
                                            <option value="1954"> 1954</option>
                                            <option value="1953"> 1953</option>
                                            <option value="1952"> 1952</option>
                                            <option value="1951"> 1951</option>
                                            <option value="1950"> 1950</option>
                                            <option value="1949"> 1949</option>
                                            <option value="1948"> 1948</option>
                                            <option value="1947"> 1947</option>
                                            <option value="1946"> 1946</option>
                                            <option value="1945"> 1945</option>
                                            <option value="1944"> 1944</option>
                                            <option value="1943"> 1943</option>
                                            <option value="1942"> 1942</option>
                                            <option value="1941"> 1941</option>
                                            <option value="1940"> 1940</option>
                                            <option value="1939"> 1939</option>
                                            <option value="1938"> 1938</option>
                                            <option value="1937"> 1937</option>
                                            <option value="1936"> 1936</option>
                                            <option value="1935"> 1935</option>
                                            <option value="1934"> 1934</option>
                                            <option value="1933"> 1933</option>
                                            <option value="1932"> 1932</option>
                                            <option value="1931"> 1931</option>
                                            <option value="1930"> 1930</option>
                                            <option value="1929"> 1929</option>
                                            <option value="1928"> 1928</option>
                                            <option value="1927"> 1927</option>
                                            <option value="1926"> 1926</option>
                                            <option value="1925"> 1925</option>
                                            <option value="1924"> 1924</option>
                                            <option value="1923"> 1923</option>
                                            <option value="1922"> 1922</option>
                                            <option value="1921"> 1921</option>
                                            <option value="1920"> 1920</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 mt-3">
                                        <label for="Countryissue" class="form-label required">Passport Expiry Date *</label>
                                        <select class="form-select form-select" name="passport_month_expiry_{{$i}}">
                                            <option value="1">01 Jan </option>
                                            <option value="2">02 Feb </option>
                                            <option value="3">03 Mar </option>
                                            <option value="4">04 Apr </option>
                                            <option value="5">05 May </option>
                                            <option value="6">06 Jun </option>
                                            <option value="7">07 Jul </option>
                                            <option value="8">08 Aug </option>
                                            <option value="9">09 Sep </option>
                                            <option value="10">10 Oct</option>
                                            <option value="11">11 Nov</option>
                                            <option value="12">12 Dec</option>
                                        </select>
                                    </div>

                                    <div class="col-4 mt-5">
                                        <select class="form-select form-select" name="passport_day_expiry_{{$i}}">
                                            <option value="01">01 </option>
                                            <option value="02">02 </option>
                                            <option value="03">03 </option>
                                            <option value="04">04 </option>
                                            <option value="05">05 </option>
                                            <option value="06">06 </option>
                                            <option value="07">07 </option>
                                            <option value="08">08 </option>
                                            <option value="09">09 </option>
                                            <option value="10">10 </option>
                                            <option value="11">11 </option>
                                            <option value="12">12 </option>
                                            <option value="13">13 </option>
                                            <option value="14">14 </option>
                                            <option value="15">15 </option>
                                            <option value="16">16 </option>
                                            <option value="17">17 </option>
                                            <option value="18">18 </option>
                                            <option value="19">19 </option>
                                            <option value="20">20 </option>
                                            <option value="21">21 </option>
                                            <option value="22">22 </option>
                                            <option value="23">23 </option>
                                            <option value="24">24 </option>
                                            <option value="25">25 </option>
                                            <option value="26">26 </option>
                                            <option value="27">27 </option>
                                            <option value="28">28 </option>
                                            <option value="29">29 </option>
                                            <option value="30">30 </option>
                                            <option value="31">31 </option>
                                        </select>
                                    </div>

                                    <div class="col-4 mt-5">
                                        <select class="form-select form-select" name="passport_year_expiry_{{$i}}">
                                            <option value="2043"> 2043</option>
                                            <option value="2042"> 2042</option>
                                            <option value="2041"> 2041</option>
                                            <option value="2040"> 2040</option>
                                            <option value="2039"> 2039</option>
                                            <option value="2038"> 2038</option>
                                            <option value="2037"> 2037</option>
                                            <option value="2036"> 2036</option>
                                            <option value="2035"> 2035</option>
                                            <option value="2034"> 2034</option>
                                            <option value="2033"> 2033</option>
                                            <option value="2032"> 2032</option>
                                            <option value="2031"> 2031</option>
                                            <option value="2030"> 2030</option>
                                            <option value="2029"> 2029</option>
                                            <option value="2028"> 2028</option>
                                            <option value="2027"> 2027</option>
                                            <option value="2026"> 2026</option>
                                            <option value="2025" selected="selected"> 2025</option>
                                            <option value="2024"> 2024</option>
                                            <option value="2023"> 2023</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label class="form-label required">Email Traveller{{$i}} *</label>
                                        <input type="email" class="form-control" name="email_{{$i}}" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label required">Phone Number{{$i}} *</label>
                                        <input type="tel" class="form-control" name="phone_{{$i}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor

                    @for($i=1; $i<=$session_data['children']; $i++)
                        <div class="card mb-4 p-3 shadow-sm border ">
                            <div class="card-header bg-primary text-white">
                                Children Passenger {{$i}} Details
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="children_traveller_type_{{$i}}" value="children"/>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Select Title <span class="text-danger">*</span></label>
                                        <div class="BF-title-box-container">
                                            <!-- Radio buttons for title -->
                                            @foreach(['MR', 'MSTR', 'MRS', 'MISS'] as $title)
                                                <label class="BF-title-box {{ $title === 'MR' ? 'BF-selected' : '' }}">
                                                    <input type="radio" class="BF-title-radio" name="children_traveller_title_{{$i}}" {{ $title === 'MR' ? 'checked' : '' }}>
                                                    {{ $title }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mt-3">
                                        <label for="firstName" class="form-label required">First Name *</label>
                                        <input type="text" class="form-control" id="firstName"   name="children_first_name_{{$i}}" placeholder="First Name"  required maxlength="12">
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label for="lastName" class="form-label required">Last Name *</label>
                                        <input type="text" class="form-control" id="lastName" name="children_last_name_{{$i}}" placeholder="Last Name" required maxlength="12">
                                    </div>
                                    <div class="col-2 mt-3">
                                        <label for="BF-dob" class="form-label required">DOB</label>
                                        <select class="form-select form-select" name="children_dob_month_{{$i}}">
                                            <option value="1">01 Jan </option>
                                            <option value="2">02 Feb </option>
                                            <option value="3">03 Mar </option>
                                            <option value="4">04 Apr </option>
                                            <option value="5">05 May </option>
                                            <option value="6">06 Jun </option>
                                            <option value="7">07 Jul </option>
                                            <option value="8">08 Aug </option>
                                            <option value="9">09 Sep </option>
                                            <option value="10">10 Oct</option>
                                            <option value="11">11 Nov</option>
                                            <option value="12">12 Dec</option>
                                        </select>
                                    </div>
                                    <div class="col-2 mt-5">
                                        <select name="children_dob_day_{{$i}}" class="form-select form-select">
                                            <option value="01">01 </option>
                                            <option value="02">02 </option>
                                            <option value="03">03 </option>
                                            <option value="04">04 </option>
                                            <option value="05">05 </option>
                                            <option value="06">06 </option>
                                            <option value="07">07 </option>
                                            <option value="08">08 </option>
                                            <option value="09">09 </option>
                                            <option value="10">10 </option>
                                            <option value="11">11 </option>
                                            <option value="12">12 </option>
                                            <option value="13">13 </option>
                                            <option value="14">14 </option>
                                            <option value="15">15 </option>
                                            <option value="16">16 </option>
                                            <option value="17">17 </option>
                                            <option value="18">18 </option>
                                            <option value="19">19 </option>
                                            <option value="20">20 </option>
                                            <option value="21">21 </option>
                                            <option value="22">22 </option>
                                            <option value="23">23 </option>
                                            <option value="24">24 </option>
                                            <option value="25">25 </option>
                                            <option value="26">26 </option>
                                            <option value="27">27 </option>
                                            <option value="28">28 </option>
                                            <option value="29">29 </option>
                                            <option value="30">30 </option>
                                            <option value="31">31 </option>
                                        </select>
                                    </div>

                                    <div class="col-2 mt-5">
                                        <select class="form-select form-select" name="children_dob_year_{{$i}}">
                                            <option value="2023"> 2023</option>
                                            <option value="2022"> 2022</option>
                                            <option value="2021" selected="selected"> 2021</option>
                                            <option value="2020"> 2020</option>
                                            <option value="2019"> 2019</option>
                                            <option value="2018"> 2018</option>
                                            <option value="2017"> 2017</option>
                                            <option value="2016"> 2016</option>
                                            <option value="2015"> 2015</option>
                                            <option value="2014"> 2014</option>
                                            <option value="2013"> 2013</option>
                                            <option value="2012"> 2012</option>
                                            <option value="2011"> 2011</option>
                                            <option value="2010"> 2010</option>
                                            <option value="2009"> 2009</option>
                                            <option value="2008"> 2008</option>
                                            <option value="2007"> 2007</option>
                                            <option value="2006"> 2006</option>
                                            <option value="2005"> 2005</option>
                                            <option value="2004"> 2004</option>
                                            <option value="2003"> 2003</option>
                                            <option value="2002"> 2002</option>
                                            <option value="2001"> 2001</option>
                                            <option value="2000"> 2000</option>
                                            <option value="1999"> 1999</option>
                                            <option value="1998"> 1998</option>
                                            <option value="1997"> 1997</option>
                                            <option value="1996"> 1996</option>
                                            <option value="1995"> 1995</option>
                                            <option value="1994"> 1994</option>
                                            <option value="1993"> 1993</option>
                                            <option value="1992"> 1992</option>
                                            <option value="1991"> 1991</option>
                                            <option value="1990"> 1990</option>
                                            <option value="1989"> 1989</option>
                                            <option value="1988"> 1988</option>
                                            <option value="1987"> 1987</option>
                                            <option value="1986"> 1986</option>
                                            <option value="1985"> 1985</option>
                                            <option value="1984" > 1984</option>
                                            <option value="1983"> 1983</option>
                                            <option value="1982"> 1982</option>
                                            <option value="1981"> 1981</option>
                                            <option value="1980"> 1980</option>
                                            <option value="1979"> 1979</option>
                                            <option value="1978"> 1978</option>
                                            <option value="1977"> 1977</option>
                                            <option value="1976"> 1976</option>
                                            <option value="1975"> 1975</option>
                                            <option value="1974"> 1974</option>
                                            <option value="1973"> 1973</option>
                                            <option value="1972"> 1972</option>
                                            <option value="1971"> 1971</option>
                                            <option value="1970"> 1970</option>
                                            <option value="1969"> 1969</option>
                                            <option value="1968"> 1968</option>
                                            <option value="1967"> 1967</option>
                                            <option value="1966"> 1966</option>
                                            <option value="1965"> 1965</option>
                                            <option value="1964"> 1964</option>
                                            <option value="1963"> 1963</option>
                                            <option value="1962"> 1962</option>
                                            <option value="1961"> 1961</option>
                                            <option value="1960"> 1960</option>
                                            <option value="1959"> 1959</option>
                                            <option value="1958"> 1958</option>
                                            <option value="1957"> 1957</option>
                                            <option value="1956"> 1956</option>
                                            <option value="1955"> 1955</option>
                                            <option value="1954"> 1954</option>
                                            <option value="1953"> 1953</option>
                                            <option value="1952"> 1952</option>
                                            <option value="1951"> 1951</option>
                                            <option value="1950"> 1950</option>
                                            <option value="1949"> 1949</option>
                                            <option value="1948"> 1948</option>
                                            <option value="1947"> 1947</option>
                                            <option value="1946"> 1946</option>
                                            <option value="1945"> 1945</option>
                                            <option value="1944"> 1944</option>
                                            <option value="1943"> 1943</option>
                                            <option value="1942"> 1942</option>
                                            <option value="1941"> 1941</option>
                                            <option value="1940"> 1940</option>
                                            <option value="1939"> 1939</option>
                                            <option value="1938"> 1938</option>
                                            <option value="1937"> 1937</option>
                                            <option value="1936"> 1936</option>
                                            <option value="1935"> 1935</option>
                                            <option value="1934"> 1934</option>
                                            <option value="1933"> 1933</option>
                                            <option value="1932"> 1932</option>
                                            <option value="1931"> 1931</option>
                                            <option value="1930"> 1930</option>
                                            <option value="1929"> 1929</option>
                                            <option value="1928"> 1928</option>
                                            <option value="1927"> 1927</option>
                                            <option value="1926"> 1926</option>
                                            <option value="1925"> 1925</option>
                                            <option value="1924"> 1924</option>
                                            <option value="1923"> 1923</option>
                                            <option value="1922"> 1922</option>
                                            <option value="1921"> 1921</option>
                                            <option value="1920"> 1920</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label class="form-label required">Gender *</label>
                                        <div class="radio-group d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" checked name="children_gender_{{$i}}" id="male">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check ms-3">
                                                <input class="form-check-input" type="radio" name="children_gender_{{$i}}" id="female">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <input type="hidden" class="form-control" id="c-mail"  name="children_email_{{$i}}"  >
                                <input type="hidden" class="form-control" id="c-number" name="children_phone_{{$i}}" >
                            </div>
                        </div>
                    @endfor

                    @for($i=1; $i<=$session_data['infants']; $i++)
                        <div class="card mb-4 p-3 shadow-sm border ">
                            <div class="card-header bg-primary text-white">
                                Infant Passenger {{$i}} Details
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="infant_traveller_type_{{$i}}" value="infants"/>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Select Title <span class="text-danger">*</span></label>
                                        <div class="BF-title-box-container">
                                            <!-- Radio buttons for title -->
                                            @foreach(['MR', 'MSTR', 'MRS', 'MISS'] as $title)
                                                <label class="BF-title-box {{ $title === 'MR' ? 'BF-selected' : '' }}">
                                                    <input type="radio" class="BF-title-radio" name="infant_traveller_title_{{$i}}" {{ $title === 'MR' ? 'checked' : '' }}>
                                                    {{ $title }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mt-3">
                                        <label for="firstName" class="form-label required">First Name *</label>
                                        <input type="text" class="form-control" id="firstName"   name="infant_first_name_{{$i}}" placeholder="First Name"  required maxlength="12">
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label for="lastName" class="form-label required">Last Name *</label>
                                        <input type="text" class="form-control" id="lastName" name="infant_last_name_{{$i}}" placeholder="Last Name" required maxlength="12">
                                    </div>
                                    <div class="col-2 mt-3">
                                        <label for="BF-dob" class="form-label required">DOB</label>
                                        <select class="form-select form-select" name="infant_dob_month_{{$i}}">
                                            <option value="1">01 Jan </option>
                                            <option value="2">02 Feb </option>
                                            <option value="3">03 Mar </option>
                                            <option value="4">04 Apr </option>
                                            <option value="5">05 May </option>
                                            <option value="6">06 Jun </option>
                                            <option value="7">07 Jul </option>
                                            <option value="8">08 Aug </option>
                                            <option value="9">09 Sep </option>
                                            <option value="10">10 Oct</option>
                                            <option value="11">11 Nov</option>
                                            <option value="12">12 Dec</option>
                                        </select>
                                    </div>
                                    <div class="col-2 mt-5">
                                        <select name="infant_dob_day_{{$i}}" class="form-select form-select">
                                            <option value="01">01 </option>
                                            <option value="02">02 </option>
                                            <option value="03">03 </option>
                                            <option value="04">04 </option>
                                            <option value="05">05 </option>
                                            <option value="06">06 </option>
                                            <option value="07">07 </option>
                                            <option value="08">08 </option>
                                            <option value="09">09 </option>
                                            <option value="10">10 </option>
                                            <option value="11">11 </option>
                                            <option value="12">12 </option>
                                            <option value="13">13 </option>
                                            <option value="14">14 </option>
                                            <option value="15">15 </option>
                                            <option value="16">16 </option>
                                            <option value="17">17 </option>
                                            <option value="18">18 </option>
                                            <option value="19">19 </option>
                                            <option value="20">20 </option>
                                            <option value="21">21 </option>
                                            <option value="22">22 </option>
                                            <option value="23">23 </option>
                                            <option value="24">24 </option>
                                            <option value="25">25 </option>
                                            <option value="26">26 </option>
                                            <option value="27">27 </option>
                                            <option value="28">28 </option>
                                            <option value="29">29 </option>
                                            <option value="30">30 </option>
                                            <option value="31">31 </option>
                                        </select>
                                    </div>

                                    <div class="col-2 mt-5">
                                        <select class="form-select form-select" name="infant_dob_year_{{$i}}">
                                            <option value="2024" selected="selected"> 2024</option>
                                            <option value="2023"> 2023</option>
                                            <option value="2022"> 2022</option>
                                            <option value="2021"> 2021</option>
                                            <option value="2020"> 2020</option>
                                            <option value="2019"> 2019</option>
                                            <option value="2018"> 2018</option>
                                            <option value="2017"> 2017</option>
                                            <option value="2016"> 2016</option>
                                            <option value="2015"> 2015</option>
                                            <option value="2014"> 2014</option>
                                            <option value="2013"> 2013</option>
                                            <option value="2012"> 2012</option>
                                            <option value="2011"> 2011</option>
                                            <option value="2010"> 2010</option>
                                            <option value="2009"> 2009</option>
                                            <option value="2008"> 2008</option>
                                            <option value="2007"> 2007</option>
                                            <option value="2006"> 2006</option>
                                            <option value="2005"> 2005</option>
                                            <option value="2004"> 2004</option>
                                            <option value="2003"> 2003</option>
                                            <option value="2002"> 2002</option>
                                            <option value="2001"> 2001</option>
                                            <option value="2000"> 2000</option>
                                            <option value="1999"> 1999</option>
                                            <option value="1998"> 1998</option>
                                            <option value="1997"> 1997</option>
                                            <option value="1996"> 1996</option>
                                            <option value="1995"> 1995</option>
                                            <option value="1994"> 1994</option>
                                            <option value="1993"> 1993</option>
                                            <option value="1992"> 1992</option>
                                            <option value="1991"> 1991</option>
                                            <option value="1990"> 1990</option>
                                            <option value="1989"> 1989</option>
                                            <option value="1988"> 1988</option>
                                            <option value="1987"> 1987</option>
                                            <option value="1986"> 1986</option>
                                            <option value="1985"> 1985</option>
                                            <option value="1984" > 1984</option>
                                            <option value="1983"> 1983</option>
                                            <option value="1982"> 1982</option>
                                            <option value="1981"> 1981</option>
                                            <option value="1980"> 1980</option>
                                            <option value="1979"> 1979</option>
                                            <option value="1978"> 1978</option>
                                            <option value="1977"> 1977</option>
                                            <option value="1976"> 1976</option>
                                            <option value="1975"> 1975</option>
                                            <option value="1974"> 1974</option>
                                            <option value="1973"> 1973</option>
                                            <option value="1972"> 1972</option>
                                            <option value="1971"> 1971</option>
                                            <option value="1970"> 1970</option>
                                            <option value="1969"> 1969</option>
                                            <option value="1968"> 1968</option>
                                            <option value="1967"> 1967</option>
                                            <option value="1966"> 1966</option>
                                            <option value="1965"> 1965</option>
                                            <option value="1964"> 1964</option>
                                            <option value="1963"> 1963</option>
                                            <option value="1962"> 1962</option>
                                            <option value="1961"> 1961</option>
                                            <option value="1960"> 1960</option>
                                            <option value="1959"> 1959</option>
                                            <option value="1958"> 1958</option>
                                            <option value="1957"> 1957</option>
                                            <option value="1956"> 1956</option>
                                            <option value="1955"> 1955</option>
                                            <option value="1954"> 1954</option>
                                            <option value="1953"> 1953</option>
                                            <option value="1952"> 1952</option>
                                            <option value="1951"> 1951</option>
                                            <option value="1950"> 1950</option>
                                            <option value="1949"> 1949</option>
                                            <option value="1948"> 1948</option>
                                            <option value="1947"> 1947</option>
                                            <option value="1946"> 1946</option>
                                            <option value="1945"> 1945</option>
                                            <option value="1944"> 1944</option>
                                            <option value="1943"> 1943</option>
                                            <option value="1942"> 1942</option>
                                            <option value="1941"> 1941</option>
                                            <option value="1940"> 1940</option>
                                            <option value="1939"> 1939</option>
                                            <option value="1938"> 1938</option>
                                            <option value="1937"> 1937</option>
                                            <option value="1936"> 1936</option>
                                            <option value="1935"> 1935</option>
                                            <option value="1934"> 1934</option>
                                            <option value="1933"> 1933</option>
                                            <option value="1932"> 1932</option>
                                            <option value="1931"> 1931</option>
                                            <option value="1930"> 1930</option>
                                            <option value="1929"> 1929</option>
                                            <option value="1928"> 1928</option>
                                            <option value="1927"> 1927</option>
                                            <option value="1926"> 1926</option>
                                            <option value="1925"> 1925</option>
                                            <option value="1924"> 1924</option>
                                            <option value="1923"> 1923</option>
                                            <option value="1922"> 1922</option>
                                            <option value="1921"> 1921</option>
                                            <option value="1920"> 1920</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label class="form-label required">Gender *</label>
                                        <div class="radio-group d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" checked name="infant_gender_{{$i}}" id="male">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check ms-3">
                                                <input class="form-check-input" type="radio" name="infant_gender_{{$i}}" id="female">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <input type="hidden" class="form-control" id="c-mail"  name="infant_email_{{$i}}"  >
                                <input type="hidden" class="form-control" id="c-number" name="infant_phone_{{$i}}" >
                            </div>
                        </div>
                    @endfor





                </div>
                    <br>
                    <div class="card p-3 shadow-sm border  mb-4" >
                        <div class="card-header   d-flex justify-content-between align-items-center" >
                            Payment Method
                            <img src="{{ url('public/assets/images/stripe.png') }}" alt="Stripe Logo" width="80">
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="acceptPayment" name="accept_payment" required>
                                <label class="form-check-label" for="acceptPayment">I accept to pay with Stripe and agree to the terms & conditions.</label>
                            </div>
                        </div>
                    </div>

                    <br>

                    <button class="submit-purchase-fm-btn">
                        Secure Payment - {{$routes->segments[0][0]->currency}} {{$routes->segments[0][0]->price}}
                    </button>
            </form>
        </div>

        <!-- right colmun -->
        <div class="col-lg-4 col-12 GT-sub-rg-col">
            <div class="booking-page-right-col-sticky">
                <div class="card MSF-right-column">
                <div class="card-body">
                    <div class="row border-bottom pb-3 pt-3">
                        <div class="col"><small>Fare Breakdown</small></div>
                        <div class="col text-end"><small>Price are shown in {{$routes->segments[0][0]->currency}}</small></div>
                    </div>
                    <div class="row border-bottom pb-3 pt-3">
                        <div class="col">
                            Your booking is protected by
                            <span class="fw-bold text-primary">TravelBookingPanel</span>
                        </div>
                    </div>
                    <div class="row mt-3 border-bottom pb-3">
                        <div class="col-12 fw-bold">Price Details</div>
                        <div class="col-6 mt-3">Adult Price</div>
                        <div class="col-6 mt-3 text-end">{{$routes->segments[0][0]->currency}} {{$routes->segments[0][0]->adult_price}}</div>
                        {{-- Children Price --}}
                        @if(!empty($routes->segments[0][0]->child_price))
                            <div class="col-6 mt-3">Children Price</div>
                            <div class="col-6 mt-3 text-end">
                                {{$routes->segments[0][0]->currency}} {{$routes->segments[0][0]->child_price}}
                            </div>
                        @endif

                        {{-- Infant Price --}}
                        @if(!empty($routes->segments[0][0]->infant_price))
                            <div class="col-6 mt-3">Infant Price</div>
                            <div class="col-6 mt-3 text-end">
                                {{$routes->segments[0][0]->currency}} {{$routes->segments[0][0]->infant_price}}
                            </div>
                        @endif
                        <div class="col-6 mt-3">Discount</div>
                        <div class="col-6 mt-3 text-end text-warning">{{$routes->segments[0][0]->currency}} 0</div>
                        <div class="col-6 mt-3">Service Fee</div>
                        <div class="col-6 mt-3 text-end">{{$routes->segments[0][0]->currency}} 0</div>
                        <div class="col-6 mt-3">Base Fare</div>
                        <div class="col-6 mt-3 text-end">{{$routes->segments[0][0]->currency}} {{$routes->segments[0][0]->price}}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">Total</div>
                        <div class="col-6 text-end text-primary">{{$routes->segments[0][0]->currency}} {{$routes->segments[0][0]->price}}</div>
                    </div>
                </div>
                </div>
            </div>

            <div class="card MSF-right-column mt-3 p-3">
                <div class="row">
                    <div class="col-12">
                        <img src="{{url('public/assets/images/support1.png')}}" width="18px" height="19px" alt="">
                        <small>For any assistance visit <span class="ms-2 text-primary">support
                                center</span></small>
                    </div>
                    <div class="col-12 mt-1">
                        <img src="{{url('public/assets/images/support2.png')}}" width="18px" height="19px" alt="">
                        <small>write to us <span class="ms-2 text-primary">support</span></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    // passenger deatil section in MSF
    // Add click handlers for the title boxes
    document.querySelectorAll('.BF-title-box').forEach(box => {
        box.addEventListener('click', function () {
            // Remove selected class from all boxes
            document.querySelectorAll('.BF-title-box').forEach(b => {
                b.classList.remove('BF-selected');
            });
            // Add selected class to clicked box
            this.classList.add('BF-selected');
            // Trigger the radio button
            this.querySelector('.BF-title-radio').checked = true;
        });
    });

</script>

@endsection
