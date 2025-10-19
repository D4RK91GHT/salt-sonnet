<div class="modal fade" id="referFriendModal" tabindex="-1" aria-labelledby="referFriendModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="referFriendModalLabel">Refer a Friend</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10" style="width: 64px; height: 64px;">
                        <i class="fas fa-gift text-success fs-4"></i>
                    </div>
                    <h2 class="h4 mt-3 mb-2">Give $10, Get $10</h2>
                    <p class="text-muted mb-0">Invite your friends to Bistro and earn $10 in credits when they make their first order.</p>
                </div>

                <div class="alert alert-info d-flex align-items-center mb-4">
                    <i class="fas fa-info-circle me-3"></i>
                    <div>
                        Your friends get $10 off their first order, and you'll get $10 when they spend $15 or more.
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label mb-0">Your referral link</label>
                        <button type="button" 
                                class="btn btn-link p-0 text-decoration-none"
                                x-data="{ copied: false }"
                                @click="
                                    navigator.clipboard.writeText($refs.referralLink.textContent);
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                ">
                            <span x-show="!copied">Copy</span>
                            <span x-show="copied" class="text-success">Copied!</span>
                        </button>
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" 
                               class="form-control" 
                               readonly
                               :value="'{{ url('/') }}?ref=' + '{{ auth()->id() }}'">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                    <p class="text-muted small mb-0" x-ref="referralLink">
                        {{ url('/') }}?ref={{ auth()->id() }}
                    </p>
                </div>

                <div class="mb-4">
                    <label class="form-label">Or share via</label>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="fab fa-facebook-f text-primary me-1"></i> Facebook
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="fab fa-twitter text-info me-1"></i> Twitter
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="fab fa-whatsapp text-success me-1"></i> WhatsApp
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-envelope text-muted me-1"></i> Email
                        </button>
                    </div>
                </div>

                <div class="border-top pt-3">
                    <h6 class="mb-3">Your referrals</h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                    <div>
                                        <div class="fw-medium">john.doe@example.com</div>
                                        <small class="text-muted">Invited 2 days ago</small>
                                    </div>
                                </div>
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    Pending
                                </span>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                    <div>
                                        <div class="fw-medium">sarah.smith@example.com</div>
                                        <small class="text-muted">Earned $10.00</small>
                                    </div>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    Completed
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
