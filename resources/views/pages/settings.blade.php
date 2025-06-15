{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Settings
@endsection

{{-- Page name --}}
@section('page-name')
    Settings
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-notifications.html"><i class="bx bx-bell me-1"></i>
                            Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-connections.html"><i
                                class="bx bx-link-alt me-1"></i> Connections</a>
                    </li> --}}
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="first_name" name="first_name" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" id="last_name" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="phone" name="phone" class="form-control" />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="country">Country</label>
                                    <select id="country" class="select2 form-select" name="country">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                        <option value="China">China</option>
                                        <option value="France">France</option>
                                        <option value="Germany">Germany</option>
                                        <option value="India" selected>India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Language</label>
                                    <select id="language" name="language" class="select2 form-select">
                                        <option value="">Select Language</option>
                                        <option value="en">English</option>
                                        <option value="fr">French</option>
                                        <option value="de">German</option>
                                        <option value="pt">Portuguese</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="time_zones" class="form-label">Timezone</label>
                                    <select id="time_zones" name="time_zone" class="select2 form-select">
                                        <option value="">Select Timezone</option>
                                        <option value="-12">(GMT-12:00) International Date Line West</option>
                                        <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                        <option value="-10">(GMT-10:00) Hawaii</option>
                                        <option value="-9">(GMT-09:00) Alaska</option>
                                        <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                                        <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                        <option value="-7">(GMT-07:00) Arizona</option>
                                        <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                        <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                                        <option value="-6">(GMT-06:00) Central America</option>
                                        <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                                        <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                        <option value="-6">(GMT-06:00) Saskatchewan</option>
                                        <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                        <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                                        <option value="-5">(GMT-05:00) Indiana (East)</option>
                                        <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                        <option value="-4">(GMT-04:00) Caracas, La Paz</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="currency" class="form-label">Currency</label>
                                    <select id="currency" name="currency" class="select2 form-select">
                                        <option value="">Select Currency</option>
                                        <option value="usd">USD</option>
                                        <option value="euro">Euro</option>
                                        <option value="pound">Pound</option>
                                        <option value="bitcoin">Bitcoin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                {{-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> --}}
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" onsubmit="return false">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
