@extends('layouts.dashboard')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview mx-auto">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active">{{ $section->title }}</li>
                                    </ul>
                                </nav>
                            </div>
                        </div><!-- .nk-block-head -->

                        <!-- main alert @s -->
                        @include('partials.alerts')
                        <!-- main alert @e -->
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    {!! Form::model($setting, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
                                    @method($section->method)
                                        <div class="row g-gs">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Client Name</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::text('client_name', null, ['class' => 'form-control', 'placeholder' => 'Enter System Name', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Contact Number</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('contact_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Contact Number', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="default-06">Logo Header (105x65)(png)</label>
                                                <div class="form-control-wrap">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image" name="logo_header_image">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="background: #ccc;">
                                                @if($setting->logo_header)
                                                    <img class="email-logo" src="{{ asset($setting->logo_header) }}" alt="logo" style="max-width: 150px;">
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="default-06">Header Banner</label>
                                                <div class="form-control-wrap">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image" name="logo_footer_image">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="background: #ccc;">
                                                @if($setting->logo_footer)
                                                    <img class="email-logo" src="{{ asset($setting->logo_footer) }}" alt="logo" style="max-width: 150px;">
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="default-06">Fav Icon (32x32)(png)</label>
                                                <div class="form-control-wrap">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image" name="fav_icon_image">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="background: #ccc;">
                                                @if($setting->fav_icon)
                                                    <img class="email-logo" src="{{ asset($setting->fav_icon) }}" alt="logo" style="max-width: 150px;">
                                                @endif
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Header Content</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::textarea('header_content', null, ['class' => 'form-control  tinymce-basic', 'placeholder' => 'Enter Header Content', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Footer Content</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::textarea('footer_content', null, ['class' => 'form-control  tinymce-basic', 'placeholder' => 'Enter Header Content', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Privacy Policy</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::textarea('privacy_policy', null, ['class' => 'form-control  tinymce-basic', 'placeholder' => 'Enter Header Content']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Terms of Codition</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::textarea('terms_condition', null, ['class' => 'form-control  tinymce-basic', 'placeholder' => 'Enter Header Content']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Address</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Display Product Image</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('display_product_images', array(1 => 'Yes', 0 => 'No'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a option', 'required' => 'required']); !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Website Link</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('website_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Webiste Link']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Facebook Link</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('facebook_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Facebook Link']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Twitter Link</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('twitter_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Twitter Link']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Instagram Link</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('instagram_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Instagram Link']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Linkedin Link</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('linkedin_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Linkedin Link']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Google Plus Link</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('google_plus_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Google Plus Link']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Header Color</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::color('header_color', null, ['class' => 'form-control colorpicker', 'placeholder' => 'Enter Header Color']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Footer Color</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::color('footer_color', null, ['class' => 'form-control colorpicker', 'placeholder' => 'Enter Footer Color']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Theme Primary Color</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::color('theme_primary_color', null, ['class' => 'form-control colorpicker', 'placeholder' => 'Enter Theme Primary Color']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Theme Variant Color</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::color('theme_variant_color', null, ['class' => 'form-control colorpicker', 'placeholder' => 'Enter Theme Variant Color']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Currency</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('currency', null, ['class' => 'form-control', 'placeholder' => 'Enter Currency']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">GST. Tax</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('tax', null, ['class' => 'form-control', 'placeholder' => 'Enter Tax %', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Delivery Module Enable</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('is_delivery', array(1 => 'Yes', 0 => 'No'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a option', 'required' => 'required']); !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Delivery Flat Charges</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('delivery_flat_charges', null, ['class' => 'form-control', 'placeholder' => 'Enter Delivery Flat Charges']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Delivery Time</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('delivery_time', null, ['class' => 'form-control', 'placeholder' => 'Enter Delivery Time in Minutes', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Minimum Order</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('minimum_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Minimum Order in Rupees', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-2"><label class="form-label" for="fv-topics">Day</label></div>
                                            <div class="col-md-5"><label class="form-label" for="fv-topics">Open Time</label></div>
                                            <div class="col-md-5"><label class="form-label" for="fv-topics">Close Time</label></div>

                                            <div class="col-md-2"><label class="form-label" for="fv-topics">Monday</label></div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('monday_open_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('monday_close_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2"><label class="form-label" for="fv-topics">Tuesday</label></div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('tuesday_open_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('tuesday_close_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2"><label class="form-label" for="fv-topics">Wednesday</label></div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('wednesday_open_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('wednesday_close_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2"><label class="form-label" for="fv-topics">Thursday</label></div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('thursday_open_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('thursday_close_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2"><label class="form-label" for="fv-topics">Friday</label></div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('friday_open_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('friday_close_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2"><label class="form-label" for="fv-topics">Saturday</label></div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('saturday_open_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('saturday_close_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2"><label class="form-label" for="fv-topics">Sunday</label></div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('sunday_open_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-clock"></em>
                                                        </div>
                                                        {!! Form::text('sunday_close_time', null, ['class' => 'form-control time-picker', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {!! Form::button('<i class="fa fa-check-square-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div><!-- .nk-block -->
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
