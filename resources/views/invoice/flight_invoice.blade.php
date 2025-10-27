<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Flight Booking Invoice</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <style>
        :root {
            --primary-blue: #0E6EFD;
            --primary-light: #f0f6ff;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --surface-color: #ffffff;
            --background-color: #f8fafc;
            --text-primary: #374151;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            --border-radius: 8px;
            --border-radius-lg: 12px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--background-color);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.5;
            color: var(--text-primary);
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 1rem;
        }

        .invoice-container {
            background: var(--surface-color);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .invoice-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #3b82f6 100%);
            color: white;
            padding: 1.5rem;
            position: relative;
        }

        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 2;
        }

        .status-badge .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.75rem;
            box-shadow: var(--shadow-sm);
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .header-subtitle {
            opacity: 0.9;
            font-size: 0.85rem;
            font-weight: 400;
        }

        .duration-badge {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .invoice-body {
            padding: 1.5rem;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: var(--primary-blue);
            font-size: 0.9rem;
        }

        .flight-segment {
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            border-left: 3px solid var(--primary-blue);
            margin: 1rem 0;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            transition: all 0.2s ease;
        }

        .flight-segment:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--primary-blue);
        }

        .flight-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .flight-title {
            color: var(--primary-blue);
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .airline-badge {
            background: var(--primary-blue);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .flight-path {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 1.5rem;
            align-items: center;
            margin: 1.5rem 0;
        }

        .airport-info {
            text-align: center;
            padding: 0.8rem;
            background: var(--primary-light);
            border-radius: var(--border-radius);
            border: 1px solid rgba(14, 110, 253, 0.1);
        }

        .airport-code {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.2rem;
        }

        .airport-city {
            color: var(--text-secondary);
            font-size: 0.75rem;
            font-weight: 500;
            margin-bottom: 0.8rem;
        }

        .flight-time {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-primary);
            margin-bottom: 0.1rem;
        }

        .flight-date {
            color: var(--text-secondary);
            font-size: 0.75rem;
        }

        .flight-arrow-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
            padding: 0.5rem;
        }

        .flight-arrow {
            color: var(--primary-blue);
            font-size: 1.2rem;
        }

        .flight-type {
            color: var(--text-secondary);
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .flight-duration {
            color: var(--primary-blue);
            font-weight: 500;
            font-size: 0.75rem;
        }

        .flight-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 0.8rem;
            margin-top: 1.5rem;
            padding: 1rem;
            background: #f9fafb;
            border-radius: var(--border-radius);
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .detail-label {
            color: var(--text-secondary);
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .detail-value {
            color: var(--text-primary);
            font-weight: 500;
            font-size: 0.8rem;
        }

        .passenger-card {
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin: 0.8rem 0;
            transition: all 0.2s ease;
        }

        .passenger-card:hover {
            box-shadow: var(--shadow-md);
        }

        .passenger-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .passenger-info h5 {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.2rem;
            font-size: 1rem;
        }

        .passenger-role {
            color: var(--text-secondary);
            font-size: 0.75rem;
            font-weight: 400;
        }

        .passenger-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 0.8rem;
            margin: 1rem 0;
        }

        .contact-info {
            background: #f9fafb;
            padding: 1rem;
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            height: fit-content;
        }

        .contact-info h6 {
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: var(--text-primary);
            font-size: 0.85rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        .contact-item i {
            color: var(--primary-blue);
            width: 12px;
            font-size: 0.7rem;
        }

        .payment-section {
            background: #f9fafb;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            margin-top: 1.5rem;
        }

        .form-select {
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 0.7rem;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 2px rgba(14, 110, 253, 0.1);
        }

        .price-breakdown {
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.2rem;
        }

        .price-breakdown h6 {
            color: var(--text-secondary);
            font-weight: 600;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            font-size: 0.75rem;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.8rem;
        }

        .price-item:last-child {
            border-bottom: none;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.9rem;
            padding-top: 0.8rem;
            margin-top: 0.3rem;
            border-top: 1px solid var(--border-color);
        }

        .price-item span:first-child {
            color: var(--text-secondary);
        }

        .price-item span:last-child {
            font-weight: 500;
            color: var(--text-primary);
        }

        .amount-display {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #3b82f6 100%);
            color: white;
            padding: 1.2rem;
            border-radius: var(--border-radius);
            text-align: center;
            margin: 1rem 0;
        }

        .amount-display h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .amount-display p {
            opacity: 0.9;
            font-size: 0.8rem;
            margin: 0;
        }

        .btn-pay {
            background: var(--primary-blue);
            border: none;
            padding: 0.8rem 2rem;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 25px;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
        }

        .btn-pay:hover {
            background: #0056d6;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .footer-section {
            text-align: center;
            margin-top: 2rem;
            padding: 1.5rem 0;
            border-top: 1px solid var(--border-color);
        }

        .footer-section p {
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        .footer-section strong {
            color: var(--text-primary);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0.5rem;
            }

            .invoice-header {
                padding: 1rem;
            }

            .header-title {
                font-size: 1.3rem;
            }

            .status-badge {
                position: static;
                text-align: center;
                margin-bottom: 1rem;
            }

            .invoice-body {
                padding: 1rem;
            }

            .flight-segment {
                padding: 1rem;
            }

            .flight-path {
                grid-template-columns: 1fr;
                gap: 0.8rem;
                text-align: center;
            }

            .flight-arrow-container {
                transform: rotate(90deg);
                margin: 0.3rem 0;
            }

            .airport-code {
                font-size: 1.3rem;
            }

            .passenger-card {
                padding: 1rem;
            }

            .payment-section {
                padding: 1rem;
            }

            .amount-display h3 {
                font-size: 1.5rem;
            }

            .btn-pay {
                padding: 0.7rem 1.5rem;
                font-size: 0.8rem;
            }

            .flight-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .flight-details {
                grid-template-columns: 1fr;
            }

            .price-breakdown {
                padding: 1rem;
            }

            .section-title {
                font-size: 0.9rem;
            }
        }


        .error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-left: 4px solid #ef4444;
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
    animation: slideIn 0.3s ease-out;
}

.error h5 {
    color: #dc2626;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.error h5:before {
    content: "\f071";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    color: #ef4444;
    font-size: 1rem;
}

.error h6 {
    color: var(--text-secondary);
    font-weight: 400;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
    background: white;
    padding: 1rem;
    border-radius: var(--border-radius);
    border: 1px solid #fecaca;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mobile responsive */
@media (max-width: 768px) {
    .error {
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .error h5 {
        font-size: 1rem;
    }

    .error h6 {
        font-size: 0.85rem;
        padding: 0.8rem;
    }
}
    </style>
</head>
<body>


@php
    $segmentData = is_array($booking->booking_flight_segment) ? $booking->booking_flight_segment : json_decode($booking->booking_flight_segment, true);
    $guestData = is_array($booking->booking_guest) ? $booking->booking_guest : json_decode($booking->booking_guest, true);
    $responseError = $booking->booking_response_error ? (is_array($booking->booking_response_error) ? $booking->booking_response_error : json_decode($booking->booking_response_error, true)) : null;
@endphp

<div class="container py-4">
    @if(!empty($responseError))
    <div class="error">
        <h5>{{ is_array($responseError) ? $responseError[0]['title'] ?? 'Error' : 'Error' }}</h5>
        <h6>{{ is_array($responseError) ? $responseError[0]['detail'] ?? 'Unknown error' : $responseError }}</h6>
    </div>
    @endif
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="status-badge">
                @if($booking->booking_status_flag == "confirmed")
                    <span class="badge bg-success">
                        <i class="fas fa-check me-1"></i>Confirmed
                    </span>
                @else
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-clock me-1"></i>Awaiting Payment
                    </span>
                @endif
            </div>
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="header-title">
                        <i class="fas fa-plane me-2"></i>Flight Booking Invoice
                    </h1>
                    <div class="header-subtitle">
                        <p class="mb-1">Booking Reference: <strong>#{{ $booking->booking_code_ref }}</strong></p>
                        @if(!empty($booking->booking_air_pnr))
                        <p class="mb-1">Booking Air PNR: <strong>{{ $booking->booking_air_pnr }}</strong></p>
                        @endif
                        <p class="mb-0">Issued: <strong>{{ $booking->created_at->format('D, d M Y') }}</strong></p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-2 mt-lg-0">
                    <div class="duration-badge">
                        <i class="fas fa-clock me-1"></i>Duration: {{ $booking->flight_details['duration'] ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-body">
            <!-- Flight Segments -->
            <div class="mb-4">
                <h4 class="section-title">
                    <i class="fas fa-route"></i>Flight Itinerary
                </h4>

@if(!empty($segmentData['segments']) && is_array($segmentData['segments']))
    @foreach($segmentData['segments'] as $segmentGroup)
        @if(is_array($segmentGroup))
            @foreach($segmentGroup as $segment)
            <div class="flight-segment">
                <div class="flight-header">
                    <h5 class="flight-title">
                        <i class="fas fa-plane-departure"></i>Flight Segment
                    </h5>
                    <span class="airline-badge">{{ $segment['airline_name'] ?? 'N/A' }} • {{ $segment['flight_number'] ?? 'N/A' }}</span>
                </div>

                <div class="flight-path">
                    <div class="airport-info">
                        <div class="airport-code">{{ $segment['departure']['airport'] ?? 'N/A' }}</div>
                        <div class="airport-city">{{ $segment['departure']['city_name'] ?? 'N/A' }}</div>
                        <div class="flight-time">{{ $segment['departure']['time'] ?? 'N/A' }}</div>
                        <div class="flight-date">{{ $segment['departure']['date_convert'] ?? 'N/A' }}</div>
                    </div>

                    <div class="flight-arrow-container">
                        <i class="fas fa-plane flight-arrow"></i>
                        <div class="flight-type">{{ $segment['stop_count'] == 0 ? 'Direct' : $segment['stop_count'] . ' Stop(s)' }}</div>
                        <div class="flight-duration">{{ $segment['duration'] ?? 'N/A' }}</div>
                    </div>

                    <div class="airport-info">
                        <div class="airport-code">{{ $segment['arrival']['airport'] ?? 'N/A' }}</div>
                        <div class="airport-city">{{ $segment['arrival']['city_name'] ?? 'N/A' }}</div>
                        <div class="flight-time">{{ $segment['arrival']['time'] ?? 'N/A' }}</div>
                        <div class="flight-date">{{ $segment['arrival']['date_convert'] ?? 'N/A' }}</div>
                    </div>
                </div>

                <div class="flight-details">
                    <div class="detail-item">
                        <span class="detail-label">Flight Number</span>
                        <span class="detail-value">{{ $segment['flight_number'] ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Class</span>
                        <span class="detail-value">{{ $segment['class'] ?? 'Economy' }} Class</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Checked Baggage</span>
                        <span class="detail-value">{{ $segment['baggage'] ?? 0 }} kg</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Cabin Baggage</span>
                        <span class="detail-value">{{ $segment['cabin_baggage'] ?? 0 }} kg</span>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    @endforeach
@endif
            </div>

            <!-- Passenger Info -->
            <div class="mb-4">
                <h4 class="section-title">
                    <i class="fas fa-users"></i>Passenger Details
                </h4>

@if(!empty($guestData) && is_array($guestData))
    @foreach($guestData as $passenger)
    <div class="passenger-card">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="passenger-avatar me-3">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="passenger-info">
                        <h5>{{ ($passenger['first_name'] ?? '') . ' ' . ($passenger['last_name'] ?? '') }}</h5>
                        <div class="passenger-role">{{ ucfirst($passenger['traveller_type'] ?? 'Passenger') }}</div>
                    </div>
                </div>
                <div class="passenger-details">
                    <div class="detail-item">
                        <span class="detail-label">Gender</span>
                        <span class="detail-value">{{ $passenger['gender'] ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Date of Birth</span>
                        <span class="detail-value">
                            @if(!empty($passenger['dob_day']) && !empty($passenger['dob_month']) && !empty($passenger['dob_year']))
                                {{ $passenger['dob_day'] }}/{{ $passenger['dob_month'] }}/{{ $passenger['dob_year'] }}
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Passport</span>
                        <span class="detail-value">{{ $passenger['passport'] ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-3 mt-lg-0">
                <div class="contact-info">
                    <h6>Contact Information</h6>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $passenger['email'] ?? 'N/A' }}</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $passenger['phone'] ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif
            </div>

            @if($booking->booking_status_flag != "confirmed" && $booking->booking_payment_status != "paid")
            <!-- Payment Section -->
            <div class="payment-section">
                <h4 class="section-title">
                    <i class="fas fa-credit-card"></i>Payment Information
                </h4>

                <form method="get" action="{{ route('payment', ['gateway_name' => strtolower($booking->booking_payment_gateway), 'booking_ref' => $booking->booking_code_ref]) }}">
                    <div class="mb-3">
                        <label for="payment_method" class="form-label fw-bold mb-2" style="font-size: 0.85rem;">Select Payment Method</label>
                        <select class="form-select" id="payment_method" required>
                            <option value="">Choose your preferred payment method</option>
                            <option value="stripe">Stripe</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <div class="price-breakdown">
                                <h6>Price Breakdown</h6>
                                <div class="price-item">
                                    <span>Base Fare ({{ $booking->passenger_count }})</span>
                                    <span>{{ $booking->booking_currency_origin }} {{ $booking->booking_fare_base }}</span>
                                </div>
                                <div class="price-item">
                                    <span>Taxes & Fees</span>
                                    <span>{{ $booking->booking_currency_origin}} 0.00</span>
                                </div>
                                <div class="price-item">
                                    <span>Service Charge</span>
                                    <span>{{ $booking->booking_currency_origin}} 0.00</span>
                                </div>
                                <div class="price-item">
                                    <span>Total Amount</span>
                                    <span>{{ $booking->booking_currency_origin}} {{ $booking->booking_fare_base}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="amount-display">
                                <h3>{{ $booking->booking_currency_origin}} {{ $booking->booking_fare_base}}</h3>
                                <p>Total Amount Due</p>
                            </div>
                            <button type="submit" class="btn btn-primary btn-pay w-100">
                                <i class="fas fa-shield-alt me-2"></i>Pay Securely Now
                            </button>
                            <div class="text-center mt-2">
                                <small class="text-muted" style="font-size: 0.7rem;">
                                    <i class="fas fa-lock me-1"></i>256-bit SSL encryption • Money-back guarantee
                                </small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endif

            <!-- Footer -->
            <div class="footer-section">
                <p><strong>Need Help?</strong> Contact our 24/7 customer support</p>
                <p>
                    <i class="fas fa-phone me-1"></i>+1-800-FLIGHTS |
                    <i class="fas fa-envelope me-1"></i>support@codeweblo.com |
                    <i class="fas fa-comments me-1"></i>Live Chat Available
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Simple interactivity
    document.getElementById('payment_method').addEventListener('change', function() {
        const payButton = document.querySelector('.btn-pay');
        if (this.value) {
            payButton.style.background = '#10b981';
            payButton.innerHTML = '<i class="fas fa-check me-2"></i>Proceed with ' + this.options[this.selectedIndex].text;
        } else {
            payButton.style.background = '#0E6EFD';
            payButton.innerHTML = '<i class="fas fa-shield-alt me-2"></i>Pay Securely Now';
        }
    });

    // Simple hover effects
    document.querySelectorAll('.passenger-card, .flight-segment').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Loading state for payment
    document.querySelector('form')?.addEventListener('submit', function(e) {
        const payButton = document.querySelector('.btn-pay');
        if (payButton) {
            payButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            payButton.disabled = true;
        }
    });
</script>
</body>
</html>
