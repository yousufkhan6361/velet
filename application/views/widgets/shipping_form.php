<style type="text/css">
    /*td,th
    {
        text-align: center !important;
    }
    #manufacturers_sec .form-control {
        width: 80%;
        margin: 0;
        height: 33px;
        margin-top: 0px;
        border-radius: 0;
    }*/
    table#shiptype{
        display:none;
    }
    table#shiptype{
        display:none;
    }
    table#shiptype1{
        /*display:none;*/
    }
    #specialdiv
    {
        display: none;
    }
    .proceed{
        display: none;
    }
</style>

<div class="cart_totals uspsdiv">
    <h3> Shipment</h3>

    <!-- Selection dropdown start -->
    <!--<div>

        <label>Select Shipment</label>

        <select class="selectshipment" onchange="showusp(this)">
            <option value="">--Select Shipment--</option>
            <option value="ups">UPS Shipment</option>
            <option value="fedex">Fedex Shipment</option>
            <option value="usps">USPS Shipment</option>
        </select>

    </div>-->
    <!-- Selection dropdown end -->

    <!-- USP form start -->
    <!--<table class="table table-striped uspsdiv " id="upsshiptype">



            <input type="hidden" name="ounces" value="5">
            <input type="hidden" name="pound" value="5">
             <input type="hidden" name="originZip" value="">
            <input type="hidden" name="grandTotal" id="grandTotal" value="200">


            <tbody>
            <tr>
                <td colspan="2" style="text-align: left;">
                    <label>UPS Shipment</label>
                </td>
            </tr>


            <tr style="height: 30px;">

                <td class="text-left">Country</td>
                <td class="text-right"><strong>

                        <select name="servictype" style="    width: 100%;" class="form-control">
                            <option value="">--Service--</option>
                            <option value="01">UPS Next Day Air</option>
                            <option value="02">UPS Second Day Air</option>
                            <option value="03">UPS Ground</option>
                            <option value="07">UPS Worldwide Express</option>
                            <option value="08">UPS Worldwide Expedited</option>
                            <option value="11">UPS Standard</option>
                            <option value="12">UPS Three-Day Select</option>
                            <option value="14">UPS Next Day Air Early AM</option>
                            <option value="54">UPS Worldwide Express Plus</option>
                            <option value="59">UPS Second Day Air AM</option>
                            <option value="65">UPS Saver</option>
                        </select>

                    </strong></td>

            </tr>

            <tr>
                <td class="text-left">Destination (Zip code)</td>
                <td class="text-right"><strong>

                        <input style="width:310px; " class="input-text form-control" type="text" name="destination">

                    </strong>
                </td>

            </tr>


            <tr>

                <td></td>
                <td class="text-right"><strong>

                        <button class="btn btn-danger" type="button" title="Get a Quote" id="submitShipups">Get a Quote ship
                            <span class="glyphicon glyphicon-play"></span></button>


                    </strong></td>

            </tr>


            </tbody>
    </table>-->
    <!-- USP form end -->

    <div class="clearfix"></div>

    <!-- USPS form start -->
    <!--<table class="table table-striped uspsdiv " id="shiptype">


        <form method="post" id="shipping-zip-form"></form>

        <input type="hidden" name="ounces" value="5">
        <input type="hidden" name="pound" value="5">
        <input type="hidden" name="originZip" value="59759">
        <input type="hidden" name="grandTotal" id="grandTotal" value="200">


        <tbody>
        <tr>
            <td>
                <label>USPS Shipment</label>
            </td>
        </tr>


        <tr style="height: 30px;">

            <td class="text-left">Country</td>
            <td class="text-right"><strong>
                    <select style="width:320px; height: 30px;" name="country" id="country" class="validate-select"
                            title="Country">

                        <option value="1">Afghanistan</option>


                        <option value="2">Albania</option>


                        <option value="3">Algeria</option>


                        <option value="4">Andorra</option>


                        <option value="5">Angola</option>


                        <option value="6">Anguilla</option>


                        <option value="7">Antigua and Barbuda</option>


                        <option value="8">Argentina</option>


                        <option value="9">Armenia</option>


                        <option value="10">Austria</option>


                        <option value="11">Azerbaijan</option>


                        <option value="12">Bahamas</option>


                        <option value="13">Bahrain</option>


                        <option value="14">Bangladesh</option>


                        <option value="15">Barbados</option>


                        <option value="16">Belarus</option>


                        <option value="17">Belgium</option>


                        <option value="19">Belize</option>


                        <option value="20">Bermuda</option>


                        <option value="21">Bhutan</option>


                        <option value="22">Bolivia</option>


                        <option value="23">Bosnia Herzegovina</option>


                        <option value="24">Botswana</option>


                        <option value="25">Brazil</option>


                        <option value="26">Brunei</option>


                        <option value="27">Bulgaria</option>


                        <option value="28">Burkina Faso</option>


                        <option value="29">Burundi</option>


                        <option value="30">Cambodia</option>


                        <option value="31">Cameroon</option>


                        <option value="32">Canada</option>


                        <option value="33">Cape Verde</option>


                        <option value="34">Cayman Islands</option>


                        <option value="35">Central African Republic</option>


                        <option value="36">Chad</option>


                        <option value="37">Chile</option>


                        <option value="38">China</option>


                        <option value="39">Colombia</option>


                        <option value="40">Comoros</option>


                        <option value="41">Congo</option>


                        <option value="42">Congo (DRC)</option>


                        <option value="43">Cook Islands</option>


                        <option value="44">Costa Rica</option>


                        <option value="45">Cote d'Ivoire</option>


                        <option value="46">Croatia</option>


                        <option value="47">Cuba</option>


                        <option value="48">Cyprus</option>


                        <option value="49">Czech Republic</option>


                        <option value="50">Denmark</option>


                        <option value="51">Djibouti</option>


                        <option value="52">Dominica</option>


                        <option value="53">Dominican Republic</option>


                        <option value="54">East Timor</option>


                        <option value="55">Ecuador</option>


                        <option value="56">Egypt</option>


                        <option value="57">El Salvador</option>


                        <option value="58">Equatorial Guinea</option>


                        <option value="59">Eritrea</option>


                        <option value="60">Estonia</option>


                        <option value="61">Ethiopia</option>


                        <option value="62">Falkland Islands</option>


                        <option value="63">Faroe Islands</option>


                        <option value="64">Fiji</option>


                        <option value="65">Finland</option>


                        <option value="66">France</option>


                        <option value="67">French Guiana</option>


                        <option value="68">French Polynesia</option>


                        <option value="69">Gabon</option>


                        <option value="70">Gambia</option>


                        <option value="71">Georgia</option>


                        <option value="72">Germany</option>


                        <option value="73">Ghana</option>


                        <option value="74">Gibraltar</option>


                        <option value="75">Greece</option>


                        <option value="76">Greenland</option>


                        <option value="77">Grenada</option>


                        <option value="78">Guadeloupe</option>


                        <option value="79">Guam</option>


                        <option value="80">Guatemala</option>


                        <option value="81">Guinea</option>


                        <option value="82">Guinea-Bissau</option>


                        <option value="83">Guyana</option>


                        <option value="84">Haiti</option>


                        <option value="85">Honduras</option>


                        <option value="86">Hong Kong</option>


                        <option value="87">Hungary</option>


                        <option value="88">Iceland</option>


                        <option value="89">India</option>


                        <option value="90">Indonesia</option>


                        <option value="91">Iran</option>


                        <option value="92">Iraq</option>


                        <option value="93">Ireland</option>


                        <option value="94">Israel</option>


                        <option value="95">Italy</option>


                        <option value="96">Jamaica</option>


                        <option value="97">Japan</option>


                        <option value="98">Jordan</option>


                        <option value="99">Kazakhstan</option>


                        <option value="100">Kenya</option>


                        <option value="101">Kiribati</option>


                        <option value="102">South Korea</option>


                        <option value="103">Kuwait</option>


                        <option value="104">Kyrgyzstan</option>


                        <option value="105">Laos</option>


                        <option value="106">Latvia</option>


                        <option value="107">Lebanon</option>


                        <option value="108">Lesotho</option>


                        <option value="109">Liberia</option>


                        <option value="110">Libya</option>


                        <option value="111">Liechtenstein</option>


                        <option value="112">Lithuania</option>


                        <option value="113">Luxembourg</option>


                        <option value="114">Macao SAR</option>


                        <option value="115">Macedonia</option>


                        <option value="116">Madagascar</option>


                        <option value="117">Malawi</option>


                        <option value="118">Malaysia</option>


                        <option value="119">Maldives</option>


                        <option value="120">Mali</option>


                        <option value="121">Malta</option>


                        <option value="122">Martinique</option>


                        <option value="123">Mauritania</option>


                        <option value="124">Mauritius</option>


                        <option value="125">Mayotte</option>


                        <option value="126">Mexico</option>


                        <option value="127">Micronesia</option>


                        <option value="128">Moldova</option>


                        <option value="129">Monaco</option>


                        <option value="130">Mongolia</option>


                        <option value="131">Montserrat</option>


                        <option value="132">Morocco</option>


                        <option value="133">Mozambique</option>


                        <option value="134">Myanmar</option>


                        <option value="135">Namibia</option>


                        <option value="136">Nauru</option>


                        <option value="137">Nepal</option>


                        <option value="138">Netherlands</option>


                        <option value="139">Netherlands Antilles</option>


                        <option value="140">New Caledonia</option>


                        <option value="141">New Zealand</option>


                        <option value="142">Nicaragua</option>


                        <option value="143">Niger</option>


                        <option value="144">Nigeria</option>


                        <option value="145">Niue</option>


                        <option value="146">Norfolk Island</option>


                        <option value="147">North Korea</option>


                        <option value="148">Norway</option>


                        <option value="149">Oman</option>


                        <option value="150">Pakistan</option>


                        <option value="151">Panama</option>


                        <option value="152">Papua New Guinea</option>


                        <option value="153">Paraguay</option>


                        <option value="154">Peru</option>


                        <option value="155">Philippines</option>


                        <option value="156">Pitcairn Islands</option>


                        <option value="157">Poland</option>


                        <option value="158">Portugal</option>


                        <option value="159">Puerto Rico</option>


                        <option value="160">Qatar</option>


                        <option value="161">Reunion</option>


                        <option value="162">Romania</option>


                        <option value="163">Russia</option>


                        <option value="164">Rwanda</option>


                        <option value="165">Samoa</option>


                        <option value="166">San Marino</option>


                        <option value="167">Sao Tome and Principe</option>


                        <option value="168">Saudi Arabia</option>


                        <option value="169">Senegal</option>


                        <option value="170">Serbia</option>


                        <option value="171">Seychelles</option>


                        <option value="172">Sierra Leone</option>


                        <option value="173">Singapore</option>


                        <option value="174">Slovakia</option>


                        <option value="175">Slovenia</option>


                        <option value="176">Solomon Islands</option>


                        <option value="177">Somalia</option>


                        <option value="178">South Africa</option>


                        <option value="179">Spain</option>


                        <option value="180">Sri Lanka</option>


                        <option value="181">St. Helena</option>


                        <option value="182">St. Kitts and Nevis</option>


                        <option value="183">St. Lucia</option>


                        <option value="184">St. Pierre and Miquelon</option>


                        <option value="185">St. Vincent</option>


                        <option value="186">Sudan</option>


                        <option value="187">Suriname</option>


                        <option value="188">Swaziland</option>


                        <option value="189">Sweden</option>


                        <option value="190">Switzerland</option>


                        <option value="191">Syria</option>


                        <option value="192">Taiwan</option>


                        <option value="193">Tajikistan</option>


                        <option value="194">Tanzania</option>


                        <option value="195">Thailand</option>


                        <option value="196">Togo</option>


                        <option value="197">Tokelau</option>


                        <option value="198">Tonga</option>


                        <option value="199">Trinidad and Tobago</option>


                        <option value="200">Tunisia</option>


                        <option value="201">Turkey</option>


                        <option value="202">Turkmenistan</option>


                        <option value="203">Turks and Caicos Islands</option>


                        <option value="204">Tuvalu</option>


                        <option value="205">Uganda</option>


                        <option value="206">Ukraine</option>


                        <option value="207">UAE</option>


                        <option value="208">UK</option>


                        <option value="209">Uruguay</option>


                        <option value="211">Uzbekistan</option>


                        <option value="212">Vanuatu</option>


                        <option value="213">Venezuela</option>


                        <option value="214">Vietnam</option>


                        <option value="215">US Virgin Islands</option>


                        <option value="216">British Virgin Islands</option>


                        <option value="217">Wallis and Futuna</option>


                        <option value="218">Yemen</option>


                        <option value="219">Yugoslavia</option>


                        <option value="220">Zambia</option>


                        <option value="221">Zimbabwe</option>


                        <option value="222">Australia</option>


                        <option selected="" value="223">USA</option>


                        <option value="225">Palestine</option>


                        <option value="226">Benin</option>


                        <option value="227">Saint Barthelemy</option>


                        <option value="228">Aland Islands</option>


                        <option value="229">American Samoa</option>


                        <option value="230">Aruba</option>


                        <option value="231">Guernsey</option>


                        <option value="232">Isle of Man</option>


                        <option value="233">Jersey</option>


                        <option value="234">Marshall Islands</option>


                        <option value="235">Montenegro</option>


                        <option value="236">Northern Mariana Islands</option>


                        <option value="237">Palau</option>


                        <option value="238">Western Sahara</option>


                        <option value="239">Saint Martin</option>


                    </select>

                </strong></td>

        </tr>


        <tr>

            <td class="text-left">Destination</td>
            <td class="text-right"><strong>
                    <input style="width:310px; " class="input-text" type="text" name="destination">


                </strong></td>

        </tr>


        <tr id="shiprow" style="display: none;">

            <td class="text-left">Shipment</td>
            <td class="text-right">
                <strong id="shipdata">

                </strong>
            </td>

        </tr>


        <tr>

            <td></td>
            <td class="text-right"><strong>

                    <button class="btn btn-danger" type="button" title="Get a Quote" id="submitShip">Get a Quote ship
                        <span class="glyphicon glyphicon-play"></span></button>


                </strong></td>

        </tr>


        </tbody>
    </table>-->
    <!-- USPS form end -->

    <div class="clearfix"></div>

    <!-- Fedex form start -->
    <table class="table table-striped fedexdiv " id="shiptype1">


        <form method="post" id="shipping-zip-form-fedex">



        <input type="hidden" name="ounces" value="5">
        <input type="hidden" name="pound" value="5">
        <!--<input type="hidden" name="originZip" value="59759">-->
        <input type="hidden" name="grandTotal" id="grandTotal" value="<?php echo $cart_total;?>">

            <tbody>
        <tr>

            <td>
                <label>Fedex Shipment</label>
            </td>

        </tr>


        <tr style="height: 30px;">

            <td class="text-left">Country</td>
            <td class="text-right"><strong>
                    <select style="width:320px; height: 30px;" name="country" id="country" class="validate-select form-control"
                            title="Country">
                        <?/*
                        foreach ($country as $key=>$value):
                            $country =  $value['country'];
                            */?><!--
                            <option value="<?php /*echo $country;*/?>" <?php /*echo ($value['id']=='223') ? 'selected': ''*/?>><?php /*echo $country;*/?></option>
                        --><?php /*endforeach;
                        */?>
                        <option value="223" >USA</option>
                    </select>

                </strong></td>

        </tr>


        <tr>

            <td class="text-left">City</td>
            <td class="text-right">
                <select style="width:320px; height: 30px;" name="states" class="form-control">
                    <option value="3613">Alabama</option>
                    <option value="3614">Alaska</option>
                    <option value="3615">American Samoa</option>
                    <option value="3616">Arizona</option>
                    <option value="3617">Arkansas</option>
                    <option value="3618">Armed Forces Africa</option>
                    <option value="3619">Armed Forces Americas</option>
                    <option value="3620">Armed Forces Canada</option>
                    <option value="3621">Armed Forces Europe</option>
                    <option value="3622">Armed Forces Middle East</option>
                    <option value="3623">Armed Forces Pacific</option>
                    <option value="3624">California</option>
                    <option value="3625">Colorado</option>
                    <option value="3626">Connecticut</option>
                    <option value="3627">Delaware</option>
                    <option value="3628">District of Columbia</option>
                    <option value="3629">Federated States Of Micronesia</option>
                    <option value="3630">Florida</option>
                    <option value="3631">Georgia</option>
                    <option value="3632">Guam</option>
                    <option value="3633">Hawaii</option>
                    <option value="3634">Idaho</option>
                    <option value="3635">Illinois</option>
                    <option value="3636">Indiana</option>
                    <option value="3637">Iowa</option>
                    <option value="3638">Kansas</option>
                    <option value="3639">Kentucky</option>
                    <option value="3640">Louisiana</option>
                    <option value="3641">Maine</option>
                    <option value="3642">Marshall Islands</option>
                    <option value="3643">Maryland</option>
                    <option value="3644">Massachusetts</option>
                    <option value="3645">Michigan</option>
                    <option value="3646">Minnesota</option>
                    <option value="3647">Mississippi</option>
                    <option value="3648">Missouri</option>
                    <option value="3649">Montana</option>
                    <option value="3650">Nebraska</option>
                    <option value="3651">Nevada</option>
                    <option value="3652">New Hampshire</option>
                    <option value="3653">New Jersey</option>
                    <option value="3654">New Mexico</option>
                    <option value="3655">New York</option>
                    <option value="3656">North Carolina</option>
                    <option value="3657">North Dakota</option>
                    <option value="3658">Northern Mariana Islands</option>
                    <option value="3659">Ohio</option>
                    <option value="3660">Oklahoma</option>
                    <option value="3661">Oregon</option>
                    <option value="3662">Palau</option>
                    <option value="3663">Pennsylvania</option>
                    <option value="3664">Puerto Rico</option>
                    <option value="3665">Rhode Island</option>
                    <option value="3666">South Carolina</option>
                    <option value="3667">South Dakota</option>
                    <option value="3668">Tennessee</option>
                    <option value="3669">Texas</option>
                    <option value="3670">Utah</option>
                    <option value="3671">Vermont</option>
                    <option value="3672">Virgin Islands</option>
                    <option value="3673">Virginia</option>
                    <option value="3674">Washington</option>
                    <option value="3675">West Virginia</option>
                    <option value="3676">Wisconsin</option>
                    <option value="3677">Wyoming</option>
                </select>
            </td>

        </tr>


        <tr>

            <td class="text-left">Service Type</td>
            <td class="text-right">
                <select style="width:320px; height: 30px;" name="ServiceType" class="form-control">

                    <option value="INTERNATIONAL_PRIORITY">Internal Priority</option>

                    <option value="STANDARD_OVERNIGHT">Standard Overnight</option>

                    <option value="PRIORITY_OVERNIGHT">Priority Overnight</option>
                    <option value="FEDEX_GROUND">Fedex Ground</option>

                    <option value="INTERNATIONAL_ECONOMY">International Economy</option>

                </select>
            </td>

        </tr>

        <tr>

            <td class="text-left">Postal Code</td>
            <td class="text-right"><strong>
                    <input style="width:310px; " class="input-text form-control" type="text" name="destination">


                </strong></td>

        </tr>


        <tr id="shiprowfedex" style="display: none;">

            <td class="text-left">Shipment</td>
            <td class="text-right">
                <div id="shipdatafedex">

                </div>
            </td>

        </tr>


        <tr>

            <td></td>
            <td class="text-right"><strong>

                    <button class="btn btn-danger" type="button" title="Get a Quote" id="submitfedex">Get a Quote <span
                            class="glyphicon glyphicon-play"></span></button>


                </strong></td>

        </tr>


        </tbody>
        </form>
    </table>
    <!-- Fedex form end -->

    <div class="clearfix"></div>

    <!-- Special shipment form start -->
    <!--<table class="table table-striped  " id="specialdiv">


        <form method="post" id="shipping-zip-form-fedex"></form>

        <input type="hidden" name="ounces" value="5">
        <input type="hidden" name="pound" value="5">
        <input type="hidden" name="originZip" value="59759">
        <input type="hidden" name="grandTotal" id="grandTotal" value="200">

        <tbody>
        <tr>

            <td>
                <label>Special Shipment $150.00</label>
            </td>

        </tr>


        <tr>

            <td></td>
            <td class="text-right"><strong>

                    <button class="btn btn-danger" type="button" title="Get a Quote" id="select_special_shipment">Select
                        Special Shipment <span class="glyphicon glyphicon-play"></span></button>


                </strong></td>

        </tr>


        </tbody>
    </table>-->
    <!-- Special shipment form end -->

</div>

<script>

    $("#submitfedex").click(function () {



        //var data = $("#upsshiptype").find('input, select').serialize();
        var data = $("#shipping-zip-form-fedex").serialize();

        $.ajax({

            type: "POST",

            url: base_url + "checkout/get_fedex",

            data: data,

            dataType: "json",

            success: function (msg) {
                console.log(msg);
                Loader.hide();

                if (msg.status == 1) {
                    $("#checkout-shipping").html(msg.shipmentprice);
                    $("#checkout-total").html(msg.total);
                    // Update price in total field
                    //$("input[name=subtotal]").val(price_with_shipment);
                    AdminToastr.success(msg.txt, 'Success');

                    $('.proceed').show();
                }
                else {
                    AdminToastr.error(msg.txt, 'Error');
                }
            },
            beforeSend: function () {
                Loader.show();
            }
        });

    });

/*
    // function use when we have multiple shipment
    function showusp(e) {


        if ($(e).val() == 'usps') {

            $('#shiptype').fadeIn();

            if ($('#shiptype1').length > 0) {

                $('#shiptype1').fadeOut();

                $('#upsshiptype').fadeOut();

                $('#specialdiv').fadeOut();


            }

        }

        else if ($(e).val() == 'fedex') {

            $('#shiptype1').fadeIn();

            if ($('#shiptype').length > 0) {

                $('#shiptype').fadeOut();

                $('#upsshiptype').fadeOut();

                $('#specialdiv').fadeOut();


            }

        }


        else if ($(e).val() == 'ups') {

            $('#upsshiptype').fadeIn();


            if ($('#shiptype').length > 0) {

                $('#shiptype').fadeOut();

                $('#shiptype1').fadeOut();

                $('#specialdiv').fadeOut();


            }

        }


        else {

            $('#specialdiv').fadeIn();

            $('#shiptype').fadeOut();

            $('#shiptype1').fadeOut();

            $('#upsshiptype').fadeOut();


        }

    }
*/
</script>