<style type="text/css">
.hero-section > .container > .row {
  height: 100vh;
  min-height: 660px;
}  
</style>

<main id="main">
  <div class="hero-section">
    <div class="wave">
      <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
            <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z"
              id="Path"></path>
          </g>
        </g>
      </svg>
    </div>

    <div class="container">
      <div class="row align-items-center">

        <div class="col-12 hero-text-image">
          <?php if (startSession('access')) { ?>
          <div class="row">
            <div class="col-lg-7 text-center text-lg-left">
              <h1 data-aos="fade-right">Welcome Administrator</h1>
              <p class="mb-5" data-aos="fade-right" data-aos-delay="100">Please login to enter your dashboard</p>
            </div>
            <div class="col-lg-5 iphone-wrap">
            	<form id="form-login">
            	  <div class="form-group nd">
            	    <label class="text-white">Email</label>
            	    <input type="text" name="key_email" class="form-control" placeholder="Enter email...">
            	    <div id="error"></div>
            	  </div>
            	  <div class="form-group nd">
            	    <label class="text-white">Password</label>
            	    <input type="password" name="key_pass" class="form-control" placeholder="Password...">
            	    <div id="error"></div>
            	  </div>
            	  <div class="form-group">
            	    <input type="checkbox" id="remember" value="1" class="checkin">
            	    <label for="remember" class="text-white">Remember me?</label>
            	  </div>
            	  <button class="btn btn-primary btn-log">Submit</button>
            	</form>
            </div>
          </div>
          <?php } else { ?>
          <div class="row">
            <div class="col-lg-6 center-block">
              <h1 data-aos="fade-right">Access Code</h1>
              <input id="access" type="password" class="form-control" autofocus>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>

  </div>
</main>