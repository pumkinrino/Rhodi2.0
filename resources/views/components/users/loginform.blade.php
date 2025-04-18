<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-medium text-left">Sign in</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{ route('customer.login') }}" method="POST">
                    @csrf <!-- Thêm token CSRF để bảo vệ form -->
                    <div class="md-form mb-4">
                        <input type="text" name="email" id="LoginForm-email" class="form-control validate"
                            placeholder="Your email" required>
                    </div>
                    <div class="md-form mb-4">
                        <input type="password" name="password" id="LoginForm-pass" class="form-control validate"
                            placeholder="Your password" required>
                    </div>
                    <div class="checkbox-link d-flex justify-content-between">
                        <div class="left-col">
                            <input type="checkbox" id="remember_me"><label for="remember_me">Remember Me</label>
                        </div>
                        <div class="right-col"><a href="#">Forget Password?</a></div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>