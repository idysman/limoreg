 </div>
        <!--  END CONTENT AREA  -->
<div class="footer-wrapper">
    <div class="footer-section f-section-1">
        <p class="" style="padding-left: 140px;">Copyright © {{ date('Y') }}. <a target="_blank" href="https://dreamlabs.com.ng">Powered by Dreamlabs Nigeria Limited</a>, All rights reserved.</p>
    </div>
</div>

<div id="modalVerticallyCentered" class="col-lg-12 layout-spacing">
    <!-- Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Verify Vehicle Credentials</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route("vehicles.verify") }}" class="px-4">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="plate-number">Vehicle Plate Number</label>
                            <input type="text" name="plate_number" class="form-control @error('plate_number') is-invalid @enderror" value="{{ old("plate_number") }}" id="plate-number" placeholder="Enter Vehicle's Plate Number" required>
                            @error('plate_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="license-number">Owner's License Number</label>
                            <input type="text" name="license_number" class="form-control @error('license_number') is-invalid @enderror " value="{{ old("license_number") }}" id="license-number" placeholder="Enter Vehicle Owner's License Number" required>
                            
                            @error('license_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>