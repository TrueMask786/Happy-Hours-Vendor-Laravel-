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
    <!--============================= HEADER =============================-->
   
 

    <!--============================= SUBPAGE HEADER BG =============================-->
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
    <!--// SUBPAGE HEADER BG -->
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
                                    <div class="form-group">
                                        <label>Outlet Name</label>
                                        <input type="text" required maxlength="35" id="outletName" name="outletName" placeholder="Your Restaurant's name"class="form-control add-listing_form" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo</label>
                                       <div><input type="file" required id="logoImg" name="logoImg"> </div>
                                    </div>
                                </div>
                            </div>
                            


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" maxlength="100" id="description" name="description" placeholder="What is so special about you?" class="form-control add-listing_form" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="url" maxlength="30" id="website" name="website" class="form-control add-listing_form" placeholder="Do you have any website?">
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
                                        <input type="text" id="address" name="address" placeholder="Restaurant's full address" required maxlength="60"  class="form-control add-listing_form" onchange="addresstoCordinates(value)" />
                                    </div>
                                </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" maxlength="25" id="city" name="city" placeholder="City or Town name" required class="form-control add-listing_form">
                                    </div>
                                </div>
                            
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input type="number" max="999999" id="pincode" name="pincode" placeholder="6-digit pincode" required class="form-control add-listing_form">
                                    </div>
                                 </div>
                                 <div>
                                     <input type="hidden" id="latitude" name="latitude">
                                     <input type="hidden" id="longitude" name="longitude">
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
                                    <div class="form-group">
                                        <label>Owner Name</label>
                                        <input type="text" id="ownerName" name="ownerName" maxlength="30"
                                         required class="form-control add-listing_form">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="ownerEmail" name="ownerEmail" required maxlength="40" class="form-control add-listing_form">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="number" id="ownerPhone" name="ownerPhone" required class="form-control add-listing_form" max="9999999999" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company</label>
                                        <input type="text" id="company" name="company" maxlength="30" class="form-control add-listing_form">
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
                                        <label>Outlet Type</label>
                                        <select id="outletType" name="outletType" class="form-control add-listing_form" required>
                                            <option selected>{{$outletTypes[0]}}</option>
                                            <option>{{$outletTypes[1]}}</option>
                                            <option>{{$outletTypes[2]}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cuisine</label>
                                        <input type="text" id="cuisine" name="cuisine" maxlength="100" class="form-control add-listing_form" placeholder="eg: Italian, South-Indian, North-Indian" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="outletEmail" name="outletEmail" maxlength="40" required class="form-control add-listing_form">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="number" max="10" id="outletPhone" name="outletPhone"  required class="form-control add-listing_form" max="9999999999">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-file">
                                        <div class="add-gallery-text">
                                            <h4>Add Your Banner Image Here</h4>
                                            <i class="ti-gallery"></i>
                                            <span>Drag &amp; Drop To Change Banner</span>
                                        </div>
                                        <input type="file" class="custom-file-input" id="bannerImg" name="bannerImg" required>
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
                                    <div class="form-group">
                                        <label><h6>Add your Menus</h6></label>
                                        <input type="file" id="menuImg" name="menuImg" required> 
                                    </div>
                                 </div>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label><h6>Avg Cost for 2</h6></label>
                                        <input type="number" id="avgCost" name="avgCost" required max="50000" /> 
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
                                    <div class="custom-file">
                                        <div class="add-gallery-text">
                                            <i class="ti-gallery"></i>
                                            <span>Drag &amp; Drop To Change Banner</span> 
                                        </div>
                                        <input type="file" class="custom-file-input" id="galleryImages" multiple name="galleryImages" required>
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
                            <div class="row">
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i1" type="checkbox">
                                        <label for="i1">Air Conditioned/label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i2" type="checkbox">
                                        <label for="i2">Private Dinning Area Available</label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i3" type="checkbox">
                                        <label for="i3">Wifi</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i4" type="checkbox">
                                        <label for="i4">Serves Jain Food</label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i5" type="checkbox">
                                        <label for="i5">Brunch</label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i6" type="checkbox">
                                        <label for="i6">Desserts and Bakes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i7" type="checkbox">
                                        <label for="i7">Sports TV</label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i8" type="checkbox">
                                        <label for="i8">Street parking</label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i9" type="checkbox">
                                        <label for="i9">Rooftop</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i11" type="checkbox">
                                        <label for="i11"> Wine</label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i12" type="checkbox">
                                        <label for="i12"> Beer  </label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i13" type="checkbox">
                                        <label for="i13">Birthday Special</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i14" type="checkbox">
                                        <label for="i14">Party Room</label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i15" type="checkbox">
                                        <label for="i15">Accepts E-Wallet</label>
                                    </div>
                                </div>
                                <div class="col-md-4 responsive-wrap">
                                    <div class="md-checkbox">
                                        <input id="i16" type="checkbox">
                                        <label for="i16">Daily Happy Hours</label>
                                    </div>
                                </div>
                            </div>
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
                                        <select class="form-control">
        <option selected>Opening Time</option>
        <option>1 :00 AM</option>
        <option>2 :00 AM</option>
        <option>3 :00 AM</option>
        <option>4 :00 AM</option>
        <option>5 :00 AM</option>
        <option>6 :00 AM</option>
        <option>7 :00 AM</option>
        <option>8 :00 AM</option>
        <option>9 :00 AM</option>
        <option>10 :00 AM</option>
        <option>11 :00 AM</option>
        <option>12 :00 AM</option>
        <option>1 :00 PM</option>
      </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control">
         <option selected>Closing Time</option>
        <option>1 :00 AM</option>
        <option>2 :00 AM</option>
        <option>3 :00 AM</option>
        <option>4 :00 AM</option>
        <option>5 :00 AM</option>
        <option>6 :00 AM</option>
        <option>7 :00 AM</option>
        <option>8 :00 AM</option>
        <option>9 :00 AM</option>
        <option>10 :00 AM</option>
        <option>11 :00 AM</option>
        <option>12 :00 AM</option>
        <option>1 :00 PM</option>
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
                                        <select class="form-control">
        <option selected>Opening Time</option>
        <option>1 :00 AM</option>
        <option>2 :00 AM</option>
        <option>3 :00 AM</option>
        <option>4 :00 AM</option>
        <option>5 :00 AM</option>
        <option>6 :00 AM</option>
        <option>7 :00 AM</option>
        <option>8 :00 AM</option>
        <option>9 :00 AM</option>
        <option>10 :00 AM</option>
        <option>11 :00 AM</option>
        <option>12 :00 AM</option>
        <option>1 :00 PM</option>
      </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control">
         <option selected>Closing Time</option>
        <option>1 :00 AM</option>
        <option>2 :00 AM</option>
        <option>3 :00 AM</option>
        <option>4 :00 AM</option>
        <option>5 :00 AM</option>
        <option>6 :00 AM</option>
        <option>7 :00 AM</option>
        <option>8 :00 AM</option>
        <option>9 :00 AM</option>
        <option>10 :00 AM</option>
        <option>11 :00 AM</option>
        <option>12 :00 AM</option>
        <option>1 :00 PM</option>
      </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-wrap btn-wrap2">
                                        <a href="#" class="btn btn-simple">SUBMIT LISTING</a>
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
                        <p>503 Sylvan Ave, Mountain View<br> CA 94041, United States</p>
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