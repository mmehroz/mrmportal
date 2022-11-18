<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity;

    protected $fillable = [
        'client_name', 'contact_number', 'header_content', 'footer_content', 'privacy_policy', 'terms_condition', 'address', 'display_product_images', 'website_link', 'facebook_link','twitter_link', 'instagram_link', 'linkedin_link', 'google_plus_link', 'mode_dark', 'header_color','footer_color', 'theme_primary_color', 'theme_variant_color', 'currency', 'is_delivery','delivery_flat_charges', 'logo_header', 'logo_footer', 'fav_icon', 'minimum_order', 'delivery_time', 'tax', 'monday_open_time', 'monday_close_time', 'tuesday_open_time', 'tuesday_close_time', 'wednesday_open_time', 'wednesday_close_time', 'thursday_open_time', 'thursday_close_time', 'friday_open_time', 'friday_close_time', 'saturday_open_time', 'saturday_close_time', 'sunday_open_time', 'sunday_close_time'
    ];

    protected static $logAttributes = [
        'client_name', 'contact_number', 'header_content', 'footer_content', 'privacy_policy', 'terms_condition', 'address', 'display_product_images', 'website_link', 'facebook_link','twitter_link', 'instagram_link', 'linkedin_link', 'google_plus_link', 'header_color','footer_color', 'theme_primary_color', 'theme_variant_color', 'currency', 'is_delivery','delivery_flat_charges', 'logo_header', 'logo_footer', 'fav_icon', 'minimum_order', 'delivery_time', 'tax', 'monday_open_time', 'monday_close_time', 'tuesday_open_time', 'tuesday_close_time', 'wednesday_open_time', 'wednesday_close_time', 'thursday_open_time', 'thursday_close_time', 'friday_open_time', 'friday_close_time', 'saturday_open_time', 'saturday_close_time', 'sunday_open_time', 'sunday_close_time'
    ];
}
