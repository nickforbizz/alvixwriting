@extends('web.layoutsWeb.app')
@section('content')


<div class="jumbotron text-center">
        <h1>WritersBay</h1>
        <p>We specialize in Online writing and Blogging</p>
        <form class="form-inline" id="subsform">
          <div class="input-group">
            <input type="email" class="form-control" size="50" name="email" placeholder="Email Address" required>
            <div class="input-group-btn">
              <input type="submit" class="btn btn-danger" value="Subscribe">
            </div>
          </div>
        </form>
      </div>

      <!-- Container (About Section) -->
      <div id="about" class="container-fluid">
        <div class="row">
          <div class="col-sm-8">

            <h2>About Company  </h2><br>
            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <br><button class="btn btn-default btn-lg">Get in Touch</button>
          </div>
          <div class="col-sm-4">
            <span class="glyphicon glyphicon-signal logo"></span>
          </div>
        </div>
      </div>

      <div class="container-fluid bg-grey">
        <div class="row">
          <div class="col-sm-4">
            <span class="glyphicon glyphicon-globe logo slideanim"></span>
          </div>
          <div class="col-sm-8">
            <h2>Our Values</h2><br>
            <h4><strong>MISSION:</strong> </h4>
            <p>
                 Our mission lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p><br>

            <h4><strong>VISION:</strong> </h4>
                <p>
                    Our vision Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

                </p>
          </div>
        </div>
      </div>

      <!-- Container (Services Section) -->
      <div id="services" class="container-fluid text-center">
        <h2>SERVICES</h2>
        <h4>What we offer</h4>
        <br>
        <div class="row slideanim">
          <div class="col-sm-4">
            <span class="glyphicon glyphicon-off logo-small"></span>
            <h4>POWER</h4>
            <p>Generate additional income thus increasing your purchasing power</p>
          </div>
          <div class="col-sm-4">
            <span class="glyphicon glyphicon-heart logo-small"></span>
            <h4>LOVE</h4>
            <p>Our love extends to all people. Subscribe to our newsletters and receive wise info</p>
          </div>
          <div class="col-sm-4">
            <span class="glyphicon glyphicon-lock logo-small"></span>
            <h4>JOB DONE</h4>
            <p>Our continues to grow to our clients when they complete their Jobs.</p>
          </div>
        </div>
        <br><br>
        <div class="row slideanim">
          <div class="col-sm-4">
            <span class="glyphicon glyphicon-leaf logo-small"></span>
            <h4>GREEN</h4>
            <p>We improve our enviroment by donating to those in need</p>
          </div>
          <div class="col-sm-4">
            <span class="glyphicon glyphicon-certificate logo-small"></span>
            <h4>CERTIFIED</h4>
            <p>Join our team an you'll receive recommendation letters</p>
          </div>
          <div class="col-sm-4">
            <span class="glyphicon glyphicon-wrench logo-small"></span>
            <h4 style="color:#303030;">HARD WORK</h4>
            <p>Hustle of everyday PAYS</p>
          </div>
        </div>
      </div>

      <!-- Container (Portfolio Section) -->
      <div id="portfolio" class="container-fluid text-center bg-grey">
        <h2>Portfolio</h2><br>
        <h4>What we have achieved</h4>
        <div class="row text-center slideanim">
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="paris.jpg" alt="Paris" width="400" height="300">
              <p><strong>Paris</strong></p>
              <p>Yes, we built Paris</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="newyork.jpg" alt="New York" width="400" height="300">
              <p><strong>New York</strong></p>
              <p>We built New York</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="sanfran.jpg" alt="San Francisco" width="400" height="300">
              <p><strong>San Francisco</strong></p>
              <p>Yes, San Fran is ours</p>
            </div>
          </div>
        </div><br>

        <h2>What our customers say</h2>
        <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <h4>"This company is the best. I am so happy with the result!"<br><span>Michael Roe, Vice President, Comment Box</span></h4>
            </div>
            <div class="item">
              <h4>"One word... WOW!!"<br><span>John Doe, Salesman, Rep Inc</span></h4>
            </div>
            <div class="item">
              <h4>"Could I... BE any more happy with this company?"<br><span>Chandler Bing, Actor, FriendsAlot</span></h4>
            </div>
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

      <!-- Container (Pricing Section) -->
      <div id="pricing" class="container-fluid">
        <div class="text-center">
          <h2>Job Types</h2>
          <h4>Choose a job category that works for you</h4>
        </div>
        <div class="row slideanim">
          <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
              <div class="panel-heading">
                <h1>Basic</h1>
              </div>
              <div class="panel-body">
                <p><strong> Availablity</strong> Sometimes </p>
                <p><strong> Revision</strong> None </p>
                <p><strong>Timespan</strong> 2 Days</p>
                <p><strong>2</strong> Sit</p>
                <p><strong>Endless</strong> Amet</p>
              </div>
              <div class="panel-footer">
                <h3>$4</h3>
                <h4>per page</h4>
                <button class="btn btn-lg">Apply</button>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
              <div class="panel-heading">
                <h1>Pro</h1>
              </div>
              <div class="panel-body">
                <p><strong>50</strong> Lorem</p>
                <p><strong>25</strong> Ipsum</p>
                <p><strong>10</strong> Dolor</p>
                <p><strong>5</strong> Sit</p>
                <p><strong>Endless</strong> Amet</p>
              </div>
              <div class="panel-footer">
                <h3>$29</h3>
                <h4>per page</h4>
                <button class="btn btn-lg">Apply</button>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
              <div class="panel-heading">
                <h1>Premium</h1>
              </div>
              <div class="panel-body">
                <p><strong>100</strong> Lorem</p>
                <p><strong>50</strong> Ipsum</p>
                <p><strong>25</strong> Dolor</p>
                <p><strong>10</strong> Sit</p>
                <p><strong>Endless</strong> Amet</p>
              </div>
              <div class="panel-footer">
                <h3>$49</h3>
                <h4>per month</h4>
                <button class="btn btn-lg">Apply</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Container (Contact Section) -->
      <div id="contact" class="container-fluid bg-grey">
        <h2 class="text-center">CONTACT</h2>
        <div class="row">
          <div class="col-sm-5">
            <p>Contact us and we'll get back to you ASAP.</p>
            <p><span class="glyphicon glyphicon-map-marker"></span> Nakuru, KENYA</p>
            <p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p>
            <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
          </div>
          <div class="col-sm-7 slideanim">
            <div class="row">
                <form action="{{ route('Web.anonymousMsg') }}" class="form-group" method="POST">
                    <div class="col-sm-6 form-group">
                      <input class="form-control" id="name" name="title" placeholder="Title" type="text" required>
                    </div>
                    <div class="col-sm-6 form-group">
                      <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                    </div>
                  </div>
                  <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5" required></textarea><br>
                  <div class="row">
                    <div class="col-sm-12 form-group">
                      <button class="btn btn-default pull-right" type="submit">Send</button>
                    </div>
                  </div>
                </form>
          </div>
        </div>
      </div>

            <!-- Add Google Maps -->
        <div id="googleMap" style="height:400px;width:100%;"></div>

@endsection

@section('bottom-scripts')
<script>
        function myMap() {
        var myCenter = new google.maps.LatLng(41.878114, -87.629798);
        var mapProp = {center:myCenter, zoom:12, scrollwheel:false, draggable:false, mapTypeId:google.maps.MapTypeId.ROADMAP};
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var marker = new google.maps.Marker({position:myCenter});
        marker.setMap(map);
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
        <!--
        To use this code on your website, get a free API key from Google.
        Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
        -->
        <script>


          $("#subsform").on('submit', (e)=> {
            e.preventDefault();
            $.ajax({
              url: 'Subscribe',
              method: 'post',
              data:$("#subsform").serializeArray(),
              success: function (data){
                console.log(data);
              },
              error:function(err){
                alert(err);
              }
            });
          })


                $(document).ready(function(){
                  // Add smooth scrolling to all links in navbar + footer link
                  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
                    // Make sure this.hash has a value before overriding default behavior
                    if (this.hash !== "") {
                      // Prevent default anchor click behavior
                      event.preventDefault();

                      // Store hash
                      var hash = this.hash;

                      // Using jQuery's animate() method to add smooth page scroll
                      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                      $('html, body').animate({
                        scrollTop: $(hash).offset().top
                      }, 900, function(){

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                      });
                    } // End if
                  });

                  $(window).scroll(function() {
                    $(".slideanim").each(function(){
                      var pos = $(this).offset().top;

                      var winTop = $(window).scrollTop();
                        if (pos < winTop + 600) {
                          $(this).addClass("slide");
                        }
                    });
                  });
                })
          //this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com
        </script>
@endsection
<!--this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com-->