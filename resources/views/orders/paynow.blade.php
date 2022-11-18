@extends('layouts.sales')

@section('content')
    <div class="nk-content " style="width: 80%;margin: auto;">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview mx-auto">
                        <div class="nk-block-head nk-block-head-lg" style="text-align: center;">
                            <div class="nk-block-head-content">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <img src="{{ asset($order->brand->picture) }}" alt="{{ $order->brand->name }}" width="250px" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->

                        <!-- main alert @s -->
                        @include('partials.alerts')
                        <!-- main alert @e -->
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    {!! Form::model($order, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
                                    @method($section->method)
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h4>Amount: {{ $order->currency }} {{ $order->amount }}</h4> <label class="form-label" for="fv-full-name"></label>
                                                    <input type="hidden" name="amount" value="{{ $order->amount }}">
                                                    <input type="hidden" name="currency" value="{{ $order->currency }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Description</label>
                                                    <div class="form-control-wrap ">
                                                        {{ $order->description }}
                                                        <input type="hidden" name="description" value="{{ $order->description }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="background: #364a63;">
                                                <div class="form-group">
                                                    <h5 style="color: #fff;">BILLING DETAILS</h5>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">First Name:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter firstname', 'required' => 'required']) !!}
                                                        {!! Form::hidden('order_id', $order->id, ['class' => 'form-control', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Last Name:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter lastname', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Address:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter address', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">City:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Enter city', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Country</label>
                                                    <div class="form-control-wrap ">
                                                       {{--  {!! Form::select('country', array('USD' => 'USD', 'AUD' => 'AUD', 'GBP' => 'GBP'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a currency', 'required' => 'required']); !!} --}}

                                          <select name="country" id="country" class="select2 form-control form-select" required="" >
                                <option value="" hidden="" selected="">Please Select</option>
                                <option value="United States">United States</option>
                                <option value="Canada">Canada</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Australia">Australia</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda
                                </option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina
                                </option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei Darussalam">Brunei Darussalam
                                </option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African
                                    Republic
                                </option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island
                                </option>
                                <option value="Cocos">Cocos (Keeling)
                                    Islands
                                </option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, The Democratic
                                    Republic of the">Congo, The Democratic
                                    Republic of the
                                </option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote D`Ivoire">Cote D`Ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic
                                </option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea
                                </option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas) </option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia
                                </option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran (Islamic Republic
                                    Of)">Iran (Islamic Republic
                                    Of)
                                </option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea North">Korea North</option>
                                <option value="Korea South">Korea South</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedonia">Macedonia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands
                                </option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles
                                </option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestine Autonomous">Palestine Autonomous
                                </option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea
">Papua New Guinea
                                </option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation
                                </option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Vincent and the
                                    Grenadines">Saint Vincent and the
                                    Grenadines
                                </option>
                                <option value="Saipan">Saipan</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapor">Singapore</option>
                                <option value="Slovak Republic">Slovak Republic</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="St. Kitts/Nevis">St. Kitts/Nevis</option>
                                <option value="St. Lucia">St. Lucia</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago
                                </option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos
                                    Islands">Turks and Caicos
                                    Islands
                                </option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates
                                </option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands
                                    (British)">Virgin Islands
                                    (British)
                                </option>
                                <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)
                                </option>
                                <option value="Wallis and Futuna
                                    Islands">Wallis and Futuna
                                    Islands
                                </option>
                                <option value="Yemen">Yemen</option>
                                <option value="Yugoslavia">Yugoslavia</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                                           
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">State / Province</label>
                                                    <div class="form-control-wrap ">
                                                       {{--  {!! Form::select('state', array('USD' => 'USD', 'AUD' => 'AUD', 'GBP' => 'GBP'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a currency', 'required' => 'required']); !!} --}}
                                       <select name="state" id="state" class="select2 form-control form-select" required="">
                                           <option value="" hidden="" selected="">Please Select</option>
                                           <optgroup label="Australian Provinces">
                                              <option value="New South Wales">New South
                                                 Wales
                                              </option>
                                              <option value="Queensland">
                                                 Queensland
                                              </option>
                                              <option value="South Australia">South
                                                 Australia
                                              </option>
                                              <option value="Tasmania">Tasmania</option>
                                              <option value="Victoria">Victoria</option>
                                              <option value="Western Australia">Western
                                                 Australia
                                              </option>
                                              <option value="Australian Capital Territory">Australian
                                                 Capital Territory
                                              </option>
                                              <option value="Northern Territory">Northern
                                                 Territory
                                              </option>
                                           </optgroup>
                                           <optgroup label="Canadian Provinces">
                                              <option value="Alberta">Alberta</option>
                                              <option value="British Columbia">British Columbia</option>
                                              <option value="Manitoba">Manitoba</option>
                                              <option value="New Brunswick">New Brunswick</option>
                                              <option value="Newfoundland">Newfoundland</option>
                                              <option value="Northwest Territories">Northwest
                                                 Territories
                                              </option>
                                              <option value="Nova Scotia">Nova Scotia</option>
                                              <option value="Nunavut">Nunavut</option>
                                              <option value="Ontario">Ontario</option>
                                              <option value="Prince Edward
                                                 Island">Prince Edward
                                                 Island
                                              </option>
                                              <option value="Quebec">Quebec</option>
                                              <option value="Saskatchewan">Saskatchewan</option>
                                              <option value="Yukon">Yukon</option>
                                           </optgroup>
                                           <optgroup label="US States">
                                              <option value="Alabama">Alabama</option>
                                              <option value="Alaska">Alaska</option>
                                              <option value="Arizona">Arizona</option>
                                              <option value="Arkansas">Arkansas</option>
                                              <option value="British Virgin Islands">British Virgin
                                                 Islands
                                              </option>
                                              <option value="California">California</option>
                                              <option value="Colorado">Colorado</option>
                                              <option value="Connecticut">Connecticut</option>
                                              <option value="Delaware">Delaware</option>
                                              <option value="Florida">Florida</option>
                                              <option value="Georgia">Georgia</option>
                                              <option value="Guam">Guam</option>
                                              <option value="Hawaii">Hawaii</option>
                                              <option value="Idaho">Idaho</option>
                                              <option value="Illinois">Illinois</option>
                                              <option value="Indiana">Indiana</option>
                                              <option value="Iowa">Iowa</option>
                                              <option value="Kansas">Kansas</option>
                                              <option value="Kentucky">Kentucky</option>
                                              <option value="Louisiana">Louisiana</option>
                                              <option value="Maine">Maine</option>
                                              <option value="Mariana Islands">Mariana Islands</option>
                                              <option value="Mariana Islands (Pacific)">Mariana Islands
                                                 (Pacific)
                                              </option>
                                              <option value="Maryland">Maryland</option>
                                              <option value="Massachusetts">Massachusetts</option>
                                              <option value="Michigan">Michigan</option>
                                              <option value="Minnesota">Minnesota</option>
                                              <option value="Mississippi">Mississippi</option>
                                              <option value="Missouri">Missouri</option>
                                              <option value="Montana">Montana</option>
                                              <option value="Nebraska">Nebraska</option>
                                              <option value="Nevada">Nevada</option>
                                              <option value="New Hampshire">New Hampshire</option>
                                              <option value="New Jersey">New Jersey</option>
                                              <option value="New Mexico">New Mexico</option>
                                              <option value="New York">New York</option>
                                              <option value="North Carolina">North Carolina</option>
                                              <option value="North Dakota">North Dakota</option>
                                              <option value="Ohio">Ohio</option>
                                              <option value="Oklahoma">Oklahoma</option>
                                              <option value="Oregon">Oregon</option>
                                              <option value="Pennsylvania">Pennsylvania</option>
                                              <option value="Puerto Rico">Puerto Rico</option>
                                              <option value="Rhode Island">Rhode Island</option>
                                              <option value="South Carolina">South Carolina</option>
                                              <option value="South Dakota">South Dakota</option>
                                              <option value="Tennessee">Tennessee</option>
                                              <option value="Texas">Texas</option>
                                              <option value="Utah">Utah</option>
                                              <option value="Vermont">Vermont</option>
                                              <option value="VI U.S. Virgin Islands">VI U.S. Virgin
                                                 Islands
                                              </option>
                                              <option value="Virginia">Virginia</option>
                                              <option value="Washington">Washington</option>
                                              <option value="Washington, D.C.">Washington, D.C.</option>
                                              <option value="West Virginia">West Virginia</option>
                                              <option value="Wisconsin">Wisconsin</option>
                                              <option value="Wyoming">Wyoming</option>
                                           </optgroup>
                                           <!-- FOR STRIPE UK -->
                                           <optgroup label="England">
                                              <option value="Bedfordshire">Bedfordshire</option>
                                              <option value="Berkshire">Berkshire</option>
                                              <option value="Bristol">Bristol</option>
                                              <option value="Buckinghamshire">Buckinghamshire</option>
                                              <option value="Cambridgeshire">Cambridgeshire</option>
                                              <option value="Cheshire">Cheshire</option>
                                              <option value="City of London">City of London</option>
                                              <option value="Cornwall">Cornwall</option>
                                              <option value="Cumbria">Cumbria</option>
                                              <option value="Derbyshire">Derbyshire</option>
                                              <option value="Devon">Devon</option>
                                              <option value="Dorset">Dorset</option>
                                              <option value="Durham">Durham</option>
                                              <option value="East Riding of Yorkshire">East Riding
                                                 of Yorkshire
                                              </option>
                                              <option value="East Sussex">East Sussex</option>
                                              <option value="Essex">Essex</option>
                                              <option value="Gloucestershire">Gloucestershire</option>
                                              <option value="Greater London">Greater London</option>
                                              <option value="Greater Manchester">Greater
                                                 Manchester
                                              </option>
                                              <option value="Hampshire">Hampshire</option>
                                              <option value="Herefordshire">Herefordshire</option>
                                              <option value="Hertfordshire"> Hertfordshire</option>
                                              <option value="Isle of Wight">Isle of Wight</option>
                                              <option value="Kent">Kent</option>
                                              <option value="Lancashire">Lancashire</option>
                                              <option value="Leicestershire">Leicestershire</option>
                                              <option value="Lincolnshire">Lincolnshire</option>
                                              <option value="Merseyside">Merseyside</option>
                                              <option value="Norfolk">Norfolk</option>
                                              <option value="North Yorkshire">North Yorkshire</option>
                                              <option value="Northamptonshire">Northamptonshire</option>
                                              <option value="Northumberland">Northumberland</option>
                                              <option value="Nottinghamshire">Nottinghamshire</option>
                                              <option value="Oxfordshire">Oxfordshire</option>
                                              <option value="Rutland">Rutland</option>
                                              <option value="Shropshire"> Shropshire</option>
                                              <option value="Somerset">Somerset</option>
                                              <option value="South Yorkshire">South Yorkshire</option>
                                              <option value="Staffordshire">Staffordshire</option>
                                              <option value="Suffolk">Suffolk</option>
                                              <option value="Surrey">Surrey</option>
                                              <option value="Tyne and Wear">Tyne and Wear</option>
                                              <option value="Warwickshire">Warwickshire</option>
                                              <option value="West Midlands">West Midlands</option>
                                              <option value="West Sussex">West Sussex</option>
                                              <option value="West Yorkshire">West Yorkshire</option>
                                              <option  value="Wiltshire">Wiltshire</option>
                                              <option value="Worcestershire">Worcestershire</option>
                                           </optgroup>
                                           <optgroup label="Scotland">
                                              <option value="Aberdeenshire">Aberdeenshire</option>
                                              <option value=" Angus">Angus</option>
                                              <option value="Argyllshire">Argyllshire</option>
                                              <option value="Ayrshire">Ayrshire</option>
                                              <option value="Banffshire">Banffshire</option>
                                              <option value="Berwickshire">Berwickshire</option>
                                              <option value="Buteshire">Buteshire</option>
                                              <option value="Cromartyshire">Cromartyshire</option>
                                              <option value="Caithness">Caithness</option>
                                              <option value="Clackmannanshire">Clackmannanshire</option>
                                              <option value="Dumfriesshire">Dumfriesshire</option>
                                              <option value="Dunbartonshire">Dunbartonshire</option>
                                              <option value="East Lothian">East Lothian</option>
                                              <option value="Fife">Fife</option>
                                              <option value="Inverness-shire">Inverness-shire</option>
                                              <option value="Kincardineshire">Kincardineshire</option>
                                              <option value="Kinross">Kinross</option>
                                              <option value="Kirkcudbrightshire">
                                                 Kirkcudbrightshire
                                              </option>
                                              <option value="Lanarkshire">Lanarkshire</option>
                                              <option value="Midlothian">Midlothian</option>
                                              <option value="Morayshire">Morayshire</option>
                                              <option value="Nairnshire">Nairnshire</option>
                                              <option value="Orkney">Orkney</option>
                                              <option value="Peeblesshire">Peeblesshire</option>
                                              <option value="Perthshire">Perthshire</option>
                                              <option value="Renfrewshire">Renfrewshire</option>
                                              <option value="Ross-shire">Ross-shire</option>
                                              <option value="Roxburghshire">Roxburghshire</option>
                                              <option value="Selkirkshire">Selkirkshire</option>
                                              <option value="Shetland">Shetland</option>
                                              <option value="Stirlingshire">Stirlingshire</option>
                                              <option value="Sutherland">Sutherland</option>
                                              <option value="West Lothian">West Lothian</option>
                                              <option value="Wigtownshire">Wigtownshire</option>
                                           </optgroup>
                                           <optgroup label="Wales">
                                              <option value="Anglesey">Anglesey</option>
                                              <option value="Brecknockshire">Brecknockshire</option>
                                              <option value=" Carmarthenshire">Cardiganshire</option>
                                              <option value="Denbighshire">Denbighshire</option>
                                              <option value="Flintshire">Flintshire</option>
                                              <option value="Glamorgan">Glamorgan</option>
                                              <option value="Merioneth">Merioneth</option>
                                              <option value="Monmouthshire">Monmouthshire</option>
                                              <option value="Montgomeryshire">Montgomeryshire</option>
                                              <option value="Pembrokeshire">Pembrokeshire</option>
                                              <option value="Radnorshire">Radnorshire</option>
                                           </optgroup>
                                           <optgroup label="Northern Ireland">
                                              <option value="Antrim">Antrim</option>
                                              <option value="Armagh">Armagh</option>
                                              <option value="Down">Down</option>
                                              <option value="Fermanagh">Fermanagh</option>
                                              <option value="Londonderry">Londonderry</option>
                                              <option value="Tyrone">Tyrone</option>
                                           </optgroup>
                                           <!-- FOR STRIPE UK END-->
                                           <option value="Other">Other</option>
                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">ZIP/Postal Code:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('zip_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Zip code']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Email</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::email('customer_email', null, ['class' => 'form-control', 'placeholder' => 'Enter email', 'required' => 'required', 'readonly']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Bank Name:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('bank_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Bank Name']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Phone</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'required' => 'required', 'onkeypress' => 'return isNumber(event)']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="payment-radio-sec">
                                                    <label  class="form-label" for="fv-full-name"> Card Type</label>
                                                    <div class="payment-radio-btn">
                                                        <div class="row">
                                                            <div class="col-sm-6 col-md-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" id="card_type_debit" name="card_type" required="required" value="debit" {{ ($order->card_type == 'debit') ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="card_type_debit">
                                                                        Debit
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" id="card_type_credit" name="card_type" value="credit" {{ ($order->card_type == 'credit') ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="card_type_credit">
                                                                        Credit
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="background: #364a63;">
                                                <div class="form-group">
                                                    <h5 style="color: #fff;">CREDIT CARD INFORMATION</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="payment-radio-sec">
                                                    <label  class="form-label" for="fv-full-name"> I Have:</label>
                                                    <div class="payment-radio-btn">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" id="transection_type_visa" name="transection_type" value="visa" {{ ($order->transection_type == 'visa') ? 'checked' : '' }} required="required">
                                                                    <label class="form-check-label" for="transection_type_visa">
                                                                        <img src="{{ asset('assets_front/images/visa_card.jpg') }}" alt="Visa" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" id="transection_type_master" name="transection_type" value="master" {{ ($order->transection_type == 'master') ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="transection_type_master">
                                                                        <img src="{{ asset('assets_front/images/master_card.jpg') }}" alt="master" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" id="transection_type_discover" name="transection_type" value="discover" {{ ($order->transection_type == 'discover') ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="transection_type_discover">
                                                                        <img src="{{ asset('assets_front/images/discover_card.jpg') }}" alt="Discover" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" id="transection_type_american_express" name="transection_type" value="american_express" {{ ($order->transection_type == 'american_express') ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="transection_type_american_express">
                                                                        <img src="{{ asset('assets_front/images/ae_card.jpg') }}" alt="American Express" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Card Number</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('card_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Card Number', 'required' => 'required', 'onkeypress' => 'return isNumber(event)']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Name on Card:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('card_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Card Name', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Expiration Month:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('expiration_month', array('1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06', '7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11', '12' => '12'), null, ['class' => 'form-control form-select select2', 'required' => 'required']); !!}
                                                    </div>
                                                </div>
                                            </div>
                                             @php
                                                $years = [];
                                                for ($x = date('Y'); $x <= date('Y') + 15; $x++) {
                                                    $years[$x] =  "$x";
                                                }
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Expiration Year:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('expiration_year', $years, null, ['class' => 'form-control form-select select2', 'required' => 'required']); !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Card CVV:</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('card_cvv', null, ['class' => 'form-control', 'placeholder' => 'Enter Card CVV', 'required' => 'required', 'onkeypress' => 'return isNumber(event)', 'minlength' => 3, 'maxlength' => 4]) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                   @php
                                                     $btn = $order->payment_status != 0 ? 'You have already paid' : 'Pay Now!';
                                                     $disabled = $order->payment_status != 0 ? 'disabled' : '';
                                                   @endphp
                                                    {!! Form::button('<i class="fa fa-check-square-o"></i>' .$btn, ['type' => 'submit', 'class' => 'btn btn-primary', $disabled ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div><!-- .nk-block -->
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
   $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Choose Option",
            // allowClear: true
        });
    });
</script>

@endsection
