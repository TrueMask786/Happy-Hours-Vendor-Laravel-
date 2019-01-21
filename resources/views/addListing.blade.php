<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Prince Jain">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <!-- Favicons -->
   <!-- <link rel="shortcut icon" href="#"> -->
    <!-- Page Title -->
    <title>Happy Hours</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900">
    <!-- Themify Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lt-themify-icons@1.1.0/themify-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Hover Effects -->
    <link rel="stylesheet" href="/css/set1.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="/css/style1.css">

    <!--JavaScripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


   <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        width: 800px;
        height: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
      }
    </style>
    
</head>

<body>

  
  @foreach($errors->all() as $error)
  {
    <span class="help-block">
          <strong>{{ $error}}</strong>
     </span>
  }
  @endforeach
    <!--============================= SUBPAGE HEADER =============================-->
    <section class="subpage-bg">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="titile-block title-block_subpage">
                    <img src="/images/mainLogoBig.png">
                     <div style="margin-top: 50px"><a class="btn" href="/">HOME</a> / ADD LISTING</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// SUBPAGE HEADER-->

    <!--============================= ADD LISTING =============================-->
    <section class="main-block">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="listing-wrap">
                 <form class="form-horizontal" id="form1" role="form" method="POST" action="{{ url('/addListing') }}"" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <!-- General Information -->
                            <div class="listing-title">
                                <span class="ti-files"></span>
                                <h4>General Information</h4>
                                <p>Write Something General Information About Your Listing</p>
                            </div>


                            <div class="row">

                                <div class="col-md-6">
                                  <div class="form-group {{$errors->has('outletName') ? 'has-error': '' }}">
                                        <label>Outlet Name</label>
                                        <input type="text" id="outletName" name="outletName" placeholder="Your Restaurant's name"class="form-control add-listing_form" required>

                                           @if ($errors->has('outletName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('outletName') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('logoImg') ? 'has-error': '' }}">
                                        <label>Logo</label>
                                       <div><input type="file" required id="logoImg" name="logoImg"> </div>
                                           @if ($errors->has('logoImg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logoImg') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                            </div>
                            


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('description') ? 'has-error': '' }} ">
                                        <label>Description</label>
                                        <input type="text" id="description" name="description" placeholder="What is so special about you?" class="form-control add-listing_form" required>
                                           @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('website') ? 'has-error': '' }} ">
                                        <label>Website</label>
                                        <input type="url" id="website" name="website" class="form-control add-listing_form" placeholder="Do you have any website?">
                                           @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>

                            </div>
                            <!--//End General Information -->
                            <!-- Add Location -->
                            <div class="listing-title">
                                <span class="ti-location-pin"></span>
                                <h4>Add Location</h4>
                                <p>Add your's outlet location</p>
                            </div>


                        
                             <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" id="address" name="address" placeholder="Restaurant's full address" required class="form-control add-listing_form" onchange="addresstoCordinates(value)" />
                                    </div>
                                </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('city') ? 'has-error': '' }} ">
                                        <label>City</label>
                                        <input type="text" maxlength="25" id="city" name="city" placeholder="City or Town name" required class="form-control add-listing_form">
                                           @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                            
                                 <div class="col-md-6">
                                    <div class="form-group {{$errors->has('pincode') ? 'has-error': '' }}">
                                        <label>Pincode</label>
                                        <input type="number" id="pincode" name="pincode" placeholder="6-digit pincode" required class="form-control add-listing_form">
                                           @if ($errors->has('pincode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pincode') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                 </div>
                                 <div>
                                     <input type="hidden" id="latitude" name="latitude" value="19.217">
                                     <input type="hidden" id="longitude" name="longitude" value="78.225">
                                 </div> 

                            </div>

                             <div style="text-align: left;" class="col-md-12 alert-info" ><p><b>Note:</b> You can auto fill your address by marking up your outlet's loaction in the map</p></div>
                            <div id="map"></div> 


                                      <script>
                                      var addValue;
                                      var latValue;
                                      var longValue;
                                      var map;
                                      var loc;
                                      var marker;

                                          function initMap() 
                                          {
                                            loc= {lat: 19.217907 , lng: 72.847084 };
                                            map = new google.maps.Map(document.getElementById('map'), {
                                              center: loc,
                                              zoom: 15
                                            });
                                           map.addListener('click', function(event) 
                                           {
                                        
                                               var myLatLng = event.latLng;
                                                var latV = myLatLng.lat();
                                                var lngV = myLatLng.lng();
                                        
                                            cordinatestoAddress(latV,lngV);
                                            });
                                         }

                              
                                        function addMarker(LatLong) 
                                        {
                                            if(marker != null)
                                            {
                                               removeMarker(); 
                                            }
                                        marker = new google.maps.Marker({
                                        position: LatLong,
                                        animation: google.maps.Animation.DROP,
                                        map: map
                                      });

                                        if(!(map.getBounds().contains(marker.getPosition())))
                                        {
                                         map.setZoom(20);
                                         map.setCenter(marker.getPosition());

                                        }
                                    }


                                    function removeMarker()
                                    {
                                      marker.setMap(null);
                                      marker=null;  
                                    }


                                    function addresstoCordinates(addressValue)
                                    {
                                      axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
                                        params: {
                                            address: addressValue,
                                            key: 'AIzaSyB-Dn7DuvPMxzzhPuI90un6-n2LFVMHikY'
                                        }
                                    })
                                    .then(function(response)
                                    {
                                      saveData(response);
                                    })
                                    .catch(function(error)
                                    {
                                        console.log(error);

                                    })  
                                    }

                                     function cordinatestoAddress(Lat,Lng)
                                    {
                                        return axios.get(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${Lat},${Lng}&key=AIzaSyB-Dn7DuvPMxzzhPuI90un6-n2LFVMHikY`)
                                    .then(function(response)
                                    {                                       
                                      saveData(response);
                                      console.log(response);
                                    })
                                    .catch(function(error)
                                    {
                                        console.log(error);

                                    })  
                                    }



                                    function saveData(responseData)
                                    {
                                      addValue=responseData.data.results[0].formatted_address;
                                      latValue=responseData.data.results[0].geometry.location.lat;    
                                      longValue=responseData.data.results[0].geometry.location.lng;
                                      document.getElementById('address').value=addValue;
                                      document.getElementById('latitude').value=latValue;
                                      document.getElementById('longitude').value=longValue;
                                      addMarker(responseData.data.results[0].geometry.location);
                                    }


                                </script>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-Dn7DuvPMxzzhPuI90un6-n2LFVMHikY&callback=initMap"
                                async defer></script> 
                            

                            <!--//End Add Location -->

                            <!-- Full Details -->
                            <div class="listing-title">
                                <span class="ti-files"></span>
                                <h4>Owner's Full Details</h4>
                                <p>Owner's/Manager's full details</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('ownerName') ? 'has-error': '' }}">
                                        <label>Owner Name</label>
                                        <input type="text" id="ownerName" name="ownerName"
                                         required class="form-control add-listing_form">
                                            @if ($errors->has('ownerName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ownerName') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('ownerEmail') ? 'has-error': '' }}">
                                        <label>Email</label>
                                        <input type="email" id="ownerEmail" name="ownerEmail" required class="form-control add-listing_form">
                                           @if ($errors->has('ownerEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ownerEmail') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('ownerPhone') ? 'has-error': '' }}">
                                        <label>Phone</label>
                                        <input type="number" id="ownerPhone" name="ownerPhone" required class="form-control add-listing_form">
                                           @if ($errors->has('ownerPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ownerPhone') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('company') ? 'has-error': '' }}">
                                        <label>Company</label>
                                        <input type="text" id="company" name="company" class="form-control add-listing_form" required>
                                           @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                            </div>

                        
                            <!--//End Full Details -->

                            <!--outlets Full Deails -->
                            <div class="listing-title">
                                <span class="ti-files"></span>
                                <h4>Outlet's Full Details</h4>
                                <p>Details of your outlet brand your customers will be seeing.</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cuisines</label>
                                        <select onchange="selectCuisine(this);" class="form-control add-listing_form" required >
                                            <option value="" selected>Select Cuisines</option>
                                            @foreach ($cuisines as  $cuisine) 
                                                { 
                                                 <option value="{{$cuisine}}">{{$cuisine}}</option>
                                                }
                                            @endforeach                                                  
                                        </select>
                                     </div>
                                 </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Outlet Type</label>
                                        <select id="outletType" name="outletType" class="form-control add-listing_form" required>
                                            <option value="" selected>Select Option</option>
                                            @foreach ($outletTypes as  $outletType) 
                                                { 
                                                 <option value="{{$outletType}}">{{$outletType}}</option>
                                                }
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                             </div>

                             <div class="row">
                                <ul id="cuisinesList">

                                </ul>
                            </div>


                            <script>

                              function selectCuisine(select)
                                {
                                  var option = select.options[select.selectedIndex];
                                  var ul = document.getElementById('cuisinesList');
                                     
                                  var choices = ul.getElementsByTagName('input');
                                  for (var i = 0; i < choices.length; i++)
                                    if (choices[i].value == option.value)
                                      return;
                                     
                                  var li = document.createElement('li');
                                  var input = document.createElement('input');
                                  var text = document.createTextNode(option.firstChild.data);
                                     
                                  input.type = "hidden";
                                  input.name = "cuisinesInputArray[]";
                                  input.value = option.value;

                                  li.appendChild(input);
                                  li.appendChild(text);
                                  li.setAttribute('onclick', 'this.parentNode.removeChild(this);');     
                                    
                                  ul.appendChild(li);
                                }
                            </script>


                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group {{$errors->has('outletEmail') ? 'has-error': '' }}">
                                        <label>Email</label>
                                        <input type="email" id="outletEmail" name="outletEmail" maxlength="40" required class="form-control add-listing_form">
                                           @if ($errors->has('outletEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('outletEmail') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group {{$errors->has('outletPhone') ? 'has-error': '' }}">
                                        <label>Phone</label>
                                        <input type="number" id="outletPhone" name="outletPhone"  required class="form-control add-listing_form">
                                           @if ($errors->has('outletPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('outletPhone') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-file {{$errors->has('bannerImg') ? 'has-error': '' }}">
                                        <div class="add-gallery-text">
                                            <h4>Add Your Banner Image Here</h4>
                                            <i class="ti-gallery"></i>
                                            <span>Drag &amp; Drop To Change Banner</span>
                                        </div>
                                        <input type="file" class="custom-file-input" id="bannerImg" name="bannerImg" required>
                                           @if ($errors->has('bannerImg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bannerImg') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                            </div><br><br>

                            <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                    <label><h6>Food Type</h6></label><br>
                                    <input type="radio" name="foodType" value="Veg" checked>Veg
                                    <input type="radio" name="foodType" value="Non veg">NonVeg
                                    <input type="radio" name="foodType" value="Both">Both
                                    </div>
                                </div>
                           
                                <div class="col-md-4">
                                    <div class="form-group {{$errors->has('menuImg') ? 'has-error': '' }} ">
                                        <label><h6>Add your Menus</h6></label>
                                        <input type="file" id="menuImg" name="menuImg" required> 
                                           @if ($errors->has('menuImg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('menuImg') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                 </div>

                                 <div class="col-md-4">
                                    <div class="form-group {{$errors->has('avgCost') ? 'has-error': '' }} ">
                                        <label><h6>Avg Cost for 2</h6></label>
                                        <input type="number" id="avgCost" name="avgCost" required max="50000" /> 
                                           @if ($errors->has('avgCost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avgCost') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                 </div>
                             </div>



                            <!--End Outlets Full Details-->


                            <!-- Add Gallery -->
                            <div class="listing-title">
                                <span class="ti-gallery"></span>
                                <h4>Add Gallery</h4>
                                  <p>Add few slider images you want to showcase Min: 2 Max: 5</p>
                                  <b>Note: Use Shift button to select multiple files</b>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-file {{$errors->has('galleryImages') ? 'has-error': '' }}">
                                        <div class="add-gallery-text">
                                            <i class="ti-gallery"></i>
                                            <span>Drag &amp; Drop To Change Banner</span> 
                                        </div>
                                        <input type="file" class="custom-file-input" id="galleryImages" multiple min="2" max="5" name="galleryImages" required>
                                           @if ($errors->has('galleryImages'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('galleryImages') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                            </div>
                            <!--//End Add Gallery -->

                            <!-- Amenities -->
                            <div class="listing-title">
                                <span class="ti-gift"></span>
                                <h4>Tags</h4>
                                <p>Tell us something more about your restaurant</p>
                            </div>
                                        
                                          @for($i = 0; $i < count($tags); $i++) 
                                                    @if($i%3 == 0)
                                                         <div class="row">
                                                     @endif       

                                                 <div class="col-md-4 responsive-wrap">
                                                    <div class="md-checkbox">
                                                    <input id="{{$tags[$i]}}" name="tagsInputArray[]" value="{{$tags[$i]}}" type="checkbox">
                                                    <label for="{{$tags[$i]}}">{{$tags[$i]}}</label>
                                                     </div>
                                                </div>

                                                @if($i%3 == 2)
                                                    </div>
                                                @endif        
                                                    
                                            @endfor
                                   
                            <!--//End Amenities -->

                            <!-- Opening Hours -->
                            <div class="listing-title">
                                <span class="ti-time"></span>
                                <h4>Opening Hours</h4>
                                <p>Oppening and Closing Hours</p>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label class="listing-time">Weekdays</label>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control add-listing_form" required id="weekdayOpeningTime" name="weekdayOpeningTime">
                                                <option value="" selected>Opening Time</option>
                                                 @foreach ($timeHours as  $hour) 
                                                    @foreach($timeMinutes as $min)
                                                     <option value="{{$hour}} : {{$min}}">{{$hour}} : {{$min}}</option>
                                                @endforeach
                                                @endforeach
                                          </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control add-listing_form" required id="weekdayClosingTime" name="weekdayClosingTime">
                                             <option value="" selected>Closing Time</option>
                                              @foreach ($timeHours as  $hour) 
                                                    @foreach($timeMinutes as $min)
                                                     <option value="{{$hour}} : {{$min}}">{{$hour}} : {{$min}}</option>
                                                @endforeach
                                                @endforeach
                                         </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-2">
                                    <label class="listing-time">Weekends</label>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control add-listing_form" required id="weekendOpeningTime" name="weekendOpeningTime">
                                              <option value="" selected>Opening Time</option>
                                                 @foreach ($timeHours as  $hour) 
                                                    @foreach($timeMinutes as $min)
                                                     <option value="{{$hour}} : {{$min}}">{{$hour}} : {{$min}}</option>
                                                @endforeach
                                                @endforeach
        
                                          </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control add-listing_form" required id="weekendClosingTime" name="weekendClosingTime">
                                             <option value="" selected>Closing Time</option>
                                                  @foreach ($timeHours as  $hour) 
                                                    @foreach($timeMinutes as $min)
                                                     <option value="{{$hour}} : {{$min}}">{{$hour}} : {{$min}}</option>
                                                @endforeach
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-wrap btn-wrap2">
                                        <button type="submit"  class="btn btn-simple">
                                            SUBMIT
                                         </button>
                                    </div>
                                </div>
                            </div>
                            <!--//End Opening Hours -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//END ADD LISTING -->
    <!--============================= FOOTER =============================-->
    <footer class="main-block gray">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 responsive-wrap">
                    <div class="location">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <p>A/202, Risha Apt, Patel Nagar<br> Bhayandar (west), Mumbai-401101</p>
                    </div>
                </div>
                <div class="col-md-4 responsive-wrap">
                    <div class="footer-logo_wrap">
                        <img src="images/mainLogoBig.png" alt="#" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-4 responsive-wrap">
                    <ul class="social-icons">
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2019 Happy Hours Inc. All rights reserved</p>
                        <a href="#">Privacy</a>
                        <a href="#">Terms</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--//END FOOTER -->
     
                    


</body>

</html>