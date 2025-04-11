<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-medium text-left">Sign up</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{ route('customer.register') }}" method="POST">
                    @csrf
                    <div class="md-form mb-4">
                        <input type="text" name="full_name" id="RegisterForm-name" class="form-control validate"
                            placeholder="Your name" required>
                    </div>
                    <div class="md-form mb-4">
                        <input type="email" name="email" id="RegisterForm-email" class="form-control validate"
                            placeholder="Your email" required>
                    </div>
                    <div class="md-form mb-4">
                        <input type="tel" name="phone" id="RegisterForm-phone" class="form-control validate"
                            placeholder="Your phone number" required>
                    </div>
                    <div class="md-form mb-4">
                        <input type="text" name="address" id="RegisterForm-address" class="form-control validate"
                            placeholder="Your address" required>
                    </div>
                    <div class="md-form mb-4">
                        <input type="password" name="password" id="RegisterForm-password" class="form-control validate"
                            placeholder="Your password" required>
                    </div>
                    <div class="md-form mb-4">
                        <input type="password" name="password_confirmation" id="RegisterForm-password-confirm"
                            class="form-control validate" placeholder="Confirm your password" required>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>