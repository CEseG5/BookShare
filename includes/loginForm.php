<!-- Modal login -->
<div class="modal fadeInUp probootstrap-animated" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-md vertical-align-center">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
        <div class="probootstrap-modal-flex">
          <div class="probootstrap-modal-figure" style="background-image: url(img/modal_bg.jpg);"></div>
          <div class="probootstrap-modal-content">
            <form action="index.php" method="POST" class="probootstrap-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" name="email">
              </div> 
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password">
              </div> 
              <div class="form-group clearfix mb40">
                <label for="remember" class="probootstrap-remember"><input type="checkbox" id="remember"> Remember Me</label>
                <a href="#" class="probootstrap-forgot">Forgot Password?</a>
              </div>
              <div class="form-group text-left">
                <div class="row">
                  <div class="col-md-6">
                    <input type="submit" name="login" class="btn btn-primary btn-block" value="Sign In">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END modal login -->