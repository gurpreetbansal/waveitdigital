<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class EmailTemplateController extends Controller {

    public function subscription_trial_invoice(Request $request) {
        return view('mails.email_templates.subscription_trial_invoice');
    }

    public function admin_subscription_trial_invoice(Request $request) {
        return view('mails.email_templates.admin_subscription_trial_invoice');
    } 

    public function subscription_invoice(Request $request) {
        return view('mails.email_templates.subscription_invoice');
    }

    public function admin_subscription_invoice(Request $request) {
        return view('mails.email_templates.admin_subscription_invoice');
    } 

    public function welcome_email(Request $request) {
        return view('mails.email_templates.welcome_email');
    }

    public function activate_account(Request $request) {
        return view('mails.email_templates.activate_account');
    }

    public function recover_password(Request $request) {
        return view('mails.email_templates.recover_password');
    }

    public function vanity_url(Request $request) {
        return view('mails.email_templates.vanity_url');
    }

    public function removed_access(Request $request) {
        return view('mails.email_templates.removed_access');
    }

    public function access_added(Request $request) {
        return view('mails.email_templates.access_added');
    }
    
    public function access_updated(Request $request) {
        return view('mails.email_templates.access_updated');
    }

    public function notification_alerts(Request $request) {
        return view('mails.email_templates.notification_alerts');
    }
    
    public function subscription_cancellation(Request $request) {
        return view('mails.email_templates.subscription_cancellation');
    }
    
    public function admin_subscription_cancellation(Request $request) {
        return view('mails.email_templates.admin_subscription_cancellation');
    }

}
