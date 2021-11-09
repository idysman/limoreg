{{-- Verification Modal --}}
<div id="modalVerticallyCentered" class="col-lg-12 layout-spacing">
    <!-- Modal -->
    <div  wire:ignore.self class="modal" id="invoiceModal"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Verify Vehicle Credentials</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="verify_vehicle" class="px-4">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label for="plate-number">Vehicle Chassis Number</label>
                            <input type="text" wire:model.debounce.150ms="chassis_number" class="form-control @error('chassis_number') is-invalid @enderror"  id="chassi-number" placeholder="Vehicle's Chassis Number" required>
                            @error('chassis_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="plate-number">Vehicle Plate Number</label>
                            <input type="text" wire:model.debounce.150ms="plate_number" class="form-control @error('plate_number') is-invalid @enderror"  id="plate-number" placeholder="Vehicle's Plate Number" required>
                            @error('plate_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="phone-number">Owner's Phone Number</label>
                            <input type="text" wire:model.debounce.150ms="phone_number" class="form-control @error('phone_number') is-invalid @enderror "id="license-number" placeholder="Owner's Phone Number" required>
                            
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @if (session('message'))
                            <div class="form-group mb-4">
                                <div class="message text-center mb-2" style="color:rgb(231, 14, 14);">
                                    {{session("message") }}
                                </div>
                                <a href="{{ route("vehicles.register") }}" class="btn btn-primary btn-block">Continue to vehicle registration >></a>
                            </div>
                        @endif
                </div>
                <div class="modal-footer d-flex {{ session('error') ?  'justify-content-between':'flex-end' }}">
                    @if (session('error'))
                        <div class="button">
                            <a href="{{ route('vehicles.register') }}" class="btn btn-primary">Register Vehicle</a>
                        </div>
                    @endif
                    <div class="button">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary">Proceed</button>
                   </div>
                  
                </div>
            </form>
            </div>
        </div>
    </div>
</div>