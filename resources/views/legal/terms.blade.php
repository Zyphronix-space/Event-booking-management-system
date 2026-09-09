@extends('layouts.app')

@section('title', 'Terms and Conditions')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="mb-3">Terms and Conditions</h1>
            <p class="text-muted">Last updated: {{ date('d M Y') }}</p>

            <p>These terms cover use of this Event Ticket Booking platform, an individual student project operated by Stephan Wasalathanthrige. This is a portfolio project, not a commercial ticketing service, and these terms are not a substitute for legal advice.</p>

            <h2 class="h4 mt-4">Use of the site</h2>
            <p>You may browse events without an account. Booking a ticket requires creating a customer account. You are responsible for keeping your login details confidential and for the accuracy of the information you submit.</p>

            <h2 class="h4 mt-4">Accounts and roles</h2>
            <p>The platform has three account types: Customer (self-registration), Organizer (created by an administrator), and Admin. Each account type can only access the areas of the site relevant to its role.</p>

            <h2 class="h4 mt-4">Bookings and payment</h2>
            <p>When you book tickets, you select a payment method of "Card" or "Cash" for record-keeping. This platform is not connected to a live payment gateway or processor: no card details are collected, and no real payment is processed through the site itself. Booking and cancellation are tracked as database records for demonstration purposes.</p>

            <h2 class="h4 mt-4">Cancellations and refunds</h2>
            <p>Customers can cancel their own bookings from the "My Bookings" page. Because no live payment processing is connected to this platform, no refund process is implemented or promised beyond the cancellation itself.</p>

            <h2 class="h4 mt-4">Event information</h2>
            <p>Event listings (name, date, venue, category, price) are entered by organizers or administrators. This platform does not verify the accuracy of event details submitted by organizers.</p>

            <h2 class="h4 mt-4">Acceptable use</h2>
            <p>You agree not to misuse the platform, including attempting to access accounts or data that are not yours, or interfering with the normal operation of the site.</p>

            <h2 class="h4 mt-4">Intellectual property</h2>
            <p>The code and design of this platform are the work of Stephan Wasalathanthrige, built as a portfolio project. Third-party libraries used (such as Bootstrap) remain the property of their respective owners under their own licenses.</p>

            <h2 class="h4 mt-4">Availability</h2>
            <p>As a student project, this site is not guaranteed to be continuously available, error-free, or maintained on any particular schedule.</p>

            <h2 class="h4 mt-4">Limitation of liability</h2>
            <p>This platform is provided as-is, for demonstration purposes, without warranties of any kind. The operator is not liable for any loss arising from use of the site.</p>

            <h2 class="h4 mt-4">Changes to these terms</h2>
            <p>These terms may be updated as the platform changes. The "last updated" date at the top of this page reflects the most recent revision.</p>

            <h2 class="h4 mt-4">Contact</h2>
            <p>Questions about these terms can be sent to <a href="mailto:stephanwasalathanthrige@gmail.com">stephanwasalathanthrige@gmail.com</a>.</p>
        </div>
    </div>
@endsection
