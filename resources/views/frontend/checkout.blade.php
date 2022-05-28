@extends('layouts.frontend')

@section('title')

    checkout

@endsection



@section('content')

    <div class="container ">
        <a href="{{url('/')}}">home</a> /
        <a href="#"> checkout</a>
    </div>

    <div class="container mt-5">
        <form action="{{url('/placeholder')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">first name</label>
                                    <input type="text" required value="{{Auth::user()->name}}" name="firstname" class="form-control firstname" placeholder="enter your first name">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">last name </label>
                                    <input type="text" required value="{{Auth::user()->last_name}}" name="lastname" class="form-control lastname" placeholder="ener your lastname">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">email</label>
                                    <input type="text" required value="{{Auth::user()->email}}" name="email" class="form-control email" placeholder="enter your email">
                                    <span id="email_error"  class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">phone number</label>
                                    <input type="text" required value="{{Auth::user()->phone_number}}" name="phonenumber" class="form-control phoneNumber" placeholder="enter your phon number">
                                    <span id="phone_error"  class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">address 1</label>
                                    <input type="text"required value="{{Auth::user()->address1}}" name="address1" class="form-control address1" placeholder="enter your address 1">
                                    <span id="addess1_error"  class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">address 2</label>
                                    <input type="text" required value="{{Auth::user()->address2}}" name="address2" class="form-control address2" placeholder="enter your address 2">
                                    <span id="address2_error"  class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">city</label>
                                    <input type="text" required value="{{Auth::user()->city}}" name="city" class="form-control city" placeholder="enter your city">
                                    <span id="city_error"  class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">state</label>
                                    <input type="text" required value="{{Auth::user()->state}}" name="state" class="form-control state" placeholder="enter your state">
                                    <span id="state_error"  class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">country</label>
                                    <input type="text" required value="{{Auth::user()->country}}" name="country" class="form-control country" placeholder=" enter your country">
                                    <span id="country_error"  class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">pin cod</label>
                                    <input type="text" required value="{{Auth::user()->pin_code}}" name="pincod" class="form-control pincod" placeholder="enter your pin code">
                                    <span id="pincod_error"  class="text-danger"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Deyails</h6>
                            <hr>
                            <table class="table table-striped table-bordered" >
                                <thead>
                                    <td>Name</td>
                                    <td>quantity</td>
                                    <td>pric</td>
                                </thead>
                                <tbody>
                                    @foreach ($iteamCard as $item)
                                        <tr>
                                            <td>{{$item->product->name}}</td>
                                            <td>{{$item->prod_qty}}</td>
                                            <td>{{$item->product->selling_price}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4></h4>
                            <br>
                            <input type="hidden" name="payment_mode"  value="COD">
                            <button type="submit" class="btn btn-primary float-end w-100">Place Order | COD</button>
                            <br>
                            <button type="button" class="btn btn-success float-end w-100 razorpay_btn">pay with razorapy</button>
                            <div class="card-footer ">
                                <div  id="paypal-button-container"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')


    <!-- paypal -->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    <script>
        paypal.Buttons(
        {
            createOrder: function(data, actions)
            {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                purchase_units: [{
                    amount: {
                    value: '0.01'
                    }
                }]
            });
        },
            onApprove: function(data, actions)
            {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details)
                {

                    var firstname = $('.firstname').val();
                    var lastname = $('.lastname').val();
                    var email = $('.email').val();
                    var phoneNumber = $('.phoneNumber').val();
                    var address1 = $('.address1').val();
                    var address2 = $('.address2').val();
                    var city = $('.city').val();
                    var state = $('.state').val();
                    var country = $('.country').val();
                    var pincod = $('.pincod').val();

                    // This function shows a transaction success message to your buyer.
                    alert('Transaction completed by ' + details.payer.name.given_name);

                    $.ajax({
                                method: "post",
                                url: "placeholder",
                                data:
                                {
                                    'firstname':firstname,
                                    'lastname':lastname,
                                    'email':email,
                                    'phonenumber':phoneNumber,
                                    'address1':address1,
                                    'address2':address2,
                                    'city':city,
                                    'state':state,
                                    'country':country,
                                    'pincod':pincod,
                                    'payment_mode':"pay by paybal",
                                    'payment_id':details.id,
                                },
                                success: function (response) {
                                    swal( response.status)
                                    .then((value) =>
                                    {
                                        window.location.href="/";
                                    });
                                }
                            });

                });
            }
        }).render('#paypal-button-container');
        //This function displays payment buttons on your web page.
    </script>

    <!-- razorpay -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function () {
            $('.razorpay_btn').click(function (e) {
                e.preventDefault();

            var firstname = $('.firstname').val();
            var lastname = $('.lastname').val();
            var email = $('.email').val();
            var phoneNumber = $('.phoneNumber').val();
            var address1 = $('.address1').val();
            var address2 = $('.address2').val();
            var city = $('.city').val();
            var state = $('.state').val();
            var country = $('.country').val();
            var pincod = $('.pincod').val();

            if (!firstname) {
                fname_error = "First Name is required";
                $('#fname_error').html(fname_error);

            } else {

                fname_error = "";
                $('#fname_error').html('');

            }

            if (!lastname) {

                lname_error = "Last Name is required";
                $('#lname_error').html(lname_error);

            } else {

                lname_error = "";
                $('#fname_error').html('');

            }


            if (!email) {

                email_error = "email is required";
                $('#email_error').html(email_error);

            } else {

                email_error = "";
                $('#email_error').html('');

            }


            if (!phoneNumber) {

                phone_error = "phone number is required";
                $('#phone_error').html(phone_error);

            } else {

                phone_error = "";
                $('#phone_error').html('');

            }


            if (!address1) {

                addess1_error = "address 1 is required";
                $('#addess1_error').html(addess1_error);

            } else {

                addess1_error = "";
                $('#addess1_error').html('');

            }


            if (!address2) {

                address2_error = "address 2 is required";
                $('#address2_error').html(address2_error);

            } else {

                address2_error = "";
                $('#address2_error').html('');

            }


            if (!city) {

                city_error = "city is required";
                $('#city_error').html(city_error);

            } else {

                city_error = "";
                $('#city_error').html('');

            }


            if (!state) {

                state_error = "state is required";
                $('#state_error').html(state_error);

            } else {

                state_error = "";
                $('#state_error').html('');

            }

            if (!country) {

                country_error = "country is required";
                $('#country_error').html(country_error);

            } else {

                country_error = "";
                $('#country_error').html('');

            }

            if (!pincod) {

                pincod_error = "zipcod is required";
                $('#pincod_error').html(pincod_error);

            } else {
                pincod_error = "";
                $('#pincod_error').html('');
            }

            if (fname_error !='' || lname_error !='' || email_error !='' || phone_error !='' || addess1_error !='' || address2_error !='' || city_error !='' ||  state_error !='' || country_error !='' || pincod_error  ) {
                return false;
            } else
            {

                var data =
                {

                    'firstname':firstname,
                    'lastname':lastname,
                    'email':email,
                    'phoneNumber':phoneNumber,
                    'address1':address1,
                    'address2':address2,
                    'city':city,
                    'state':state,
                    'country':country,
                    'pincod':pincod,
                }
                $.ajax(
                {
                    method: "post",
                    url: "proceed-to-pay",
                    data: data,
                    success: function (response)
                    {
                        var options =
                        {
                            "key": "rzp_test_ipYNioWUfrGhP4", // Enter the Key ID generated from the Dashboard
                            "amount": response.total_price*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                            "currency": "INR",
                            "name":response.firstname+''+response.lastname ,
                            "description": "thank you for choosing us",
                            "image": "https://example.com/your_logo",
                            //"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                            "handler": function (responsea)
                            {
                                alert(responsea.razorpay_payment_id);
                                $.ajax({
                                    method: "post",
                                    url: "placeholder",
                                    data:
                                    {
                                        'firstname':response.firstname,
                                        'lastname':response.lastname,
                                        'email':response.email,
                                        'phonenumber':response.phoneNumber,
                                        'address1':response.address1,
                                        'address2':response.address2,
                                        'city':response.city,
                                        'state':response.state,
                                        'country':response.country,
                                        'pincod':response.pincod,
                                        'payment_mode':"pay by razorpay",
                                        'payment_id':responsea.razorpay_payment_id,
                                    },
                                    success: function (responseb)
                                    {
                                        swal( responseb.status)
                                        .then((value) =>
                                        {
                                            window.location.href="/";
                                        });
                                    }
                                });
                            },
                            "prefill":
                            {
                                "name": response.firstname+''+response.lastname ,
                                "email": response.email,
                                "contact": response.phoneNumber
                            },
                            "theme":
                            {
                                "color": "#3399cc"
                            }
                        };

                        var rzp1 = new Razorpay(options);
                        rzp1.open();


                    }
                });
            }








            });
        });

    </script>



@endsection
