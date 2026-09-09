@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="mb-3">Privacy Policy</h1>
            <p class="text-muted">Last updated: {{ date('d M Y') }}</p>

            <p>This Event Ticket Booking platform is an individual student project built and operated by Stephan Wasalathanthrige, not a registered company. This policy explains what information the platform collects, why, and how it is handled.</p>

            <h2 class="h4 mt-4">Who operates this site</h2>
            <p>Operated by Stephan Wasalathanthrige. Contact: <a href="mailto:stephanwasalathanthrige@gmail.com">stephanwasalathanthrige@gmail.com</a>.</p>

            <h2 class="h4 mt-4">Information collected</h2>
            <p>The platform collects only the information needed to create an account and process a booking:</p>
            <ul>
                <li><strong>Customers:</strong> full name, email address, an optional phone number, a username, and a password (stored as a secure hash, never in plain text).</li>
                <li><strong>Organizers:</strong> organizer name, contact email, an optional contact number, a username, and a password (stored as a secure hash). Organizer accounts are created by an administrator, not through self-registration.</li>
                <li><strong>Bookings:</strong> the event booked, ticket quantity, a selected payment method (Card or Cash), and the resulting amount and status. No card numbers or other card details are collected or stored by this platform, because it is not connected to a live payment processor.</li>
            </ul>

            <h2 class="h4 mt-4">Why this information is collected</h2>
            <p>Account details are used to authenticate you and to associate bookings with the correct customer or organizer. Booking details are used to confirm and, where requested, cancel a booking, and to show organizers and administrators the bookings relevant to their role.</p>

            <h2 class="h4 mt-4">Cookies and similar technologies</h2>
            <p>This site uses only the cookies Laravel (the framework it is built on) requires to function: a session cookie that keeps you logged in as you move between pages, and a CSRF token cookie that protects forms from cross-site request forgery. These are strictly necessary, are not used for advertising or analytics, and are not shared with any third party. No analytics, advertising, or tracking cookies are used, and no separate cookie consent banner is shown because nothing non-essential is set.</p>

            <h2 class="h4 mt-4">Third-party services</h2>
            <p>Page styling is loaded from the Bootstrap CDN (jsdelivr.net). Loading these files causes your browser to make a request to that third-party CDN, which may log standard web request information (such as IP address) under its own policy. No other third-party services, analytics, or embeds are used on this site.</p>

            <h2 class="h4 mt-4">Data sharing</h2>
            <p>Your information is not sold or shared with third parties. It is visible only to the relevant parts of the platform: administrators can see all accounts and bookings as part of running the platform, and organizers can see bookings made for their own events.</p>

            <h2 class="h4 mt-4">Data retention</h2>
            <p>As a student portfolio project, this platform does not currently have a formal, published data-retention schedule. Account and booking records are kept for as long as the project database exists. If you would like your data removed, contact the email address above.</p>

            <h2 class="h4 mt-4">Data security</h2>
            <p>Passwords are hashed and never stored or displayed in plain text. As with any project, no method of storage or transmission can be guaranteed 100% secure.</p>

            <h2 class="h4 mt-4">Your rights</h2>
            <p>You can review or correct your account details after logging in, or contact the email address above to ask about, correct, or request deletion of your data.</p>

            <h2 class="h4 mt-4">Changes to this policy</h2>
            <p>This policy may be updated as the platform changes. The "last updated" date at the top of this page reflects the most recent revision.</p>

            <h2 class="h4 mt-4">Contact</h2>
            <p>Questions about this policy can be sent to <a href="mailto:stephanwasalathanthrige@gmail.com">stephanwasalathanthrige@gmail.com</a>.</p>
        </div>
    </div>
@endsection
